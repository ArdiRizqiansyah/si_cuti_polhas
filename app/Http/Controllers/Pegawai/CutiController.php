<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Pegawai;
use App\Models\PegawaiUnit;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cuti = Izin::with('pegawai')->joinCuti()->where('pegawai_id', auth()->user()->pegawai->id)->filter($request->keyword)->paginate(10);

        $data = [
            'cuti' => $cuti,
        ];

        return view('pegawai.cuti.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit_id = auth()->user()->pegawai->unit_id;

        $data = [
            'page' => 'Tambah',
            'url' => route('pegawai.cuti.store'),
            'pengganti' => Pegawai::where('unit_id', $unit_id)->where('kepala_id', null)->where('user_id', '!=', auth()->user()->id)->get(),
        ];

        return view('pegawai.cuti.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'tgl_mulai' => 'required|before:tgl_akhir',
            'tgl_akhir' => 'required',
            'pengganti_id' => 'required',
        ]);

        $data = [
            'jenis' => $request->jenis,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'permohonan' => 2,
            'status' => 3,
            'pegawai_id' => auth()->user()->pegawai->id,
            'pengganti_id' => $request->pengganti_id,
            'unit_id' => auth()->user()->pegawai->unit_id,
        ];

        Izin::create($data);

        return redirect()->route('pegawai.cuti.index')->with('success', 'Cuti berhasil diajukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit_id = auth()->user()->pegawai->unit_id;

        $data = [
            'cuti' => Izin::find($id),
            'page' => 'Edit',
            'url' => route('pegawai.cuti.update', $id),
            'pengganti' => Pegawai::where('unit_id', $unit_id)->where('kepala_id', null)->where('user_id', '!=', auth()->user()->id)->get(),
        ];

        return view('pegawai.cuti.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cuti = Izin::find($id);

        if($cuti->status != 3){
            return redirect()->route('pegawai.cuti.index')->with('error', 'Cuti tidak dapat diubah');
        }

        $request->validate([
            'jenis' => 'required',
            'tgl_mulai' => 'required|before:tgl_akhir',
            'tgl_akhir' => 'required',
            'pengganti_id' => 'required',
        ]);

        $data = [
            'jenis' => $request->jenis,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'pengganti_id' => $request->pengganti_id,
        ];

        $cuti->update($data);

        return redirect()->route('pegawai.cuti.index', $cuti->pegawai_id)->with('success', 'Cuti berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cuti = Izin::find($id);

        if($cuti->status != 3){
            return redirect()->route('pegawai.cuti.index')->with('error', 'Cuti tidak dapat dihapus');
        }

        $cuti->delete();

        return redirect()->route('pegawai.cuti.index', $cuti->pegawai_id)->with('success', 'Cuti berhasil dihapus');
    }
}

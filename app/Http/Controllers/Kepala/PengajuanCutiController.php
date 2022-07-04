<?php

namespace App\Http\Controllers\Kepala;

use App\Models\Izin;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PengajuanCutiController extends Controller
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

        return view('kepala.pengajuan_cuti.index', $data);
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
            'url' => route('kepala.pengajuan-cuti.store'),
            'pengganti' => Pegawai::where('unit_id', $unit_id)->where('kepala_id', null)->where('user_id', '!=', auth()->user()->id)->get(),
        ];

        return view('kepala.pengajuan_cuti.create', $data);
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

        // cek dokumen
        if ($request->file('dokumen')) {
            $dokumen = $request->file('dokumen');
            $dokumen->storeAs('public/dokumen', $dokumen->hashName());
            $data['dokumen'] = $dokumen->hashName();
        }

        // cek formulir
        if ($request->file('formulir')) {
            $formulir = $request->file('formulir');
            $formulir->storeAs('public/formulir', $formulir->hashName());
            $data['formulir'] = $formulir->hashName();
        }

        Izin::create($data);

        return redirect()->route('kepala.pengajuan-cuti.index')->with('success', 'Cuti berhasil diajukan');
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
            'url' => route('kepala.pengajuan-cuti.update', $id),
            'pengganti' => Pegawai::where('unit_id', $unit_id)->where('kepala_id', null)->where('user_id', '!=', auth()->user()->id)->get(),
        ];

        return view('kepala.pengajuan_cuti.create', $data);
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
            return redirect()->route('kepala.pengajuan-cuti.index')->with('error', 'Cuti tidak dapat diubah');
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

        // cek dokumen
        if ($request->file('dokumen')) {
            $dokumen = $request->file('dokumen');
            $dokumen->storeAs('public/dokumen', $dokumen->hashName());

            // hapus dokumen lama
            if ($cuti->dokumen) {
                Storage::delete('public/dokumen/' . $cuti->dokumen);
            }

            $data['dokumen'] = $dokumen->hashName();
        }

        // cek formulir
        if ($request->file('formulir')) {
            $formulir = $request->file('formulir');
            $formulir->storeAs('public/formulir', $formulir->hashName());
            $data['formulir'] = $formulir->hashName();
        }

        $cuti->update($data);

        return redirect()->route('kepala.pengajuan-cuti.index', $cuti->pegawai_id)->with('success', 'Cuti berhasil diubah');
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
            return redirect()->route('kepala.pengajuan-cuti.index')->with('error', 'Cuti tidak dapat dihapus');
        }

        // hapus dokumen jika ada
        if ($cuti->dokumen) {
            Storage::disk('local')->delete('public/dokumen/' . $cuti->dokumen);
        }

        $cuti->delete();

        return redirect()->route('kepala.pengajuan-cuti.index', $cuti->pegawai_id)->with('success', 'Cuti berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'cuti' => Izin::with(['pegawai'])->joinCuti()->filter($request->keyword)->paginate(10),
        ];

        return view('admin.cuti.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
    public function edit($id, Request $request)
    {
        $unit_id = $request->unit_id;

        $cuti = Izin::find($id);

        $data = [
            'cuti' => $cuti,
            'page' => 'Edit',
            'url' => route('admin.cuti.update', $id),
            'pengganti' => Pegawai::where('unit_id', $unit_id)->where('kepala_id', null)->where('id', '!=', $cuti->pegawai_id)->get(),
        ];

        return view('admin.cuti.create', $data);
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
            return redirect()->route('admin.cuti.index')->with('error', 'Cuti tidak dapat diubah');
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

        $cuti->update($data);

        return redirect()->route('admin.cuti.index')->with('success', 'Cuti berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $izin = Izin::find($id);

        // cek status izin
        if($izin->status == 1){
            return back()->with('error', 'Cuti sudah disetujui Kepala Unit');
        }elseif($izin->status == 2){
            return back()->with('error', 'Cuti sudah ditolak Kepala Unit');
        }else{
            // hapus dokumen lama
            if ($izin->dokumen) {
                Storage::delete('public/dokumen/' . $izin->dokumen);
            }

            $izin->delete();
            return back()->with('success', 'Cuti berhasil dihapus');
        }
    }
}

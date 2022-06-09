<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $izin = Izin::with('pegawai')->joinIzin()->where('pegawai_id', auth()->user()->pegawai->id)->filter($request->keyword)->paginate(10);

        $data = [
            'izin' => $izin,
        ];

        return view('pegawai.izin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'page' => 'Tambah',
            'url' => route('pegawai.izin.store'),
        ];

        return view('pegawai.izin.create', $data);
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
            // 'pengganti_id' => 'required',
        ]);

        $data = [
            'jenis' => $request->jenis,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'permohonan' => 1,
            'status' => 3,
            'pegawai_id' => auth()->user()->pegawai->id,
            // 'pengganti_id' => $request->pengganti_id,
            'unit_id' => auth()->user()->pegawai->unit_id,
        ];

        // cek dokumen
        if ($request->file('dokumen')) {
            $dokumen = $request->file('dokumen');
            $dokumen->storeAs('public/dokumen', $dokumen->hashName());
            $data['dokumen'] = $dokumen->hashName();
        }

        Izin::create($data);

        return redirect()->route('pegawai.izin.index')->with('success', 'Izin berhasil diajukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'izin' => Izin::find($id),
            'page' => 'Edit',
            'url' => route('pegawai.izin.update', $id),
        ];

        return view('pegawai.izin.create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'izin' => Izin::find($id),
            'page' => 'Edit',
            'url' => route('pegawai.izin.update', $id),
        ];

        return view('pegawai.izin.create', $data);
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
        $izin = Izin::find($id);

        if($izin->status != 3){
            return redirect()->route('pegawai.izin.index')->with('error', 'Izin tidak dapat diubah');
        }

        $request->validate([
            'jenis' => 'required',
            'tgl_mulai' => 'required|before:tgl_akhir',
            'tgl_akhir' => 'required',
            // 'pengganti_id' => 'required',
        ]);

        $data = [
            'jenis' => $request->jenis,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            // 'pengganti_id' => $request->pengganti_id,
        ];

        // cek dokumen
        if ($request->file('dokumen')) {
            $dokumen = $request->file('dokumen');
            $dokumen->storeAs('public/dokumen', $dokumen->hashName());

            // hapus dokumen lama
            if ($izin->dokumen) {
                Storage::delete('public/dokumen/' . $izin->dokumen);
            }

            $data['dokumen'] = $dokumen->hashName();
        }

        $izin->update($data);

        return redirect()->route('pegawai.izin.index', $izin->pegawai_id)->with('success', 'Izin berhasil diubah');
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

        if($izin->status != 3){
            return redirect()->route('pegawai.izin.index')->with('error', 'Izin tidak dapat dihapus');
        }

        // hapus dokumen lama
        if ($izin->dokumen) {
            Storage::delete('public/dokumen/' . $izin->dokumen);
        }

        $izin->delete();

        return redirect()->route('pegawai.izin.index', $izin->pegawai_id)->with('success', 'Izin berhasil dihapus');
    }
}

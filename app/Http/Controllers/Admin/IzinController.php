<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'izin' => Izin::with(['pegawai'])->joinIzin()->filter($request->keyword)->paginate(10),
        ];

        return view('admin.izin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data = [
            'izin' => Izin::find($id),
            'page' => 'Edit',
            'url' => route('admin.izin.update', $id),
        ];

        return view('admin.izin.create', $data);
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
            return redirect()->route('admin.izin.index')->with('error', 'Izin tidak dapat diubah');
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

        $izin->update($data);

        return redirect()->route('admin.izin.index', $izin->pegawai_id)->with('success', 'Izin berhasil diubah');
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
            return back()->with('error', 'Izin sudah disetujui Kepala Unit');
        }elseif($izin->status == 2){
            return back()->with('error', 'Izin sudah ditolak Kepala Unit');
        }else{
            $izin->delete();
            return back()->with('success', 'Izin berhasil dihapus');
        }
    }
}

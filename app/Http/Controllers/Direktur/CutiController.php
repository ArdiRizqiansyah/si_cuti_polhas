<?php

namespace App\Http\Controllers\Direktur;

use App\Models\Izin;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kepala_id = Pegawai::where('kepala_id', 1)->pluck('id');

        $cuti = Izin::whereIn('izin.pegawai_id', $kepala_id)->joinCuti()->filter($request->keyword)->paginate(10);

        $data = [
            'cuti' => $cuti,
        ];

        return view('direktur.cuti.index', $data);
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
        //
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
        if($request->permohonan == 'setuju'){
            $izin = Izin::find($id);
            if($izin->potongan === null){
                return redirect()->back()->with('error', 'Pastikan saldo terpotong telah diatur');

            }
            $izin->update([
                'keterangan' => $request->keterangan,
                'status' => 1,
            ]);
        }else{
            $izin = Izin::find($id);
            $izin->update([
                'keterangan' => $request->keterangan,
                'status' => 2,
            ]);
        }

        return redirect()->route('direktur.cuti.index')->with('success', 'Permohonan Cuti Pegawai berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function potongan(Request $request)
    {
        $izin = Izin::find($request->cuti);
        $izin->update([
            'potongan' => $request->potongan,
        ]);

        return redirect()->route('direktur.cuti.index')->with('success', 'Potongan Cuti Pegawai berhasil diubah');
    }
}

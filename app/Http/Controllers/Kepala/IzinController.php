<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Unit;
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
        $izin = Izin::where('izin.unit_id', auth()->user()->pegawai->kepala_id)->joinIzin()->filter($request->keyword)->paginate(10);

        $data = [
            'izin' => $izin,
        ];

        return view('kepala.izin.index', $data);
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

        return redirect()->route('kepala.izin.index')->with('success', 'Permohonan Izin Pegawai berhasil diubah');
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
}

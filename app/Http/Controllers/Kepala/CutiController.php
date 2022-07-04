<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Unit;
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
        $cuti = Izin::where('izin.unit_id', auth()->user()->pegawai->kepala_id)->where('pegawai_id', '!=', auth()->user()->pegawai->id)->joinCuti()->filter($request->keyword)->paginate(10);

        $data = [
            'cuti' => $cuti,
        ];

        return view('kepala.cuti.index', $data);
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
                'status' => 1,
            ]);
        }else{
            $izin = Izin::find($id);
            $izin->update([
                'status' => 2,
            ]);
        }

        return redirect()->route('kepala.cuti.index')->with('success', 'Permohonan Cuti Pegawai berhasil diubah');
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

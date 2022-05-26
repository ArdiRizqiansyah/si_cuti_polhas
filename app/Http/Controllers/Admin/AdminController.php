<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $table_izin = Izin::all();
        $izin = $table_izin->where('permohonan', 1);
        $cuti = $table_izin->where('permohonan', 2);

        $group_izin = Izin::where('permohonan', 1)->filterYear($request->tahun_izin)->groupByMonth()->get();
        $group_cuti = Izin::where('permohonan', 2)->filterYear($request->tahun_cuti)->groupByMonth()->get();

        $izin_perbulan = [];
        $cuti_perbulan = [];

        for ($i=0; $i < 12; $i++) { 
            foreach ($group_izin as $ci) {
                if($ci->bulan-1 == $i){
                    $izin_perbulan[$i] = $ci->jumlah;
                }else{
                    $izin_perbulan[$i] = 0;
                }
            }
        }

        for ($i=0; $i < 12; $i++) { 
            foreach ($group_cuti as $cc) {
                if($cc->bulan-1 == $i){
                    $cuti_perbulan[$i] = $cc->jumlah;
                }else{
                    $cuti_perbulan[$i] = 0;
                }
            }
        }

        $data = [
            'izin' => $izin,
            'cuti' => $cuti,
            'pegawai' => Pegawai::all(),
            'chart_izin' => $izin_perbulan,
            'chart_cuti' => $cuti_perbulan,
        ];        

        return view('admin.dashboard', $data);
    }
}

<?php

namespace App\Http\Controllers\Direktur;

use App\Models\Izin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;

class DashboardController extends Controller
{
    public function index()
    {
        $kepala_id = Pegawai::where('kepala_id', 1)->pluck('id');

        $izin = Izin::with(['pegawai'])->whereIn('pegawai_id', $kepala_id)->get();

        $data = [
            'izin' => $izin->where('permohonan', 1),
            'cuti' => $izin->where('permohonan', 2),
        ];

        return view('direktur.dashboard', $data);
    }
}

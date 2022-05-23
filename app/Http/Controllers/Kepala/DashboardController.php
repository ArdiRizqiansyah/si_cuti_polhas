<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $izin = Izin::with(['pegawai'])->where('unit_id', auth()->user()->pegawai->kepala_id)->get();

        $data = [
            'izin' => $izin->where('permohonan', 1),
            'cuti' => $izin->where('permohonan', 2),
        ];

        return view('kepala.dashboard', $data);
    }
}

<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $izin = Izin::where('pegawai_id', auth()->user()->pegawai->id)->get();

        $data = [
            'izin' => $izin->where('permohonan', 1),
            'cuti' => $izin->where('permohonan', 2),
        ];

        return view('pegawai.dashboard', $data);
    }
}

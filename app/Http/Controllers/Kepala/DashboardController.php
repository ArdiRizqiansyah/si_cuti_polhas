<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $izin = Unit::with('izin')->where('pegawai_id', auth()->user()->pegawai->id)->first();

        $data = [
            'izin' => $izin->izin->where('permohonan', 1),
            'cuti' => $izin->izin->where('permohonan', 2),
        ];

        return view('kepala.dashboard', $data);
    }
}

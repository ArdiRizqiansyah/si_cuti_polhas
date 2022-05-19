<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $izin = Izin::all();

        $data = [
            'izin' => $izin->where('permohonan', 1),
            'cuti' => $izin->where('permohonan', 2),
            'pegawai' => Pegawai::all(),
        ];

        return view('admin.dashboard', $data);
    }
}

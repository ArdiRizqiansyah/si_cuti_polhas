<?php

namespace App\Http\Controllers\Direktur;

use App\Models\Saldo;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaldoController extends Controller
{
    public function index()
    {
        $tahun = $_GET['tahun'] ?? date('Y');

        $data = [
            'saldo' => Saldo::first(),
            'pegawai' => Pegawai::with(['cuti' => function($query) use ($tahun){
                $query->where('status', 1)
                    ->whereYear('created_at', $tahun);
            }])->search($_GET['keyword'] ?? null)->where('kepala_id', 1)->paginate(15),
        ];

        return view('direktur.saldo.index', $data);
    }
}

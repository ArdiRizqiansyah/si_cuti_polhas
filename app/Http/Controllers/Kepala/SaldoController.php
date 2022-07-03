<?php

namespace App\Http\Controllers\Kepala;

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
            }])->search($_GET['keyword'] ?? null)->whereNull('kepala_id')->where('unit_id', auth()->user()->pegawai->unit_id)->paginate(15),
        ];

        return view('kepala.saldo.index', $data);
    }
}

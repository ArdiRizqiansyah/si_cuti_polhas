<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Saldo;
use Illuminate\Http\Request;

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
            }])->search($_GET['keyword'] ?? null)->paginate(15),
        ];

        return view('admin.saldo.index', $data);
    }

    public function updateSaldo(Request $request)
    {
        $saldo = Saldo::first();

        if($saldo){
            $saldo->update(['saldo' => $request->saldo]);
        }else{
            Saldo::create(['saldo' => $request->saldo]);
        }
        
        return back()->with('success', 'Saldo berhasil diperbarui');
    }
}

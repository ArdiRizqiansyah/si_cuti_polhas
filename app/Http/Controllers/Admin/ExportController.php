<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use Illuminate\Http\Request;
use PDF;

class ExportController extends Controller
{
    public function laporanPdf(Request $request)
    {
        $data = [
            'laporan' => Izin::joinPegawai()->filter($request->keyword)->filterBetweenDate($request->tgl_mulai, $request->tgl_akhir)->get(),
        ];

        view()->share($data);
        $pdf = PDF::loadView('export.laporan_pdf', $data);

        return $pdf->download('laporan.pdf');
    }
}

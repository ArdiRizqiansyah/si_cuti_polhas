<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use Illuminate\Http\Request;
// use PDF;
// use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function laporan_pdf(Request $request)
    {
        $data = [
            'laporan' => Izin::joinPegawai()->filter($request->keyword)->filterBetweenDate($request->tgl_mulai, $request->tgl_selesai)->get(),
        ];

        return view('export.laporan_pdf', $data);
    }
}

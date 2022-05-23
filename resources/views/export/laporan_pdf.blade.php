<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Divisi</title>

    <style>
        .text-center{
            text-align: center;
        }

        .mb-0{
            margin-bottom: 0px !important;
        }

        .mt-0{
            margin-top: 0px !important;
        }

        .table{
            border-collapse: collapse;
            padding-top: 10px;
            width: 100%;
        }

        th{
            background-color: #2c4479a4;
        }

        th, td{
            border: 1px solid #000;
            padding: 8px 20px;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h2 class="mb-0">Laporan Permohonan Izin dan Cuti Pegawai</h2>
        <h2 class="mt-0">Di Politeknik Hasnur</h2>
        <hr>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NRP</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $index => $lap )
                <tr>
                    <td>{{ $laporan->firstItem() + $index }}</td>
                    <td>{{ $lap->pegawai->nrp }}</td>
                    <td>{{ $lap->pegawai->nama }}</td>
                    <td>{{ $lap->jenis }}</td>
                    <td>{{ $lap->tgl_mulai }}</td>
                    <td>{{ $lap->tgl_selesai }}</td>
                    <td>{{ $lap->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Divisi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    <style>
        .text-small{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <table class="table border-bottom">
            <tr class="text-center align-items-center" style="width: 100%">
                <td>
                    <img src="{{ asset('images/hasnur-centre-image.png') }}" alt="" width="100px">
                </td>
                <td class="pt-4">
                    <h3 class="mb-0">Yayasan Hasnur Centre</h3>
                    <h3 class="mb-0">Politeknik Hasnur</h3>
                </td>
                <td>
                    <img src="{{ asset('images/logo.png') }}" alt="" width="100px">
                </td>
            </tr>
        </table>

        <div class="text-center">
            <p class="my-0 text-small">Jl. Brigjend H. Hasan Basri Ray 5 No.Km. 11, RT.02/RW.01, Handil Bakti, Kec. Alalak, Kabupaten Barito Kuala, Kalimantan Selatan 70582</p>
            <h2 class="mt-4 mb-0">Laporan Permohonan Izin dan Cuti Pegawai</h2>
            <p><?= date("Y/m/d"); ?></p>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Permohonan</th>
                    <th>Jenis</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $lap )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lap->pegawai->nrp }}</td>
                        <td>{{ $lap->pegawai->nama }}</td>
                        <td>{{ $lap->permohonan == 1 ? 'Izin' : 'Cuti' }}</td>
                        <td>{{ $lap->jenis }}</td>
                        <td>{{ $lap->tgl_mulai }}</td>
                        <td>{{ $lap->tgl_akhir }}</td>
                        <td>
                            @if ($lap->status == 1)
                                Di setujui
                            @elseif ($lap->status == 2)
                                Di tolak
                            @else
                                Menunggu persetujuan
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script>
        window.print();
    </script>
</body>
</html>
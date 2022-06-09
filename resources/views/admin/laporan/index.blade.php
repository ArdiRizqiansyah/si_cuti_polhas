@extends('layouts.app')

@section('title', 'Laporan')

@section('heading')
    <h3 class="text-center">Laporan</h3>
@endsection

@section('content')
    @include('includes.swal_alert')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.laporan.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="{{ old('tgl_mulai') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                                    <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="{{ old('tgl_akhir') }}">
                                </div>
                            </div>
                            <div class="col-md-4 align-self-end pb-2 mb-0 mb-md-1">
                                <button type="submit" class="btn btn-secondary">Filter Laporan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3 justify-content-between">
                        <div class="col-md-4 mb-2 mb-md-0">
                            <a href="{{ route('admin.laporan.export.pdf', ['tgl_mulai' => @$_GET['tgl_mulai'], 'tgl_selesai' => @$_GET['tgl_akhir']]) }}" class="btn btn-warning"><i class="fas fa-print"></i> Cetak Laporan</a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('admin.laporan.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari laporan">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>No</th>
                                        <th>NRP</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Pengganti</th>
                                        <th>Dokumen</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($laporan as $index => $lap )
                                            <tr>
                                                <td>{{ $laporan->firstItem() + $index }}</td>
                                                <td>{{ $lap->pegawai->nrp }}</td>
                                                <td>{{ $lap->pegawai->nama }}</td>
                                                <td>{{ $lap->jenis }}</td>
                                                <td>{{ $lap->getTglPengajuan }}</td>
                                                <td>{{ $lap->tgl_mulai }}</td>
                                                <td>{{ $lap->tgl_akhir }}</td>
                                                <td>{{ $lap->pengganti->nama ?? 'Tidak Ada' }}</td>
                                                <td>
                                                    @if ($lap->dokumen)
                                                        <a href="{{ $lap->getDokumen }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                                    @else
                                                        <span class="text-muted">Tidak ada dokumen</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($lap->status == 1)
                                                        <span class="badge bg-success">Disetujui</span>
                                                    @elseif ($lap->status == 2)
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge bg-info">Menunggu Persetujuan</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="row row-cols-2 align-items-center"> 
                                <div class="col justify-content-start">
                                    {{-- <p>
                                        Showing {{ $cuti->firstItem() }} to {{ $cuti->lastItem() }} of {{ $cuti->total() }} entries 
                                    </p> --}}
                                </div>
                                <div class="col d-flex justify-content-end">
                                    {{ $laporan->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
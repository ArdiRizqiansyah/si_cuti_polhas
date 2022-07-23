@extends('layouts.app')

@section('title', 'Cuti')

@section('heading')
    @include('partials.prosedur_cuti')
    <h3 class="text-center">Pengajuan Cuti</h3>
@endsection

@section('content')
    @include('includes.swal_alert')
    @include('partials.modal_delete')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3 justify-content-between">
                        <div class="col-md-6">
                            <a href="{{ route('kepala.pengajuan-cuti.create') }}" class="btn btn-primary"><i class="fa fa-plus me-1"></i>Tambah Cuti</a>
                            <a href="{{ asset('form_cuti_polhas.xlsx') }}" target="_blank" class="btn btn-secondary"><i class="fa fa-download me-1"></i>Unduh Formulir</a>
                            <a href="{{ asset('prosedur.pdf') }}" target="_blank" class="btn btn-secondary"><i class="fa fa-download me-1"></i>Prosedur Cuti</a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('kepala.pengajuan-cuti.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari Data Cuti">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search me-1"></i>Cari</button>
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
                                        <th>Jenis Cuti</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Jumlah Hari</th>
                                        <th>Dokumen</th>
                                        {{-- <th>Formulir</th> --}}
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($cuti as $index => $c )
                                            <tr>
                                                <td>{{ $cuti->firstItem() + $index }}</td>
                                                <td>{{ $c->nrp }}</td>
                                                <td>{{ $c->nama }}</td>
                                                <td>{{ $c->jenis }}</td>
                                                <td>{{ $c->tgl_mulai }}</td>
                                                <td>{{ $c->tgl_akhir }}</td>
                                                <td>{{ $c->getJumlahHari }} Hari</td>
                                                <td>
                                                    @if ($c->dokumen)
                                                        <a href="{{ $c->getDokumen }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                                    @else
                                                        <span class="text-muted">Tidak ada dokumen</span>
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                    @if ($c->formulir)
                                                        <a href="{{ $c->getformulir }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                                    @else
                                                        <span class="text-muted">Tidak ada formulir</span>
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    @if ($c->status == 1)
                                                        <span class="badge bg-success">Disetujui</span>
                                                    @elseif ($c->status == 2)
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge bg-info">Menunggu Persetujuan</span>
                                                    @endif
                                                </td>
                                                <td>{{ $c->keterangan ?? '-' }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ route('kepala.pengajuan-cuti.edit', ['pengajuan_cuti' => $c->id]) }}" class="btn btn-success"><i class="far fa-edit me-1"></i>Ubah</a>
                                                    <button onclick="hapusData('{{ route('kepala.pengajuan-cuti.destroy', ['pengajuan_cuti' => $c->id]) }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete"><i class="far fa-trash-alt me-1"></i>Hapus</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">Tidak ada data</td>
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
                                    {{ $cuti->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Cuti')

@section('heading')
    <h3 class="text-center">Data Cuti</h3>
@endsection

@section('content')
    @include('includes.swal_alert')
    @include('partials.modal_delete')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3 justify-content-between">
                        <div class="col-md-3">
                            <a href="{{ route('pegawai.cuti.create') }}" class="btn btn-primary">Tambah Cuti</a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('pegawai.cuti.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari Data Cuti">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Cari</button>
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
                                        <th>Status</th>
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
                                                <td>
                                                    @if ($c->status == 1)
                                                        <span class="badge bg-success">Disetujui</span>
                                                    @elseif ($c->status == 2)
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge bg-info">Menunggu Persetujuan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pegawai.cuti.edit', ['cuti' => $c->id]) }}" class="btn btn-success">Ubah</a>
                                                    <button onclick="hapusData('{{ route('pegawai.cuti.destroy', ['cuti' => $c->id]) }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete">Hapus</button>
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
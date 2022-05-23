@extends('layouts.app')

@section('title', 'Pegawai')

@section('heading')
    <h3 class="text-center">Data Pegawai</h3>
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
                            <a href="{{ route('admin.pegawai.create') }}" class="btn btn-primary"><i class="fa fa-plus me-1"></i>Tambah Pegawai</a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('admin.pegawai.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari Pegawai">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search me-1"></i>Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NRP</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
                                    <th>No. WA</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pegawai as $key => $pg)
                                    <tr>
                                        <td>{{ $pegawai->firstItem() + $key }}</td>
                                        <td>{{ $pg->nrp }}</td>
                                        <td>{{ $pg->nama }}</td>
                                        <td>{{ $pg->alamat }}</td>
                                        <td>{{ $pg->getTanggalLahir }}</td>
                                        <td>{{ $pg->jabatan }}</td>
                                        <td>{{ $pg->unit->nama ?? $pg->kepala->nama }}</td>
                                        <td>{{ $pg->no_wa }}</td>
                                        <td>
                                            <a href="{{ route('admin.pegawai.edit.pribadi', ['id' => $pg->id]) }}" class="btn btn-sm btn-success"><i class="far fa-edit me-1"></i>Edit</a>
                                            <button class="btn btn-sm btn-danger" onclick="hapusData('{{ route('admin.pegawai.destroy', ['pegawai' => $pg->id]) }}')" data-bs-toggle="modal" data-bs-target="#modal-delete"><i class="far fa-trash-alt me-1"></i>Hapus</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="9">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
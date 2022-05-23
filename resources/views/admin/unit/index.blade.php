@extends('layouts.app')

@section('title', 'Unit')

@section('heading')
    <h3 class="text-center">Data Unit</h3>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-md-between mb-3">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <a href="{{ route('admin.unit.create') }}" class="btn btn-primary"><i class="fa fa-plus me-1"></i>Tambah</a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('admin.unit.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari Unit">
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
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Kepala Unit</th>
                                    <th>Jumlah Pegawai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $key => $unit)
                                    <tr>
                                        <td>{{ $units->firstItem() + $key }}</td>
                                        <td>{{ $unit->nama }}</td>
                                        <td>{{ $unit->deskripsi }}</td>
                                        <td>{{ $unit->kepala->nama }}</td>
                                        <td>{{ $unit->pegawai->count() }}</td>
                                        <td>
                                            <a href="{{ route('admin.unit.edit', ['unit' => $unit->id]) }}" class="btn btn-success"><i class="far fa-edit me-1"></i>Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            {{ $units->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
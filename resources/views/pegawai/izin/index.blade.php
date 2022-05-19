@extends('layouts.app')

@section('title', 'izin')

@section('heading')
    <h3 class="text-center">Data Izin</h3>
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
                            <a href="{{ route('pegawai.izin.create') }}" class="btn btn-primary">Tambah Izin</a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('pegawai.izin.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari Data Izin">
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
                                        <th>Jenis Izin</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($izin as $index => $i )
                                            <tr>
                                                <td>{{ $izin->firstItem() + $index }}</td>
                                                <td>{{ $i->nrp }}</td>
                                                <td>{{ $i->nama }}</td>
                                                <td>{{ $i->jenis }}</td>
                                                <td>{{ $i->tgl_mulai }}</td>
                                                <td>
                                                    @if ($i->status == 1)
                                                        <span class="badge bg-success">Disetujui</span>
                                                    @elseif ($i->status == 2)
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge bg-info">Menunggu Persetujuan</span>
                                                    @endif
                                                </td>
                                                <td>{{ $i->tgl_akhir }}</td>
                                                <td>
                                                    <a href="{{ route('pegawai.izin.edit', ['izin' => $i->id]) }}" class="btn btn-success">Ubah</a>
                                                    <button onclick="hapusData('{{ route('pegawai.izin.destroy', ['izin' => $i->id]) }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete">Hapus</button>
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
                                        Showing {{ $izin->firstItem() }} to {{ $izin->lastItem() }} of {{ $izin->total() }} entries 
                                    </p> --}}
                                </div>
                                <div class="col d-flex justify-content-end">
                                    {{ $izin->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
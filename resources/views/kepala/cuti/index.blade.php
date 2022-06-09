@extends('layouts.app')

@section('title', 'Cuti')

@section('heading')
    <h3 class="text-center">Data Cuti</h3>
@endsection

@section('content')
    @include('includes.swal_alert')
    @include('partials.modal_setujui')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3 justify-content-end">
                        <div class="col-md-4">
                            <form action="{{ route('kepala.cuti.index') }}" method="get">
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
                                        <th>Pengganti</th>
                                        <th>Dokumen</th>
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
                                                <td>{{ $c->pengganti->nama }}</td>
                                                <td>
                                                    @if ($c->dokumen)
                                                        <a href="{{ $c->getDokumen }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                                    @else
                                                        <span class="text-muted">Tidak ada dokumen</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($c->status == 1)
                                                        <span class="badge bg-success">Berhasil disetujui</span>
                                                    @elseif ($c->status == 2)
                                                        <span class="badge bg-danger">Berhasil ditolak</span>
                                                    @else
                                                    <button onclick="setujui('{{ route('kepala.cuti.update', ['cuti' => $c->id]) }}')" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-setujui">Setujui</button>
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
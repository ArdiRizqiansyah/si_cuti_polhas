@extends('layouts.app')

@section('title', 'Izin')

@section('heading')
    <h3 class="text-center">Data Izin</h3>
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
                            <form action="{{ route('kepala.izin.index') }}" method="get">
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
                                        <th>Jumlah Hari</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Dokumen</th>
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
                                                <td>{{ $i->tgl_akhir }}</td>
                                                <td>{{ $i->getJumlahHari }} Hari</td>
                                                <td>
                                                    @if ($i->dokumen)
                                                        <a href="{{ $i->getDokumen }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                                    @else
                                                        <span class="text-muted">Tidak ada dokumen</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($i->status == 1)
                                                        <span class="badge bg-success">Berhasil disetujui</span>
                                                    @elseif ($i->status == 2)
                                                        <span class="badge bg-danger">Berhasil ditolak</span>
                                                    @else
                                                    <button onclick="setujui('{{ route('kepala.izin.update', ['izin' => $i->id]) }}')" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-setujui">Setujui</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data</td>
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
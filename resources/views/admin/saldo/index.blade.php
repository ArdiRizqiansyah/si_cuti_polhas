@extends('layouts.app')

@section('title', 'Saldo')

@section('heading')
    <h3 class="text-center">Data Saldo Cuti Pegawai</h3>
@endsection

@section('content')
    @include('includes.swal_alert')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.saldo.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="saldo" class="form-label">Batas Hari Cuti</label>
                            <input type="number" name="saldo" id="saldo" min="0" class="form-control" value="{{ old('saldo', @$saldo->saldo) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4 align-self-end pb-2 mb-0 mb-md-1">
                        <button type="submit" class="btn btn-secondary">Input batas hari cuti</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 justify-content-between">
                <div class="col-md-4">
                    
                    @php
                        $tahun_ini = date('Y');
                        $tahun_awal = 2020;
                        $selisih = $tahun_ini - $tahun_awal;

                        $pilihan_tahun = [];
                        for($i = 0; $i <= $selisih; $i++) {
                            $pilihan_tahun[$i] = $tahun_ini - $i;
                        }
                    @endphp
                    
                    <form action="" method="get">
                        <div class="row g-2 align-items-center">
                            <div class="col-auto">
                                <label for="">Pilih Tahun :</label>
                            </div>
                            <div class="col">
                                <select name="tahun" class="form-select" onchange="this.form.submit()">
                                    @foreach ($pilihan_tahun as $p)
                                        <option value="{{ $p }}" {{ $p == @$_GET['tahun'] ? 'selected' : ''  }}>{{ $p }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Cari pegawai">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NRP</th>
                            <th>Nama</th>
                            <th>Pengajuan Cuti</th>
                            <th>Jumlah Hari</th>
                            <th>Sisa Cuti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pegawai as $peg)
                            <tr>
                                <td>{{ $pegawai->firstItem() + $loop->index }}</td>
                                <td>{{ $peg->nrp }}</td>
                                <td>{{ $peg->nama }}</td>
                                <td>{{ $peg->cuti->count() }}</td>
                                <td>
                                    @php
                                        $jumlah_hari = 0;
                                        foreach ($peg->cuti as $cuti) {
                                            $jumlah_hari += $cuti->getJumlahHari;
                                        }
                                    @endphp

                                    {{ $jumlah_hari }} Hari
                                </td>
                                <td>{{ $saldo->saldo - $jumlah_hari }} Hari</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
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
                    {{ $pegawai->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

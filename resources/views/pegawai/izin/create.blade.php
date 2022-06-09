@extends('layouts.app')

@section('title', $page .' Izin')

@section('heading')
    <h3 class="text-center">{{ $page }} Izin</h3>
@endsection

@section('content')
    @include('includes.swal_alert')

    <div class="row justify-content-center">
        <div class="col-md-10">

            <a href="{{ route('pegawai.izin.index') }}"><i class="fa fa-chevron-left"></i> Kembali</a>

            <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($page == 'Edit')
                    @method('PUT')
                @endif
                
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="jenis" class="form-label">Jenis Izin <span class="text-primary">*</span></label>
                            @error('jenis')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" value="{{ old('jenis', @$izin->jenis) }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control @error('tgl_mulai') is-invalid @enderror" value="{{ old('tgl_mulai', @$izin->tgl_mulai) }}">
                            @error('tgl_mulai')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_akhir" class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control @error('tgl_akhir') is-invalid @enderror" value="{{ old('tgl_akhir', @$izin->tgl_akhir) }}">
                            @error('tgl_akhir')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dokumen" class="form-label">Dokumen</label>
                            @if ($page == 'Edit')
                                <p class="mb-2 text-muted">Kosongkan jika tidak ada perubahan</p>
                            @endif
                            @error('dokumen')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="file" name="dokumen" id="dokumen" class="form-control @error('dokumen') is-invalid @enderror">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
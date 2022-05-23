@extends('layouts.profile')

@section('header-profile')
    @include('pegawai.profile.header_profile')
@endsection

@section('content-profile')
    <form action="{{ route('pegawai.profile.update.pegawai') }}" method="POST">
        @method('put')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="nrp" class="form-label">NRP</label>
                    @error('nrp')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="text" name="nrp" id="nrp" class="form-control @error('nrp') is-invalid @enderror" value="{{ old('nrp', $profile->nrp) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="unit_id" class="form-label">Unit Keja</label>
                    <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit', $profile->unit->nama) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan', $profile->jabatan) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="jen_pangkat" class="form-label">Jenjang Kepangkatan</label>
                    <input type="text" name="jen_pangkat" id="jen_pangkat" class="form-control" value="{{ old('jen_pangkat', $profile->jenjang_kepangkatan) }}" required>
                </div>
                <div class="form-group">
                    <label for="npwp" class="form-label">NPWP</label>
                    <input type="text" name="npwp" id="npwp" class="form-control" value="{{ old('npwp', $profile->npwp) }}" required>
                </div>
                <div class="form-group">
                    <label for="nidn" class="form-label">NIDN</label>
                    <input type="text" name="nidn" id="nidn" class="form-control" value="{{ old('nidn', $profile->nidn) }}" required>
                </div>
                <div class="form-group">
                    <label for="tgl_pkwt_1" class="form-label">Tanggal Kontrak PKWT 1</label>
                    <input type="date" name="tgl_pkwt_1" id="tgl_pkwt_1" class="form-control" value="{{ old('tgl_pkwt_1', $profile->tgl_kontrak_pkwt_1) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="tgl_pkwt_2" class="form-label">Tanggal Kontrak PKWT 2</label>
                    <input type="date" name="tgl_pkwt_2" id="tgl_pkwt_2" class="form-control" value="{{ old('tgl_pkwt_2', $profile->tgl_kontrak_pkwt_2) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="tgl_sk" class="form-label">Tanggal SK Tetap</label>
                    <input type="date" name="tgl_sk" id="tgl_sk" class="form-control" value="{{ old('tgl_sk', $profile->tgl_sk_tetap) }}" readonly>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection
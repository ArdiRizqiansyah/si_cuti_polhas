@extends('layouts.profile')

@section('header-profile')
    @include('admin.pegawai.edit.head')
@endsection

@section('content-profile')
    @include('includes.form_select')

    <form action="{{ route('admin.pegawai.update.pegawai', ['id' => $profile->id]) }}" method="POST">
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
                    <input type="text" name="nrp" id="nrp" class="form-control @error('nrp') is-invalid @enderror" value="{{ old('nrp', $profile->nrp) }}">
                </div>
                <div class="form-group">
                    <label for="unit_id" class="form-label">Unit Keja</label>
                    <select name="unit_id" id="unit_id" class="choices form-select" required>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" value="{{ old('unit_id', $profile->unit_id) == $unit->id ? 'selected' : '' }}">{{ $unit->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <p class="text-muted mb-2 fst-italic">Untuk mengubah jabatan pegawai dapat dilakukan di halaman edit unit</p>
                    <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan', $profile->jabatan) }}">
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
                    <input type="date" name="tgl_pkwt_1" id="tgl_pkwt_1" class="form-control" value="{{ old('tgl_pkwt_1', $profile->tgl_kontrak_pkwt_1) }}">
                </div>
                <div class="form-group">
                    <label for="tgl_pkwt_2" class="form-label">Tanggal Kontrak PKWT 2</label>
                    <input type="date" name="tgl_pkwt_2" id="tgl_pkwt_2" class="form-control" value="{{ old('tgl_pkwt_2', $profile->tgl_kontrak_pkwt_2) }}">
                </div>
                <div class="form-group">
                    <label for="tgl_sk" class="form-label">Tanggal SK Tetap</label>
                    <input type="date" name="tgl_sk" id="tgl_sk" class="form-control" value="{{ old('tgl_sk', $profile->tgl_sk_tetap) }}">
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection
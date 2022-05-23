@extends('layouts.profile')

@section('header-profile')
    @include('kepala.profile.header_profile')
@endsection

@section('content-profile')
    <form action="{{ route('kepala.profile.update.pribadi') }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="nama" class="form-label">Nama</label>
                    @error('nama')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $profile->nama) }}" required>
                </div>
                <div class="form-group">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $profile->tempat_lahir) }}" required>
                </div>
                <div class="form-group">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $profile->tanggal_lahir) }}" required>
                </div>
                <div class="form-group">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    @error('jk')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" {{ old('jk', $profile->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }} type="radio" name="jk" id="lk" value="Laki-laki">
                            <label class="form-check-label" for="lk">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" {{ old('jk', $profile->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }} type="radio" name="jk" id="pr" value="Perempuan">
                            <label class="form-check-label" for="pr">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control" value="{{ old('nik', $profile->nik) }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" required>{{ old('alamat', $profile->alamat) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status_nikah" class="form-label">Status Perkawinan</label>
                    <select name="status_nikah" id="status_nikah" class="form-select" required>
                        <option value="1" {{ old('status_nikah', $profile->status_perkawinan == 1 ? 'selected' : '') }}>Belum Kawin</option>
                        <option value="2" {{ old('status_nikah', $profile->status_perkawinan == 2 ? 'selected' : '') }}>Kawin</option>
                        <option value="3" {{ old('status_nikah', $profile->status_perkawinan == 3 ? 'selected' : '') }}>Cerai Hidup</option>
                        <option value="4" {{ old('status_nikah', $profile->status_perkawinan == 4 ? 'selected' : '') }}>Cerai Mati</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pen_akhir" class="form-label">Pendidikan Terakhir</label>
                    <input type="text" name="pen_akhir" id="pen_akhir" class="form-control" value="{{ old('pen_akhir', $profile->pendidikan_terakhir) }}" required>
                </div>
                <div class="form-group">
                    <label for="gelar" class="form-label">Gelar</label>
                    <input type="text" name="gelar" id="gelar" class="form-control" value="{{ old('gelar', $profile->gelar) }}" required>
                </div>
                <div class="form-group">
                    <label for="agama" class="form-label">Agama</label>
                    <select name="agama" id="agama" class="form-select" required>
                        <option value="1" {{ old('agama', $profile->agama) == 1 ? 'selected' : '' }}>Islam</option>
                        <option value="2" {{ old('agama', $profile->agama) == 2 ? 'selected' : '' }}>Kristen</option>
                        <option value="3" {{ old('agama', $profile->agama) == 3 ? 'selected' : '' }}>Hindu</option>
                        <option value="4" {{ old('agama', $profile->agama) == 4 ? 'selected' : '' }}>Budha</option>
                        <option value="5" {{ old('agama', $profile->agama) == 5 ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="wa" class="form-label">No Wa</label>
                    <input type="text" name="wa" id="wa" class="form-control" value="{{ old('wa', $profile->no_wa) }}" required>
                </div>
                <div class="form-group">
                    <label for="bjps_ket" class="form-label">Nomor BPJS Ketenagakerjaan</label>
                    <input type="text" name="bjps_ket" id="bjps_ket" class="form-control" value="{{ old('bpjs_ket', $profile->no_bpjs_ketenagakerjaan) }}" required>
                </div>
                <div class="form-group">
                    <label for="bpjs_kes" class="form-label">Nomor BPJS Kesehatan</label>
                    <input type="text" name="bpjs_kes" id="bpjs_kes" class="form-control" value="{{ old('bpjs_kes', $profile->no_bpjs_kesehatan) }}" required>
                </div>
                <div class="form-group">
                    <label for="dok_1" class="form-label">Dokter Paskes Tingkat 1</label>
                    <input type="text" name="dok_1" id="dok_1" class="form-control" value="{{ old('dok_1', $profile->dokter_paskes_tingkat_1) }}" required>
                </div>
                <div class="form-group">
                    <label for="bank" class="form-label">Bank</label>
                    <input type="text" name="bank" id="bank" class="form-control" value="{{ old('bank', $profile->bank) }}" required>
                </div>
                <div class="form-group">
                    <label for="an" class="form-label">An</label>
                    <input type="text" name="an" id="an" class="form-control" value="{{ old('an', $profile->an) }}" required>
                </div>
                <div class="form-group">
                    <label for="norek" class="form-label">Nomor Rekening</label>
                    <input type="text" name="norek" id="norek" class="form-control" value="{{ old('norek', $profile->no_rekening) }}" required>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection
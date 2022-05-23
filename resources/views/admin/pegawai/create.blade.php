@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('heading')
    <h3 class="text-center">Tambah Pegawai</h3>
@endsection

@section('content')
    @include('includes.swal_alert')
    @include('includes.form_select')

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            
            <a href="{{ route('admin.pegawai.index') }}"><i class="fa fa-chevron-left"></i> Kembali</a>

            <div class="card mt-3">
                <div class="card-body">
                    <form action="{{ route('admin.pegawai.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nrp" class="form-label">NRP <span class="text-primary">*</span></label>
                            @error('nrp')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="nrp" id="nrp" class="form-control @error('nrp') is-invalid @enderror" value="{{ old('nrp') }}">
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama <span class="text-primary">*</span></label>
                            @error('nama')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-label">Username <span class="text-primary">*</span></label>
                            @error('username')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email <span class="text-primary">*</span></label>
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password </label>
                            <p class="text-muted mb-2 fst-italic">Password akan bernilai "password123" jika dikosongkan</p>
                            <input type="password" name="password" id="password" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="unit_id" class="form-label">Unit Keja</label>
                            <select name="unit_id" id="unit_id" class="choices form-select" required>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" value="{{ old('unit_id') == $unit->id ? 'selected' : '' }}">{{ $unit->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="form-label">Jabatan <span class="text-primary">*</span></label>
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_pkwt_1" class="form-label">Tanggal Kontrak PKWT 1</label>
                            <input type="date" name="tgl_pkwt_1" id="tgl_pkwt_1" class="form-control" value="{{ old('tgl_pkwt_1') }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_pkwt_2" class="form-label">Tanggal Kontrak PKWT 2</label>
                            <input type="date" name="tgl_pkwt_2" id="tgl_pkwt_2" class="form-control" value="{{ old('tgl_pkwt_2') }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_sk" class="form-label">Tanggal SK Tetap</label>
                            <input type="date" name="tgl_sk" id="tgl_sk" class="form-control" value="{{ old('tgl_sk') }}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jk" id="lk" value="laki-laki">
                                    <label class="form-check-label" for="lk">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jk" id="pr" value="perempuan">
                                    <label class="form-check-label" for="pr">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="kk" class="form-label">No KK</label>
                            <input type="text" name="kk" id="kk" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status_nikah" class="form-label">Status Perkawinan</label>
                            <select name="status_nikah" id="status_nikah" class="form-select">
                                <option value="1">Belum Kawin</option>
                                <option value="2">Kawin</option>
                                <option value="3">Cerai Hidup</option>
                                <option value="4">Cerai Mati</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jum_anak" class="form-label">Jumlah Anak</label>
                            <input type="number" name="jum_anak" id="jum_anak" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="pen_akhir" class="form-label">Pendidikan Terakhir</label>
                            <input type="text" name="pen_akhir" id="pen_akhir" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="gelar" class="form-label">Gelar</label>
                            <input type="text" name="gelar" id="gelar" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="agama" class="form-label">Agama</label>
                            <select name="agama" id="agama" class="form-select">
                                <option value="1">Islam</option>
                                <option value="2">Kristen</option>
                                <option value="3">Hindu</option>
                                <option value="4">Budha</option>
                                <option value="5">Konghucu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_telp" class="form-label">No Wa</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="ibu_kan" class="form-label">Nama Ibu Kandung</label>
                            <input type="text" name="ibu_kan" id="ibu_kan" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="ayah_kan" class="form-label">Nama Ayah Kandung</label>
                            <input type="text" name="ayah_kan" id="ayah_kan" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="ayah_mer" class="form-label">Nama Ayah Mertua</label>
                            <input type="text" name="ayah_mer" id="ayah_mer" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="jen_pangkat" class="form-label">Jenjang Kepangkatan</label>
                            <input type="text" name="jen_pangkat" id="jen_pangkat" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="npwp" class="form-label">NPWP</label>
                            <input type="text" name="npwp" id="npwp" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="nidn" class="form-label">NIDN</label>
                            <input type="text" name="nidn" id="nidn" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="tgl_pkwt_1" class="form-label">Tanggal Kontrak PKWT 1</label>
                            <input type="date" name="tgl_pkwt_1" id="tgl_pkwt_1" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="tgl_pkwt_2" class="form-label">Tanggal Kontrak PKWT 2</label>
                            <input type="date" name="tgl_pkwt_2" id="tgl_pkwt_2" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="tgl_sk" class="form-label">Tanggal SK Tetap</label>
                            <input type="date" name="tgl_sk" id="tgl_sk" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="bjps_ket" class="form-label">Nomor BPJS Ketenagakerjaan</label>
                            <input type="text" name="bjps_ket" id="bjps_ket" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="bpjs_kes" class="form-label">Nomor BPJS Kesehatan</label>
                            <input type="text" name="bpjs_kes" id="bpjs_kes" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="dok_1" class="form-label">Dokter Paskes Tingkat 1</label>
                            <input type="text" name="dok_1" id="dok_1" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="bank" class="form-label">Bank</label>
                            <input type="text" name="bank" id="bank" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="a/n" class="form-label">An</label>
                            <input type="text" name="a/n" id="a/n" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="norek" class="form-label">Nomor Rekening</label>
                            <input type="text" name="norek" id="norek" class="form-control" >
                        </div> --}}

                        <div class="text-end">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
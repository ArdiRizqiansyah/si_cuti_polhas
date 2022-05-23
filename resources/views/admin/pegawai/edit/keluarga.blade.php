@extends('layouts.profile')

@section('header-profile')
    @include('admin.pegawai.edit.head')
@endsection

@section('content-profile')
    <form action="{{ route('admin.pegawai.update.keluarga', ['id' => $profile->id]) }}" method="POST">
        @method('put')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="kk" class="form-label">Nomor KK</label>
                    <input type="text" name="kk" id="kk" class="form-control" value="{{ old('kk', $profile->no_kk) }}" required>
                </div>
                <div class="form-group">
                    <label for="jum_anak" class="form-label">Jumlah Anak</label>
                    <input type="number" name="jum_anak" id="jum_anak" class="form-control" value="{{ old('jum_anak', $profile->jumlah_anak) }}" required>
                </div>
                <div class="form-group">
                    <label for="ibu_kan" class="form-label">Nama Ibu Kandung</label>
                    <input type="text" name="ibu_kan" id="ibu_kan" class="form-control" value="{{ old('ibu_kan', $profile->nama_ibu_kandung) }}" required>
                </div>
                <div class="form-group">
                    <label for="ayah_kan" class="form-label">Nama Ayah Kandung</label>
                    <input type="text" name="ayah_kan" id="ayah_kan" class="form-control" value="{{ old('ayah_kan', $profile->nama_ayah_kandung) }}" required>
                </div>
                <div class="form-group">
                    <label for="ibu_mer" class="form-label">Nama Ibu Mertua</label>
                    <input type="text" name="ibu_mer" id="ibu_mer" class="form-control" value="{{ old('ibu_mer', $profile->nama_ibu_mertua) }}" required>
                </div>
                <div class="form-group">
                    <label for="ayah_mer" class="form-label">Nama Ayah Mertua</label>
                    <input type="text" name="ayah_mer" id="ayah_mer" class="form-control" value="{{ old('ayah_mer', $profile->nama_ayah_mertua) }}" required>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection
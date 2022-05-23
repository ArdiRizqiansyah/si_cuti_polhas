@extends('layouts.profile')

@section('header-profile')
    @include('pegawai.profile.header_profile')
@endsection

@section('content-profile')
    <form action="{{ route('pegawai.profile.update.akun') }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    @error('username')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $profile->user->username) }}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $profile->user->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="avatar" class="form-label">Foto Profil</label>
                    <p class="text-muted fst-italic mb-2">Kosongkan jika tidak ada perubahan</p>
                    @error('avatar')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label for="password">Password </label>
                    <p class="text-muted mb-2 fst-italic">Kosongkan jika tidak ingin mengubah password</p>
                    <input type="password" name="password" id="password" class="form-control" >
                </div>
                
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection
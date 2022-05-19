@extends('layouts.app')

@section('title', 'Tambah Unit')

@section('heading')
    <h3 class="text-center">Tambah Unit</h3>
@endsection

@section('content')
    {{-- panggil swal alert --}}
    @include('includes.swal_alert')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.unit.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_unit" class="form-label">Nama Unit</label>
                            @error('nama_unit')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="nama_unit" id="nama_unit" class="form-control @error('nama_unit') is-invalid @enderror" value="{{ old('nama_unit') }}">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="form-label">Deskripsi Unit</label>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="30" rows="5">{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="select_kepala" class="form-label">Apakah Kepala Unit Belum Memiliki Akun ?</label>
                            <select name="select_kepala" id="select_kepala" class="form-select" onchange="selectKepala('select_kepala')">
                                <option value="">-- Silahkan Pilih --</option>
                                <option value="ya" {{ old('select_kepala') == 'ya' ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ old('select_kepala') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="pegawai-baru">
                            <div class="form-group">
                                <label for="nama_kepala" class="form-label">Nama Kepala Unit</label>
                                @error('nama_kepala')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="text" name="nama_kepala" id="nama_kepala" class="form-control @error('nama_kepala') is-invalid @enderror" value="{{ old('nama_kepala') }}">
                            </div>
                            <div class="form-group">
                                <label for="nrp" class="form-label">NRP</label>
                                @error('nrp')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="text" name="nrp" id="nrp" class="form-control @error('nrp') is-invalid @enderror" value="{{ old('nrp') }}">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                @error('username')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <p class="text-muted mb-2 fst-italic">Password akan bernilai "password123" jika dikosongkan</p>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" >
                            </div>
                        </div>

                        <div class="pegawai-lama">
                            <div class="form-group">
                                <label for="pegawai_id" class="form-label">Pilih Pegawai</label>
                                <select name="pegawai_id" id="pegawai_id" class="choices form-select">
                                    <option value="">Ardi</option>
                                    <option value="">dika</option>
                                    <option value="">lis</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                    @include('includes.form_select')

                    @push('after-scripts')
                        <script>
                            $(document).ready(function() {
                                // sembunyikan kelas pegawai baru dan lama
                                $('.pegawai-baru').hide();
                                $('.pegawai-lama').hide();

                                selectKepala('select_kepala');
                            }); 

                            // event yang terjadi ketika #select_kepala mengalami perubahan
                            function selectKepala(id){
                                // cari nilai elemen yang dipilih
                                let val = $('#'+id).val();

                                // jika pilihan yang dipilih adalah 'ya'
                                if(val == 'ya') {
                                    // ubah value pada #pegawai_id menjadi null
                                    $('#pegawai_id').val(null);

                                    $('.pegawai-baru').show();
                                    $('.pegawai-lama').hide();
                                
                                // jika pilihan yang dipilih adalah 'tidak'
                                } else if(val == 'tidak') {
                                    $('.pegawai-baru').hide();
                                    $('.pegawai-lama').show();

                                // jika pilihan yang dipilih adalah '-- Silahkan Pilih --'
                                } else {
                                    // ubah value pada #pegawai_id menjadi null
                                    $('#pegawai_id').val(null);

                                    $('.pegawai-baru').hide();
                                    $('.pegawai-lama').hide();
                                }
                            }
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
@endsection
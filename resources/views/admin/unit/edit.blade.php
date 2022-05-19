@extends('layouts.app')

@section('title', 'Edit Unit')

@section('heading')
    <h3 class="text-center">Edit Unit</h3>
@endsection

@section('content')
    {{-- panggil swal alert --}}
    @include('includes.swal_alert')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.unit.update', ['unit' => $unit->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="nama_unit" class="form-label">Nama Unit</label>
                            @error('nama_unit')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="nama_unit" id="nama_unit" class="form-control @error('nama_unit') is-invalid @enderror" value="{{ old('nama_unit', $unit->nama) }}">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="form-label">Deskripsi Unit</label>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="30" rows="5">{{ old('deskripsi', $unit->deskripsi) }}</textarea>
                        </div>

                        <div class="pegawai-lama">
                            <div class="form-group">
                                <label for="pegawai_id" class="form-label">Kepala Unit</label>
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

                    @push('before-styles')
                        <link rel="stylesheet" href="{{ asset('assets/css/pages/form-element-select.css') }}">
                    @endpush

                    @push('after-scripts')
                        <script src="{{ asset('assets/js/extensions/form-element-select.js') }}"></script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
@endsection
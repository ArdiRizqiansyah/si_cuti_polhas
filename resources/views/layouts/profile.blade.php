@extends('layouts.app')

@section('title', 'Profile Pegawai')

@section('content')
    @include('includes.swal_alert')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row bd-highlight align-items-center p-3">
                            <div class="bd-highlight position-relative">
                                <img src="{{ $profile->user->getFoto }}" class="bio-img rounded-circle" alt="{{ $profile->nama }}">
                            </div>
                            <div class="bd-highlight ms-4">
                                <h5 class="mb-1">{{ $profile->nama }}</h5>
                                <p class="mb-0 text-capitalize">{{ $profile->user->role->name }} Unit {{ $profile->unit->nama }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-10">
                @yield('header-profile')
            </div>

            <div class="col-lg-8 col-md-10">
                @yield('content-profile')
            </div>
        </div>

    </div>
@endsection
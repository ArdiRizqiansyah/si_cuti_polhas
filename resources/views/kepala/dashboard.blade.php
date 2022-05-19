@extends('layouts.app')

@section('title', 'Dashboard')

@section('heading')
    <h3 class="text-center">SELAMAT DATANG !!!</h3>
@endsection

@section('content')
    <section class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="stats-icon purple">
                                <span class="mt-2">
                                    <i class="bi bi-people-fill"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-muted font-semibold">Permohonan Cuti</h4>
                            <h4 class="font-extra-bold mb-0">{{ $cuti->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="stats-icon green">
                                <span class="mt-2">
                                    <i class="bi bi-person-bounding-box"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-muted font-semibold">Permohonan Izin</h4>
                            <h4 class="font-extra-bold mb-0">{{ $izin->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
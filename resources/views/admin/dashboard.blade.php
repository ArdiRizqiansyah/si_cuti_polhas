@extends('layouts.app')

@section('title', 'Dashboard')

@section('heading')
    <h3 class="text-center">SELAMAT DATANG !!!</h3>
@endsection

@section('content')
    @push('after-scripts')
        <script src="{{ asset('assets/js/extensions/ui-chartjs.js') }}"></script>
    @endpush

    <section class="row">
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
                            <h4 class="text-muted font-semibold">Data Pegawai</h4>
                            <h4 class="font-extra-bold mb-0">{{ $pegawai->count() }}</h4>
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
                            <div class="stats-icon blue">
                                <span class="mt-2">
                                    <i class="bi bi-person-badge-fill"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-muted font-semibold">Data Cuti</h4>
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
                            <h4 class="text-muted font-semibold">Data Izin</h4>
                            <h4 class="font-extra-bold mb-0">{{ $izin->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div class="bd-highligt">
                        <h4 class="card-title mb-0">Chart Cuti</h4>
                    </div>
                    <div class="bd-highlight ms-auto">
                        <form action="{{ route('admin.dashboard') }}" method="GET" id="form-chart-cuti">
                            <select class="form-select" name="tahun_cuti" onchange="event.preventDefault(); document.getElementById('form-chart-cuti').submit();">
                                <option value="">-Semua Tahun-</option>
                                <option value="2020" {{ @$_GET['tahun_cuti'] == 2020 ? 'selected' : '' }}>2020</option>
                                <option value="2021" {{ @$_GET['tahun_cuti'] == 2021 ? 'selected' : '' }}>2021</option>
                                <option value="2022" {{ @$_GET['tahun_cuti'] == 2022 ? 'selected' : '' }}>2022</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chart-cuti" height="350px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div class="bd-highligt">
                        <h4 class="card-title mb-0">Chart Izin</h4>
                    </div>
                    <div class="bd-highlight ms-auto">
                        <form action="{{ route('admin.dashboard') }}" method="GET" id="form-chart-izin">
                            <select class="form-select" name="tahun_izin" onchange="event.preventDefault(); document.getElementById('form-chart-izin').submit();">
                                <option value="">-Semua Tahun-</option>
                                <option value="2020" {{ @$_GET['tahun_izin'] == 2020 ? 'selected' : '' }}>2020</option>
                                <option value="2021" {{ @$_GET['tahun_izin'] == 2021 ? 'selected' : '' }}>2021</option>
                                <option value="2022" {{ @$_GET['tahun_izin'] == 2022 ? 'selected' : '' }}>2022</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chart-izin" height="350px"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script>
            var ctx = document.getElementById('chart-cuti').getContext('2d');
            var data = {
                labels: ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'],
                datasets: [{
                    label: 'Data Cuti',
                    data: {!! json_encode($chart_cuti) !!},
                    backgroundColor: 'rgb(67,94,190)',
                    borderWidth: 1
                }
                ]
            };
            var incomePerPeriode = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    "animation": {
                    "duration": 1,
                    "onComplete": function() {
                        var chartInstance = this.chart,
                        ctx = chartInstance.ctx;

                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                        });
                    }
                    },
                    tooltips: {
                    "enabled": true
                    },
                    scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                        display: true
                        },
                        ticks: {
                        display: true,
                        beginAtZero: true
                        },
                    }],
                    xAxes: [{
                        // stackWeight: 1
                        gridLines: {
                        display: true
                        },
                        ticks: {
                        beginAtZero: true
                        }
                    }]
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>

<script>
    var ctx = document.getElementById('chart-izin').getContext('2d');
    var data = {
        labels: ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'],
        datasets: [{
            label: 'Data Izin',
            data: {!! json_encode($chart_izin) !!},
            backgroundColor: 'rgb(65,177,249)',
            borderWidth: 1
        }
        ]
    };
    var incomePerPeriode = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            "animation": {
            "duration": 1,
            "onComplete": function() {
                var chartInstance = this.chart,
                ctx = chartInstance.ctx;

                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function(dataset, i) {
                var meta = chartInstance.controller.getDatasetMeta(i);
                meta.data.forEach(function(bar, index) {
                    var data = dataset.data[index];
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                });
                });
            }
            },
            tooltips: {
            "enabled": true
            },
            scales: {
            yAxes: [{
                display: true,
                gridLines: {
                display: true
                },
                ticks: {
                display: true,
                beginAtZero: true
                },
            }],
            xAxes: [{
                // stackWeight: 1
                gridLines: {
                display: true
                },
                ticks: {
                beginAtZero: true
                }
            }]
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
    @endpush
@endsection
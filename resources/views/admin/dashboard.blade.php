@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Kategori Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-0">Kategori</h6>
                                <h3 class="mb-0">{{ $categorycount }}</h3>
                            </div>
                            <i class="fas fa-box fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengguna Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-0">Pengguna</h6>
                                <h3 class="mb-0">{{ $usercount }}</h3>
                            </div>
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tugas Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-0">Jumlah Tugas</h6>
                                <h3 class="mb-0">{{ $taskcount }}</h3>
                            </div>
                            <i class="fas fa-tasks fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tugas Tertunda Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-0">Tugas Tertunda</h6>
                                <h3 class="mb-0">{{ $taskPending }}</h3>
                            </div>
                            <i class="fas fa-clock fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Jumlah Tugas per Minggu</h5>
                    </div>
                    <div class="card-body">
                        <div id="taskTrendChart"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [{
                    name: 'Jumlah Tugas',
                    data: @json($taskData) // Data jumlah tugas per minggu
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Jumlah Tugas per Minggu',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: @json($weeks), // Label minggu
                    title: {
                        text: 'Minggu'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Tugas'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#taskTrendChart"), options);
            chart.render();
        });
    </script>
@endsection


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
                data: @json($taskData) // Data jumlah tugas per hari
            }, {
                name: 'Tugas Selesai',
                data: @json($completedData) // Data tugas selesai per hari
            }],
            chart: {
                type: 'line',
                height: 350,
                zoom: { enabled: false },
                toolbar: { show: true }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            markers: {
                size: 6,
                strokeWidth: 2,
                hover: { size: 8 }
            },
            colors: ['#3b82f6', '#10b981'],
            dataLabels: { enabled: false },
            title: {
                text: 'Statistik Tugas Harian (7 Hari Terakhir)',
                align: 'left',
                style: { fontSize: '16px', fontWeight: 'bold' }
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
                borderColor: '#e7e7e7'
            },
            xaxis: {
                categories: @json($formattedDates), // Label tanggal
                labels: {
                    style: { colors: '#6b7280' }
                },
                title: {
                    text: 'Tanggal',
                    style: { color: '#6b7280' }
                }
            },
            yaxis: {
                title: {
                    text: 'Jumlah Tugas',
                    style: { color: '#6b7280' }
                },
                labels: {
                    style: { colors: '#6b7280' }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                markers: {
                    radius: 12
                }
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (value) {
                        return value + ' tugas';
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#taskTrendChart"), options);
        chart.render();
    });
</script>
@endsection

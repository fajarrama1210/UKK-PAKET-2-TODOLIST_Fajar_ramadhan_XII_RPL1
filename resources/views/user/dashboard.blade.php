@extends('user.layouts.app')

@section('title')
    DASHBOARD
@endsection

@section('content')
    <div class="container-fluid">
        <!--  Owl carousel -->
        <div class="owl-carousel counter-carousel owl-theme">
            <div class="item">
                <div class="card border-0 zoom-in bg-light-primary shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            @include('components.icons.dashboard.category')
                            <p class="fw-semibold fs-3 text-primary mb-1">Kategori</p>
                            <h5 class="fw-semibold text-primary mb-0">{{ $categoryCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-warning shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            @include('components.icons.dashboard.project')
                            <p class="fw-semibold fs-3 text-warning mb-1">Tugas Saya</p>
                            <h5 class="fw-semibold text-warning mb-0">{{ $taskListCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-info shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            @include('components.icons.dashboard.tasklist')
                            <p class="fw-semibold fs-3 text-info mb-1">Tugas</p>
                            <h5 class="fw-semibold text-info mb-0">{{ $taskCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-danger shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            @include('components.icons.dashboard.pending')
                            <p class="fw-semibold fs-3 text-danger mb-1">Tugas Tertunda</p>
                            <h5 class="fw-semibold text-danger mb-0">{{ $pendingTasks }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-success shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            @include('components.icons.dashboard.dikerjakan')
                            <p class="fw-semibold fs-3 text-success mb-1"> Dikerjakan</p>
                            <h5 class="fw-semibold text-success mb-0">{{ $inProgressTasks }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-info shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            @include('components.icons.dashboard.taskdone')
                            <p class="fw-semibold fs-3 text-info mb-1">Tugas Selesai</p>
                            <h5 class="fw-semibold text-info mb-0">{{ $completedTasks }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-danger shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            @include('components.icons.dashboard.later')
                            <p class="fw-semibold fs-3 text-danger mb-1"> Terlambat</p>
                            <h5 class="fw-semibold text-danger mb-0">{{ $overdueTasks }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Section: Line Chart for Task Count per Week -->
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
        <div class="row mt-5">
            <div class="col-12">
                <footer class="text-center">
                    <p>&copy; 2025 Compirayc by Fajar Ramadhan. All rights reserved.</p>
                    <p>Contact us on Instagram: <a href="https://www.instagram.com/jar_rmd/" target="_blank">jar_rmd</a></p>
                </footer>
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
                data: @json($taskData)
            }, {
                name: 'Tugas Selesai',
                data: @json($completedData)
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
                categories: @json($formattedDates),
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

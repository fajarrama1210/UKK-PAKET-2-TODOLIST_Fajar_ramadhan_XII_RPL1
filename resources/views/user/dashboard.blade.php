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

        <!-- New Section: Line Chart for Task Count per Month -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Jumlah Tugas per Bulan</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="taskTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var ctx = document.getElementById('taskTrendChart').getContext('2d');
            var taskTrendChart = new Chart(ctx, {
                type: 'line', // Line chart
                data: {
                    labels: {!! json_encode($months) !!}, // Bulan
                    datasets: [{
                        label: 'Jumlah Tugas',
                        data: {!! json_encode($taskData) !!}, // Data jumlah tugas
                        borderColor: '#4BC0C0', // Warna garis
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang area chart
                        borderWidth: 2,
                        tension: 0.3 // Menambahkan kelengkungan pada garis
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return 'Jumlah Tugas: ' + tooltipItem.raw; // Menampilkan jumlah tugas pada tooltip
                                }
                            }
                        }
                    }
                }
            });
        </script>

        <!-- Footer -->
        <div class="row mt-5">
            <div class="col-12">
                <footer class="text-center">
                    <p>&copy; 2025 Todo App. All rights reserved.</p>
                    <p>Contact us at: <a href="mailto:support@todoapp.com">support@todoapp.com</a></p>
                </footer>
            </div>
        </div>
    </div>
@endsection

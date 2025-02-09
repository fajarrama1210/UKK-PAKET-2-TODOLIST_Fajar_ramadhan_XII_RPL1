@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Dashboard Title -->

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

        <!-- Grafik Tugas Selesai per Bulan -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Jumlah Tugas Selesai per Bulan</h4>
                        <canvas id="taskCompleteChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Chart.js -->
    <script>
        var ctx = document.getElementById('taskCompleteChart').getContext('2d');
        var taskCompleteChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months), // Menampilkan bulan
                datasets: [{
                    label: 'Tugas Selesai',
                    data: @json($taskCounts), // Menampilkan jumlah tugas selesai
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

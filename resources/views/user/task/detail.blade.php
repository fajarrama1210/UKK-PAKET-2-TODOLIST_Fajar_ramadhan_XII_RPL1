@extends('user.layouts.app')

@section('title', 'Detail Task')
<?php $listid = request()->segment(4); ?>

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-0">
                            <!-- Nama Task -->
                            <div class="mb-2">
                                <label for="">Nama Task</label>
                                <p class="mb-0 fs-5"><strong>{{ $task->name }}</strong></p>
                            </div>
                            <div class="mb-2">
                                <label for="">Kategori</label>
                                <p class="mb-0 fs-5"><strong>{{ $task->category->name }}</strong></p>
                            </div>
                            <div class="mb-2">
                                <label for="">Status</label>
                                <p class="mb-3 fs-5">
                                    @if ($task->status == 'completed')
                                        <span
                                            class="badge bg-light-primary rounded-3 py-2 text-primary fw-semibold fs-2">Completed</span>
                                    @elseif ($task->status == 'pending')
                                        <span
                                            class="badge bg-light-success rounded-3 py-2 text-success fw-semibold fs-2">Pending</span>
                                    @elseif ($task->status == 'In Progress')
                                        <span class="badge bg-light-warning rounded-3 py-2 text-warning fw-semibold fs-2">In
                                            Progress</span>
                                    @else
                                        <span
                                            class="badge bg-light-danger rounded-3 py-2 text-danger fw-semibold fs-2">Unknown</span>
                                    @endif
                                </p>
                            </div>
                            <div class="mb-2">
                                <label for="">Prioritas</label>
                                <p class="mb-0 fs-5">
                                    <span
                                        class="badge
                                        @if ($task->priority == 'low') bg-secondary
                                        @elseif ($task->priority == 'medium') bg-primary
                                        @elseif ($task->priority == 'high') bg-danger
                                        @else bg-warning @endif
                                        text-white">{{ ucfirst($task->priority) }}</span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <label for="">Tanggal</label>
                                <div class="bg-light p-2 rounded">
                                    <strong>{{ \Carbon\Carbon::parse($task->date)->format('d F Y') }}</strong>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <label for="">Dibuat Pada</label>
                                <div class="bg-light p-2 rounded">
                                    <strong>{{ \Carbon\Carbon::parse($task->created_at)->format('d F Y, H:i') }}</strong>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for="">Deadline</label>
                                <div class="bg-light p-2 rounded text-danger">
                                    <strong>{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d F Y') : 'Tidak ada' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-success mb-0 mt-3">
            <h6 class="mb-1"><b>Remainder!</b></h6>
            <p class="mb-0">Setiap langkah kecil membawa Anda lebih dekat pada tujuan. Jangan lupa untuk kembali ke Daftar
                Tugas Anda dan lanjutkan perjalanan ini.</p>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('user.tasks.list.filter', $listid) }}" class="btn btn-secondary btn-sm">Kembali ke
                Daftar Tugas</a>
        </div>
    </div>
@endsection

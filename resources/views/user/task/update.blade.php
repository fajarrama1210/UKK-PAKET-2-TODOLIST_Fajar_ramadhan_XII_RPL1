@extends('user.layouts.app')
@section('title')
    Update Tugas
@endsection
<?php $listid = $task->list_id; ?> 
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">Edit Tugas</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="">

                                <a href="{{ route('user.tasks.list.filter', ['taskList' => $listid]) }}"
                                    class="btn btn-outline-indigo btn-sm fw-bold">
                                    <b>← Kembali</b>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <b>Terjadi kesalahan pada proses input data</b> <br>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('user.tasks.update', $task->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $task->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Kategori Tugas</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="">- Pilih Kategori Tugas -</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $task->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="priority" class="form-label">Prioritas</label>
                                <select name="priority" id="priority" class="form-select" required>
                                    <option value="Low"
                                        {{ old('priority', $task->priority) == 'Low' ? 'selected' : '' }}>Low</option>
                                    <option value="Medium"
                                        {{ old('priority', $task->priority) == 'Medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="High"
                                        {{ old('priority', $task->priority) == 'High' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In
                                        Progress</option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="date" id="date"
                                    value="{{ old('date', $task->date) }}" required>
                                <small>Masukkan tanggal yang valid.</small>
                            </div>

                            <div class="mb-3">
                                <label for="time" class="form-label">Jam</label>
                                <input type="time" class="form-control" name="time" id="time"
                                    value="{{ old('time', \Carbon\Carbon::parse($task->time)->format('H:i')) }}" required>
                            </div>

                            <div class="mb-3">
                                <a class="btn btn-link" data-bs-toggle="collapse" href="#deadlineForm" role="button"
                                    aria-expanded="false" aria-controls="deadlineForm">
                                    <b>Set Deadline</b>
                                </a>

                                <div class="collapse" id="deadlineForm">
                                    <div class="mb-3 mt-3">
                                        <label for="deadline" class="form-label">Deadline</label>
                                        <input type="date" class="form-control" name="deadline" id="deadline"
                                            value="{{ old('deadline', $task->deadline) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="description" id="description" rows="3" maxlength="255" required>{{ old('description', $task->description) }}</textarea>
                                <small>Deskripsi minimal 50 karakter.</small><br>
                                <small>Deskripsi tidak boleh lebih dari 255 karakter.</small>
                            </div>

                            <button type="submit" class="btn btn-primary"><b>Simpan Data</b></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

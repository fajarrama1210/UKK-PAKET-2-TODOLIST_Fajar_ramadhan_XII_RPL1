@extends('user.layouts.app')

@section('title')
    Tambah Tugas
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">Tambah Tugas</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="">
                                <a href="{{ route('user.tasks.list') }}" class="btn btn-outline-indigo btn-sm fw-bold">
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

                        <form method="POST" action="{{ route('user.tasks.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select name="category_id" id="category_id" class="form-select select2" required>
                                    <option value="">- Pilih Kategori -</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="priority" class="form-label">Prioritas</label>
                                <select name="priority" id="priority" class="form-select" required>
                                    <option value="">- Pilih Prioritas -</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="date" id="date"
                                    value="{{ old('date') }}" required>
                                <small class="text-danger"><b>Tanggal yang Anda masukkan harus tanggal sekarang atau tanggal
                                        ke depan.</b></small>
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Waktu</label>
                                <input type="time" class="form-control" name="time" id="time"
                                    value="{{ old('time') }}" required>
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
                                            value="{{ old('deadline') }}">
                                        <small class="text-danger"><b>Tanggal yang Anda masukkan harus tanggal sekarang atau
                                                tanggal ke depan.</b></small>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="description" id="description" rows="3" maxlength="255">{{ old('description') }}</textarea>
                                <small class="text-danger"><b>Deskripsi minimal 50 karakter.</b></small><br>
                                <small class="text-danger"><b></b>Deskripsi tidak boleh lebih dari 255 karakter.</small>
                            </div>
                            <button type="submit" class="btn btn-primary"><b>Simpan Data</b></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')
@section('title', 'Tambah User')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="mb-4">Tambah User</h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.user.list') }}" class="btn btn-outline-indigo btn-sm fw-bold">
                            <b>← Kembali</b>
                        </a>
                    </div>
                </div>
                <div>
                    <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama "
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Hp</label>
                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Masukkan nomor handphone"
                                value="{{ old('phone') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email </label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto </label>
                            <input type="file" class="form-control" name="photo" id="photo" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><b>Simpan Data</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

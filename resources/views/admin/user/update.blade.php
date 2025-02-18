@extends('admin.layouts.app')
@section('title', 'Update User')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">Update User</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.user.list') }}" class="btn btn-outline-indigo btn-sm fw-bold">
                                <b>← Kembali</b>
                            </a>
                        </div>
                    </div>
                    <div>
                        <!-- Form update dengan enctype multipart/form-data untuk upload foto -->
                        <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Gunakan metode PUT untuk update -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan nama" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Hp</label>
                                <input type="number" class="form-control" name="phone" id="phone"
                                    placeholder="Masukkan nomor handphone" value="{{ old('phone', $user->phone) }}" required>
                            </div>
                                                        <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Masukkan email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="photo" id="photo">

                                <!-- Menampilkan foto saat ini -->
                                <div class="mt-2">
                                    <p class="mb-1">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . $user->photo) }}" class="img-fluid border"
                                        style="width: 150px; height: 150px; object-fit: cover; object-position: top;"
                                        alt="User Photo">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><b>Simpan Data</b></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

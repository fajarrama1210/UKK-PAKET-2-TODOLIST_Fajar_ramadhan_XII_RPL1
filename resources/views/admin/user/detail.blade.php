@extends('admin.layouts.app')

@section('title', 'Detail User')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Kolom Kiri: Foto Profil -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Foto Profil User -->
                        <div class="mb-3">
                            <label for="">Foto Profil</label>
                            <div class="border p-2 rounded bg-light d-flex justify-content-center">
                                @if ($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <p class="text-muted">Tidak ada foto</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Data User -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Nama User -->
                        <div class="mb-2">
                            <label for="">Nama User</label>
                            <p class="mb-0 fs-5"><strong>{{ $user->name }}</strong></p>
                        </div>

                        <!-- Email -->
                        <div class="mb-2">
                            <label for="">Email</label>
                            <p class="mb-0 fs-5"><strong>{{ $user->email }}</strong></p>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mb-2">
                            <label for="">Nomor Telepon</label>
                            <p class="mb-0 fs-5"><strong>{{ $user->phone }}</strong></p>
                        </div>

                        <!-- Role -->
                        <div class="mb-2">
                            <label for="">Role</label>
                            <p class="mb-0 fs-5">
                                <span class="badge bg-secondary rounded-3 py-2 fw-semibold fs-3">{{ ucfirst($user->role) }}</span>
                            </p>
                        </div>

                        <!-- Status -->
                        <div class="mb-2">
                            <label for="">Status</label>
                            <p class="mb-3 fs-5">
                                @if ($user->status == 'active')
                                    <span class="badge bg-light-primary rounded-3 py-2 text-primary fw-semibold fs-2">Active</span>
                                @elseif ($user->status == 'inactive')
                                    <span class="badge bg-light-danger rounded-3 py-2 text-danger fw-semibold fs-2">Inactive</span>
                                @else
                                    <span class="badge bg-light-danger rounded-3 py-2 text-danger fw-semibold fs-2">Unknown</span>
                                @endif
                            </p>
                        </div>

                        <!-- Tanggal Dibuat -->
                        <div class="mb-2">
                            <label for="">Tanggal Dibuat</label>
                            <p class="mb-0 fs-5"><strong>{{ \Carbon\Carbon::parse($user->created_at)->format('d F Y, H:i') }}</strong></p>
                        </div>

                        <!-- Tanggal Diperbarui -->
                        <div class="mb-2">
                            <label for="">Tanggal Diperbarui</label>
                            <p class="mb-0 fs-5"><strong>{{ \Carbon\Carbon::parse($user->updated_at)->format('d F Y, H:i') }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('admin.user.list') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar User</a>
        </div>
    </div>
@endsection

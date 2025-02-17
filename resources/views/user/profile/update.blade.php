@extends('user.layouts.app')
@section('title', 'Update Profile')
@section('content')
<div class="row">
    <!-- Profile Update Form Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="mb-4">Update Profile</h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('user.profile.list') }}" class="btn btn-outline-indigo btn-sm fw-bold">
                            <b>← Kembali</b>
                        </a>
                    </div>
                </div>
                <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                        <label for="current_password" class="form-label">Password Lama</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="current_password" id="current_password"
                                placeholder="Masukkan password lama" value="{{ old('current_password') }}">
                            <span class="input-group-text" id="toggleCurrentPassword">
                                <i class="fas fa-eye" id="eyeIconCurrent"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="new_password" id="new_password"
                                placeholder="Masukkan password baru">
                            <span class="input-group-text" id="toggleNewPassword">
                                <i class="fas fa-eye" id="eyeIconNew"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="new_password_confirmation"
                                id="new_password_confirmation" placeholder="Masukkan konfirmasi password baru">
                            <span class="input-group-text" id="toggleConfirmPassword">
                                <i class="fas fa-eye" id="eyeIconConfirm"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="photo" id="photo">

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

    <!-- Warning Column -->
    <div class="col-md-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">Perhatian!</h5>
                <p class="card-text">Jika Anda tidak mengubah password, maka password akun Anda akan tetap sama.</p>
            </div>
        </div>
    </div>
</div>

    <script>
        // Toggle untuk password
        document.getElementById('toggleCurrentPassword').addEventListener('click', function() {
            var passwordField = document.getElementById('current_password');
            var icon = document.getElementById('eyeIconCurrent');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            var passwordField = document.getElementById('new_password');
            var icon = document.getElementById('eyeIconNew');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            var passwordField = document.getElementById('new_password_confirmation');
            var icon = document.getElementById('eyeIconConfirm');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
@endsection

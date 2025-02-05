@extends('user.layouts.app')
@section('title', 'Tambah List')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="mb-4">Tambah List</h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('user.list.list') }}" class="btn btn-outline-indigo btn-sm fw-bold">
                            <b>← Kembali</b>
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('user.list.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Task List</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama List"
                            value="{{ old('name') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><b>Simpan Data</b></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

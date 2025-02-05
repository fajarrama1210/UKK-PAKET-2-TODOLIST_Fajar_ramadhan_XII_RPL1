@extends('user.layouts.app')
@section('title')
Kategori
@endsection
@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <p class="text-gray-md letter-spacing-2 fs-1 mb-2">Pencarian Data</p>
                    <form action="{{ route('user.category.list') }}" method="GET" class="row gy-2 gx-3 align-items-center">
                        <div class="col-md-auto mb-2 position-relative">
                            <span class="position-absolute top-50 translate-middle-y ms-3">
                                @include('components.icons.kacaPembesar')
                            </span>
                            <input type="text" class="form-control ps-5" name="search_keyword" id="search_keyword"
                                placeholder="Masukkan kata kunci" value="{{ request('search_keyword') }}">
                        </div>
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-primary"><b>Cari</b></button>
                        </div>
                        @if(request()->has('search_keyword') && request('search_keyword') != '')
                            <div class="col-md-auto">
                                <a href="{{ route('user.category.list') }}" class="btn btn-secondary">Reset Filter</a>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets/dist/images/breadcrumb/ChatBc.png') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0 lh-sm">Tabel Kategori</h5>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive rounded-2 mb-4">
                <table class="table border text-nowrap customize-table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                                <td>{{ $category->name }}</td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('assets/dist/images/noData.png') }}" alt=""
                                    style="max-width: 200px; max-height: 200px;">
                                <p class="fs-3 fw-semibold text-gray-md">Data tidak ditemukan</p>
                            </td>
                        </tr>
                @endforelse
                    </tbody>
                </table>
            </div>
            @include('components.pagination.pagination', ['paginator' => $categories])
        </div>
    </div>
</div>


@endsection



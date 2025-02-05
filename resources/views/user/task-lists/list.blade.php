@extends('user.layouts.app')
@section('title', 'Task List')
@section('content')
<div class="container-fluid">
    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0 lh-sm">Tabel Task List</h5>
            <div>
                <a href="{{ route('user.list.add') }}" class="btn btn-primary btn-sm me-2">Tambah List</a>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive rounded-2 mb-4">
                <table class="table border text-nowrap customize-table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>No</th>
                            <th>Nama List</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($taskLists as $taskList)
                            <tr>
                                <td>{{ $loop->iteration + ($taskLists->currentPage() - 1) * $taskLists->perPage() }}</td>
                                <td>{{ $taskList->name }}</td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <a href="#" class="text-muted" data-bs-toggle="dropdown">
                                            @include('components.icons.elipis')
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3"
                                                    href="{{ route('user.list.edit', $taskList) }}">
                                                    @include('components.icons.edit') Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form id="delete-form-{{ $taskList->id }}"
                                                    action="{{ route('user.list.delete', $taskList) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="javascript:void(0)"
                                                    onclick="confirmDelete({{ $taskList->id }})"
                                                    class="dropdown-item d-flex align-items-center gap-3">
                                                    @include('components.icons.delete') Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
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
            @include('components.pagination.pagination', ['paginator' => $taskLists])
        </div>
    </div>
</div>
@endsection

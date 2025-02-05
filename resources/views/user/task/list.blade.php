@extends('user.layouts.app')
@section('title')
    Task List
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-gray-md letter-spacing-2 fs-1 mb-2">PENCARIAN DATA</p>
                        <form action="" method="GET" class="row gy-2 gx-3 align-items-center">
                            <input type="hidden" name="filter_on" value="true">

                            {{-- Filter Kategori --}}
                            <div class="col-md-auto mb-2">
                                <label class="visually-hidden" for="filter_kategori">Kategori</label>
                                <select class="form-select" id="filter_kategori" name="filter_kategori">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('filter_kategori') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filter Status --}}
                            <div class="col-md-auto mb-2">
                                <label class="visually-hidden" for="filter_status">Status</label>
                                <select class="form-select" id="filter_status" name="filter_status">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('filter_status') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="In Progress"
                                        {{ request('filter_status') == 'In Progress' ? 'selected' : '' }}>In Progress
                                    </option>
                                    <option value="completed"
                                        {{ request('filter_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            {{-- Filter Prioritas --}}
                            <div class="col-md-auto mb-2">
                                <label class="visually-hidden" for="filter_prioritas">Prioritas</label>
                                <select class="form-select" id="filter_prioritas" name="filter_prioritas">
                                    <option value="">Semua Prioritas</option>
                                    <option value="low" {{ request('filter_prioritas') == 'low' ? 'selected' : '' }}>Low
                                    </option>
                                    <option value="medium" {{ request('filter_prioritas') == 'medium' ? 'selected' : '' }}>
                                        Medium</option>
                                    <option value="high" {{ request('filter_prioritas') == 'high' ? 'selected' : '' }}>
                                        High</option>
                                </select>
                            </div>

                            {{-- Filter Bulan --}}
                            <div class="col-md-auto mb-2">
                                <label class="visually-hidden" for="filter_bulan">Bulan</label>
                                <select class="form-select" id="filter_bulan" name="filter_bulan">
                                    <option value="">Semua Bulan</option>
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ $month }}"
                                            {{ request('filter_bulan') == $month ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filter Tahun --}}
                            <div class="col-md-auto mb-2">
                                <label class="visually-hidden" for="filter_tahun">Tahun</label>
                                <select class="form-select" id="filter_tahun" name="filter_tahun">
                                    <option value="">Tahun</option>
                                    @foreach (range(date('Y'), date('Y') + 5) as $year)
                                        <option value="{{ $year }}"
                                            {{ request('filter_tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tombol Submit dan Reset --}}
                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary"><b>Pencarian</b></button>
                                @if (request()->hasAny(['filter_kategori', 'filter_status', 'filter_prioritas', 'filter_bulan', 'filter_tahun']))
                                    <a href="{{ url()->current() }}" class="btn btn-outline-primary ms-1">Reset Filter</a>
                                @endif
                            </div>
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
                <h5 class="card-title fw-semibold mb-0 lh-sm">Tabel Tugas</h5>
                <div>
                    <a href="{{ route('user.tasks.add') }}" class="btn btn-primary btn-sm me-2">Tambah Data</a>
                    <button class="btn btn-success btn-sm">Download Excel</button>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border text-nowrap customize-table mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">No</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0 ">Nama </h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Tanggal</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Jam</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Batas Tugas</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Prioritas</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <h6 class="fs-4 fw-semibold mb-0">{{ $task->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ \Carbon\Carbon::parse($task->date)->format('d F Y') }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ \Carbon\Carbon::parse($task->time)->format(' H:i') }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">
                                            @if ($task->deadline)
                                                {{ \Carbon\Carbon::parse($task->deadline)->format('d F Y') }}
                                            @else
                                                <span class="text-muted">Tidak Ada</span>
                                            @endif
                                        </p>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($task->priority == 'low')
                                                <span class="badge bg-secondary rounded-5 fw-semibold fs-3">Low</span>
                                            @elseif ($task->priority == 'medium')
                                                <span class="badge bg-primary rounded-3 fw-semibold fs-2">Medium</span>
                                            @elseif ($task->priority == 'high')
                                                <span class="badge bg-danger rounded-3 fw-semibold fs-3">High</span>
                                            @else
                                                <span class="badge bg-warning rounded-3 fw-semibold fs-3">Unknown</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if ($task->status == 'completed')
                                            <span
                                                class="badge bg-light-primary rounded-3 py-8 text-primary fw-semibold fs-2">completed</span>
                                        @elseif ($task->status == 'pending')
                                            <span
                                                class="badge bg-light-success rounded-3 py-8 text-success fw-semibold fs-2">pending</span>
                                        @elseif ($task->status == 'In Progress')
                                            <span
                                                class="badge bg-light-warning rounded-3 py-8 text-warning fw-semibold fs-2">In
                                                Progress</span>
                                        @else
                                            <span
                                                class="badge bg-light-danger rounded-3 py-8 text-danger fw-semibold fs-2">Unknown</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown dropstart">
                                            <a href="#" class="text-muted" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                @include('components.icons.elipis')
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3"
                                                        href="{{ route('user.tasks.show', $task->id) }}">
                                                        @include('components.icons.detail')Detail
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3"
                                                        href="{{ route('user.tasks.edit', $task->id) }}">
                                                        @include('components.icons.edit')Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('user.tasks.delete', $task->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item d-flex align-items-center gap-3">
                                                            @include('components.icons.delete')Delete
                                                        </button>
                                                    </form>
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
            </div>
        </div>
    </div>
@endsection

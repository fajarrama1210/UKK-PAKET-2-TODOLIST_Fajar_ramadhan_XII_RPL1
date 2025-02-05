<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img">
                <div class="" style="overflow: hidden; height: 110px;">
                    <img src="{{ asset('assets/dist/images/eTodo logo.svg') }}" class="dark-logo" width="180"
                        alt="" />
                </div>
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- Home Section -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- Dashboard Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.dashboard') }}" aria-expanded="false">
                        <span>
                            @include('components.icons.dashboard') <!-- Ganti dengan icon dashboard jika diperlukan -->
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <!-- Category Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.category.list') }}" aria-expanded="false">
                        <span>
                            @include('components.icons.category') <!-- Ganti dengan icon category jika diperlukan -->
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>
                <!-- Task Lists Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.list.list') }}" aria-expanded="false">
                        <span>
                            @include('components.icons.task') <!-- Ganti dengan icon task jika diperlukan -->
                        </span>
                        <span class="hide-menu">Task Lists</span>
                    </a>
                </li>
                <!-- Divider -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">My Task Lists</span>
                </li>

                <!-- Loop melalui Task Lists -->
                @foreach (auth()->user()->TaskLists as $taskList)
                    <li class="sidebar-item">
                        <a class="sidebar-link"
                            href="{{ route('user.tasks.list.filter', ['taskList' => $taskList->id]) }}"
                            aria-expanded="false">
                            <span>
                                {{-- @include('components.icons.task') <!-- Ganti dengan icon task list jika diperlukan --> --}}
                            </span>
                            <span class="hide-menu">{{ $taskList->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
<!-- Sidebar End -->

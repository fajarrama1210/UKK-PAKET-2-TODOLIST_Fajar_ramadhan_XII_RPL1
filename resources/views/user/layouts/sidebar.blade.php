<aside class="left-sidebar">
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
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.dashboard') }}" aria-expanded="false">
                        <span>
                            @include('components.icons.dashboard')
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.category.list') }}" aria-expanded="false">
                        <span>
                            @include('components.icons.category')
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.list.list') }}" aria-expanded="false">
                        <span>
                            @include('components.icons.task')
                        </span>
                        <span class="hide-menu">Task Lists</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pengaturan</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user.profile.list') }}" aria-expanded="false">
                        <span>
                            @include('components.icons.user')
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Tugas Saya</span>
                </li>

                @foreach (auth()->user()->TaskLists as $taskList)
                    <li class="sidebar-item">
                        <a class="sidebar-link"
                            href="{{ route('user.tasks.list.filter', ['taskList' => $taskList->id]) }}"
                            aria-expanded="false">
                            <span>
                                @include('components.icons.circle')
                            </span>
                            <span class="hide-menu">{{ $taskList->name }}</span>
                        </a>
                    </li>
                @endforeach

            </ul>
        </nav>
    </div>
</aside>

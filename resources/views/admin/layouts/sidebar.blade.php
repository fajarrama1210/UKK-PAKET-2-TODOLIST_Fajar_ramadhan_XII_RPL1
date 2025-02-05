        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="#" class="text-nowrap logo-img">
                        <div class="" style="overflow: hidden; height: 110px;">
                            <img src="{{ asset('assets/dist/images/eTodo logo.svg') }}"
                                class="dark-logo" width="180" alt="" />
                        </div>
                    </a>
                    <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8 text-muted"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <span>
                                    @include('components.icons.dashboard')
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Apps</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.category.list') }}" aria-expanded="false">
                                <span>
                                    @include('components.icons.category')
                                </span>
                                <span class="hide-menu">Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.user.list') }}" aria-expanded="false">
                                <span>
                                    @include('components.icons.user')
                                </span>
                                <span class="hide-menu">User</span>
                            </a>
                        </li>
                    </ul>
                    <div class="unlimited-access hide-menu bg-light-primary position-relative my-7 rounded">
                        <div class="d-flex">
                            <div class="unlimited-access-title">
                                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Unlimited Access</h6>
                                <button class="btn btn-primary fs-2 fw-semibold lh-sm">Signup</button>
                            </div>
                            <div class="unlimited-access-img">
                                <img src="{{ asset('assets/dist/images/backgrounds/rocket.png') }}" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>

<nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse"
                href="javascript:void(0)">
            @include('components.icons.menu')
            </a>
        </li>
    </ul>

    <div class="d-block d-lg-none">
        <img src="{{ asset('assets/dist/images/eTodo logo.png') }}" class="light-logo" width="180" alt="" />
    </div>
    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="p-2">
            <i class="ti ti-dots fs-7"></i>
        </span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="d-flex align-items-center justify-content-between">
            <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                aria-controls="offcanvasWithBothOptions">
                <i class="ti ti-align-justified fs-7"></i>
            </a>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                <li class="nav-item dropdown">
                    <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div class="user-profile-img">
                                <img src="{{ asset(auth()->user()->photo == null ? 'Default.png' : 'storage/' . auth()->user()->photo) }}"
                                    class="rounded-circle"
                                    style="object-fit: cover; width: 35px; height: 35px; border-radius: 50%; object-position: top;"
                                    alt="" />
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                        aria-labelledby="drop1">
                        <div class="profile-dropdown position-relative" data-simplebar>
                            <div class="py-3 px-7 pb-0">
                                <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                            </div>
                            <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                <img src="{{ asset('storage/' . (Auth::user()->photo ?? 'images/default-profile.jpg')) }}"
                                    class="rounded-circle"
                                    style="object-fit: cover; width: 80px; height: 80px; border-radius: 50%; object-position: top;"
                                    alt="User Photo" />
                                <div class="ms-3">
                                    <h5 class="mb-1 fs-3">{{ Auth::user()->name }}</h5>
                                    <span class="mb-1 d-block text-dark">{{ Auth::user()->role ?? 'User' }}</span>
                                    <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                         {{ Auth::user()->email }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-grid py-4 px-7 pt-8">
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="btn btn-outline-primary">Log Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

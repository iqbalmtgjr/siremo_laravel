<body
    class="layout-fixed sidebar-expand-lg bg-body-tertiary {{ request()->is('transaksi') ? 'sidebar-mini sidebar-collapse' : '' }}">
    <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="javascript:void(0)" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    <li class="nav-item d-none d-md-block">
                        <a href="javascript:void(0)" class="nav-link text-danger fw-bold" data-bs-toggle="modal"
                            data-bs-target="#kritikSaranModal">Kritik
                            & Saran</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
                    <!--begin::Messages Dropdown Menu-->
                    {{-- <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i
                                class="bi bi-bell-fill"></i> <span class="navbar-badge badge text-bg-warning">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <span
                                class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i
                                    class="bi bi-envelope me-2"></i> 4 new messages
                                <span class="float-end text-secondary fs-7">3 mins</span> </a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i
                                    class="bi bi-people-fill me-2"></i> 8 friend requests
                                <span class="float-end text-secondary fs-7">12 hours</span> </a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i
                                    class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                                <span class="float-end text-secondary fs-7">2 days</span> </a>
                            <div class="dropdown-divider"></div> <a href="#"
                                class="dropdown-item dropdown-footer">
                                See All Notifications
                            </a>
                        </div>
                    </li> <!--end::Notifications Dropdown Menu--> <!--begin::Fullscreen Toggle--> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-lte-toggle="fullscreen"> <i
                                data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i
                                data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                        </a>
                    </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('asset/assets/img/siremoLogo.png') }}"
                                class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->nama }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                <img class="rounded-circle shadow" src="{{ asset('asset/assets/img/siremoLogo.png') }}"
                                    alt="user" />
                                {{-- <img src="asset/assets/img/siremoLogo.png" class="rounded-circle shadow"
                                    alt="User Image"> --}}
                                <p>
                                    {{ Auth::user()->nama }}
                                    {{-- <small>Member since Nov. 2023</small> --}}
                                </p>
                            </li> <!--end::User Image--> <!--begin::Menu Body-->
                            <li class="user-body"> <!--begin::Row-->
                                {{-- <div class="row">
                                    <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                                    <div class="col-4 text-center"> <a href="#">Sales</a> </div>
                                    <div class="col-4 text-center"> <a href="#">Friends</a> </div>
                                </div> <!--end::Row--> --}}
                            </li> <!--end::Menu Body--> <!--begin::Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ url('profil/' . Auth::user()->id) }}"
                                    class="btn btn-primary btn-flat">Profil</a>
                                <a href="{{ route('logout') }}" class="btn btn-danger btn-flat float-end"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Keluar</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li> <!--end::User Menu Dropdown-->
                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->
        @include('modalkritikdansaran')

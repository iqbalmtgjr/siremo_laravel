<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a
            href="{{ auth()->user()->role == 'staff_mitra' ? url('/transaksi') : url('/home') }}" class="brand-link">
            <!--begin::Brand Image--> <img src="{{ asset('asset/assets/img/siremoLogo.png') }}" alt="Siremo Logo"
                class="brand-image opacity-75 shadow"> <!--end::Brand Image-->
            <!--begin::Brand Text--> <span class="brand-text fw-light">SI<b>REMO</b></span> <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            @if (auth()->user()->role != 'staff_mitra')
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}"> <i
                                class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                </ul>
            @endif
            @if (auth()->user()->role == 'super_admin')
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('mitra') }}" class="nav-link {{ request()->is('mitra') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-intersect"></i>
                            <p>Mitra</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('pengguna') }}"
                            class="nav-link {{ request()->is('pengguna') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people-fill"></i>
                            <p>Semua Pengguna</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('kritik') }}" class="nav-link {{ request()->is('kritik') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-chat-dots"></i>
                            <p>Kritik & Saran</p>
                        </a>
                    </li>
                </ul>
            @endif
            @if (auth()->user()->role == 'admin_mitra')
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('penggunamitra') }}"
                            class="nav-link {{ request()->is('penggunamitra') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people-fill"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('kendaraan') }}"
                            class="nav-link {{ request()->is('kendaraan') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-truck"></i>
                            <p>Kendaraan</p>
                        </a>
                    </li>
                </ul>
                {{-- <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('hargasewa') }}"
                            class="nav-link {{ request()->is('hargasewa') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-currency-dollar"></i>
                            <p>Harga Sewa</p>
                        </a>
                    </li>
                </ul> --}}
            @endif
            @if (auth()->user()->role == 'admin_mitra' || auth()->user()->role == 'staff_mitra')
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('transaksi') }}"
                            class="nav-link {{ request()->is('transaksi') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-cash-stack"></i>
                            <p>Transaksi</p>
                        </a>
                    </li>
                </ul>
            @endif
            @if (auth()->user()->role == 'admin_mitra')
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('riwayat') }}"
                            class="nav-link {{ request()->is('riwayat') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clipboard-data"></i>
                            <p>Riwayat Transaksi</p>
                        </a>
                    </li>
                </ul>
            @endif
        </nav>
    </div>
</aside>

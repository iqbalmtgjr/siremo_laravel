@include('layouts.header')

<body class="register-page bg-body-secondary">
    <div class="register-box"> <!-- /.register-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header"> <a href="{{ url('/register') }}"
                    class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0"> SI<b>REMO</b>
                    </h1>
                </a> </div>
            <div class="card-body register-card-body">
                <p class="register-box-msg">Daftar SIREMO</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerFullName" type="text"
                                class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama') }}" placeholder="">
                            <label for="registerFullName">Nama Lengkap</label>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerFullName" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username') }}" placeholder="">
                            <label for="registerFullName">Username</label>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerEmail" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="">
                            <label for="registerEmail">Email</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerFullName" type="text"
                                class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                value="{{ old('no_hp') }}" placeholder="">
                            <label for="registerFullName">No HP</label>
                            @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group-text"> <span class="bi bi-phone"></span> </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerPassword" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="">
                            <label for="registerPassword">Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    </div> <!--begin::Row-->
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" placeholder="">
                            <label for="password-confirm">Konfirmasi Password</label>
                        </div>
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    </div> <!--begin::Row-->
                    <div class="row mt-2">
                        {{-- <div class="col-8 d-inline-flex align-items-center">
                            <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">
                                    I agree to the <a href="#">terms</a> </label> </div>
                        </div> <!-- /.col --> --}}
                        <div class="col-12">
                            <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Daftar
                                    Sekarang</button>
                            </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
                <!--<div class="social-auth-links text-center mb-3 d-grid gap-2">-->
                <!--    <p>- Atau -</p>-->
                <!--    {{-- <a href="#" class="btn btn-primary"> <i class="bi bi-facebook me-2"></i> Sign in-->
                <!--        using Facebook-->
                <!--    </a> --}}-->
                <!--    <a href="{{ route('auth.google') }}" class="btn btn-danger"> <i class="bi bi-google me-2"></i>-->
                <!--        Masuk dengan Google-->
                <!--    </a>-->
                <!--</div> <!-- /.social-auth-links -->
                <p class="mb-0 mt-3"> <a href="{{ route('login') }}" class="link-primary text-center">
                        Sudah daftar? Masuk disini
                    </a> </p>
            </div> <!-- /.register-card-body -->
        </div>
    </div> <!-- /.register-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="asset/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->
</body><!--end::Body-->

</html>

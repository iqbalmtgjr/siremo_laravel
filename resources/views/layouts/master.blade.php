@include('layouts.header')

@include('layouts.navbar')
@include('layouts.sidebar')
<main class="app-main"> <!--begin::App Content Header-->
    @yield('content')
    {{ isset($slot) ? $slot : null }}
</main> <!--end::App Main--> <!--begin::Footer-->
@include('layouts.footer')

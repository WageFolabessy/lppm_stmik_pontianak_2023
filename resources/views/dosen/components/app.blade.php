<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="garisAs" content="projek" />
    <title>LPPM STMIK PONTIANAK - @yield('title')</title>
    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    {{-- Icons --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
    {{-- CSS Template Dan Bootstrap v5.3.0 --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/sb-admin-2/sb-admin-2.min.css') }}">
    {{-- CSS Untuk Halaman Lain --}}
    @yield('css')
</head>

<body id="page-top">
    {{-- Wrapper Start --}}
    <div id="wrapper">
        {{-- Sidebar --}}
        @include('dosen.components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                {{-- Top Navbar --}}
                @include('dosen.components.top-navbar')
                {{-- Content --}}
                <div class="container-fluid">
                    <div class="justify-content-center">
                        @yield('content')
                    </div>
                </div>
            </div>
            {{-- Footer --}}
            @include('components.footer')
        </div>
    </div>
    {{-- Wrapper End --}}

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- JavaScript Untuk Jquery v3.7.1 dan Bootstrap v5.3.0 --}}
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- JavaScript Untuk Template Ini --}}
    <script src="{{ asset('assets/vendor/sb-admin-2/sb-admin-2.min.js') }}"></script>
    {{-- JavaScript Untuk Halaman Lain --}}
    @yield('script')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Admin Panel')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles (order matters: Bootstrap -> Icons -> Theme) -->
    <link href="{{ asset('admin/sb2/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/sb2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/sb2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body id="page-top">

    <div id="wrapper">
        {{-- Sidebar placeholder: sayfa özel sidebar gerekiyorsa burada include edebilirsin --}}
        @includeIf('admin.partials.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                {{-- Topbar placeholder --}}
                @includeIf('admin.partials.topbar')

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            {{-- Footer --}}
            @includeIf('admin.partials.footer')
        </div>
    </div>

    {{-- Scroll to Top Button--}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Scripts -->
    <script src="{{ asset('admin/sb2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/sb2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/sb2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/sb2/js/sb-admin-2.min.js') }}"></script>
    @stack('scripts')
</body>

</html>



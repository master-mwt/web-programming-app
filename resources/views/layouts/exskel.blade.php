<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title  -->
        <title>{{ config('app.name', 'wpapp') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="hold-transition sidebar-mini">
    
        <!-- Wrapper -->
        <div class="wrapper">
            
            <!-- Navbar -->
            @include('layouts.navs.nav')

            <!-- Sidebar -->
            @include('layouts.sbars.sbar')

            <!-- Content -->
            <div class="content-wrapper">
                <div class="content p-4">
                    @yield('content')
                </div>
            </div>

        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
        <!-- Bootstrap -->
        <!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
        <!-- AdminLTE -->
        <!-- <script src="dist/js/adminlte.js"></script> -->
    </body>
</html>

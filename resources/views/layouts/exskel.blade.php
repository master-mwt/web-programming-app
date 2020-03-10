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
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- EasyMDE markdown editor -->
        <link rel="stylesheet" href="{{ URL::asset('css/easymde.min.css') }}">
        <script src="{{ URL::asset('js/easymde.min.js') }}"></script>
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

        <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
        @stack('scripts')
    </body>
</html>

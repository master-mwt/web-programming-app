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

        <!-- Marked markdown parser -->
        <script src="{{ URL::asset('js/marked.min.js') }}"></script>
    </head>

    <body class="hold-transition sidebar-mini">

        <!-- Wrapper -->
        <div class="wrapper">

            <!-- Navbar -->
            @include('layouts.navs.nav')

            <!-- Sidebar -->
            @include('layouts.sbars.sbar')

            <!-- toasts -->
            <div class="position-fixed bg-danger" style="z-index: 1000; right: 0; min-width: 350px;">

                <!-- toast 1 -->
                <div id="toast1" class="toast ml-auto bg-dark m-4" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto">Bootstrap</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    See? Just like this.
                </div>
                </div>

                <!-- toast 2 -->
                <div id="toast2" class="toast ml-auto bg-dark m-4" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto">Bootstrap</strong>
                    <small class="text-muted">2 seconds ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Heads up, toasts will stack automatically
                </div>
                </div>

            </div>
            <!-- end toasts -->

            <!-- toast js -->
            <script>
                $(document).ready(function() {
                    $('#toast1').toast({delay: 3000});
                    $('#toast1').toast('show');  
                    $('#toast2').toast({delay: 5000});
                    $('#toast2').toast('show');  
                });
            </script>
            <!-- end toast js -->

            <!-- Content -->
            <div class="content-wrapper">
                <div class="content p-4">
                    @yield('content')
                </div>
            </div>

        </div>
        <!-- ./wrapper -->

        <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
        <script type="javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>

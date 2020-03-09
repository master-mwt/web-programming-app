<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">

    <!-- Brand Logo -->
    <a href="/" class="brand-link">
    <img src="{{ URL::asset('/imgs/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">Kernel Panic</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        @guest
        @else
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{ route('home') }}">
                    <img src="{{ URL::asset('/imgs/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </a>
            </div>

            <div class="info">
                <a href="{{ route('home') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        @endguest

        @guest
            @include('layouts.sbars.menu.guest')
        @else
            @include('layouts.sbars.menu.guest')
        @endguest

    </div>
    <!-- /.sidebar -->
</aside>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
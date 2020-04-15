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
                @php
                    $user = Auth::User();
                    $user->image = \App\Image::where('id', $user->image_id)->first();
                @endphp
                <a href="{{ route('home') }}">
                    <img src="@if(is_null($user->image)) {{ URL::asset('imgs/no_profile_img.jpg') }} @else {{ $user->image->location }} @endif" class="img-circle elevation-2" alt="User Image">
                </a>
            </div>

            <div class="info">
                <a href="{{ route('home') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        @endguest

        @include('layouts.sbars.menu.menu')

    </div>
    <!-- /.sidebar -->
</aside>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="" class="nav-link">Home</a>
        </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline mx-3 d-inline w-100" role="form" method="get" action="{{ route('search') }}">
        @csrf
        <div class="input-group input-group-sm">

            <div class="input-group-append mr-2">
                <select name="target" id="" class="form-control form-control-sm form-control-navbar" style="outline: none; box-shadow: none; background-color: #eee">
                    <option value="posts" @if (!empty($target) && $target == 'posts') selected="selected" @endif>posts</option>
                    <option value="channels" @if (!empty($target) && $target == 'channels') selected="selected" @endif>channels</option>
                    <option value="users" @if (!empty($target) && $target == 'users') selected="selected" @endif>users</option>
                    <option value="tags" @if (!empty($target) && $target == 'tags') selected="selected" @endif>tags</option>
                </select>
            </div>

            <input class="form-control form-control-navbar rounded" type="search" placeholder="Search" aria-label="Search" name="query" value="@if (!empty($query)) {{$query}}@endif">

            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>

        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @guest
        @else
            <!-- Messages modal trigger -->
            <button id="notification-button" type="button" class="btn btn-outline-none" data-toggle="modal" data-target="#messages_modal"><i class="far fa-bell"></i></button>

            <!-- Notification modal trigger -->
{{--            <button id="notification-button" type="button" class="btn btn-outline-none" data-toggle="modal" data-target="#notification_modal"><i class="far fa-bell"></i></button>--}}
        @endguest

        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                <!-- {{ __('Login') }} -->
                <i class="fas fa-sign-in-alt"></i>
                </a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                    <!-- {{ __('Register') }} -->
                    <i class="fas fa-user-plus"></i>
                    </a>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <!-- {{ __('Logout') }} -->
                    <i class="fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</nav>
<!-- /.navbar -->

<!-- Messages modal -->
<div class="modal fade" id="messages_modal" tabindex="-1" role="dialog" aria-labelledby="messages_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- aggiunta -->
            <div class="modal-header p-2 justify-content-center">
                <h5 id="notification-count" class="m-0">No Notifications</h5>
            </div>
            <!-- /aggiunta -->
            <div id="notification-area" class="modal-body pb-0 px-3 pt-3">
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button onclick="location.href='{{ route('notification.clear') }}'" type="button" class="btn btn-outline-secondary">Dismiss All Messages</button>
            </div>
        </div>
    </div>
</div>

<!-- Notification modal -->
<!--
<div class="modal fade" id="notification_modal" tabindex="-1" role="dialog" aria-labelledby="notification_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header p-2 justify-content-center">
            <h5 id="notification-count" class="m-0">No Notifications</h5>
        </div>
        <div id="notification-area" class="d-flex flex-column modal-body px-3">
        </div>
        <div class="modal-footer p-2">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button onclick="location.href='{{ route('notification.clear') }}'" type="button" class="btn btn-outline-secondary">Dismiss All Messages</button>
        </div>
        </div>
    </div>
</div>
-->

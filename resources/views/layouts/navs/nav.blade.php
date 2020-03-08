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
        <div class="input-group input-group-sm">

            <div class="input-group-append">
                <select name="target" id="" class="form-control form-control-sm form-control-navbar" style="outline: none; box-shadow: none; background-color: #eee">
                    <option value="posts">posts</option>
                    <option value="channels">channels</option>
                    <option value="users">users</option>
                </select>
            </div>

            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="query">

            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>

        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Messages modal trigger -->
        <button type="button" class="btn btn-outline-none" data-toggle="modal" data-target="#messages_modal"><i class="far fa-comments"></i></button>

        <!-- Notification modal trigger -->
        <button type="button" class="btn btn-outline-none" data-toggle="modal" data-target="#notification_modal"><i class="far fa-bell"></i></button>

        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                {{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                    {{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
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
        <div class="modal-body pb-0 px-3 pt-3">

        <div class="media">
            <img src="{{ URL::asset('/imgs/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
                <h3 class="dropdown-item-title">
                User 1
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
        </div>

        <div class="media">
            <img src="{{ URL::asset('/imgs/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
                <h3 class="dropdown-item-title">
                User 3
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 5 Hours Ago</p>
            </div>
            </div>
        </div>

        <div class="modal-footer p-2">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-outline-secondary">See All Messages</button>
        </div>
        </div>
    </div>
</div>

<!-- Notification modal -->
<div class="modal fade" id="notification_modal" tabindex="-1" role="dialog" aria-labelledby="notification_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header p-2 justify-content-center">
            <h5 class="m-0">15 Notifications</h5>
        </div>
        <div class="d-flex flex-column modal-body px-3">
            <a href="#" class="my-2">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <a href="#" class="my-2">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <a href="#" class="my-2">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
            </a>
        </div>
        <div class="modal-footer p-2">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-outline-secondary">See All Messages</button>
        </div>
        </div>
    </div>
</div>
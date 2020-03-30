<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- backend: visible only if logged&&administrator -->
        @if(Auth::check() && Auth::User()->group_id == 1)

        <li class="nav-header px-0 px-3">ADMIN</li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tools"></i>
            <p>
                Backend
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('backend.channels') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Channels</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backend.tags') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tags</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backend.posts') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Posts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backend.replies') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Replies</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backend.comments') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Comments</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        <li class="nav-header px-0 px-3">USER</li>

        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon fas fa-user-circle"></i>
            <p>Home</p>
            </a>
        </li>

        @if(Auth::check())
        <li class="nav-item">
            <a href="{{ route('users.edit', Auth::user()->id) }}" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>Settings</p>
            </a>
        </li>
        @endif

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Posts
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home.post.owned') }}" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>My Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home.post.saved') }}" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Saved Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home.post.hidden') }}" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Hidden Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home.post.reported') }}" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Reported Posts</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Replies
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home.reply.owned') }}" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>My Replies</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Comments
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home.comment.owned') }}" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>My Comments</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Channels
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home.channel.owned') }}" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>My Channels</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home.channel.joined') }}" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Joined Channels</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="nav-header px-0 px-3">INFO</li>

        <li class="nav-item">
            <a href="{{ route('help') }}" class="nav-link">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>Help</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('about') }}" class="nav-link">
            <i class="nav-icon fas fa-info"></i>
            <p>About</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('contact') }}" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
            <p>Contact Us</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->

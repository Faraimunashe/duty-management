<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin-categories') }}">
                    <i class="bi bi-truck"></i>
                    <span>Vehicle Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin-users') }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>
        @elseif (Auth::user()->hasRole('user'))

        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('profile') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="bi bi-lock"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside>

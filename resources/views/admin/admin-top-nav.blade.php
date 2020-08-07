<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}">Chep.XYZ</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#" onclick="toggleSidebar('sb-sidenav-toggled');return false;"><i class="fas fa-bars"></i></button>

    <!-- Navbar-->
    <ul class="navbar-nav position-absolute" style="right:1rem;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                @if(!App::isLocale('en'))
                    <a class="dropdown-item" href="/lang/en">English</a>
                @endif
                @if(!App::isLocale('vi'))
                    <a class="dropdown-item" href="/lang/vi">tiếng Việt</a>
                @endif
                @if(!App::isLocale('de'))
                    <a class="dropdown-item" href="/lang/de">Deutsche</a>
                @endif

                <div class="dropdown-divider"></div>
                {{-- ben duoi la nut logout --}}
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('messages.textLogout') }} 
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</nav>
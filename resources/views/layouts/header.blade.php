<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>

                <ul class="user-menu dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#"><i class="fa fa-power-off" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></i> {{ __('Logout') }}</a></li>
                </ul>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>

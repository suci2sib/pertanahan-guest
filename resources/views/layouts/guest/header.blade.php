<header class="header navbar-area" style="padding:0;margin:0;">
    <div class="container-fluid px-5"> <!-- tambahkan padding horizontal -->
        <nav class="navbar navbar-expand-lg w-100">
            <a class="navbar-brand" href="#home">
                <img src="{{ asset('assets/assets-guest/images/logo/logo.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                @if (Auth::check())
                    <ul id="nav" class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                href="{{ route('dashboard.index') }}#home">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                href="{{ route('dashboard.index') }}#about">
                                About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                href="{{ route('dashboard.index') }}#layanan">
                                Layanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                href="{{ route('dashboard.index') }}#kontak">
                                Kontak
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('auth.destroy') }}" method="POST"
                            style="display:none;">
                            @csrf
                        </form>

                        <a class="nav-link" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                    </ul>
                @else
                    <div class="ms-auto">
                        <a href="{{ route('auth.index') }}" class="btn btn-primary">Login</a>
                    </div>
                @endif
            </div>
        </nav>
    </div>
</header>

<header class="header navbar-area" style="padding:0;margin:0;">
    <div class="container-fluid px-5">
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
                    <ul id="nav" class="navbar-nav ms-auto align-items-center">
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
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                href="{{ route('dashboard.index') }}#developer">
                                Developer
                            </a>
                        </li>

                        <li class="nav-item ms-lg-3">
                            <form id="logout-form" action="{{ route('auth.destroy') }}" method="POST"
                                style="display:none;">
                                @csrf
                            </form>

                            <a class="btn" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                style="background-color: #ff6b81; 
                                       color: white; 
                                       padding: 6px 20px; 
                                       border-radius: 50px; 
                                       font-size: 14px; 
                                       border: none; 
                                       font-weight: 600;
                                       box-shadow: 0 4px 10px rgba(255, 107, 129, 0.3);
                                       transition: 0.3s;">
                                Logout
                            </a>
                        </li>
                    </ul>
                @else
                    <div class="ms-auto">
                        <a href="{{ route('auth.index') }}" class="btn" 
                           style="background-color: #ff6b81; 
                                  color: white; 
                                  padding: 6px 20px; 
                                  border-radius: 50px; 
                                  font-size: 14px; 
                                  border: none;
                                  font-weight: 600;
                                  box-shadow: 0 4px 10px rgba(255, 107, 129, 0.3);">
                           Login
                        </a>
                    </div>
                @endif
            </div>
        </nav>
    </div>
</header>
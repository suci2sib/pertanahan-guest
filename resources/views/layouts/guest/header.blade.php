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
                <ul id="nav" class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}#developer">Developer</a>
                    </li>

                    {{-- Ganti bagian dropdown profile dengan ini --}}
@if (Auth::check())
    <li class="nav-item dropdown ms-lg-3">
        <a class="nav-link dropdown-toggle d-flex align-items-center profile-trigger" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="profile-avatar-mini me-2">
                @if(Auth::user()->foto_profil)
                    <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Profile" style="width:24px;height:24px;border-radius:50%;object-fit:cover;">
                @else
                    <i class="lni lni-user"></i>
                @endif
            </div>
            <span class="user-name-text">{{ Auth::user()->nama ?? Auth::user()->name ?? Auth::user()->username }}</span>
        </a>
        
        <ul class="dropdown-menu dropdown-menu-end custom-dropdown shadow-lg" aria-labelledby="navbarDropdown">
            <li>
                <a class="dropdown-item p-3" href="{{ route('profile.show') }}">
                    <div class="d-flex align-items-center">
                        <i class="lni lni-user me-3 fs-5"></i>
                        <span class="item-text fw-bold">My Profile</span>
                    </div>
                </a>
            </li>
            <li><hr class="dropdown-divider my-0 opacity-100" style="border-color: #f0f0f0;"></li>
            <li>
    <form id="logout-form" action="{{ route('auth.destroy') }}" method="POST" class="d-inline">
        @csrf
        {{-- HAPUS @method('POST') KARENA ROUTE SUDAH POST --}}
        <button type="submit" class="dropdown-item p-3 w-100 text-start" style="background:none;border:none;">
            <div class="d-flex align-items-center">
                <i class="lni lni-exit me-3 fs-5"></i>
                <span class="item-text fw-bold">Logout</span>
            </div>
        </button>
    </form>
</li>
        </ul>
    </li>
@else
    <li class="nav-item ms-lg-3">
        <a href="{{ route('auth.index') }}" class="btn login-btn">Login</a>
    </li>
@endif
                </ul>
            </div>
        </nav>
    </div>
</header>

<style>
    /* Styling agar tetap sinkron dengan tema Pink-White Anda */
    .profile-trigger {
        background-color: #fff0f3; 
        color: #ff6b81 !important; 
        padding: 6px 18px !important; 
        border-radius: 50px; 
        font-weight: 700 !important; 
        font-size: 14px; 
        border: 1px solid #ffe3e8;
        transition: 0.3s;
    }
    .profile-trigger:hover {
        background-color: #ff6b81;
        color: white !important;
    }
    .profile-avatar-mini {
        width: 24px; height: 24px;
        background: #ff6b81;
        color: white;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px;
    }

    .custom-dropdown {
        background-color: #ffffff !important;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #eee;
        min-width: 200px;
        padding: 0;
        margin-top: 12px !important;
    }
    
    /* TEKS MY PROFILE & LOGOUT JADI HITAM PEKAT */
    .custom-dropdown .dropdown-item {
        color: #000000 !important; 
        font-weight: 700 !important;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .custom-dropdown .dropdown-item i {
        color: #000000;
        transition: 0.3s;
    }

    /* HOVER TETAP PINK */
    .custom-dropdown .dropdown-item:hover {
        background-color: #fff0f3 !important; 
        color: #ff6b81 !important; 
    }
    
    .custom-dropdown .dropdown-item:hover i {
        color: #ff6b81 !important;
    }

    .login-btn {
        background-color: #ff6b81; color: white !important; padding: 8px 25px; 
        border-radius: 50px; font-size: 14px; font-weight: 700; border: none;
        box-shadow: 0 4px 10px rgba(255, 107, 129, 0.3); transition: 0.3s;
    }
    .login-btn:hover { background-color: #ff4757; transform: translateY(-2px); }
</style>


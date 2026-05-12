<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/rpg-awesome@0.2.0/css/rpg-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
        }

        /* Navbar */
        .navbar-custom {
            background: linear-gradient(90deg, #0ea5e9 0%, #3b82f6 100%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.3);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .navbar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 30px;
            max-width: 100%;
        }

        /* Logo */
        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-right: 40px;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #0ea5e9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .logo-text h2 {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            margin: 0;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Menu */
        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 5px;
            flex: 1;
        }

        .navbar-menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
        }

        .navbar-menu a i {
            font-size: 18px;
        }

        .navbar-menu a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .navbar-menu a.active {
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
            border-bottom: 2px solid #fff;
        }

        /* Right Side */
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: auto;
        }

        .guest-buttons {
            display: flex;
            gap: 8px;
        }

        .guest-buttons a {
            padding: 8px 14px !important;
            font-size: 13px !important;
            text-align: center;
            border-radius: 6px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: #fff;
        }

        .guest-buttons a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.8);
            color: #fff;
        }

        /* User Dropdown */
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding-right: 10px;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: #fff;
        }

        .user-email {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-user-menu {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #fff;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-user-menu:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.6);
            color: #fff;
        }

        .dropdown-menu {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            min-width: 180px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .dropdown-menu .dropdown-item {
            color: #1e293b;
            font-size: 14px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #f1f5f9;
            color: #0ea5e9;
        }

        .dropdown-divider {
            border-color: #e2e8f0;
        }

        .dropdown-edit-btn {
            padding: 10px 15px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            border: none !important;
            background: none !important;
            cursor: pointer !important;
            width: 100% !important;
            text-align: left !important;
            transition: all 0.2s ease;
            color: #1e293b;
        }

        .dropdown-edit-btn:hover {
            background-color: #f1f5f9 !important;
            color: #0ea5e9 !important;
            padding-left: 18px !important;
        }

        .dropdown-edit-btn i {
            margin-right: 8px;
            font-size: 14px;
            color: #3b82f6;
        }

        /* Hamburger */
        .hamburger-btn {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
            margin-left: auto;
        }

        .hamburger-btn span {
            width: 24px;
            height: 3px;
            background: #fff;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .hamburger-btn.active span:nth-child(1) {
            transform: rotate(45deg) translate(10px, 10px);
        }

        .hamburger-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger-btn.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        /* Mobile Dropdown Menu */
        .navbar-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            z-index: 999;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .navbar-dropdown-menu.active {
            max-height: 500px;
        }

        .dropdown-menu-content {
            display: flex;
            flex-direction: column;
            padding: 15px 20px;
            gap: 0;
        }

        .dropdown-menu-content a,
        .dropdown-menu-content button,
        .dropdown-menu-content .guest-buttons {
            color: #1e293b;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border: none;
            background: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            width: 100%;
            text-align: left;
            margin: 0;
        }

        .dropdown-menu-content a:hover,
        .dropdown-menu-content button:hover {
            background-color: #f1f5f9;
            color: #0ea5e9;
            padding-left: 20px;
        }

        .dropdown-menu-content a.active {
            background: #e0f2fe;
            color: #0ea5e9;
            border-left: 3px solid #0ea5e9;
            padding-left: 12px;
        }

        .dropdown-menu-content a i,
        .dropdown-menu-content button i {
            font-size: 18px;
            color: #3b82f6;
        }

        .dropdown-menu-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 8px 0;
        }

        .dropdown-guest-buttons {
            display: flex;
            gap: 8px;
            padding: 12px 15px;
            width: 100%;
        }

        .dropdown-guest-buttons a {
            flex: 1;
            padding: 8px 12px !important;
            font-size: 13px !important;
            text-align: center;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0 !important;
            border: 1px solid #cbd5e1;
            color: #0ea5e9;
            background: #f8fafc;
        }

        .dropdown-guest-buttons a:hover {
            background: #e0f2fe;
            border-color: #0ea5e9;
        }

        /* Content */
        .content {
            flex: 1;
            padding: 30px;
            width: 100%;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            border-radius: 8px;
        }

        .alert-success .btn-close {
            opacity: 0.5;
        }

        .alert-success .btn-close:hover {
            opacity: 0.8;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .hamburger-btn {
                display: flex;
            }

            .navbar-menu,
            .navbar-right {
                display: none;
            }

            .navbar-content {
                padding: 12px 15px;
                position: relative;
            }

            .navbar-logo {
                margin-right: 0;
            }

            .logo-text h2 {
                font-size: 14px;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .content {
                padding: 16px;
            }
        }

        @media (max-width: 576px) {
            .hamburger-btn span {
                width: 20px;
                height: 2.5px;
            }

            .navbar-logo {
                margin-right: auto;
            }

            .content {
                padding: 12px;
            }

            .dropdown-menu-content {
                padding: 10px 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-content">
            <a href="{{ route('home') }}" class="navbar-logo">
                <div class="logo-icon">
                    <i class="ra ra-angel-wings"></i>
                </div>
                <div class="logo-text">
                    <h2>Sepatah</h2>
                </div>
            </a>

            <div class="navbar-menu">
                <a href="{{ route('home') }}" class="@if(Route::currentRouteName() == 'home') active @endif">
                    <i class="bi bi-house-door"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('postingan.index') }}" class="@if(Route::currentRouteName() == 'postingan.index') active @endif">
                    <i class="bi bi-pencil-fill"></i>
                    <span>Postingan</span>
                </a>
            </div>

            <div class="navbar-right">
                @if (auth()->check())
                    <div class="user-dropdown">
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="user-email">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="dropdown">
                            <button class="btn-user-menu dropdown-toggle" type="button" id="userMenuDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-gear"></i><a>Pengaturan</a>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuDropdown">
                                <li>
                                    <button type="button" class="dropdown-item dropdown-edit-btn"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="ra ra-pencil"></i> Edit Profil
                                    </button>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"
                                            style="border: none; background: none; cursor: pointer; width: 100%; text-align: left;">
                                            <i class="ra ra-exit"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="guest-buttons">
                        <a href="{{ route('login') }}" class="btn btn-sm">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-sm">Register</a>
                    </div>
                @endif
            </div>

            <button class="hamburger-btn" id="hamburgerBtn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div class="navbar-dropdown-menu" id="navbarDropdownMenu">
            <div class="dropdown-menu-content">
                <a href="{{ route('home') }}" class="@if(Route::currentRouteName() == 'home') active @endif">
                    <i class="bi bi-house"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('postingan.index') }}" class="@if(Route::currentRouteName() == 'postingan.index') active @endif">
                    <i class="bi bi-pencil-square"></i>
                    <span>Postingan</span>
                </a>
                <div class="dropdown-menu-divider"></div>
                @if (auth()->check())
                    <button type="button" class="dropdown-item dropdown-edit-btn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil"></i> Edit Profil
                    </button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"
                            style="border: none; background: none; cursor: pointer; width: 100%; text-align: left; padding: 12px 15px; display: flex; align-items: center; gap: 12px;">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                @else
                    <div class="dropdown-guest-buttons">
                        <a href="{{ route('login') }}" class="btn btn-sm">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-sm">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>✓ Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    @if (Auth::check())
        <!-- Modal Edit Akun -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg">

                    {{-- Header --}}
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold text-primary d-flex align-items-center gap-2" id="exampleModalLabel">
                            <i class="bi bi-person"></i> Edit Profil
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('akun.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            {{-- Preview Foto --}}
                            <div class="text-center mt-2 mb-3">
                                @if (Auth::user()->profil)
                                    <img src="{{ asset('storage/' . Auth::user()->profil) }}"
                                        class="rounded-circle object-fit-cover border" style="width: 200px; height: 200px;">
                                    <p class="text-muted mt-2 mb-0 medium-emphasis">
                                        Ingin hapus foto? Klik tombol di bawah form ini.
                                    </p>
                                @else
                                    <p class="text-secondary mb-0">Anda belum memiliki foto profil.</p>
                                @endif
                            </div>

                            {{-- Input Foto --}}
                            <div class="mb-3">
                                <label for="profil" class="form-label fw-semibold text-primary">
                                    <i class="ra ra-image"></i> Profil
                                </label>
                                <input type="file" class="form-control" id="profil" name="profil" accept="image/*">
                            </div>

                            {{-- Input Nama --}}
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold text-primary">
                                    <i class="ra ra-user"></i> Nama
                                </label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name"
                                    value="{{ old('name', Auth::user()->name) }}"
                                    placeholder="Masukkan nama Anda">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Input Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold text-primary">
                                    <i class="ra ra-mailbox"></i> Email
                                </label>
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email"
                                    value="{{ old('email', Auth::user()->email) }}"
                                    placeholder="Masukkan email Anda">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Input Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold text-primary">
                                    <i class="ra ra-lock"></i> Password Baru
                                </label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password"
                                    placeholder="Masukkan password baru (opsional)">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Footer Form --}}
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary flex-grow-1">Simpan Perubahan</button>
                        </div>
                    </form>

                    {{-- Hapus Foto --}}
                    @if (Auth::user()->profil)
                        <form action="{{ route('akun.destroyProfil', Auth::user()->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus foto profil?');"
                            class="px-3 pb-3">
                            @csrf
                            @method('DELETE')
                            <div class="d-grid">
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="ra ra-trash"></i> Hapus Foto Profil
                                </button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const navbarDropdownMenu = document.getElementById('navbarDropdownMenu');
        const dropdownMenuLinks = document.querySelectorAll('.navbar-dropdown-menu a, .navbar-dropdown-menu button');

        hamburgerBtn.addEventListener('click', () => {
            navbarDropdownMenu.classList.toggle('active');
            hamburgerBtn.classList.toggle('active');
        });

        dropdownMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (link.tagName !== 'FORM' && !link.getAttribute('data-bs-toggle')) {
                    navbarDropdownMenu.classList.remove('active');
                    hamburgerBtn.classList.remove('active');
                }
            });
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.navbar-custom')) {
                navbarDropdownMenu.classList.remove('active');
                hamburgerBtn.classList.remove('active');
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && navbarDropdownMenu.classList.contains('active')) {
                navbarDropdownMenu.classList.remove('active');
                hamburgerBtn.classList.remove('active');
            }
        });
    </script>
</body>

</html>
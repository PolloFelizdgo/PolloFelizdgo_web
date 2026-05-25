<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel interno') | Pollo Feliz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .panel-shell {
            min-height: 100vh;
            background:
                radial-gradient(1000px 360px at 12% -8%, rgba(248, 113, 113, 0.20), transparent 70%),
                radial-gradient(820px 300px at 88% -14%, rgba(250, 204, 21, 0.18), transparent 70%),
                linear-gradient(180deg, #fff8f2 0%, #fefcf8 58%, #fffdfb 100%);
        }

        .dark .panel-shell {
            background:
                radial-gradient(920px 340px at 12% -8%, rgba(239, 68, 68, 0.20), transparent 70%),
                radial-gradient(760px 300px at 88% -14%, rgba(245, 158, 11, 0.16), transparent 70%),
                linear-gradient(180deg, #111827 0%, #0b1220 55%, #0a0f1b 100%);
        }

        .panel-header {
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 1px solid rgba(229, 231, 235, 0.9);
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(12px);
        }

        .dark .panel-header {
            border-bottom-color: rgba(55, 65, 81, 0.7);
            background: rgba(17, 24, 39, 0.84);
        }

        .panel-brand-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 9999px;
            padding: 0.25rem 0.7rem;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #991b1b;
            background: rgba(254, 202, 202, 0.72);
            border: 1px solid rgba(252, 165, 165, 0.68);
        }

        .dark .panel-brand-badge {
            color: #fde68a;
            background: rgba(146, 64, 14, 0.35);
            border-color: rgba(251, 191, 36, 0.35);
        }

        .panel-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .panel-nav-mobile {
            display: none;
        }

        .panel-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border-radius: 9999px;
            padding: 0.46rem 0.92rem;
            font-size: 0.87rem;
            font-weight: 600;
            color: #374151;
            border: 1px solid transparent;
            transition: all 140ms ease;
        }

        .panel-nav-link:hover {
            color: #b91c1c;
            background: rgba(254, 226, 226, 0.75);
            border-color: rgba(252, 165, 165, 0.7);
        }

        .panel-nav-link.is-active {
            color: #ffffff;
            background: linear-gradient(135deg, #dc2626, #ef4444);
            box-shadow: 0 10px 20px -14px rgba(220, 38, 38, 0.9);
        }

        .dark .panel-nav-link {
            color: #d1d5db;
        }

        .dark .panel-nav-link:hover {
            color: #fde68a;
            background: rgba(146, 64, 14, 0.35);
            border-color: rgba(251, 191, 36, 0.35);
        }

        .panel-nav-glyph {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.2rem;
            height: 1.2rem;
            border-radius: 9999px;
            font-size: 0.68rem;
            font-weight: 800;
            color: #991b1b;
            background: rgba(254, 226, 226, 0.92);
        }

        .panel-nav-link.is-active .panel-nav-glyph {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.23);
        }

        .dark .panel-nav-glyph {
            color: #fde68a;
            background: rgba(146, 64, 14, 0.42);
        }

        .panel-menu-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            border-radius: 9999px;
            border: 1px solid rgba(209, 213, 219, 0.95);
            background: #ffffff;
            color: #374151;
            font-size: 0.82rem;
            font-weight: 700;
            padding: 0.42rem 0.8rem;
        }

        .dark .panel-menu-toggle {
            background: #111827;
            color: #e5e7eb;
            border-color: rgba(75, 85, 99, 0.92);
        }

        .panel-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.38rem 0.72rem;
            border-radius: 9999px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #4b5563;
            border: 1px solid rgba(209, 213, 219, 0.95);
            background: rgba(255, 255, 255, 0.82);
        }

        .panel-breadcrumb-sep {
            opacity: 0.5;
        }

        .dark .panel-breadcrumb {
            color: #d1d5db;
            border-color: rgba(75, 85, 99, 0.9);
            background: rgba(17, 24, 39, 0.82);
        }

        .panel-main {
            max-width: 1100px;
            margin-inline: auto;
            padding: 1.85rem 1.2rem 2.4rem;
        }

        .panel-card {
            border-radius: 1.1rem;
            border: 1px solid rgba(229, 231, 235, 0.94);
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 20px 38px -34px rgba(15, 23, 42, 0.55);
        }

        .dark .panel-card {
            border-color: rgba(55, 65, 81, 0.9);
            background: rgba(17, 24, 39, 0.9);
            box-shadow: 0 22px 40px -34px rgba(0, 0, 0, 0.8);
        }

        .panel-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            padding: 0.62rem 1rem;
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            color: #ffffff;
            background: linear-gradient(135deg, #dc2626, #ef4444);
            box-shadow: 0 16px 28px -20px rgba(220, 38, 38, 0.95);
            transition: transform 140ms ease, filter 140ms ease;
        }

        .panel-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.03);
        }

        .panel-btn-muted {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            padding: 0.62rem 1rem;
            font-size: 0.88rem;
            font-weight: 700;
            color: #374151;
            background: #ffffff;
            border: 1px solid rgba(209, 213, 219, 0.95);
            transition: transform 140ms ease, border-color 140ms ease;
        }

        .panel-btn-muted:hover {
            transform: translateY(-1px);
            border-color: rgba(248, 113, 113, 0.85);
        }

        .dark .panel-btn-muted {
            color: #e5e7eb;
            background: #111827;
            border-color: rgba(75, 85, 99, 0.92);
        }

        @media (min-width: 768px) {
            .panel-main {
                padding-left: 1.6rem;
                padding-right: 1.6rem;
            }

            .panel-nav-mobile {
                display: flex !important;
            }

            .panel-menu-toggle {
                display: none;
            }
        }
    </style>
</head>
<body class="panel-shell text-gray-900 dark:text-gray-100 min-h-screen">
    @php
        $currentTitle = trim($__env->yieldContent('title', 'Dashboard'));
    @endphp
    <header class="panel-header">
        <div class="max-w-6xl mx-auto px-5 md:px-6 py-4">
            <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="panel-brand-badge">Panel interno</p>
                        <h1 class="mt-2 text-xl md:text-2xl font-extrabold tracking-tight">Pollo Feliz Durango</h1>
                    </div>
                    <div class="flex items-center gap-2">
                        @auth
                            <div class="hidden sm:flex items-center gap-2 rounded-full border border-gray-200 dark:border-gray-700 bg-white/85 dark:bg-gray-900/85 px-3 py-1.5 text-xs font-semibold text-gray-600 dark:text-gray-300">
                                <span class="panel-nav-glyph">{{ strtoupper(substr((string) auth()->user()->name, 0, 1)) }}</span>
                                <span>{{ auth()->user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="panel-btn-muted text-xs">Salir</button>
                            </form>
                        @endauth
                        <button type="button" id="panelMenuToggle" class="panel-menu-toggle" aria-expanded="false" aria-controls="panelNavigation">
                            <span>Menu</span>
                            <span aria-hidden="true">☰</span>
                        </button>
                    </div>
                </div>

                <nav id="panelNavigation" class="panel-nav panel-nav-mobile hidden md:flex" aria-label="Navegacion del panel">
                    <a href="{{ route('panel.dashboard') }}" class="panel-nav-link {{ request()->routeIs('panel.dashboard') ? 'is-active' : '' }}"><span class="panel-nav-glyph">D</span><span>Dashboard</span></a>
                    <a href="{{ route('panel.users.index') }}" class="panel-nav-link {{ request()->routeIs('panel.users.*') || request()->routeIs('panel.roles.*') ? 'is-active' : '' }}"><span class="panel-nav-glyph">U</span><span>Usuarios</span></a>
                    <a href="{{ route('panel.content.home.edit') }}" class="panel-nav-link {{ request()->routeIs('panel.content.home.*') ? 'is-active' : '' }}"><span class="panel-nav-glyph">H</span><span>Home</span></a>
                    <a href="{{ route('panel.content.about.edit') }}" class="panel-nav-link {{ request()->routeIs('panel.content.about.*') ? 'is-active' : '' }}"><span class="panel-nav-glyph">A</span><span>Acerca</span></a>
                    <a href="{{ route('panel.content.footer.edit') }}" class="panel-nav-link {{ request()->routeIs('panel.content.footer.*') ? 'is-active' : '' }}"><span class="panel-nav-glyph">F</span><span>Footer</span></a>
                    <a href="{{ route('panel.content.menu.edit') }}" class="panel-nav-link {{ request()->routeIs('panel.content.menu.*') ? 'is-active' : '' }}"><span class="panel-nav-glyph">M</span><span>Menu</span></a>
                    <a href="{{ route('panel.content.theme.edit') }}" class="panel-nav-link {{ request()->routeIs('panel.content.theme.*') ? 'is-active' : '' }}"><span class="panel-nav-glyph">E</span><span>Estilo</span></a>
                    <a href="{{ route('home') }}" class="panel-nav-link"><span class="panel-nav-glyph">↗</span><span>Ver sitio</span></a>
                </nav>

                <div>
                    <p class="panel-breadcrumb">
                        <span>Panel</span>
                        <span class="panel-breadcrumb-sep">/</span>
                        <span>{{ $currentTitle }}</span>
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main class="panel-main">
        @yield('content')
    </main>

    <script>
        (() => {
            const toggle = document.getElementById('panelMenuToggle');
            const nav = document.getElementById('panelNavigation');

            if (!toggle || !nav) {
                return;
            }

            toggle.addEventListener('click', () => {
                const isHidden = nav.classList.contains('hidden');
                nav.classList.toggle('hidden', !isHidden);
                toggle.setAttribute('aria-expanded', String(isHidden));
            });
        })();
    </script>
</body>
</html>

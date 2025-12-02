<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ========================
           LIGHT THEME (existing)
        =========================*/
        :root {
            --bg-1: #d8ecff;
            --bg-2: #b8d5f5;
            --bg-3: #8bb9f1;
            --sidebar-bg: rgba(118, 147, 190, 0.95);
            --sidebar-user: #839dd4;
            --text-main: #0f172a; /* dark text for light theme */
            --muted: #6b7280;
            --card-bg: rgba(255,255,255,0.9);
            --card-shadow: 0 10px 25px rgba(9,30,66,0.08);
            --accent: #2563eb;
        }

        .main-bg {
            background: linear-gradient(180deg, var(--bg-1) 0%, var(--bg-2) 40%, var(--bg-3) 100%);
            min-height: 100vh;
        }

        aside {
            background-color: var(--sidebar-bg);
            backdrop-filter: blur(3px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .user-section {
            background-color: var(--sidebar-user);
            text-align: center;
            padding: 1rem;
            font-weight: 500;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        nav a {
            transition: all 0.25s ease;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out both;
        }

        @media (max-width: 768px) {
            aside {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                position: fixed;
                bottom: 0;
                left: 0;
                z-index: 50;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }
            .user-section { display: none; }
        }

        /* ========================
           DARK THEME overrides
        =========================*/
        .dark :root,
        .dark body {
            /* Not used: but keep for clarity */
        }

        /* Apply dark mode colors */
        .dark .main-bg {
            background: linear-gradient(to bottom right, #1e1f26, #2a2c35);
        }

        .dark aside {
            background-color: #16171d;
            color: #e5e5e5;
        }

        .dark nav a { color: #d7d9de; }
        .dark nav a:hover { background-color: rgba(255,255,255,0.06); }

        .dark .user-section {
            background-color: #23242b;
            border-top: 1px solid rgba(255,255,255,0.04);
            color: #e5e5e5;
        }

        /* Cards (global) - if your cards are using .card class, they will adapt */
        .card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 26px;
            box-shadow: var(--card-shadow);
            color: var(--text-main);
        }

        .dark .card {
            background: #23242b;
            color: #e8e8e8;
            box-shadow: 0 8px 30px rgba(2,6,23,0.65);
        }

        .card .subtitle { color: var(--muted); }
        .dark .card .subtitle { color: #9ea3b0; }

        .card .value { font-weight: 700; color: #0f172a; }
        .dark .card .value { color: #ffffff; }

        /* Welcome title */
        .welcome-title { color: #1e3a8a; }
        .dark .welcome-title { color: #cdd6ff; }

        /* Status colors (ensure visibility in dark) */
        .status-ok { color: #16a34a; }     /* green */
        .status-warning { color: #f59e0b; }/* yellow */
        .status-danger { color: #ef4444; } /* red */
        .status-info { color: #3b82f6; }   /* blue */

        .dark .status-ok { color: #4ade80; }
        .dark .status-warning { color: #fbbf24; }
        .dark .status-danger { color: #f87171; }
        .dark .status-info { color: #60a5fa; }

        /* Sidebar active / selected */
        .sidebar-link { color: #e6eefc; display:block; padding: .75rem 1.5rem; border-radius: .5rem; }
        .sidebar-link.active { background: rgba(255,255,255,0.15); color: #fff; }
        .dark .sidebar-link.active { background: rgba(255,255,255,0.08); color: #fff; }

        /* Theme toggle button (small) */
        .theme-toggle {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .35rem .6rem;
            border-radius: .5rem;
            border: 1px solid rgba(255,255,255,0.06);
            background: transparent;
            color: inherit;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .theme-toggle svg { width: 18px; height: 18px; }

        /* responsive fix: ensure aside width same as before on desktop */
        aside.w-64 { width: 16rem; }
    </style>
</head>
<body>
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 text-gray-200">
            <div>
                <div class="p-6 text-2xl font-bold border-b border-gray-700">
                    AQUA
                </div>

                <nav class="mt-4">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}"
                       class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>

                    <!-- Sensor Data -->
                    <a href="{{ route('sensor.data') }}"
                       class="sidebar-link {{ request()->routeIs('sensor.data') ? 'active' : '' }}">
                        Sensor Data
                    </a>

                    <!-- Device Control -->
                    <a href="{{ route('device-control') }}"
                       class="sidebar-link {{ request()->routeIs('device-control') ? 'active' : '' }}">
                        Device Control
                    </a>

                    <!-- Graph -->
                    <a href="{{ route('graph') }}"
                       class="sidebar-link {{ request()->routeIs('graph') ? 'active' : '' }}">
                        Graph
                    </a>

                    <!-- Settings -->
                    <a href="{{ route('settings') }}"
                       class="sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}">
                        Settings
                    </a>
                </nav>
            </div>

            <!-- Bagian bawah: nama user + tombol logout + theme toggle -->
            <div class="user-section flex flex-col items-center space-y-3">
                <div class="flex items-center gap-2">
                    <span>👤</span>
                    <span>{{ Auth::user()->name }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-sm bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition duration-200">
                            Logout
                        </button>
                    </form>

                    <!-- Theme toggle button -->
                    <button id="themeToggle" class="theme-toggle" aria-label="Toggle dark mode" title="Toggle dark mode">
                        <svg id="iconSun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="display:none">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2M12 19v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4M12 7a5 5 0 100 10 5 5 0 000-10z"/>
                        </svg>

                        <svg id="iconMoon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                        </svg>

                        <span id="themeText">Dark</span>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col main-bg">
            <main class="flex-1 p-6 fade-in-up">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Immediately set theme before painting to avoid flash
        (function() {
            try {
                const stored = localStorage.getItem('theme'); // 'dark' or 'light' or null
                if (stored === 'dark') {
                    document.documentElement.classList.add('dark');
                } else if (stored === 'light') {
                    document.documentElement.classList.remove('dark');
                } else {
                    // follow system preference as default
                    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (prefersDark) document.documentElement.classList.add('dark');
                }
            } catch (e) {
                console.warn('theme init err', e);
            }
        })();

        // DOM ready
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('themeToggle');
            const iconSun = document.getElementById('iconSun');
            const iconMoon = document.getElementById('iconMoon');
            const themeText = document.getElementById('themeText');

            function updateUI() {
                const isDark = document.documentElement.classList.contains('dark');
                if (isDark) {
                    iconMoon.style.display = '';
                    iconSun.style.display = 'none';
                    themeText.textContent = 'Dark';
                } else {
                    iconMoon.style.display = 'none';
                    iconSun.style.display = '';
                    themeText.textContent = 'Light';
                }
            }

            // initial update
            updateUI();

            btn.addEventListener('click', function () {
                const isDark = document.documentElement.classList.toggle('dark');
                try {
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                } catch (e) { /* ignore */ }
                updateUI();
            });
        });
    </script>
</body>
</html>

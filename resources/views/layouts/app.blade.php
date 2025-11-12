<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== Background Gradasi Laut ===== */
        .main-bg {
            background: linear-gradient(180deg, #d8ecff 0%, #b8d5f5 40%, #8bb9f1 100%);
            min-height: 100vh;
        }

        /* ===== Sidebar ===== */
        aside {
            background-color: rgba(118, 147, 190, 0.95);
            backdrop-filter: blur(3px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* ===== User Info di Bawah Sidebar ===== */
        .user-section {
            background-color: #839dd4;
            text-align: center;
            padding: 1rem;
            font-weight: 500;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* ===== Hover & Active Menu ===== */
        nav a {
            transition: all 0.25s ease;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        /* ===== Animasi Fade-In Smooth ===== */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(15px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out both;
        }

        /* ===== Responsive Sidebar ===== */
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
            .user-section {
                display: none;
            }
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900">
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
                       class="block px-6 py-3 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-700/80 text-white' : 'text-gray-300' }}">
                        Dashboard
                    </a>

                    <!-- Sensor Data -->
                    <a href="{{ route('sensor.data') }}"
                       class="block px-6 py-3 rounded {{ request()->routeIs('sensor.data') ? 'bg-gray-700/80 text-white' : 'text-gray-300' }}">
                        Sensor Data
                    </a>

                    <!-- Device Control -->
                    <a href="{{ route('device-control') }}"
                       class="block px-6 py-3 rounded {{ request()->routeIs('device-control') ? 'bg-gray-700/80 text-white' : 'text-gray-300' }}">
                        Device Control
                    </a>

                    <!-- Graph -->
                    <a href="{{ route('graph') }}"
                       class="block px-6 py-3 rounded {{ request()->routeIs('graph') ? 'bg-gray-700/80 text-white' : 'text-gray-300' }}">
                        Graph
                    </a>

                    <!-- Settings -->
                    <a href="{{ route('settings') }}"
                       class="block px-6 py-3 rounded {{ request()->routeIs('settings') ? 'bg-gray-700/80 text-white' : 'text-gray-300' }}">
                        Settings
                    </a>
                </nav>
            </div>

            <!-- Bagian bawah: nama user + tombol logout -->
            <div class="user-section flex flex-col items-center space-y-2">
                <div>👤 {{ Auth::user()->name }}</div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition duration-200">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col main-bg">
            <main class="flex-1 p-6 fade-in-up">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

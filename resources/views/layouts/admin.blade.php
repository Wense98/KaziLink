<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="scroll-smooth"
      x-data="{ 
          darkMode: localStorage.getItem('theme') === 'dark',
          toggleTheme() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
          }
      }"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel | {{ config('app.name', 'KaziLink') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'brand': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        'admin-dark': '#0f172a',
                        'admin-card': '#ffffff',
                        'admin-sidebar': '#ffffff',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f1f5f9;
            color: #1e293b;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .dark body {
            background-color: #0f172a;
            color: #f1f5f9;
        }
        .admin-glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }
        .dark .admin-glass {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(255, 255, 255, 0.05);
        }
        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-link.active {
            background: #3b82f6;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
        }
        .sidebar-link:not(.active):hover {
            background: rgba(59, 130, 246, 0.05);
            color: #3b82f6;
        }
        .dark .sidebar-link:not(.active):hover {
            background: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
        }
        /* Custom Scrollbar for Sidebar */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; }

        .stat-card {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .dark .stat-card {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-900 dark:text-slate-100 overflow-x-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300" x-data="{ sidebarOpen: true }">
    
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'w-72' : 'w-20'"
            class="fixed left-0 top-0 h-screen bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 transition-all duration-300 z-50 flex flex-col"
        >
            <!-- Logo area -->
            <div class="p-8 flex items-center justify-between">
                <div class="flex items-center space-x-3 overflow-hidden">
                    <img src="{{ asset('images/logo.png') }}" class="w-8 h-8 shrink-0" alt="Logo">
                    <span x-show="sidebarOpen" class="font-black text-xl tracking-tight text-slate-900 dark:text-white whitespace-nowrap">KaziLink <span class="text-brand-500">Admin</span></span>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="flex-grow px-4 overflow-y-auto custom-scrollbar pt-4">
                <div class="space-y-1">
                    @php
                        $navItems = [
                            ['view' => 'overview', 'label' => 'Overview', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                            ['view' => 'users', 'label' => 'User Management', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                            ['view' => 'workers', 'label' => 'Worker Verification', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                            ['view' => 'payments', 'label' => 'Payments', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['view' => 'reports', 'label' => 'Reports', 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                            ['view' => 'data', 'label' => 'Location & Category', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                            ['view' => 'roles', 'label' => 'Admin Roles', 'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                            ['view' => 'logs', 'label' => 'Audit Logs', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['view' => 'settings', 'label' => 'System Settings', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <a href="{{ route('admin.dashboard', ['view' => $item['view']]) }}" 
                           class="sidebar-link flex items-center px-5 py-3.5 rounded-2xl group {{ $currentView === $item['view'] ? 'active' : 'text-slate-500 hover:text-brand-600' }}">
                            <div class="shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $item['icon'] }}" />
                                </svg>
                            </div>
                            <span x-show="sidebarOpen" class="ml-4 text-[13px] font-bold tracking-tight whitespace-nowrap">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </nav>

            <!-- Bottom area -->
            <div class="p-6 border-t border-slate-100 dark:border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-5 py-3 rounded-2xl text-slate-500 hover:bg-red-50 dark:hover:bg-red-500/10 hover:text-red-600 transition-all text-[13px] font-bold">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span x-show="sidebarOpen" class="ml-4 tracking-tight">Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div 
            :class="sidebarOpen ? 'ml-72' : 'ml-20'"
            class="flex-grow min-h-screen transition-all duration-300 flex flex-col"
        >
            <!-- Topbar -->
            <header class="sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-8 h-20 flex items-center justify-between">
                <div class="flex items-center space-x-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2.5 rounded-xl hover:bg-slate-100 text-slate-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                    <div class="hidden md:flex items-center bg-slate-100 dark:bg-slate-800 px-4 py-2 rounded-2xl border border-transparent focus-within:border-brand-500/30 focus-within:bg-white dark:focus-within:bg-slate-700 transition-all w-80">
                        <svg class="w-4 h-4 text-slate-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Search anything..." class="bg-transparent border-none focus:ring-0 text-[13px] font-medium w-full placeholder-slate-400 text-slate-900 dark:text-white">
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <!-- Notifications -->
                    <button class="relative p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 transition-colors">
                        <div class="absolute top-2.5 right-2.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-slate-900"></div>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center space-x-4 pl-6 border-l border-slate-200 dark:border-slate-800">
                        <div class="text-right hidden sm:block">
                            <p class="text-[13px] font-bold text-slate-900 dark:text-white leading-none mb-1">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-black text-brand-500 uppercase tracking-widest leading-none">Super Admin</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-brand-500 flex items-center justify-center text-white font-black text-sm shadow-lg shadow-brand-500/20">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-8 pb-32">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50
            });
        });
    </script>
</body>
</html>

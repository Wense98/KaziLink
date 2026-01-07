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

        <title>{{ config('app.name', 'KaziLink') }}</title>


        <!-- Styles & Scripts -->
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
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
                            'kazi-dark': '#0f172a',
                            'kazi-navy': '#1e293b',
                        },
                        fontFamily: {
                            sans: ['ui-sans-serif', 'system-ui', 'sans-serif'],
                        },
                        animation: {
                            'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                            'float': 'float 6s ease-in-out infinite',
                        },
                        keyframes: {
                            float: {
                                '0%, 100%': { transform: 'translateY(0)' },
                                '50%': { transform: 'translateY(-20px)' },
                            }
                        }
                    }
                }
            }
        </script>
        <style>
            body {
                background-color: #f8fafc;
                background-image: linear-gradient(rgba(248, 250, 252, 0.9), rgba(248, 250, 252, 0.9)), url('/images/background.png');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                color: #1e293b;
                transition: background-color 0.3s ease, color 0.3s ease;
            }
            .dark body {
                background-color: #0f172a;
                background-image: linear-gradient(rgba(15, 23, 42, 0.95), rgba(15, 23, 42, 0.95)), url('/images/background.png');
                color: #f1f5f9;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(16px) saturate(180%);
                -webkit-backdrop-filter: blur(16px) saturate(180%);
                border: 1px solid rgba(255, 255, 255, 0.4);
                box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.05);
            }
            .dark .glass-card {
                background: rgba(15, 23, 42, 0.7);
                border-color: rgba(255, 255, 255, 0.05);
                box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
            }
            .mesh-gradient {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                background-color: #f8fafc;
                background-image: 
                    radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.1) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(37, 99, 235, 0.05) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.1) 0px, transparent 50%),
                    radial-gradient(at 0% 100%, rgba(37, 99, 235, 0.05) 0px, transparent 50%);
            }
            .dark .mesh-gradient {
                background-color: #0f172a;
                background-image: 
                    radial-gradient(at 0% 0%, rgba(30, 58, 138, 0.3) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(15, 23, 42, 0.2) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(30, 58, 138, 0.3) 0px, transparent 50%),
                    radial-gradient(at 0% 100%, rgba(15, 23, 42, 0.2) 0px, transparent 50%);
            }
            .glass-nav {
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .dark .glass-nav {
                background: rgba(15, 23, 42, 0.75);
                border-color: rgba(255, 255, 255, 0.05);
            }
            .gradient-text {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-size: 200% auto;
                animation: shine 5s linear infinite;
            }
            @keyframes shine {
                to { background-position: 200% center; }
            }
            .premium-button {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                color: white !important;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
            }
            .premium-button:hover {
                transform: translateY(-3px) scale(1.02);
                box-shadow: 0 12px 25px rgba(59, 130, 246, 0.3);
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            }
            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.2); border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: rgba(59, 130, 246, 0.5); }
        </style>
    </head>
    <body class="font-sans antialiased overflow-x-hidden transition-colors duration-300">
        <div class="mesh-gradient"></div>
        <div class="min-h-screen relative">

            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="pt-28 pb-8 px-4 sm:px-6 lg:px-8 border-b border-white/5" data-aos="fade-down">
                    <div class="max-w-7xl mx-auto">
                        <div class="flex items-center space-x-6">
                            <div class="w-1.5 h-10 bg-brand-500 rounded-full shadow-[0_0_15px_rgba(59,130,246,0.5)]"></div>
                            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-wider">
                                {{ $header }}
                            </h2>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="relative z-10 pt-4">
                {{ $slot }}
            </main>

            <footer class="py-12 border-t border-white/5 mt-20 text-center">
                <p class="text-gray-500 text-xs font-bold uppercase tracking-[0.3em]">
                    &copy; {{ date('Y') }} KaziLink • Built for Excellence
                </p>
            </footer>
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

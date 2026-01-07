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
                        },
                        fontFamily: {
                            sans: ['ui-sans-serif', 'system-ui', 'sans-serif'],
                        },
                        animation: {
                            'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.4);
                box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
            }
            .dark .glass-card {
                background: rgba(30, 41, 59, 0.7);
                border-color: rgba(255, 255, 255, 0.05);
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            }
            .glass-nav {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
            }
            .dark .glass-nav {
                background: rgba(15, 23, 42, 0.8);
                border-color: rgba(255, 255, 255, 0.05);
            }
            .gradient-text {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .premium-button {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                position: relative;
                overflow: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                color: white !important;
            }
            .premium-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 24px rgba(59, 130, 246, 0.3);
            }
            .glow-border {
                position: relative;
            }
            .glow-border::before {
                content: '';
                position: absolute;
                inset: -1px;
                background: linear-gradient(45deg, transparent, rgba(34, 197, 94, 0.3), transparent);
                border-radius: inherit;
                z-index: -1;
                animation: border-glow 4s linear infinite;
            }
            @keyframes border-glow {
                0% { background-position: 0% 50%; }
                100% { background-position: 200% 50%; }
            }
        </style>
    </head>
    <body class="font-sans antialiased overflow-x-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
        <div class="min-h-screen flex flex-col relative z-10">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="pt-28 pb-8 px-4 sm:px-6 lg:px-8 border-b border-white/5" data-aos="fade-down">
                    <div class="max-w-7xl mx-auto">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow pt-4">
                {{ $slot }}
            </main>

            <!-- Footer -->
            @include('layouts.footer')
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

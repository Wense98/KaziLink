<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
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

        <!-- Styles -->
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            'kazi-dark': '#0f172a',
                            'brand': {
                                50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd',
                                400: '#60a5fa', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8',
                                800: '#1e40af', 900: '#1e3a8a',
                            },
                        },
                        fontFamily: {
                            sans: ['Outfit', 'Inter', 'system-ui', 'sans-serif'],
                        },
                    }
                }
            }
        </script>
        
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

        <style>
            [x-cloak] { display: none !important; }

            :root {
                --mesh-gradient-1: #3b82f6;
                --mesh-gradient-2: #8b5cf6;
                --mesh-gradient-3: #6366f1;
            }

            .mesh-gradient {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                filter: blur(80px);
                opacity: 0.15;
                background: 
                    radial-gradient(circle at 0% 0%, var(--mesh-gradient-1) 0, transparent 50%),
                    radial-gradient(circle at 100% 0%, var(--mesh-gradient-2) 0, transparent 50%),
                    radial-gradient(circle at 100% 100%, var(--mesh-gradient-3) 0, transparent 50%),
                    radial-gradient(circle at 0% 100%, var(--mesh-gradient-1) 0, transparent 50%);
            }

            .dark .mesh-gradient {
                opacity: 0.1;
                filter: blur(100px);
            }

            body {
                background: #fdfdfd;
                transition: background-color 0.5s ease-in-out;
            }
            .dark body { background: #020617; }

            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .dark .glass-card {
                background: rgba(30, 41, 59, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }

            .gradient-text {
                background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .premium-button {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                color: white;
                position: relative;
                overflow: hidden;
                transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            }

            .premium-button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: all 0.5s;
            }

            .premium-button:hover::before { left: 100%; }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased overflow-x-hidden selection:bg-brand-500/20">
        <div class="mesh-gradient"></div>
        
        <div class="min-h-screen flex items-center justify-center p-6 relative">
            <div class="w-full max-w-[1000px] relative z-10" data-aos="zoom-in" data-aos-duration="1000">
                {{ $slot }}
            </div>
        </div>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                once: true,
                easing: 'ease-out-cubic'
            });
        </script>
    </body>
</html>

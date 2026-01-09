<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: false }"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KaziLink') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'brand': {
                            50: '#f0f7ff',
                            100: '#e0effe',
                            200: '#bae0fd',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                        'glass': 'rgba(255, 255, 255, 0.03)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    backdropBlur: {
                        'xxl': '40px',
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        body {
            @apply bg-[#020617] text-white font-sans antialiased;
            background-image: url('{{ asset('images/auth_bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border-radius: 2.5rem;
        }

        .input-premium {
            @apply w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder:text-white/30 focus:ring-2 focus:ring-brand-600/50 focus:border-brand-600 focus:bg-white/10 transition-all outline-none font-medium;
        }

        .btn-premium {
            @apply w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-brand-600/40 active:scale-[0.98] flex items-center justify-center gap-2;
        }

        .glass-icon {
            @apply w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center border border-white/10 backdrop-blur-md;
        }

        /* Custom scrollbar for glass */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.05); }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative overflow-x-hidden">
    <!-- Subtle overlay for better legibility -->
    <div class="fixed inset-0 bg-black/40 pointer-events-none"></div>

    <div class="relative w-full max-w-lg z-10">
        {{ $slot }}
    </div>
</body>
</html>

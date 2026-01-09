<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: false }"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KaziLink') }}</title>

    <!-- Styles -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'kazi-dark': '#0f172a',
                        'kazi-blue': '#2563eb',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    borderRadius: {
                        '4xl': '2rem',
                        '5xl': '3rem',
                    }
                }
            }
        }
    </script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
        
        body {
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Custom UI classes for Auth */
        .auth-card-premium {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            border-radius: 2.5rem;
            width: 100%;
            max-width: 480px;
            overflow: hidden;
            position: relative;
        }

        .skyline-header {
            height: 120px;
            background-color: #f1f5f9;
            background-image: url('{{ asset('images/skyline.png') }}'); /* Replace with actual generated image path if handled via storage/public */
            background-size: cover;
            background-position: bottom;
            opacity: 0.6;
        }

        .btn-primary-kazi {
            @apply bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-blue-600/20 active:scale-95 text-center block w-full;
        }

        .input-auth {
            @apply w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-semibold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 focus:bg-white transition-all outline-none;
        }

        .otp-box-kazi {
            @apply w-12 h-14 bg-slate-50 border border-slate-200 rounded-xl text-center font-bold text-lg text-slate-800 transition-all focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 focus:bg-white outline-none;
        }

        .checklist-bullet {
            @apply w-4 h-4 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        {{ $slot }}
    </div>
</body>
</html>

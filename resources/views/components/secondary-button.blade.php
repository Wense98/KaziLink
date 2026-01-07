<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-8 py-3 bg-white/5 border border-white/10 rounded-2xl font-black text-[10px] text-gray-400 uppercase tracking-[0.3em] hover:bg-white/10 hover:text-white active:scale-95 focus:outline-none focus:ring-2 focus:ring-white/10 focus:ring-offset-2 dark:focus:ring-offset-kazi-dark disabled:opacity-25 transition-all duration-300']) }}>
    {{ $slot }}
</button>

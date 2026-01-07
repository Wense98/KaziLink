<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-3 bg-red-500/10 border border-red-500/20 rounded-2xl font-black text-[10px] text-red-500 uppercase tracking-[0.3em] hover:bg-red-500 hover:text-white active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-kazi-dark transition-all duration-300 shadow-xl shadow-red-500/10']) }}>
    {{ $slot }}
</button>

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-3 bg-brand-600 border border-transparent rounded-2xl font-black text-[10px] text-white uppercase tracking-[0.3em] hover:bg-brand-500 active:scale-95 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:focus:ring-offset-kazi-dark transition-all duration-300 shadow-xl shadow-brand-500/20']) }}>
    {{ $slot }}
</button>

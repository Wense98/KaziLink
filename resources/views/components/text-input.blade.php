@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/5 border-white/10 text-white text-sm font-medium rounded-2xl focus:border-brand-500 focus:ring-brand-500 transition-all placeholder-gray-800']) }}>

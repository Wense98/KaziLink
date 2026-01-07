@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-[10px] font-black text-gray-600 uppercase tracking-[0.3em]']) }}>
    {{ $value ?? $slot }}
</label>

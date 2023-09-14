@props(['disabled' => false])

<input style="background: transparent;" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['style' => 'opacity: 0.5; cursor: not-allowed;', 'class' => 'text-white text-opacity-50 block mt-1 w-full border-0 border-b-2 border-b-[#ffffffb3] focus:border-b-[#ffffffb3] transition-colors']) !!}>

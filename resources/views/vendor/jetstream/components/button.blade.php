<button style="background: linear-gradient(45deg, #007e36, #00ba4c) !important; text-transform: capitalize !important; padding: 16px; font-size: 16px; font-weight: 600;" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-red-700 rounded font-semibold text-sm text-white w-full hover:bg-red-900']) }}>
    {{ $slot }}
</button>

<button style="color: #fff !important; background: #ffffff26 !important; text-transform: capitalize !important; padding: 16px; font-size: 16px; font-weight: 600;" {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-red-700 rounded font-semibold text-sm text-white w-full']) }}>
    {{ $slot }}
</button>

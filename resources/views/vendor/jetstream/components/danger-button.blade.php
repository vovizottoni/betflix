<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-900 focus:outline-none active:bg-red-900 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>

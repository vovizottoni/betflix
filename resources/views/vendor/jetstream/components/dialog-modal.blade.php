@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg text-white">
            {{ $title }}
        </div>

        <div class="mt-4 opacity-70">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 text-right" style="background: #0f0f0f !important">
        {{ $footer }}
    </div>
</x-jet-modal>

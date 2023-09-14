<div class="md:col-span-1 flex justify-between">
    <div class="px-0 pb-2 md:pb-8 title-bordered">
        <h3 class="text-lg font-medium text-white">{{ $title }}</h3>

        <p class="mt-1 text-sm text-white text-opacity-75">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>

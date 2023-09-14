<x-app-layout>

    <div>
        @auth()
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('player.accounts')
        </div>
        @endauth

    </div>
</x-app-layout>
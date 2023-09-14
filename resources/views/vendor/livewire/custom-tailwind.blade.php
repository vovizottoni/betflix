<div class="flex justify-center w-full mx-auto mt-6">
    @if ($paginator->hasPages())

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button type="button"
                    class="text-center btn gap-2 bg-base-800 border-none  m-2 opacity-70  cursor-not-allowed "
            >
                {!! __('pagination.previous') !!}
            </button>
        @else
            @if(method_exists($paginator,'getCursorName'))
                <button type="button" dusk="previousPage"
                        wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                        class="text-center btn gap-2 bg-base-800 border-none hover:bg-base-700 m-2 ">
                    {!! __('pagination.previous') !!}
                </button>
            @else
                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"  dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        class="text-center btn gap-2 bg-base-800 border-none hover:bg-base-700 m-2"
                >
                    {!! __('pagination.previous') !!}
                </button>

            @endif
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            @if(method_exists($paginator,'getCursorName'))
                <button type="button" dusk="nextPage"
                        wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                        class="text-center btn gap-2 bg-base-800 border-none hover:bg-base-700 m-2">
                    {!! __('pagination.next') !!}
                </button>
            @else
                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        class="text-center btn gap-2 bg-base-800 border-none hover:bg-base-700 m-2"
                >
                    {!! __('pagination.next') !!}
                </button>
            @endif
        @else
            <button type="button"
                    class="text-center btn gap-2 bg-base-800 border-none  m-2 opacity-70  cursor-not-allowed ">

                {!! __('pagination.next') !!}
            </button>

        @endif

    @endif

</div>

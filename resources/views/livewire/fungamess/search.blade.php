<div class="w-full">
    <form class="md:mb-5" wire:ignore>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input wire:model="search" type="search" id="default-search" autocomplete="off" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pesquise um jogo..." required>

            {{-- <fieldset class="text-white absolute bottom-2.5" style="right:4rem; opacity: 0;">
                <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                <div class="flex items-center" wire:click="jogosProvedoresSearch('{{'jogos'}}')">
                    <input id="radioJogos" name="jogos_ou_provedores_search" type="radio" checked class="h-4 w-4 border-gray-300 text-red-600 focus:ring-red-500" value="games">
                    <label for="email" class="ml-3 block text-sm font-medium text-white">Jogos</label>
                </div>

                <div class="flex items-center" wire:click="jogosProvedoresSearch('{{'provedores'}}')">
                    <input id="radioProvedores" name="jogos_ou_provedores_search" type="radio" class="h-4 w-4 border-gray-300 text-red-600 focus:ring-red-500" value="providers">
                    <label for="sms" class="ml-3 block text-sm font-medium text-white"> Provedores </label>
                </div>
                </div>
            </fieldset> --}}
        </div>
    </form>

    <div>
        @if($showSearch)

            <style type="text/css">
                .grid-result-search{
                    border: none;
                    background: #0e0e0e;
                    padding: 1rem;
                    width: 100%;
                    z-index: 999;
                    min-height: 300px;
                    font-size: 1.5rem;
                    font-weight: 700;
                    color: #ffffff6b;
                    margin-top: 10px;
                }
            </style>
            @if(!empty($games))
            <div class="grid-result-search">


                @if($jogos_ou_provedores_search == 'games')

                
                {{-- <div class="flex gap-2 flex-wrap">
                    @foreach ($games as $key => $game)

                    <a href="{{ route('fgames.game', $game->game_code) }}" style="width: 100px;">
                        <div class="h-[70px] w-full min-w-[100px] max-w-[100px] rounded-md" style="background: url({{$game->img}}); background-size: cover; background-position: 50%;">
                        </div>
                        <div class="mt-4 mb-2">
                            <h5 class="text-xs text-white" style="max-width: 120px;">{{$game->name}}</h5>
                        </div>
                    </a>
                    @endforeach
                </div> --}}
                
                <div class="flex gap-4 flex-wrap">
                    @foreach ($games as $key => $game)
                        @if(str_contains($game->img, ' ') === true) @continue @endif
                        {{-- link para jogos hypetech --}}
                        @if ($game->game_code == 'rocketcrash' || $game->game_code == 'pipa' || $game->game_code == 'motograu' || $game->game_code == 'embaixadinha' || $game->game_code == 'aviator' || $game->game_code == 'mask' || $game->game_code == 'toguro' || $game->game_code == 'double' || $game->game_code == 'crash' || $game->game_code == 'wall-street')
                        {{-- @php
                                dd($game);
                            @endphp --}}
                            <a href="{{ route('games.'. $game->game_code) }}">
                                <div class="h-[100px] w-full min-w-[150px] max-w-[150px] rounded-md" style="background: url({{$game->image}}); background-size: cover; background-position: 50%;">
                                </div>
                                <div class="mt-4 mb-2">
                                    <h5 class="font-bold text-sm text-white" style="max-width: 150px;">{{$game->name}}</h5>
                                </div>
                            </a>
                            
                        @else
                            
                            {{-- link para jogos fungamess --}}
                            <a href="{{ route('fgames.game', $game->game_code) }}">
                                <div class="h-[100px] w-full min-w-[150px] max-w-[150px] rounded-md" style="background: url({{$game->image}}); background-size: cover; background-position: 50%;">
                                </div>
                                <div class="mt-4 mb-2">
                                    <h5 class="font-bold text-sm text-white" style="max-width: 150px;">{{$game->name}}</h5>
                                </div>
                            </a>
                            
                        @endif
                    @endforeach
                </div>

                @else <!-- provedores -->

                    <ul role="list" class="mx-auto grid max-w-2xl grid-cols-2 gap-y-16 gap-x-8 text-center sm:grid-cols-3 md:grid-cols-4 lg:mx-0 lg:max-w-none lg:grid-cols-5 xl:grid-cols-8 owl-carousel carousel-providers slotgames">
                        @foreach ($games as $provider)
                        <li class="rounded-sm bg-slate-200" style="filter: invert(1) grayscale(1);">
                            <a href="{{ route('fprovider.provider-games', [$this->slug($provider->name), $provider->id]) }}">
                                <img loading="lazy" class="mx-auto h-24 p-6" src="{{$provider->logo}}" alt="" style="max-width: 120px;">
                                <p class="text-sm leading-6 text-black text-opacity-80"><b>{{ $provider->name }}</b>
                                <p class="text-xs leading-6 text-black text-opacity-80 pb-4"><b>{{ count($provider->games) }}</b> Games </p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            @endif
    @endif
    </div>
</div>
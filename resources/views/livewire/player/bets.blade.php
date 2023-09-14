<div class="max-w-7xl mx-auto">
    <style type="text/css">
        .card {
            background: #0e1830;
            width: 100%;
            padding: 40px;
        }

        a.block.bg-dark-800:hover {
            background: #101010b5 !important;
        }

        .bg-dark-700 {
            background: #10101085 !important;
        }


        .bg-dark-500 {
            background: #ffffff1a !important;
        }
    </style>
    <div class="bg-section">

        <div class="px-2 w-full">


            @php
                $value = \App\Models\Bet::where('accounts_id', '=', $account_id)->get();
            @endphp
            @if ($value->isEmpty())
                <div class="text-center">
                    <img src="{{ asset('assets/images/misc/withoutRegisters.gif') }}" alt=""
                        style="filter: contrast(1.6) brightness(0.9) hue-rotate(200deg);" class="w-32 mx-auto mt-xl">
                    <h1 class="text-xl font-bold pt-2">{{ __('bets.you_dont_have_bets') }}</h1>
                    <p class="opacity-60 pt-6 text-sm max-w-md mx-auto">{{ __('bets.it_looks_like') }} <span
                            class="font-bold">:(</span> {{ __('bets.all_bets_and_results') }}</p>
                    <a class="active:bg-transparent deposit-btn">
                        <div class="form-control">
                            <label for="depo-modal"
                                class="deposit-btn nunes-btn font-bold">
                                {{ __('bets.click_make_deposit') }}
                            </label>
                        </div>
                    </a>
                </div>
            @else
                <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8 relative" style="z-index: 1;">
                    <div class="grid lg:grid-cols-2 gap-4">
                        <div>
                            <h1 class="text-white text-xl lg:text-3xl font-bold">
                                {{ __('bets.history_bets_title') }}</h1>

                        </div>
                    </div>
                </div>

                <div class="tabs mb-16 mx-auto sm:px-6 lg:px-8 mt-10">
                    <a href="{{route('bets')}}" class="tab tab-lg tab-bordered transition-all tab-active" style="color: #fff !important;">Apostas</a>
                    <a href="{{route('player.account.transactions')}}" class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;">Transações</a>
                    {{--
                    <a href="{{route('player.mybonus')}}" class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;">Bônus</a>
                    --}}
                </div>


                <div class="max-w-7xl mx-auto m:px-6 lg:px-8 mt-12 relative " style="z-index: 1;">
                    <div class="grid grid-cols-1 min-[500px]:grid-cols-2 min-[1260px]:grid-cols-4 gap-4">
                        <div class="card">
                            <h3 class="text-2xl">{{ 'R$' . number_format($total_amount_balance, 2, ',', '.') }}</h3>
                            <p>{{ __('bets.total_earnings') }}</p>
                        </div>
                        <div class="card">
                            <h3 class="text-2xl">{{ $total_bets }}</h3>
                            <p>{{ __('bets.games_played') }}</p>
                        </div>
                        @php
                            // <div class="card">
                            //     <h3 class="text-2xl">&nbsp;</h3>
                            //     <p>&nbsp;</p>
                            // </div>
                            // <div class="card">
                            //     <h3 class="text-2xl">&nbsp;</h3>
                            //     <p>&nbsp;</p>
                            // </div>
                        @endphp

                    </div>

                </div>

                <br>

                <div class="max-w-7xl mx-auto mt-4 m:px-6 lg:px-8 relative">
                    <div class="hidden xl:flex justify-between items-center max-w-full">




                        <div class="form-control">
                            <div class="input-group max-w-xs">
                                <input type="text" wire:model="searchCode" id="external_reference_ID"
                                    placeholder="{{ __('bets.bet_code') }}" class="input max-w-full w-full" />

                                <button class="btn btn-square border-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>


                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0"
                                class=" bg-[#090f1e] hover:bg-[#060b16] border-none btn m-1 remove-focus flex items-center">
                                <span class="text-sm capitalize">Filtrar</span>
                                <svg class="h-3 fill-current ml-2" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                </svg>
                            </label>
                            <div tabindex="0" class="dropdown-content rounded-md card-compact w-64 p-2 shadow mt-4"
                                style=" background: #0E1830;">
                                <div class="card-body flex flex-col py-4 px-2 gap-4">


                                    <select wire:model="result" class="select w-full max-w-xs">

                                        <option value="">{{ __('bets.result') }}</option>
                                        <option value="pending"> {{ __('bets.result_pending') }}</option>
                                        <option value="green"> {{ __('bets.result_green') }}</option>
                                        <option value="red"> {{ __('bets.result_red') }}</option>
                                        <option value="canceled"> {{ __('bets.result_canceled') }}</option>


                                    </select>
                                    <input type="date" wire:model.lazy="created_at__from" id="created_at__from_ID"
                                        value="" class="input w-full max-w-xs"> <!-- created_at from -->
                                    <input type="date" wire:model.lazy="created_at__to" id="created_at__to_ID"
                                        value="" class="input w-full max-w-xs"> <!-- created_at to -->

                                    <select wire:model="balance_used" class="select w-full max-w-xs">
                                        <option value="">{{ __('bets.balance_used') }}</option>
                                        <option value="balance"> {{ __('bets.balance_used_BRL') }}</option>
                                        <option value="balanceBonus"> {{ __('bets.balance_used_BRL_Bonus') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="flex xl:hidden max-w-full justify-between items-center">
                        <div class="form-control">
                            <div class="input-group input-group-sm">
                                <input type="text" wire:model="external_reference" id="external_reference_ID"
                                    placeholder="{{ __('history.codigo_da_transacao') }}"
                                    class="input max-w-xs input-sm" style="width: 150px !important" />

                                <button class="btn btn-square btn-sm border-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0"
                                class=" bg-[#090f1e] hover:bg-[#060b16] border-none btn btn-sm m-1 remove-focus flex items-center">
                                <span class="text-sm capitalize">Filtrar</span>
                                <svg class="h-3 fill-current ml-2" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                </svg>
                            </label>
                            <div tabindex="0" class="dropdown-content rounded-md card-compact w-64 p-2 shadow mt-4"
                                style="backdrop-filter: blur(10px); background: #0E1830;">
                                <div class="card-body flex flex-col py-4 px-2 gap-4">

                                    <select wire:model="result" class="select w-full max-w-xs select-sm text-xs">

                                        <option value="">{{ __('bets.result') }}</option>
                                        <option value="pending"> {{ __('bets.result_pending') }}</option>
                                        <option value="green"> {{ __('bets.result_green') }}</option>
                                        <option value="red"> {{ __('bets.result_red') }}</option>
                                        <option value="canceled"> {{ __('bets.result_canceled') }}</option>


                                    </select>
                                    <input type="date" wire:model.lazy="created_at__from" id="created_at__from_ID"
                                        value="" class="input input-sm w-full max-w-xs">
                                    <!-- created_at from -->
                                    <input type="date" wire:model.lazy="created_at__to" id="created_at__to_ID"
                                        value="" class="input input-sm w-full max-w-xs"> <!-- created_at to -->


                                    @php
                                        /*
                                <select wire:model="balance_used" class="select w-full max-w-xs">
                                    <option value="">{{ __('bets.balance_used') }}</option>
                                        <option value="balance"> {{ __('bets.balance_used_BRL') }}</option>
                                        <option value="balanceBonus"> {{ __('bets.balance_used_BRL_Bonus') }}</option>
                                        <option value="balanceUSD"> {{ __('bets.balance_used_USD') }}</option>
                                        <option value="balanceUSDBonus"> {{ __('bets.balance_used_USD_Bonus') }}</option>
                                </select>
                                    */
                                    @endphp


                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="max-w-7xl mx-auto mt-12 m:px-6 lg:px-8 relative" style="z-index: 1;">
                    <div class="overflow-hidden bg-dark-700 shadow sm:rounded-md">
                        <ul id="last_record" role="list" class="">

                            <div wire:loading.delay.shorter class="w-full">
                                <div class="loading ml-auto mr-auto mb-4 mt-12"></div>
                            </div>

                            @if ($bets->isEmpty())
                                <p class="text-center py-12 font-bold opacity-50">{{ __('bets.no_records_matching') }}
                                </p>
                            @else
                                @foreach ($bets as $bet)
                                    <li class="relative" style="border-bottom: 1px solid #ffffff08;">
                                        <div class="block bg-[#0E1830]">
                                            <div class="flex items-center px-4 py-4 sm:px-6">
                                                <div class="flex min-w-0 flex-1 items-center">

                                                    <div class="flex-shrink-0">



                                                        @if ($bet->result == 'green')
                                                            <svg class="h-6 w-6 flex-shrink-0 text-green-400"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        @endif



                                                        @if ($bet->result == 'red')
                                                            <svg class="h-5 w-5 flex-shrink-0 text-red-500"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512">
                                                                <path fill='currentColor'
                                                                    d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224c0-17.7-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32z" />
                                                            </svg>
                                                        @endif



                                                        @if ($bet->result == 'pending')
                                                            <svg class="h-5 w-5 flex-shrink-0 text-yellow-400"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512">
                                                                <path fill='currentColor'
                                                                    d="M256 512C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256s-114.6 256-256 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                                            </svg>
                                                        @endif

                                                        @if ($bet->result == 'canceled')
                                                            <svg class="h-5 w-5 flex-shrink-0 text-orange-500"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512">
                                                                <path fill='currentColor'
                                                                    d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256S114.6 512 256 512s256-114.6 256-256zM215 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L392 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-214.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L103 273c-9.4-9.4-9.4-24.6 0-33.9L215 127z" />
                                                            </svg>
                                                        @endif


                                                    </div>

                                                    @php
                                                        $name_game = '';
                                                        if (!empty($bet->games_id)) {
                                                            $game_to = DB::table('games')
                                                                ->where('id', '=', $bet->games_id)
                                                                ->first();
                                                            $name_game = $game_to->name;
                                                        }
                                                        if(!empty($bet->game_fungamess_id)){
                                                            $game_to = DB::table('fungamess_games')
                                                                ->where('id', '=', $bet->game_fungamess_id)
                                                                ->first();
                                                            $name_game = $game_to->name;
                                                        }

                                                    @endphp
                                                    <div class="min-w-0 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                        <div>
                                                            <p class="truncate text-xs md:text-sm font-bold text-white">
                                                                {{ $name_game }} </p>
                                                            <p class="mt-2 flex items-center text-xs md:text-sm text-gray-500">
                                                                @if ($bet->result == 'green')
                                                                    <span
                                                                        class="font-bold mr-1 text-white text-opacity-80">{{ __('bets.profit') }}:</span>
                                                                    {{ 'R$ + ' . number_format($bet->amount * $bet->odd - $bet->amount, 2) }}
                                                                @elseif ($bet->result == 'red')
                                                                    <span
                                                                        class="font-bold mr-1 text-white text-opacity-80">{{ __('bets.amount') }}:
                                                                    </span>R$ - {{ $bet->amount }}
                                                                @elseif ($bet->result == 'pending')
                                                                    <span
                                                                        class="font-bold mr-1 text-white text-opacity-80">{{ __('bets.entry_value') }}:
                                                                    </span>R$ - {{ $bet->amount }}
                                                                @elseif ($bet->result == 'canceled')
                                                                    <span
                                                                        class="font-bold mr-1 text-white text-opacity-80">{{ __('bets.amount') }}:
                                                                    </span>R$ {{ $bet->amount }}
                                                                @endif
                                                            </p>
                                                            <p class="mt-2 flex items-center text-xs md:text-sm text-gray-500">
                                                                <span
                                                                    class="font-bold mr-1 text-white text-opacity-80">{{ __('bets.result') }}:</span>
                                                                @if ($bet->result == 'green')
                                                                    {{ __('bets.result_green') }}
                                                                @elseif($bet->result == 'red')
                                                                    {{ __('bets.result_red') }}
                                                                @elseif($bet->result == 'pending')
                                                                    {{ __('bets.result_pending') }}
                                                                @else
                                                                    {{ __('bets.result_canceled') }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="hidden md:block">
                                                            <div>
                                                                <p class="text-xs md:text-sm text-gray-400">

                                                                </p>
                                                                <p
                                                                    class="mt-2 flex items-center text-xs text-gray-500">
                                                                    <!-- Heroicon name: mini/check-circle -->
                                                                <p>{{ date('d/m/Y', strtotime($bet->created_at)) }}
                                                                    @if (strtotime($bet->updated_at) > strtotime('-20 minutes') && $bet->result == 'green')
                                                                        <span
                                                                            class="badge badge-sm">{{ __('bets.new_update') }}</span>
                                                                    @endif
                                                                </p>
                                                                <p
                                                                    class="mt-2 flex items-center text-xs md:text-sm text-gray-500">
                                                                    {{ __('bets.entry_value') }}:
                                                                    {{ 'R$' . $bet->amount }}@if ($bet->result == 'green' or $bet->result == 'pending')
                                                                    @endif
                                                                </p>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="flex-1">
                                                        <p class="font-bold text-sm">{{ __('bets.bet_code') }}</p>
                                                        <p class="text-gray-500 text-xs md:text-sm">{{ $bet->bet_code }}</p>
                                                    </div>

                                                    <div class="absolute top-1 right-1 md:static">
                                                        @if ($bet->balance_used == 'balanceBonus')
                                                            <div class="badge history">
                                                                {{ __('bets.balance_used_BRL_Bonus') }}
                                                            </div>
                                                        @else
                                                            <div class="badge history">
                                                                {{ __('bets.balance_used_BRL') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- <div>
                                                    <!-- Heroicon name: mini/chevron-right -->
                                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                                    </svg>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                @if($count_bets >= $amount)
                                <div class="flex justify-center w-full">
                                    <button class="text-center btn gap-2 bg-[#090f1e] border-none hover:bg-[#060b16]"
                                        wire:click='laodMore()'>{{ __('bets.load_more') }}</button>
                                </div>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>

            @endif


        </div>
    </div>


</div>

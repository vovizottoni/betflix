<div class="max-w-7xl mx-auto">

    <style type="text/css">
        .card {
            background: #00000038;
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
    <div class="bg-section w-full">
        <div class="px-2 w-full">



            @if($check_transaction->isEmpty())
                <div class="text-center">
                    <img src="{{asset('assets/images/misc/withoutRegisters.gif')}}" style="filter: contrast(1.6) brightness(0.9) hue-rotate(200deg);" class="w-32 mx-auto mt-xl">
                    <h1 class="text-xl font-bold pt-2">{{__("history.you_dont_have_transaction")}}</h1>
                    <p class="opacity-60 pt-6 text-sm max-w-md mx-auto">{{__("history.it_looks_like")}} <span class="font-bold">:(</span> {{__("history.after_making_your_first_deposit")}}</p>
                    <a class="active:bg-transparent deposit-btn">
                        <div class="form-control">
                            <label for="depo-modal" class="deposit-btn nunes-btn font-bold">
                                {{__("history.click_make_first_deposit")}}
                            </label>
                        </div>
                    </a>
                </div>

            @else

                <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8 relative" style="z-index: 1;">
                    <div class="grid lg:grid-cols-2 gap-4">
                        <div>
                            <h1 class="text-white text-xl lg:text-3xl font-bold">{{ __('history.historico_transacoes_titulo') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="tabs mb-16 mx-auto sm:px-6 lg:px-8 mt-10">
                    <a href="{{route('bets')}}" class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;">Apostas</a>
                    <a href="{{route('player.account.transactions')}}" class="tab tab-lg tab-bordered transition-all tab-active" style="color: #fff !important;">Transações</a>
                    {{--
                    <a href="{{route('player.mybonus')}}" class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;">Bônus</a>
                    --}}
                </div>

                <div class="sm:px-6 lg:px-8 mt-20">

                    <div class="max-w-7xl w-full mx-auto mt-12 relative hidden" style="z-index: 1;">
                        <div class="grid grid-cols-1 min-[420px]:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="card">
                                <h3 class="text-2xl">R$ 0,00</h3>
                                <p>{{__("history.deposits")}}</p>
                            </div>
                            <div class="card">
                                <h3 class="text-2xl">R$ 0,00</h3>
                                <p>{{__("history.my_earnings")}}</p>
                            </div>
                            <div class="card">
                                <h3 class="text-2xl">R$ 0,00</h3>
                                <p>{{__("history.my_bonuses")}}</p>
                            </div>
                            <div class="card">
                                <h3 class="text-2xl">R$ 0,00</h3>
                                <p>{{__("history.my_withdrawals")}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-7xl w-full mx-auto mt-4 relative">
                        <div class="hidden xl:flex justify-between items-center max-w-full">


                            <div class="form-control">
                                <div class="input-group max-w-xs">
                                  <input type="text" wire:model="external_reference" id="external_reference_ID" placeholder="{{ __('history.codigo_da_transacao') }}" class="input max-w-full w-full" />

                                  <button class="btn btn-square bg-base-900 hover:bg-base-000 border-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                  </button>
                                </div>
                            </div>
                            {{--
                            <div class="dropdown dropdown-bottom dropdown-end">
                                <label tabindex="0" class=" bg-base-800 hover:bg-[#060b16] border-none btn m-1 remove-focus flex items-center">
                                    <span class="text-sm capitalize">{{__('history.filter')}}</span>
                                    <svg class="h-3 fill-current ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                                </label>
                                <div tabindex="0" class="dropdown-content rounded-md card-compact w-64 p-2 shadow mt-4" style="backdrop-filter: blur(10px); background: #0E1830;">
                                  <div class="card-body flex flex-col py-4 px-2 gap-4">

                                    <select wire:model="accounts_user_selected" class="select w-full max-w-xs">
                                        <option value=''>Selecione uma conta</option>
                                        @foreach ($accounts_user as $accounts)
                                            <option value="{{$accounts->id}}">{{$accounts->name}}</option>
                                        @endforeach
                                    </select>

                                    <select wire:model="type" id="type_ID" class="select w-full max-w-xs">
                                        <option value="">{{ __('history.type') }}</option>

                                        <optgroup label="{{ __('history.transactions_pix') }}">
                                            <option value="cashinPIX">{{ __('history.type_opcao_cashinPIX') }}</option>

                                            @php
                                                /*
                                                    <option value="cashinCC">{{ __('history.type_opcao_cashinCC') }}</option>
                                                */
                                            @endphp

                                            <option value="cashoutPIX">{{ __('history.type_opcao_cashoutPIX') }}</option>
                                        </optgroup>

                                        <optgroup label="{{ __('history.transactions_coingate') }}">
                                            <option value="coinGateCashin">{{ __('history.type_opcao_coingate') }}</option>
                                        </optgroup>
                                    </select>
                                    <select wire:model="status" id="status_ID" class="select w-full max-w-xs">

                                        <option value="">{{ __('history.status') }}</option>

                                        <optgroup label="{{ __('history.status_optgroup_cashin') }}">
                                            <option value="waiting_for_payment">{{ __('history.status_opcao_waiting_for_payment') }}</option>
                                            <option value="paid">{{ __('history.status_opcao_paid') }}</option>
                                            <option value="canceled">{{ __('history.status_opcao_canceled') }}</option>
                                        </optgroup>
                                        <optgroup label="{{ __('history.status_optgroup_cashout') }}">
                                            <option value="waiting_for_withdraw">{{ __('history.status_opcao_waiting_for_withdraw') }}</option>
                                            <option value="drawee">{{ __('history.status_opcao_drawee') }}</option>
                                            <option value="canceled">{{ __('history.status_opcao_canceled') }}</option>
                                        </optgroup>
                                        <optgroup label="{{ __('history.type_opcao_coingate') }}">
                                            <option value="coingate_waiting_for_payment">{{ __('history.status_opcao_waiting_for_payment') }}</option>
                                            <option value="coingate_paid">{{ __('history.status_opcao_paid') }}</option>
                                            <option value="coingate_canceled">{{ __('history.status_opcao_canceled') }}</option>
                                        </optgroup>
                                    </select>
                                    <input type="datetime-local" wire:model.lazy="created_at__from" id="created_at__from_ID" value="" class="input w-full max-w-xs"> <!-- created_at from -->
                                    <input type="datetime-local" wire:model.lazy="created_at__to" id="created_at__to_ID" value="" class="input w-full max-w-xs"> <!-- created_at to -->

                                  </div>
                                </div>
                            </div>
                            --}}
                        </div>
                        <div class="flex xl:hidden max-w-full justify-between items-center">
                            <div class="form-control">
                                <div class="input-group input-group-sm">
                                  <input type="text" wire:model="external_reference" id="external_reference_ID" placeholder="{{ __('history.codigo_da_transacao') }}" class="input max-w-xs input-sm" style="width: 150px !important" />

                                  <button class="btn btn-square btn-sm bg-base-900 hover:bg-base-900 border-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                  </button>
                                </div>
                            </div>

                            {{--
                            <div class="dropdown dropdown-bottom dropdown-end">
                                <label tabindex="0" class=" bg-base-800 hover:bg-[#060b16] border-none btn btn-sm m-1 remove-focus flex items-center">
                                    <span class="text-sm capitalize">Filtrar</span>
                                    <svg class="h-3 fill-current ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                                </label>
                                <div tabindex="0" class="dropdown-content rounded-md card-compact w-64 p-2 shadow mt-4" style="backdrop-filter: blur(10px); background: #0E1830;">
                                  <div class="card-body flex flex-col py-4 px-2 gap-4">
                                    <select wire:model="type" id="type_ID" class="select w-full max-w-xs select-sm text-xs">
                                        <option value="">{{ __('history.type') }}</option>
                                        <option value="cashinPIX">{{ __('history.type_opcao_cashinPIX') }}</option>
                                        <option value="cashinCC">{{ __('history.type_opcao_cashinCC') }}</option>
                                        <option value="cashoutPIX">{{ __('history.type_opcao_cashoutPIX') }}</option>
                                    </select>
                                    <select wire:model="status" id="status_ID" class="select w-full max-w-xs select-sm text-xs">

                                        <option value="">{{ __('history.status') }}</option>

                                        <optgroup label="{{ __('history.status_optgroup_cashin') }}">
                                            <option value="waiting_for_payment">{{ __('history.status_opcao_waiting_for_payment') }}</option>
                                            <option value="paid">{{ __('history.status_opcao_paid') }}</option>
                                            <option value="canceled">{{ __('history.status_opcao_canceled') }}</option>
                                        </optgroup>
                                        <optgroup label="{{ __('history.status_optgroup_cashout') }}">
                                            <option value="waiting_for_withdraw">{{ __('history.status_opcao_waiting_for_withdraw') }}</option>
                                            <option value="drawee">{{ __('history.status_opcao_drawee') }}</option>
                                            <option value="canceled">{{ __('history.status_opcao_canceled') }}</option>
                                        </optgroup>
                                    </select>
                                    <input type="datetime-local" wire:model.lazy="created_at__from" id="created_at__from_ID" value="" class="input input-sm w-full max-w-xs"> <!-- created_at from -->
                                    <input type="datetime-local" wire:model.lazy="created_at__to" id="created_at__to_ID" value="" class="input input-sm w-full max-w-xs"> <!-- created_at to -->


                                  </div>
                                </div>
                            </div>
                            --}}

                        </div>
                    </div>

                </div>

                <div class=" mx-auto mt-12 m:px-6 lg:px-8 relative" style="z-index: 1;">
                    <div class="overflow-hidden bg-dark-700 shadow sm:rounded-md">
                        <ul role="list" class="">

                            <div wire:loading.delay.shorter class="w-full">
                                <div class="loading ml-auto mr-auto mb-4 mt-12"></div>
                            </div>

                            @if(($transactions)->isEmpty())

                                <p class="text-center py-12 font-bold opacity-50">{{__("bets.no_records_matching")}} </p>

                            @else

                                @foreach ($transactions as $transaction)


                                @php

                                    //analisa status
                                    $statusTransaction_VIEW = '';

                                    $statusTransaction_VIEW = $transaction->status;

                                @endphp




                                @php
                                    //Prepara informacoes de type e status, iconeSVG e sinal matemático
                                    $transactionTipo_VIEW = '';
                                    $iconTransactionSVG_VIEW = '';
                                    $mathOperator = '';

                                    //preenchendo informações baseadas no type
                                    if($transaction->type == 'cashinPIX'){
                                        $transactionTipo_VIEW = __('history.type_opcao_cashinPIX');
                                        $mathOperator = '+';

                                    }else if($transaction->type == 'cashoutPIX'){
                                        $transactionTipo_VIEW = __('history.type_opcao_cashoutPIX');
                                        $mathOperator = '-';

                                    }else if($transaction->type == 'coinGateCashin'){
                                        $transactionTipo_VIEW = __('history.type_opcao_coingate');
                                        $mathOperator = '+';
                                    }

                                    //preenchendo informações baseadas no type
                                    if($transaction->status == 'waiting_for_payment' || $transaction->status == 'waiting_for_withdraw' || $transaction->status == 'coinGate_waiting_for_confimation' || $transaction->status == 'coingate_new' || $transaction->status == 'coingate_pending' || $transaction->status == 'coingate_confirming'){
                                        $iconTransactionSVG_VIEW = '<svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path fill="currentColor" d="M256 512C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256s-114.6 256-256 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"></path>
                                                        </svg>';

                                    }elseif($transaction->status == 'paid' || $transaction->status == 'drawee' || $transaction->status == 'coingate_paid'){
                                        $iconTransactionSVG_VIEW = '<svg class="mr-1.5 h-6 w-6 flex-shrink-0 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"></path>
                                                        </svg>';

                                    }else{
                                        $iconTransactionSVG_VIEW = '<svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path fill="currentColor" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224c0-17.7-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32z"></path>
                                                        </svg>';
                                    }
                                @endphp

                                @php

                                    //moeda - R$, $ , ...
                                    $currency = 'R$';

                                    //Balanbce used - normal ou Bonus
                                    $typeBalance = 'normal'; // normal - bonus



                                    //moeda
                                    if($transaction->balance_used == 'balance' || $transaction->balance_used == 'balanceBonus'){

                                        $currency = 'R$';

                                    }else if($transaction->balance_used == 'balanceUSD' || $transaction->balance_used == 'balanceUSDBonus') {

                                        $currency = '$';

                                    }else{

                                        //outras moedas
                                    }



                                    //balance_used da transaction
                                    if($transaction->balance_used == 'balance' || $transaction->balance_used == 'balanceUSD'){

                                        $typeBalance = 'normal';

                                    }else{

                                        $typeBalance = 'bonus';

                                    }

                                @endphp


                                    <li style="border-bottom: 1px solid #ffffff08;" title="{{$transaction->status}}">
                                        <a href="#" class="block bg-[#0E1830]">
                                            <div class="flex items-center px-4 py-4 sm:px-6">
                                                <div class="flex min-w-0 flex-1 items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="mr-1.5 h-5 w-5 flex-shrink-0 text-yellow-400" >
                                                            {!! $iconTransactionSVG_VIEW !!}
                                                        </div>

                                                    </div>
                                                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                        <div>
                                                            <p class="truncate text-sm font-bold text-white">{{ $transactionTipo_VIEW }}</p>
                                                            <p class="mt-2 flex items-center text-sm text-gray-500">{{ $mathOperator }} {{ $currency }} {{  number_format($transaction->amount, 2, ',', '.') }} </p>

                                                        </div>
                                                        <div class="hidden md:block">
                                                            <div>
                                                                <p class="text-sm text-gray-400">
                                                                    {{ $util->statusTrated($transaction->status) }}
                                                                </p>

                                                                <p class="m-t-2 flex items-center text-xs text-gray-500">
                                                                    <!-- Heroicon name: mini/check-circle -->
                                                                    {{-- {!! $little_iconTransactionSVG_VIEW !!} --}}
                                                                    {{ date('d/m/Y H:i:s', strtotime($transaction->created_at))   }}
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div>
                                                    <!-- Heroicon name: mini/chevron-right -->
                                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                                    </svg>
                                                </div> --}}
                                            </div>
                                        </a>
                                    </li>

                                @endforeach
                                @if($transactions_count >= $amount_____)
                                <br>
                                <div class="flex justify-center w-full">
                                    <button class="text-center btn gap-2 bg-base-800 border-none hover:bg-[#060b16]" wire:click='laodMore()' >{{__("bets.load_more")}}</button>
                                </div>
                                @endif
                            @endif

                        </ul>

                    </div>
                </div>

            @endif

            <!--
                Paginate do LUAN
            <div class="w-full flex justify-end">
                <div class="btn-group mt-12">
                    <button class="btn pag-active">1</button>
                    <button class="btn">2 aaaaaaaaaaaaaaa</button>
                    <button class="btn">3 bbbbbbbbbbbbbbb</button>
                    <button class="btn btn-disabled">...</button>
                    <button class="btn">98</button>
                    <button class="btn">99</button>
                    <button class="btn">100</button>
                </div>
            </div>
        -->

        </div>
    </div>



</div>
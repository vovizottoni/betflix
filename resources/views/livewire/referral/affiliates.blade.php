
<div class="max-w-7xl mx-auto">


    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8 relative" style="z-index: 1;">
        <div class="grid lg:grid-cols-2 gap-4">
            <div>
                <h1 class="text-white text-xl lg:text-3xl font-bold">
                    Meus indicados</h1>

            </div>
        </div>
    </div>

    <div class="tabs mb-16 mx-auto sm:px-6 lg:px-8 mt-10">

            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.myinvitations') }}">
                {{__("invitations.overview")}}
            </a>

            <a class="tab tab-lg tab-bordered transition-all tab-active" style="color: #fff !important;" href="{{ route('player.myaffiliates') }}">
                Meus indicados
            </a>

            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.show-heirarchy') }}">
                Meus afiliados
            </a>
            
            @if (Auth::user()->bonus3_nivelhierarquico == 'master' || Auth::user()->bonus3_nivelhierarquico == 'supervisor' || Auth::user()->bonus3_nivelhierarquico == 'gerente' || Auth::user()->bonus3_nivelhierarquico == 'subgerente' )
            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.myaffiliatesxray') }}">
                Dashboard
            </a>
            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{url('player/mybonus')}}">
                    Extrato
                </a>
            @endif
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="pb-[150px]">

            {{-- caixa de pesquisa -- DESKTOP --}}
                <div class="hidden md:form-control mb-20 flex">
                    <div class="input-group max-w-xs">
                        <input type="text" wire:model.defer="searchTerm" placeholder="Digite o nome" class="input max-w-full w-full" />

                        <button wire:click='search()' class="btn btn-square bg-base-900 hover:bg-base-000 border-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                        {{--
                        <div class="pl-2">
                            <button wire:click='clearSearchField()' class="btn  bg-base-900 hover:bg-base-000 border-none">Limpar Filtros</button>
                        </div>
                        --}}
                    </div>
                </div>
                {{-- caixa de pesquisa --}}

            @if(($invites)->isEmpty())
            <div class="text-center">
                <img src="{{asset('assets/images/misc/withoutRegisters.gif')}}" style="width: 120px;filter: contrast(1.6) brightness(0.9) hue-rotate(200deg);margin: 0 auto;margin-top: 120px;">
                <h1 class="text-xl font-bold pt-2">{{__("affiliates.you_do_not_have_affiliates")}}</h1>
                <p class="opacity-60 pt-6 text-sm max-w-md mx-auto">{{__("affiliates.so_far_no_user_registered")}}</p>
            </div>
            @else

            <ul style="list-style-type: none;">




                @foreach ($invites as $affiliate)
                <li style="border-bottom: 1px solid #ffffff08;">
                    @php
                    $photo='';
                    if(!empty($affiliate->id)){
                    $photo_to = DB::table('accounts')->where('users_id', '=', $affiliate->id)->first();
                    }
                    $photo = $photo_to ? $photo_to->photo : '';

                    $e_primeiro_deposito = 'Não';
                    $numero_transactions_c_status_paid = 0;
                    $id_da_transaction_c_status_paid = 0;

                    $accounts_user___ = DB::table('accounts')->where([['users_id', '=', $affiliate->id]])->get();

                    foreach($accounts_user___ as $account_user___){
                    //busca transactions dessa account_user___
                    $transactions______ = DB::table('transactions')->where([['accounts_id', '=',
                    $account_user___->id]])->get();

                    foreach($transactions______ as $transaction______){

                    if(($transaction______->type == 'cashinPIX') && ($transaction______->status == 'paid' ||
                    $transaction______->status == 'coingate_paid') ){
                    ++$numero_transactions_c_status_paid;
                    $id_da_transaction_c_status_paid = $transaction______->id;

                    if($numero_transactions_c_status_paid > 1){
                    break;
                    }
                    }
                    }
                    if($numero_transactions_c_status_paid > 1){
                    break;
                    }
                    }
                    if($numero_transactions_c_status_paid >= 1){
                    $e_primeiro_deposito = 'Sim';

                    }

                    if($affiliate->group_id){
                        $cpa = DB::table('group')->where('id',$affiliate->group_id)->first();
                    }


                    //analisar se o convidado ($affiliate) gerou bonus2 parao influenciador ( Auth::user()->id)
                    $bonus2_gerado_valor = '';
                    $bonus2_gerado = DB::table('bonus')->where([['accounts_id', '=',
                    $var_id_primeira_account_user_logado], ['group_id', '=', Auth::user()->group_id], ['group_id', '=',
                    Auth::user()->group_id], ['group_tipo', '=', '2'], ['users_id_gerador_do_bonus', '=',
                    $affiliate->id]])->first();
                    if(empty($bonus2_gerado)){
                    $bonus2_gerado_valor = '-';
                    }else{
                    $bonus2_gerado_valor = 'R$'.number_format($bonus2_gerado->amount, 2, ',', '.');
                    }


                    @endphp
                    <div href="#" class="block bg-[#0E1830]">
                        <div class="flex items-center px-4 py-4 sm:px-6">
                            <div class="flex min-w-0 flex-1">
                                <div class="flex-shrink-0">
                                    <div>
                                        @if ($affiliate->bonus3_nivelhierarquico)
                                        <img src="https://cdn-icons-png.flaticon.com/512/6941/6941697.png"
                                            class="h-8 mx-auto">
                                        @endif
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png" class="rounded-md h-12 w-12">
                                    </div>

                                </div>

                                <div class="min-w-0 flex-1 px-4 grid md:grid-cols-3 gap-4">
                                    <div>
                                        <p class="truncate text-sm font-bold text-white">{{$affiliate->name}}</p>
                                        <p class="text-sm text-gray-400 lowercase">
                                            #{{$affiliate->my_invite_code}}
                                        </p>
                                    </div>
                                    <div class="hidden md:block">
                                        <div>
                                            <p class="text-sm text-gray-400">
                                                {{$affiliate->email}}
                                            </p>
                                            <p class="mt-1 flex items-center text-xs text-gray-500">
                                                {{__('affiliates.register_date')}}
                                                {{ \Carbon\Carbon::parse($affiliate->created_at)->format('d/m/y')}}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div>
                                            <p class="text-sm text-gray-400 md:text-right">
                                                Primeiro depósito: {{$e_primeiro_deposito}}
                                            </p>
                                            <p class="text-sm text-gray-400 md:text-right">
                                                CPA Gerado: {{$bonus2_gerado_valor}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>

            <div class="flex justify-center w-full mx-auto mt-6">
                <button class="text-center btn gap-2 bg-base-800 border-none hover:bg-base-700"
                    wire:click='laodMore()'>Carregar mais indicados</button>
            </div>

            @endif
        </div>

    </div>
</div>
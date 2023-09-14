<div>
    <!-- Link e scripts para select 2-------------------------------------------------------------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--------------------------------------------------------------------------------------------------------------------->



    <div class="page-header">
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>Histórico de Bônus 1 e 2</b>
    </div>



    <div class="card has-table">

        <div class="w-full">

            <form class="w-full">
                <div class="flex flex-row items-end justify-center gap-6 px-6 py-4 sm:justify-start">
                    <div>
                        <button class='btn' wire:click='cancel'>VOLTAR</button>
                    </div>
                    <div class="form-control w-56">
                        <label class="label" for="label flex items-center justify-start">
                            Usuário que recebeu:
                        </label>
                        <select id="group_name_select" wire:model='convidado_escolhido'>
                            <option value="">Selecione um usuário:</option>
                            @foreach ($convidados as $convidado)
                                <option value="{{ $convidado->id }}"
                                    @php if($convidado_escolhido == $convidado->id){ echo 'selected';  } @endphp>
                                    {{ $convidado->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($convidado_escolhido)
                    <div class="form-control w-56">
                        <label class="label" for="label flex items-center justify-start">
                            Conta que recebeu:
                        </label>
                        <select id="group_account_select" wire:model='account_select'>
                            <option value="">Selecione uma conta:</option>
                            @foreach ($account as $conta)
                                <option value="{{ $conta->id }}"
                                    @php if($account_select == $conta->id){ echo 'selected';  } @endphp>
                                    {{ $conta->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="form-control w-56">
                        <label class="label" for="label flex items-center justify-start">
                            Selecione o Grupo:
                        </label>
                        <select id="group_select" wire:model='group_select'>
                            <option value="">Selecione um grupo:</option>
                            @foreach ($name_group as $group)
                                <option value="{{ $group->id }}"
                                    @php if($group_select == $group->id){ echo 'selected';  } @endphp>
                                    {{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-56">
                        <label class="label" for="label flex items-center justify-start">
                          Gateway de pagamento:
                        </label>
                        <select wire:model="gateway_pagamento" class="select select-bordered">
                            <option value="">Selecione uma opção:</option>
                            <option value="pagstar">Pagstar</option>
                            <option value="coingate">Coingate</option>
                        </select>
                    </div>

                    <div class="form-control w-56">
                        <label class="label" for="label flex items-center justify-start">
                          Tipo de Grupo:
                        </label>
                        <select wire:model="tipo_group" class="select select-bordered">
                            <option value="">Selecione uma opção:</option>
                            <option value="1">Bônus 1</option>
                            <option value="2">Bônus 2</option>
                        </select>
                    </div>

                    <div class="form-control w-56">
                        <label class="label" for="">Data de Início</label>
                        <input type="date" wire:model.lazy="created_at__from" id="created_at__from_ID" value=""
                            class="input w-full max-w-xs">
                    </div>

                    <div class="form-control w-56">
                        <label class="label" for="">Data Fim</label>
                        <input type="date" wire:model.lazy="created_at__to" id="created_at__to_ID" value=""
                            class="input w-full max-w-xs">
                    </div>

                    <div>
                        <button class='btn' wire:click='resetFilters'>LIMPAR FILTROS</button>
                    </div>
                </div>
            </form>
            </header>


            <div class="px-4 sm:px-6 lg:px-8 relative z-10 overflow-visible">
                <div class="mt-8 flex flex-col overflow-visible">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 overflow-visible">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 overflow-visible">
                            <table class="min-w-full divide-y divide-gray-300 overflow-visible">
                                <thead class="overflow-visible">
                                    <tr class="overflow-visible">

                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            ID</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Data de criação</th>

                                        <th scope="col"
                                        class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Nome do grupo</th>

                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Tipo do Grupo</th>
                                        <th scope="col"
                                        class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Quantia</th>
                                        <th scope="col"
                                        class="py-3.5 px-3 text-left text-xs font-semibold text-gray-900">
                                            Usuário Gerador do Bônus:</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 overflow-visible">
                                    @if (!$bonus12->IsEmpty())
                                        @foreach ($bonus12 as $bonus_)

                                            @php
                                                if ($bonus_->group_id) {

                                                    $group_ = DB::table('group')->where('id', $bonus_->group_id)->first();
                                                }

                                                if ($bonus_->accounts_id) {

                                                    $account = DB::table('accounts')->where('id', $bonus_->accounts_id)->first();
                                                    $user__ = DB::table('users')->where('id', $account->users_id )->first();

                                                    }




                                            @endphp

                                            <tr>

                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                   {{ $bonus_->id }}</td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                       {{ date('d/m/Y', strtotime($bonus_->created_at)) }}
                                                </td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                    {{ $group_->name }}</td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                {{ $bonus_->group_tipo  }}</td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                    {{ 'R$ '. number_format($bonus_->amount, 2, '.', ',') }}</td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                    {{ $user__->name }} <br> {{ $user__->email }}</td>



                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">Nenhum registro encontrado.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <br>
                            <!--
                            // Não está traduzido, e está aparecendo a todo instante, mesmo quando não há mais transações a carregar;
                            <div>
                                <button class="text-center btn gap-2 bg-base-700" wire:click='laodMore()' > Carregar Mais</button>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">


                    $(document).ready(function() {
                    $('#group_name_select').select2();
                    $('#group_name_select').on('change', function(e) {
                        var data = $('#group_name_select').select2("val");

                        // alert(data);

                        @this.set('convidado_escolhido', data);
                    });
                });

                $(document).ready(function() {
                    $('#group_account_select').select2();
                    $('#group_account_select').on('change', function(e) {
                        var data = $('#group_account_select').select2("val");

                        // alert(data);

                        @this.set('account_select', data);
                    });
                });

                $(document).ready(function() {
                    $('#group_select').select2();
                    $('#group_select').on('change', function(e) {
                        var data = $('#group_select').select2("val");

                        // alert(data);

                        @this.set('group_select', data);
                    });
                });



            //##################################################################################################################################################################################################################
            //##################################################################################################################################################################################################################
            //o momento callback dehydrate() é executando sempre apos um render e ele dispara o contentChanged para dar um refresh no JS
            document.addEventListener('contentChanged', function(e) {

                $(document).ready(function() {
                    $('#group_name_select').select2();
                    $('#group_name_select').on('change', function(e) {
                        var data = $('#group_name_select').select2("val");

                        // alert(data);

                        @this.set('convidado_escolhido', data);
                    });
                });

                $(document).ready(function() {
                    $('#group_account_select').select2();
                    $('#group_account_select').on('change', function(e) {
                        var data = $('#group_account_select').select2("val");

                        // alert(data);

                        @this.set('account_select', data);
                    });
                });

                $(document).ready(function() {
                    $('#group_select').select2();
                    $('#group_select').on('change', function(e) {
                        var data = $('#group_select').select2("val");

                        // alert(data);

                        @this.set('group_select', data);
                    });
                });


            });
            //##################################################################################################################################################################################################################
            //##################################################################################################################################################################################################################
        </script>
    </div>
</div>

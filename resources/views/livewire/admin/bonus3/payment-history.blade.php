<div>
    <!-- Link e scripts para select 2-------------------------------------------------------------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--------------------------------------------------------------------------------------------------------------------->



    <div class="page-header">
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>Histórico de Bônus 3(Bônus sobre perda/red): {{ $userObj->name }}&nbsp;({{ $userObj->bonus3_nivelhierarquico }})</b>
    </div>



    <div class="card has-table">

        <div class="w-full">
            <form class="w-full">
                <div class="flex flex-row items-end justify-center gap-6 px-6 py-4 sm:justify-start">
                    <div class="form-control w-56">
                        <label class="label" for="label flex items-center justify-start">
                            Bônus gerado pelo convidado:
                        </label>
                        <select wire:model='convidado_escolhido' id="group_name_select" name="">
                            <option value="">Selecione um usuário:</option>
                            @foreach ($convidados as $convidado)
                                <option value="{{ $convidado->id }}"
                                    @php if($convidado_escolhido == $convidado->id){ echo 'selected';  } @endphp>
                                    {{ $convidado->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-56">
                        <label class="label" for="label flex items-center justify-start">
                          Bônus 3 Processado?
                        </label>
                        <select wire:model="group3_processado" class="select select-bordered">
                            <option value="">Selecione uma opção:</option>
                            <option value="s">Sim</option>
                            <option value="n">Não</option>
                        </select>
                    </div>

                    <div class="form-control w-56">
                        <label class="label" for="label flex items-center justify-start">
                          Resultado Bet
                        </label>
                        <select wire:model="resultado_processamento" class="select select-bordered">
                            <option value="">Selecione uma opção:</option>
                            <option value="-">Green</option>
                            <option value="+">Red</option>
                        </select>
                    </div>

                    <div class="form-control w-56">
                        <label class="label" for="label flex items-center justify-start">
                          Semana de Processamento
                        </label>
                        <select wire:model="semana_processamento" class="select select-bordered">
                            <option value="">Selecione uma opção:</option>
                            <option value="1">Semana 1</option>
                            <option value="2">Semana 2</option>
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
                </div>
            </form>
            @if (!$bonus3->IsEmpty())
            <div class="mb-8">
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">
                    <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                        <dt>
                            <div class="absolute rounded-md bg-green-700 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                            <p class="ml-16 truncate text-sm font-medium text-gray-500">Revenue Share Pago</p>
                        </dt>
                        <dd class="ml-16 flex items-baseline pb-3">
                            @php
                                $amountSharePagoSUM = $bonus3->where('pagou', 's')->sum('amount');
                            @endphp
                            <p class="text-2xl font-semibold text-gray-900">R$ {{number_format($amountSharePagoSUM, 2, ',', '.')}} </p>
                        </dd>
                    </div>
                    <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                        <dt>
                            <div class="absolute rounded-md bg-green-700 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                            <p class="ml-16 truncate text-sm font-medium text-gray-500">Revenue Share em Aberto</p>
                        </dt>
                        <dd class="ml-16 flex items-baseline pb-3">
                            @php
                                $amountShareNaoPagoSUM = $bonus3->where('pagou', 'n')->sum('amount');
                            @endphp
                            <p class="text-2xl font-semibold text-gray-900">R$ {{number_format($amountShareNaoPagoSUM, 2, ',', '.')}} </p>
                        </dd>
                    </div>
                </dl>
            </div>
            @endif
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
                                            Data</th>

                                        <th scope="col"
                                            class="whitespace-nowrap py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Código da Aposta</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Valor do Bônus</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Green/Red</th>

                                        <th scope="col"
                                        class="py-3.5 px-3 text-left text-xs font-semibold text-gray-900">
                                            Semana / Pagamento Processado? / Recebeu B3? / Valor Recebido nessa Semana</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 overflow-visible">
                                    @if (!$bonus3->IsEmpty())
                                        @foreach ($bonus3 as $bonus3_)

                                            @php
                                                if ($bonus3_->bets_id) {
                                                    $bet = DB::table('bets')->where('id', $bonus3_->bets_id)->first();
                                                    
                                                }

                                                $pagou = '';
                                                if (isset($bonus3_->pagou) && $bonus3_->pagou == 's') {
                                                    $pagou = 'sim';
                                                }elseif (isset($bonus3_->pagou) && $bonus3_->pagou == 'n') {
                                                    $pagou = 'não';
                                                }else {
                                                    $pagou = 'não';
                                                }

                                                $bonus3_valordopagamentosemanal = '';
                                                if (isset($bonus3_->bonus3_valordopagamentosemanal) && is_numeric($bonus3_->bonus3_valordopagamentosemanal) ) {
                                                    $bonus3_valordopagamentosemanal = 'R$ ' . number_format($bonus3_->bonus3_valordopagamentosemanal, 2, '.', ',');
                                                }else {
                                                    $bonus3_valordopagamentosemanal = '-';
                                                }

                                            @endphp

                                            <tr>

                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                   {{ $bonus3_->id }}</td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                       {{ date('d/m/Y', strtotime($bonus3_->created_at)) }}
                                                </td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                    @if (!is_null($bet))
                                                        {{ $bet->bet_code }}
                                                    @endif
                                                </td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                    {{ 'R$ '. number_format($bonus3_->amount, 2, '.', ',') }}</td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                {{ $bonus3_->bonus3_sinal == '+'? 'red': 'green'  }}</td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                    {{ $bonus3_->bonus3_semanapagamento .' / '. ($bonus3_->bonus3_processado == 's'? 'sim': 'não') . ' / ' . $pagou . ' / ' . $bonus3_valordopagamentosemanal }}</td>


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
                            <div>
                                <button class="text-center btn gap-2 bg-base-700" wire:click='laodMore()' > Carregar Mais</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">






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


            });
            //##################################################################################################################################################################################################################
            //##################################################################################################################################################################################################################
        </script>
    </div>
</div>


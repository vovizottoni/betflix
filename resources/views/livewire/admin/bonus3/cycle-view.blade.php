<div>
    <div class="page-header">

        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>Visão do Ciclo de Afiliados</b>
    </div>

    <hr style="margin-top: 50px;">
    <div class="mt-12 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-12 lg:gap-6">
        <div class="col-span-12">
            <div class="flex items-center justify-between">
                <h2 class="font-bold tracking-wide text-[#000]">
                    Fechamento Semanal
                </h2>
            </div>
            <input wire:model="search" type="text" placeholder="Buscar afiliado">
            <div class="card mt-3">
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">

                    <table id="tabela-home" class="dataTable is-hoverable w-full text-left">
                        <thead>
                            <tr>
                                <th
                                    class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Afiliado
                                </th>
                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Registros<br>no período
                                </th>
                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Depósitos
                                </th>
                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Saques
                                </th>
                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Net P&L
                                </th>
                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Revenue Share
                                </th>

                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Porcentagem CPA do <br>afiliado
                                </th>

                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Piso CPA do<br>afiliado
                                </th>

                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Teto CPA do<br>afiliado
                                </th>

                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    CPA
                                </th>
                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    QFTD'S<br>CPA
                                </th>
                                <th
                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5 text-xs">
                                    Comissão à<br>Receber
                                </th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($affiliates as $affiliate)
                            @if (stripos($affiliate['name'], $search) !== false)
                            @if(isset($affiliate['cashout_affiliates']) && $affiliate['cashout_affiliates'] > 0)
                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">{{$affiliate['name']}}</p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">
                                        {{$affiliate['count_register_affiliate']}}</p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">{{$affiliate['cashin_affiliates']}}</p>
                                </td>


                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">{{$affiliate['cashout_affiliates']}}</p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">R$ {{ number_format($affiliate['ggr'], 2, ',', '.')
                                        }}</p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">R$ {{ number_format($affiliate['rev'], 2, ',', '.')
                                        }}</p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">
                                        @if(isset($affiliate['cpa_details']->bonus2_percentual_valor_integer))
                                            {{ $affiliate['cpa_details']->bonus2_percentual_valor_integer }}
                                        @else
                                            0
                                        @endif
                                        /
                                        @if(isset($affiliate['cpa_details']->bonus2_percentual_superior_integer))
                                            {{ $affiliate['cpa_details']->bonus2_percentual_superior_integer }}
                                        @else
                                            0
                                        @endif
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm"> {{
                                        $affiliate['cpa_details']->bonus2_piso_integer }}
                                    </p>
                                </td>


                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm"> {{
                                        $affiliate['cpa_details']->bonus2_teto_integer }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">R$ {{ number_format($affiliate['cpa'], 2, ',', '.')
                                        }}</p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">{{$affiliate['qftd']}}</p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-sm">R$ {{ number_format($affiliate['bonus'], 2, ',', '.')
                                        }}</p>
                                </td>


                            </tr>
                            @endif
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                    <div class="mt-4">
                        <button wire:click="previousPage" wire:disabled="currentPage == 1" class="mr-2">
                            Página Anterior
                        </button>

                        <button wire:click="nextPage">Próxima página</button>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
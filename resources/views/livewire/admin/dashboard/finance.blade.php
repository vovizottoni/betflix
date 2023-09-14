<div class="p-3">

    <style type="text/css">
        .fa-gift:before {
    content: "\f06b";
}
    </style>
    <!--
        
        Total de saldo real nas contas
        Total de saldo bônus nas contas
        Total de saldo CPA nas contas
        Total de saldo sacável
        Total de 


        Médias
            - Valor médio de primeiro depósito;
            - Ticket médio por cliente
            - Lucro médio por cliente;
    -->

    <section>
        <div class="md:flex md:items-center md:justify-between md:space-x-5 p-3">
            <div class="flex items-start space-x-5">
                <div class="pt-1.5">
                    <h1 class="text-2xl font-bold text-gray-900 uppercase"> Relatório analítico financeiro </h1>
                    <p class="text-sm font-medium text-gray-900"> Resumo Geral de Dados </p>
                </div>
            </div>
            <div class="justify-stretch mt-6 flex flex-col-reverse space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-y-0 sm:space-x-3 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">

                <button type="button" class="btn-filter inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm" data-filter="hoje" wire:click="filter({{ true }}, '{{ date('Y-m-d') }}')" wire:ignore> Hoje </button>

                <button type="button" class="btn-filter inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm" data-filter="ontem" wire:click="filter({{ true }}, '{{ date('Y-m-d', strtotime('-1 days')) }}')" wire:ignore> Ontem </button>

                <button type="button" class="btn-filter inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm" data-filter="7-dias" wire:click="filter({{ true }}, '{{ date('Y-m-d', strtotime('-7 days')) }}')" wire:ignore> 7 dias </button>

                <button type="button" class="btn-filter inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm" data-filter="30-dias" wire:click="filter({{ true }}, '{{ date('Y-m-d', strtotime('-30 days')) }}')" wire:ignore> 30 dias </button>

                <button type="button" class="btn-filter inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm" data-filter="3-meses" wire:click="filter({{ true }}, '{{ date('Y-m-d', strtotime('-3 months')) }}')" wire:ignore> 3 meses </button>

                <button type="button" class="btn-filter inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm" data-filter="6-meses" wire:click="filter({{ true }}, '{{ date('Y-m-d', strtotime('-6 months')) }}')" wire:ignore> 6 meses </button>

                <button type="button" class="btn-filter inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm bg-red-600" data-filter="todos" wire:click="filter({{ false }})" wire:ignore> Todos os períodos </button>
            </div>
        </div>
    </section>


    <div class="mb-8">
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Total em depósitos </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_in_deposit, 2, ',', '.') }}</p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Total em retiradas </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_withdraw, 2, ',', '.') }} </p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6" id="totalAccountBalance" wire:ignore>
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Saldo nas contas </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_account_balance, 2, ',', '.') }} </p>
                </dd>
            </div>
        </dl>
    </div>

    <div class="mb-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-1xl font-bold tracking-tight text-gray-900">GRR: Seletor Geral e Por Jogo</h2>
            </div>
        </div>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Total em apostas </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_bets, 2, ',', '.') }} </p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Pagamento aos vencedores </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_payment_to_winners, 2, ',', '.') }} </p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Lucro garantido e porcentagem </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_guaranteed_profit_percentage['total'], 2, ',', '.') }} / <small> {{ $total_guaranteed_profit_percentage['percentage'] }}%</small> </p>
                </dd>
            </div>
        </dl>
    </div>

    <div class="mb-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-1xl font-bold tracking-tight text-gray-900"> Bônus </h2>
            </div>
        </div>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Total pago </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_bonus_paid, 2, ',', '.') }} </p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Total apostado em bônus </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_bonus_bet, 2, ',', '.') }} </p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6" id="totalBonusHome" wire:ignore>
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Bônus da casa </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_bonus_home, 2, ',', '.') }} </p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Total gerado em saldo Real </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_bonus_real_balance, 2, ',', '.') }} </p>
                </dd>
            </div>
        </dl>
    </div>

    <div class="mb-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-1xl font-bold tracking-tight text-gray-900"> Médias </h2>
            </div>
        </div>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Valor médio de primeiro depósito </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($average_first_deposit_amount, 2, ',', '.') }} </p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-3 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500"> Ticket médio por cliente </p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-3">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($average_ticket_customer, 2, ',', '.') }} </p>
                </dd>
            </div>
        </dl>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</div>
<div>
    <div class="page-header">
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>Histórico de transações</b>
    </div>



    <div class="card has-table">

        <div class="w-full">



            <div class="px-4 sm:px-6 lg:px-8 relative z-10 overflow-visible">
                <div class="mt-8 flex flex-col overflow-visible">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 overflow-visible">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 overflow-visible">
                            <table class="min-w-full divide-y divide-gray-300 overflow-visible">
                                <thead class="overflow-visible">
                                    <tr class="overflow-visible">

                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            ID da transação</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Data</th>

                                        <th scope="col"
                                            class="whitespace-nowrap py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Tipo</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Status</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Valor</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 overflow-visible">
                                    @if (!$transactions->IsEmpty())
                                    @foreach ($transactions as $transaction)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            {{ $transaction->id }}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            @if($transaction->type == 'cashoutPIX')
                                            Saque
                                            @elseif($transaction->type == 'cashinPIX')
                                            Depósito
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            @if($transaction->status == 'drawee')
                                            Pago
                                            @elseif($transaction->status == 'paid')
                                            Pago
                                            @elseif($transaction->status == 'waiting_for_payment')
                                            Aguardando Pagamento
                                            @elseif($transaction->status == 'waiting_for_withdraw')
                                            Processando saque
                                            @elseif($transaction->status == 'canceled')
                                            Cancelado
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                        </td>
                                    </tr>

                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4">Nenhum registro encontrado.</td>
                                    </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4 px-4 sm:px-6 lg:px-8">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

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
                                            Debito/Credito</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Tipo de Evento</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                            Valor</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 overflow-visible">
                                    @if (!$gameGains->IsEmpty())
                                    @foreach ($gameGains as $gamegain)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            {{ $gamegain->id }}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($gamegain->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            {{ $gamegain->direction }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            {{ $gamegain->event_type }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                            R$ {{ number_format($gamegain->amount, 2, ',', '.') }}
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
                    {{ $gameGains->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

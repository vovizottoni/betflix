<label for="modal-{{ $row->id }}"
    class="cursor-pointer inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
    {{ $row->bonus3_nivelhierarquico ? 'Gerenciar' : 'Adicionar' }}
</label>

@if ($row->bonus3_nivelhierarquico)
    <input type="checkbox" id="modal-{{ $row->id }}" class="modal-toggle" />
    <label for="my-modal-4" class="modal cursor-pointer">
        <label class="modal-box w-fit relative grid grid-cols-2 gap-2" for="">
            <h3 class="text-lg font-bold mb-2 text-white">Ações</h3>

            <label class="btn col-span-full" for="bonus3_received-{{ $row->id }}">
                Exibir Revenue Share recebidos
            </label>
            <label class="btn col-span-full" for="inactive-rev-{{ $row->id }}">
                Desativar Revenue Share
            </label>
        </label>
        <div class="modal-action mt-1">
            <label for="modal-{{ $row->id }}" class="btn bg-danger">Fechar</label>
        </div>
    </label>
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Modal {{ $row->id }}</h3>
            <div class="modal-action">
                <label for="modal-{{ $row->id }}" class="btn">Close 1</label>
            </div>
        </div>
    </div>

    <style>
        #table-index-row-{{ $row->id }} {
            margin: 0 !important;
            width: 100% !important;
        }
    </style>

    {{-- MODAL DESATIVAR REV --}}

    <input type="checkbox" id="inactive-rev-{{ $row->id }}" class="modal-toggle z-50" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-dark-700">
                DESATIVAR BÔNUS 3 PARA O USUÁRIO
            </h3>
            <p class="py-4 text-slate-100">
                Têm certeza que desaja desativar Revenue Share para este usuário?
            </p>
            <div class="modal-action flex items-center justify-end">
                <label class="label cancel-btn cursor-pointer" for="inactive-rev-{{ $row->id }}">
                    {{ __('admin_user_index.cancel_modal_change') }}
                </label>

                <form action="{{ route('admin.bonus3.actions.desactive', $row->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="label text-white cursor-pointer">
                        DESATIVAR
                    </button>
                </form>
            </div>
        </div>
    </div>


    {{-- MODAL EXIBIR BONUS 3 RECEBIDOS --}}

    <input type="checkbox" value="1" id="bonus3_received-{{ $row->id }}" class="modal-toggle z-50" />
    <div id='modal_group' class="modal">
        <div class="modal-box min-w-[500px] md:min-w-[1500px]">
            <h3 class="text-lg font-bold mb-4 text-white" style="text-transform: uppercase">
                Histórico de Bônus 3(Bônus sobre perda/red)
            </h3>
            <div class="p-2 mt-2 bg-white rounded">
                <table id="table-index-row-{{ $row->id }}"
                    class="w-full text-sm text-left text-gray-500 min-w850 bg-white">
                    <thead class="border-b bg-neutral-50 font-medium dark:border-neutral-500 dark:text-neutral-800">
                        <tr>
                            {!! $columns->table !!}
                        </tr>
                    </thead>
                    <tbody class="border-b dark:border-neutral-500">

                    </tbody>
                </table>
            </div>

            <div class='modal-action flex items-center justify-end'>
                <label class="label text-white cursor-pointer" for="bonus3_received-{{ $row->id }}">
                    FECHAR
                </label>
            </div>
        </div>
    </div>

    <script>
        var table = $('#table-index-row-{{ $row->id }}').DataTable({
            stateSave: true,
            "dom": 'lrtip',
            orderCellsTop: true,
            scrollX: true,
            fixedHeader: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.bonus3.payment-history.data-table', $row->id) }}",
            order: [
                [0, 'desc']
            ],

            "deferRender": true,
            // "deferLoading": 10,


            columns: {!! $columns->js !!},
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
            },
        });

        setTimeout(() => {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();

            $('select[name=table-index-row-{{ $row->id }}_length]').addClass(
                'w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ml-2 mr-2 h-10'
            );

            $('div.dataTables_length').addClass('bg-gray-200 py-2 px-4 rounded-t w-full ');
            $('div.dataTables_length label').addClass('flex items-center');

            $('.filters:first > th:last').html('');

        }, 1500);
    </script>
@else
    <style>
        form.row-{{ $row->id }} .hide-select {
            display: none;
        }
    </style>

    <input type="checkbox" id="modal-{{ $row->id }}" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-dark-700">
                Adicone o Revenue Share do Usuário
            </h3>
            <p class="py-4">
                Selecione uma opção para o nivel deste este usuário.
            </p>

            <form class="row-{{ $row->id }}" action="{{ route('admin.bonus3.actions.add', $row->id) }}"
                method="POST">
                @csrf
                <div class="modal-body">

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nível
                        </label>
                        <select name="nivel"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecione uma opção:</option>
                            <option value="master">Gerente Master</option>
                            <option value="supervisor">Gerente</option>
                            <option value="gerente">Sub Gerente</option>
                            <option value="subgerente">Top Afiliado</option>
                        </select>

                    </div>

                    <div class="mt-5 hide-select supervisor">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Escolha um Gerente Master:
                        </label>
                        <select name="group_master"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecione uma opção:</option>
                            @foreach ($group_master as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mt-5 hide-select gerente">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Escolha um Gerente:
                        </label>
                        <select name="group_supervisor"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecione uma opção:</option>
                            @foreach ($group_supervisor as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mt-5 hide-select subgerente">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Escolha um Sub Gerente:
                        </label>
                        <select name="group_gerente"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecione uma opção:</option>
                            @foreach ($group_gerente as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="mt-5 hide-select master supervisor gerente subgerente">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            % de Revenue Share:
                        </label>
                        <input type="text" name="percentage"
                            class="percentage2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <p class="mt-2 text-sm hide-select master"
                            style="display: block;background: #fb8c02;padding: 5px 12px;border-radius: 5px;color: white;">
                            O percentual deve ser entre 1% e 100%.
                        </p>

                        <p class="mt-2 text-sm hide-select supervisor gerente subgerente"
                            style="display: block;background: #fb8c02;padding: 5px 12px;border-radius: 5px;color: white;">
                            O percentual deve ser entre 1% e 15%.
                        </p>
                    </div>



                </div>
                <div class='modal-action flex items-center justify-end'>
                    <label class="label cancel-btn cursor-pointer" for="modal-{{ $row->id }}">
                        {{ __('admin_user_index.cancel_modal_change') }}
                    </label>
                    <button type="submit" class="label save-btn cursor-pointer">
                        {{ __('admin_user_index.confirm_modal_change') }}
                    </button>

                </div>
            </form>
        </div>
    </div>

    <script>
        $("form.row-{{ $row->id }} select[name=nivel]").change(function() {
            let form = "form.row-{{ $row->id }}";
            let ref = "." + this.value;

            $(form + ' .hide-select').hide();
            if (this.value !== '') {
                $(form + " " + ref).show();
            }


        });
    </script>
@endif

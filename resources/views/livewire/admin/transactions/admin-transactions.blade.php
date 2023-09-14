<div>
    <link href="/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Link e scripts para select 2-------------------------------------------------------------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--------------------------------------------------------------------------------------------------------------------->

    <style>
        .dataTables_processing {
            z-index: 999999999999 !important;
            /* display: flex !important; */
            align-content: center !important;
            justify-content: center !important;
            padding: 0 !important;
            padding-top: 0px !important;
            background: rgba(30, 30, 30, 0.671) !important;
            color: white !important;
            border-radius: 5px !important;
            padding-top: 5px !important;
            margin-top: 25px !important;
            margin-bottom: 25px !important;
        }

        tr.filters {
            background: #e5e7eb !important;
        } 

        td {
            color: black !important;
        }

        table.dataTable thead th {
            border-bottom: none !important;
        }
    </style>


    <div class="page-header">
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>{{ __('admin_transactions_pagstar.deposits_and_withdrawals') }}</b>
    </div>

    <div class="p-6 pt-1">
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-4">

            <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 default-card sm:px-6 sm:py-6 ">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3 gradient-card-green">
                        <!-- Heroicon name: outline/users -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75"></path>
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Total em entradas</p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">R$
                        {{ number_format($total_in_entries, 2, ',', '.') }}</p>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 default-card sm:px-6 sm:py-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3 gradient-card-yellow">
                        <!-- Heroicon name: outline/users -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75"></path>
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Total em saídas</p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">R$
                        {{ number_format($total_in_exits, 2, ',', '.') }}</p>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 default-card sm:px-6 sm:py-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3 gradient-card-red">
                        <!-- Heroicon name: outline/users -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Estimativa de taxas pagas</p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900"> {{ number_format(($total_in_exits+$total_in_entries)*0.03, 2, ',', '.') }} </p>
                </dd>
            </div>

        </dl>

        <div class="card has-table">

            <div class="p-2">
                <table id="table-index" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 min-w850">
                    <thead class="border-b bg-neutral-50 font-medium dark:border-neutral-500 dark:text-neutral-800">
                        <tr>
                            {!! $columns->table !!}
                        </tr>
                    </thead>
                    <tbody class="border-b dark:border-neutral-500">
                    </tbody>
                </table>
            </div>

            <!-- Datatable -->
            <script src="/plugins/datatables/js/jquery.dataTables.min.js"></script>
            <script src="/js/init/datatables.init.js"></script>

            <script src="/plugins/jquery.mask.js"></script>

            <script type="text/javascript">
                $(function() {

                    $('#table-index thead tr')
                        .clone(true)
                        .addClass('filters')
                        .appendTo('#table-index thead');

                    var table = $('#table-index').DataTable({
                        // stateSave: true,
                        "dom": 'lrtip',
                        orderCellsTop: true,
                        // scrollX: true,
                        fixedHeader: true,
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('admin.transactions.pagstar.data-table') }}",
                        order: [
                            [4, 'desc']
                        ],

                        columns: {!! $columns->js !!},
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                        },

                        initComplete: function() {

                            var api = this.api();

                            api
                                // .columns()
                                .columns([0, 1, 2, 3, 4, 5])
                                .eq(0)
                                .each(function(colIdx) {

                                    var $input =
                                        "<input type='text' class='w-full h-6 rounded text-dark h-8' placeholder='Buscar' />";

                                    switch (colIdx) {
                                        case 0:
                                            var $input =
                                                "<input type='text' class='w-full h-6 rounded text-dark money h-8' placeholder='Buscar' />";
                                            break;
                                        case 2:
                                            var $input =
                                                "<select name='status' class='text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-32 h-8 p-0 pl-2'> <option value='all'>Todos</option><option value='paid'>{{ __('admin_transactions_pagstar.paid') }}</option><option value='waiting_for_payment'>{{ __('admin_transactions_pagstar.waiting_for_payment') }}</option><option value='canceled'>{{ __('admin_transactions_pagstar.canceled') }}</option><option value='drawee'>{{ __('admin_transactions_pagstar.drawee') }}</option><option value='waiting_for_withdraw'>{{ __('admin_transactions_pagstar.waiting_for_withdraw') }}</option><option value='coinGate_waiting_for_confimation'>{{ __('Aguardando confirmação') }}</option><option value='coingate_new'>{{ __('Nova') }}</option><option value='coingate_pending'>{{ __('Pendente') }}</option><option value='coingate_confirming'>{{ __('Confirmado') }}</option><option value='coingate_paid'>{{ __('Pago') }}</option><option value='coingate_invalid'>{{ __('Inválido') }}</option><option value='coingate_expired'>{{ __('Expirado') }}</option><option value='coingate_canceled'>{{ __('Cancelado') }}</option><option value='coingate_error'>{{ __('Falha') }}</option></select>";
                                            break;
                                        case 4:
                                            var $input =
                                                "<input type='text' class='w-full h-6 rounded text-dark date h-8' placeholder='Buscar' />";
                                            break;
                                        default:
                                    }

                                    var cell = $('.filters th').eq(
                                        $(api.column(colIdx).header()).index()
                                    );
                                    var title = $(cell).text();

                                    $(cell).html($input);

                                    $(
                                            'input, select',
                                            $('.filters th').eq($(api.column(colIdx).header()).index())
                                        )
                                        .on('change', function(e) {

                                            var value = this.value;

                                            $(this).attr('title', $(this).val());
                                            var regexr =
                                                '{search}';

                                            api
                                                .column(colIdx)
                                                .search(
                                                    this.value != '' ?
                                                    regexr.replace('{search}', value) :
                                                    '',
                                                    this.value != '',
                                                    this.value == ''
                                                )
                                                .draw();
                                        })
                                        .on('keyup', function(e) {
                                            e.stopPropagation();
                                            $(this).trigger('change');
                                        });
                                });
                        },
                    });

                    setTimeout(() => {
                        $($.fn.dataTable.tables(true)).DataTable()
                            .columns.adjust();

                        $('select[name=table-index_length]').addClass(
                            'w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ml-2 mr-2 h-10'
                        );

                        $('div.dataTables_length').addClass('bg-gray-200 py-2 px-4 rounded-t w-full ');
                        $('div.dataTables_length label').addClass('flex items-center');
                    }, 300);


                    $(document).on('focus', '.money', function() {
                        $(this).mask("#.##0,00", {
                            reverse: true
                        });
                    })

                    $(document).on('focus', '.cpf', function() {
                        $(this).mask('000.000.000-00', {
                            reverse: true
                        });
                    })
                    $(document).on('focus', '.date', function() {
                        $(this).mask('00/00/0000');
                    })

                });
            </script>

        </div>
    </div>
    <!-- Setando o select2 para select_user_id  e os dados para $user-->
    <script>
        $(document).ready(function() {
            $('#select_user_id').select2();
            $('#select_user_id').on('change', function(e) {
                var data = $('#select_user_id').select2("val");
                @this.set('user', data);
            });
        });
    </script>
</div>

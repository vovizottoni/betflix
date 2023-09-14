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

    <!-- Barra azul superior ----------------------------------------------------------------------------------------------------->
    <div class="page-header">

        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>Visão dos Jogos Próprios</b>
    </div>

    <!--------------------------------------------------------------------------------------------------------------->

    <div class="p-6">
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-4">

            <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 default-card sm:px-6 sm:py-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3 gradient-card-yellow">
                        <!-- Heroicon name: outline/users -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z"></path>
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Total em Apostas</p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($total_bets, 2, ',', '.') }}</p>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 default-card sm:px-6 sm:py-6 ">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3 gradient-card-red">
                        <!-- Heroicon name: outline/users -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0"></path>
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Prêmios Pagos</p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($pay_bets, 2, ',', '.') }}</p>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 default-card sm:px-6 sm:py-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3 gradient-card-green">
                        <!-- Heroicon name: outline/users -->
                        <svg  class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"></path>
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"></path>
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Lucro Bruto</p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">R$ {{ number_format($ggr['total'], 2, ',', '.') }} <span class="text-[12px]">/ {{ number_format($ggr['percentage'], 2, ',', '.') }}% GGR</span></p>
                </dd>
            </div>

        </dl>
        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
            <div class="card has-table">

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
                    // fixedHeader: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.bets.data-table') }}",
                    order: [
                        [2, 'desc']
                    ],

                    columns: {!! $columns->js !!},
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                    },


                    initComplete: function() {

                        var api = this.api();

                        api
                            // .columns()
                            .columns([0, 1, 2, 3, 4, 5, 6, 7])
                            .eq(0)
                            .each(function(colIdx) {

                                var $input =
                                    "<input type='text' class='w-full h-6 rounded text-dark h-8' placeholder='Buscar' />";

                                switch (colIdx) {
                                    case 2:
                                        $input =
                                            "<input type='text' class='w-full h-6 rounded text-dark h-8 created_at' placeholder='Buscar' />";
                                        break;
                                    case 3:
                                        $input =
                                            "<input type='text' class='w-full h-6 rounded text-dark h-8 ammount' placeholder='Buscar' />";
                                        break;
                                    case 4:
                                        $input =
                                            "<input type='text' class='w-full h-6 rounded text-dark h-8 odd' placeholder='Buscar' />";
                                        break;

                                    case 5:
                                        var $input =
                                            "<select name='result' class='text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-32 h-8 p-0 pl-2'><option value='all'>Todos</option><option value='green'>Verde</option><option value='red'>Vermelho</option><option value='canceled'>Cancelado</option><option value='pending'>Pendente</option></select>";
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

                    $('.filters:first > th:last').html('');
                }, 300);

                $(document).on('focus', '.created_at', function() {
                    $(this).mask("00/00/0000");
                })

                $(document).on('focus', '.ammount', function() {
                    $(this).mask("#.##0,00", {
                        reverse: true
                    });
                })
                $(document).on('focus', '.odd', function() {
                    $(this).mask("0.00");
                })

            });
        </script>

    </div>
</div>

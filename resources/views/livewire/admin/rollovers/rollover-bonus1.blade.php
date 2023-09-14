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
        <b>{{ __('Rollover Bonus 1') }}</b>
    </div>

    <div class="card has-table">

        <div class="p-5">
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
                    // fixedHeader: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.rollover-bonus1.data-table') }}",
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
                            .columns([0, 1, 2, 3, 5])
                            .eq(0)
                            .each(function(colIdx) {

                                var $input =
                                    "<input type='text' class='w-full h-6 rounded text-dark h-8' placeholder='Buscar' />";


                                switch (colIdx) {

                                    case 0:
                                        var $input =
                                            "<input type='text' class='w-24 h-6 rounded text-dark h-8' placeholder='Buscar' />";
                                        break;
                                        
                                    case 3:
                                        var $input =
                                            "<input type='text' class='w-full rounded text-dark h-8 money' placeholder='Buscar' />";
                                        break;

                                    case 5:
                                        var $input =
                                            "<select name='active' class='text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-32 h-8 p-0 pl-2'><option value='all'>Todos</option><option value='s'>Atingiu</option><option value='n'>Não Atingiu</option></select>";
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
                                    // .off('keyup change')
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


                    $('.filters:first > th:nth(4)').html('');
                    $('.filters:first > th:nth(5)').html('');

                }, 1000);



                $(document).on('focus', '.money', function() {
                    $(this).mask("#.##0,00", {
                        reverse: true
                    });
                })

            });
        </script>
    </div>
</div>

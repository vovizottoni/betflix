<div>

    <link href="/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Link e scripts para select 2-------------------------------------------------------------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
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
        <b>{{ __('admin_kyc.kyc_viewing_and_approval') }}</b>
    </div>

    <div class="p-6">
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-4">

            <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 default-card sm:px-6 sm:py-6 ">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3 gradient-card-green">
                        <!-- Heroicon name: outline/users -->
                        <i class="mdi mdi-account-check w-6 h-6 text-white"></i>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">KYCs Aprovados</p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">0</p>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 default-card sm:px-6 sm:py-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3 gradient-card-yellow">
                        <!-- Heroicon name: outline/users -->
                        <i class="mdi mdi-account-off w-6 h-6 text-white"></i>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">KYCs Pendentes</p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900"> 0 </p>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 default-card sm:px-6 sm:py-6">
                <dt>
                    <div class="absolute rounded-md bg-red-600 p-3 gradient-card-red">
                        <!-- Heroicon name: outline/users -->
                        <i class="mdi mdi-account-off w-6 h-6 text-white"></i>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">KYCs Recusados</p>
                </dt>
                <dd class="ml-16 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900"> 0 </p>
                </dd>
            </div>

        </dl>
        <div class="card has-table">
            <div class="">
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
                ajax: "{{ route('admin.kyc.data-table') }}",
                order: [
                    [0, 'desc']
                ],

                columnDefs: [{
                    orderable: false,
                    targets: [5]
                }, ],

                columns: {!! $columns->js !!},
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                },


                initComplete: function() {

                    var api = this.api();

                    api
                        // .columns()
                        .columns([0, 1, 2, 3, 4])
                        .eq(0)
                        .each(function(colIdx) {

                            var $input =
                                "<input type='text' class='w-full h-6 rounded text-dark h-8' placeholder='Buscar' />";


                            switch (colIdx) {
                                case 2:
                                    var $input =
                                        "<select name='status' class='text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-32 h-8 p-0 pl-2'> <option value='all'>Todos</option><option value='under_verification'>{{ __('admin_kyc.under_verification') }}</option><option value='verified'>{{ __('admin_kyc.verified') }}</option><option value='failed_verification'>{{ __('admin_kyc.failed_verification') }}</option></select>";
                                    break;

                                case 3:
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

                $('.filters:first > th:last').html('');
            }, 300);

            $(document).on('focus', '.date', function() {
                $(this).mask('00/00/0000');
            })

        });
    </script>
</div>

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
            background: #e5e2e2 !important;
        }

        td {
            color: black !important;
        }
    </style>

    <div class="page-header">
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>{{ __('Depósitos CoinGate') }}</b>
    </div>

    <div class="p-6 pt-1">
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
                    var table = $('#table-index').DataTable({
                        // stateSave: true,
                        "dom": 'lrtip',
                        orderCellsTop: true,
                        // scrollX: true,
                        fixedHeader: true,
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('admin.transactions.coingate.data-table') }}",
                        order: [
                            [0, 'desc']
                        ],

                        columns: {!! $columns->js !!},
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                        },

                    });
                });
            </script>

        </div>
    </div>
</div>

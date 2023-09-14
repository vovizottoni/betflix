<div class="max-w-7xl mx-auto">


    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8 relative" style="z-index: 1;">
        <div class="grid lg:grid-cols-2 gap-4">
            <div>
                <h1 class="text-white text-xl lg:text-3xl font-bold">
                    Extrato de Bônus</h1>

            </div>
        </div>
    </div>

    <style type="text/css">
        .dataTables_length,
        #table-index_filter {
            display: none;
        }

        td.dataTables_empty {
            text-align: center;
            padding: 30px 0;
            font-weight: 300;
        }

        th {
            color: #ffffffbd;
            font-size: 14px;
            font-weight: 500;
            padding-bottom: 15px;
            border-bottom: 1px solid #ffffff29;
        }

        td {
            border-bottom: 1px solid #ffffff29;
        }

        div#table-index_info {
            font-size: 10px;
            text-align: center;
            margin-top: 10px;
            opacity: 0.6;
        }

        a#table-index_previous {
            background: #ffffff21;
            margin: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
        }

        a#table-index_next {
            background: #ffffff21;
            margin: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
        }

        .disabled {
            cursor: not-allowed;
        }

        div#table-index_paginate {
            margin: 0 auto;
            text-align: center;
            padding-top: 20px;
        }
    </style>

    <div class="tabs mb-16 mx-auto sm:px-6 lg:px-8 mt-10">

            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.myinvitations') }}">
                {{__("invitations.overview")}}
            </a>

            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.myaffiliates') }}">
                Meus convidados
            </a>

            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.show-heirarchy') }}">
                Meus afiliados
            </a>
            @if (Auth::user()->bonus3_nivelhierarquico == 'master' || Auth::user()->bonus3_nivelhierarquico == 'supervisor' || Auth::user()->bonus3_nivelhierarquico == 'gerente' || Auth::user()->bonus3_nivelhierarquico == 'subgerente' )
            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.myaffiliatesxray') }}">
                Dashboard
            </a>
            <a class="tab tab-lg tab-bordered transition-all tab-active" style="color: #fff !important;" href="{{url('player/mybonus')}}">
                    Extrato
                </a>
            @endif
    </div>

    <style type="text/css">
            .bg-section {
            width: 100%;
            min-height: 100vh;
            }
            .bg-section:after {
            z-index: -999;
            content: '';
            background: url("{{asset('/assets/images/backgrounds/referrer.png')}}");
            background-size: cover; width: 100%; height: 100%; position: absolute; top:0; right: 0;
            }

            .referrer-promo-card {
                background: url('https://img.freepik.com/free-vector/realistic-casino-background_52683-7265.jpg?w=2000&t=st=1669412028~exp=1669412628~hmac=977320626d56c2ea7659441f0ce8c4fb600f4e1ace549ee6b93649d2cc73246c');
                background-size: cover;
                background-position: 50%;
                height: 300px;
                filter: hue-rotate(5deg);
                margin-top: 40px !important;
            }

            .nav-active {
                border-bottom: 3px solid red;
                padding-bottom: 13px;
            }

            .card {
                background: #00000038;
                width: 100%;
                padding: 40px;
            }

            a.block.bg-dark-800:hover {
                background: #101010b5 !important;
            }

            .bg-dark-700 {
                background: #10101085 !important;
            }


            .bg-dark-500 {
                background: #ffffff1a !important;
            }
        </style>
        <style type="text/css">
        .card {
            background: #00000038;
            width: 100%;
            padding: 10px;
        }
        .card-bg-2{
            background: #312f2f38;
        }
        a.block.bg-dark-800:hover {
            background: #101010b5 !important;
        }
        .bg-dark-700 {
            background: #10101085 !important;
        }
        .bg-dark-500 {
            background: #ffffff1a !important;
        }
        .icons{
            background: linear-gradient(45deg, #dc1b27, #dc1b2785);
            width: 50px;
            height: 50px;
            padding: 10px;
            border-radius: 5px;
        }
    </style>


    <div class="max-w-7xl mx-auto px-6">

            <!--
                TILES:

                    Total em depósitos
                    Total recebido:

            -->

        <table id="table-index" class="w-full min-w850">
            <thead class="border-b">
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

<script type="text/javascript">
    $(function() {
        var table = $('#table-index').DataTable({
            // "pageLength": 25,
            // stateSave: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('player.mybonus.data-table') }}",
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
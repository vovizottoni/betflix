<div>
    <!-- Link e scripts para select 2-------------------------------------------------------------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--------------------------------------------------------------------------------------------------------------------->

        <style>
            input.select2-search__field {
                font-size: 17px !important;
                padding: 13px 20px;
                color: #fff !important;
                border-radius: 4px !important;
                background: #2e2e2e;
                height: 52px;
                border: 1px solid #ffffff0d !important;
            }

            .flag-text {
                margin-left: 10px;
                font-weight: 300 !important;
                font-size: 16px;
                opacity: 0.8;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 26px;
                position: absolute;
                top: 15px;
                right: 10px;
                width: 30px;
            }

            .select2 {
                width: 100% !important;
            }

            .select2-container {
                font-size: 17px !important;
                margin-top: 5px !important;
                padding: 13px 20px !important;
                color: #fff !important;
                border-radius: 4px !important;
                background-color: #2e2e2e !important;
                border-color: #2e2e2e !important;
            }

            .select2-selection__rendered {
                color: #929292 !important;
                opacity: 1;
                /* Firefox */
            }

            .select2-search__field {
                color: black;
            }

            .select2-search__field::placeholder {
                color: black;
            }


            .select2-container--default .select2-selection--single {

                background-color: transparent !important;
                border: unset !important;
                border-radius: unset !important;

            }

            .select2-results__option {
                background-color: #1a1817 !important;
                border-color: #2e2e2e !important;
            }

            /* scrool bar */
            /* Nao funciona, nao estiliza a scroolbar do select2
            .select2-results__option{
                scrollbar-color: red yellow !important;
            }
            */


            .select2-dropdown {
                border: 0px !important;
            }

            .select2-dropdown {
                background-color: #1a1817 !important;
                border: 0px !important;
                border-radius: 4px !important;
            }

            .select2-container .select2-selection--single .select2-selection__rendered {
                padding: 0px !important;
            }
            /* BUGANDO O SELECT2 NÃO ATIVAR */

            .select2-container {
                display: grid !important;
            }

            .flag-icon.flag-icon-squared {
                width: 1.3em !important;
                height: 1.3em !important;
                border-radius: 3px !important;
                border: 2px solid #fff !important;
            }

            ul#select2-country-gh-results {
                padding: 15px !important;
            }
        </style>

        <style type="text/css">
            .bg-section {
                width: 100%;
                min-height: 100vh;
            }

            .nav-active {
                border-bottom: 3px solid red;
                padding-bottom: 13px;
            }

            .card {
                background: #00000038;
                width: 100%;
                padding: 10px;
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

    <div class="tabs mb-16 mx-auto sm:px-6 lg:px-8 mt-10">

            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.myinvitations') }}">
                {{__("invitations.overview")}}
            </a>
            <a class="tab tab-lg tab-bordered transition-all " style="color: #fff !important;" href="{{ route('player.myaffiliates') }}">
                Meus indicados
            </a>
            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.show-heirarchy') }}">
                Meus afiliados
            </a>

            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.myaffiliatesxray') }}">
                Relatório Raio X
            </a>

            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.balance-affiliates') }}">
                Wallet
            </a>

            {{-- <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;">
                Materiais
            </a> --}}
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if ($my_heirarchy == 'master')
        <div class="max-w-7xl mx-auto mt-4 relative">
            <div class="block w-full">
                <div tabindex="0" class="dropdown-content rounded-md card-compact w-full p-2 shadow mt-4"
                    style="background: #ffffff0d;">
                    <label class="label" for="label flex items-center justify-start">
                        Escolha o Gerente
                    </label>
                    <select wire:model='group_supervisor_select' id="select_supervisor"
                        class="select w-full max-w-xs custom-select-2" name="">
                        <option value="">Clique para selecionar o Gerente</option>
                        @foreach ($group_supervisor as $name_supervisor)
                            <option value="{{$name_supervisor->id}}">{{$name_supervisor->name}}</option>
                        @endforeach
                    </select>
                </div>

                @if ($group_supervisor_select)

                <div tabindex="0" class="dropdown-content rounded-md card-compact w-full p-2 shadow mt-4"
                    style="backdrop-filter: blur(10px); background: #000000c4;">
                    <label class="label" for="label flex items-center justify-start">
                        Escolha o Gerente
                    </label>
                    <select wire:model='gerente_tree' id="select_gerente_tree"
                        class="select w-full max-w-xs custom-select-2" name="">
                        <option value="">Clique para selecionar o Gerente</option>
                        @foreach ($gerente_detail as $gerente)
                        <option value="{{$gerente->id}}">{{$gerente->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if ($gerente_tree)

                <div tabindex="0" class="dropdown-content rounded-md card-compact w-full p-2 shadow mt-4"
                    style="backdrop-filter: blur(10px); background: #000000c4;">
                    <label class="label" for="label flex items-center justify-start">
                        Escolha o Gerente
                    </label>
                    <select wire:model='subgerente_tree' id="select_subgerente_tree"
                        class="select w-full max-w-xs custom-select-2" name="">
                        <option value="">Clique para selecionar o Gente</option>
                        @foreach ($subgerente_detail as $subgerente)
                        <option value="{{$subgerente->id}}">{{$subgerente->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

            </div>
        </div>

        @endif


        @if ($my_heirarchy == 'supervisor')
        <div class="max-w-7xl mx-auto mt-4 relative">
            <div class="hidden xl:block w-full justify-between items-center max-w-full">
                <div tabindex="0" class="dropdown-content rounded-md card-compact w-full p-2 shadow mt-4"
                    style="backdrop-filter: blur(10px); background: #000000c4;">
                    <label class="label" for="label flex items-center justify-start">
                        Escolha o Gerente
                    </label>
                    <select wire:model='group_gerente_select' id="select_gerente"
                        class="select w-full max-w-xs custom-select-2" name="">
                        <option value="">Clique para selecionar o Gerente</option>
                        @foreach ($group_gerente as $name_gerente)
                        <option value="{{$name_gerente->id}}">{{$name_gerente->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($group_gerente_select)

            <div tabindex="0" class="dropdown-content rounded-md card-compact w-full p-2 shadow mt-4"
                style="backdrop-filter: blur(10px); background: #000000c4;">
                <label class="label" for="label flex items-center justify-start">
                    Escolha o Gerente
                </label>
                <select wire:model='subgerente_tree' id="select_subgerente_tree"
                    class="select w-full max-w-xs custom-select-2" name="">
                    <option value="">Clique para selecionar o Gerente</option>
                    @foreach ($subgerente_detail as $subgerente)
                    <option value="{{$subgerente->id}}">{{$subgerente->name}}</option>
                    @endforeach
                </select>
            </div>
            @endif

        </div>
        @endif


        @if ($my_heirarchy == 'gerente')
        <div class="max-w-7xl mx-auto mt-4 relative">
            <div class="hidden xl:block w-full justify-between items-center max-w-full">
                <div tabindex="0" class="dropdown-content rounded-md card-compact w-full p-2 shadow mt-4"
                    style="backdrop-filter: blur(10px); background: #000000c4;">
                    <label class="label" for="label flex items-center justify-start">
                        Escolha o Gerente
                    </label>
                    <select wire:model='group_subgerente_select' id="select_subgerente"
                        class="select w-full max-w-xs custom-select-2" name="">
                        <option value="">Clique para selecionar o Gerente</option>
                        @foreach ($group_subgerente as $name_subgerente)
                        <option value="{{$name_subgerente->id}}">{{$name_subgerente->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endif
        <div class="max-w-7xl mx-auto mt-12 relative" style="z-index: 1;">
            <div class="overflow-hidden bg-dark-700 shadow sm:rounded-md">
                <ul id="last_record" role="list" class="">

                    <div wire:loading.delay.shorter class="w-full">
                        <div class="loading ml-auto mr-auto mb-4 mt-12"></div>
                    </div>
                    @if ($my_heirarchy == 'subgerente')
                    <p class="text-center py-12 font-bold opacity-50">{{ __('show_heirarchy.invalid_bonus3') }}
                    </p>
                    @endif
                    @if ($affiliates->isEmpty() && ($my_heirarchy <> 'subgerente'))
                        <p class="text-center py-12 font-bold opacity-50">{{ __('bets.no_records_matching') }}
                        </p>

                        @else
                        @foreach ($affiliates as $affiliate__)
                        @php
                        $supervisor = '';
                        if(!empty($affiliate__->bonus3_superiorhierarquico_user_id))
                        {
                        $name_to_superior = DB::table('users')->where('id', '=',
                        $affiliate__->bonus3_superiorhierarquico_user_id)->first();
                        $supervisor = $name_to_superior->name;
                        }

                        if(!empty($affiliate__->id))
                        {
                        //encotra a primeira conta do user, onde é gerado o pagamento
                        $conta_recebe = DB::table('accounts')->where('users_id', '=',Auth::user()->id)->first();
                        $beneficiado = $conta_recebe->id;
                        $bonus_gerado = DB::table('bonus')->where('accounts_id','=', $beneficiado)->where('users_id_gerador_do_bonus', '=',
                        $affiliate__->id)->sum('amount');


                        $supervisor = $name_to_superior->name;
                        }
                        @endphp
                        <li style="border-bottom: 1px solid #ffffff08;">
                            <div class="block bg-[#0E1830]">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="">
                                        <div class="px-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                                            <div class="flex gap-4">
                                                <div class="h-12 w-12 rounded-full">
                                                    <img src="<?=getBaseDomain()?>/assets/images/avatars/avatar-1.jpeg">
                                                </div>
                                                <div>
                                                    <p class="text-white font-bold">{{ $affiliate__->name }} </p>
                                                    <p class="flex items-center text-sm text-gray-500 capitalize">{{ $affiliate__->my_invite_code }}</p>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div>
                                                    <p class="flex items-center text-gray-400"><svg class="mr-1.5 h-4 w-4 flex-shrink-0 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"></path> </svg> {{ date('d/m/Y',
                                                        strtotime($affiliate__->created_at)) }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-500 text-sm">{{ __('show_heirarchy.country') }}: {{ $affiliate__->country }}</p>
                                                </div>
                                            </div>
                                            <!--
                                            <div class="flex-1">
                                                <p class="text-white font-bold">{{$supervisor}}</p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500">Superior</p>
                                            </div>
                                            -->
                                            {{-- <div class="flex-1">
                                                <p class="text-white font-bold">{{number_format($bonus_gerado, 2, ',', '.')}}</p>
                                                <p class="flex items-center text-sm text-gray-500">Comissão gerada</p>
                                            </div> --}}
                                            <div class="flex-1">
                                                <p class="flex items-center text-2xl font-bold text-white" style="transform: skew(-4deg);">
                                                    {{$affiliate__->bonus3_percentual}}%
                                                </p>
                                                <p class="flex items-center text-sm text-gray-500">Comissão repassada</p>
                                            </div>

                                            <div class="flex-1">
                                                <p class="flex items-center text-xl text-white" style="transform: skew(-4deg);">
                                                    {{ $this->getGroupUser($affiliate__->group_id) }}
                                                </p>
                                                <p class="flex items-center text-sm text-gray-500">Grupo CPA</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        <br>

                        @if($count_affiliates >= $amount)
                        <div>
                            <button class="text-center btn gap-2 bg-base-700" wire:click='laodMore()'>

                                {{__('bets.load_more') }}</button>
                        </div>
                        @else
                            <p class="text-center py-12 font-bold opacity-50">{{ __('bets.end_search') }}
                            </p>
                        @endif

                    @endif
                </ul>
            </div>
        </div>
    </div>
    <script>
            $(document).ready(function() {
                $('#select_supervisor').select2();
                $('#select_supervisor').on('change', function (e) {
                    var data = $('#select_supervisor').select2("val");

                  // alert(data);

                    @this.set('group_supervisor_select', data);
                });
              });

              $(document).ready(function() {
                $('#select_gerente_tree').select2();
                $('#select_gerente_tree').on('change', function (e) {
                    var data = $('#select_gerente_tree').select2("val");

                  // alert(data);

                    @this.set('gerente_tree', data);
                });
              });


              $(document).ready(function() {
                $('#select_subgerente_tree').select2();
                $('#select_subgerente_tree').on('change', function (e) {
                    var data = $('#select_subgerente_tree').select2("val");

                  // alert(data);

                    @this.set('subgerente_tree', data);
                });
              });



              $(document).ready(function() {
                $('#select_gerente').select2();
                $('#select_gerente').on('change', function (e) {
                    var data = $('#select_gerente').select2("val");

                  // alert(data);

                    @this.set('group_gerente_select', data);
                });
              });


              $(document).ready(function() {
                $('#select_subgerente').select2();
                $('#select_subgerente').on('change', function (e) {
                    var data = $('#select_subgerente').select2("val");

                  // alert(data);

                    @this.set('group_subgerente_select', data);
                });
              });



            //##################################################################################################################################################################################################################
            //##################################################################################################################################################################################################################
            //o momento callback dehydrate() é executando sempre apos um render e ele dispara o contentChanged para dar um refresh no JS
            document.addEventListener('contentChanged', function(e) {



              $(document).ready(function() {
                $('#select_supervisor').select2();
                $('#select_supervisor').on('change', function (e) {
                    var data = $('#select_supervisor').select2("val");

                  // alert(data);

                    @this.set('group_supervisor_select', data);
                });
              });

              $(document).ready(function() {
                $('#select_gerente_tree').select2();
                $('#select_gerente_tree').on('change', function (e) {
                    var data = $('#select_gerente_tree').select2("val");

                  // alert(data);

                    @this.set('gerente_tree', data);
                });
              });


              $(document).ready(function() {
                $('#select_subgerente_tree').select2();
                $('#select_subgerente_tree').on('change', function (e) {
                    var data = $('#select_subgerente_tree').select2("val");

                  // alert(data);

                    @this.set('subgerente_tree', data);
                });
              });

              $(document).ready(function() {
                $('#select_gerente').select2();
                $('#select_gerente').on('change', function (e) {
                    var data = $('#select_gerente').select2("val");

                  // alert(data);

                    @this.set('group_gerente_select', data);
                });
              });

              $(document).ready(function() {
                $('#select_subgerente').select2();
                $('#select_subgerente').on('change', function (e) {
                    var data = $('#select_subgerente').select2("val");

                  // alert(data);

                    @this.set('group_subgerente_select', data);
                });
              });


            });
            //##################################################################################################################################################################################################################
            //##################################################################################################################################################################################################################

    </script>
</div>

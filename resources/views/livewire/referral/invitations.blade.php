<div>
    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8 relative" style="z-index: 1;">
        <div class="grid lg:grid-cols-2 gap-4">
            <div>
                <h1 class="text-white text-xl lg:text-3xl font-bold">
                    Visão Geral</h1>

            </div>
        </div>
    </div>

    <div class="tabs mb-16 mx-auto sm:px-6 lg:px-8 mt-10">

        <a class="tab tab-lg tab-bordered transition-all tab-active" style="color: #fff !important;" href="{{ route('player.myinvitations') }}">
            {{__("invitations.overview")}}
        </a>

        <a class="tab tab-lg tab-bordered transition-all " style="color: #fff !important;" href="{{ route('player.myaffiliates') }}">
            Meus indicados
        </a>

        <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.show-heirarchy') }}">
            Meus afiliados
        </a>
        
        @if (Auth::user()->bonus3_nivelhierarquico == 'master' || Auth::user()->bonus3_nivelhierarquico == 'supervisor' || Auth::user()->bonus3_nivelhierarquico == 'gerente' || Auth::user()->bonus3_nivelhierarquico == 'subgerente' )
        <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{ route('player.myaffiliatesxray') }}">
            Dashboard
        </a>
        <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{url('player/mybonus')}}">
            Extrato
        </a>
    </div>

    @endif

    {{-- <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;">
        Materiais
    </a> --}}


    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8 relative mt-20" style="z-index: 1;">
        <div class="grid md:grid-cols-3 md:gap-8">
            <div class="col-span-1">

                <div class="box-card">

                    <h5 class="font-bold text-white">{{__("invitations.invite_and_win")}}</h5>
                    <p style="
                        margin-top: 20px;
                        font-size: 14px;
                        opacity: 0.8;
                    ">{{__("invitations.receive_lifetime_commissions")}}</p>


                    <h5 class="font-bold text-white mt-12">Convide por link:</h5>

                    <input type="hidden" id="referrer_id" value="{{ url('/').'/affiliate/'.Auth::user()->my_invite_code }}">
                    <button type="button" data-clipboard-target="#referrer_id" id="copy-referrer" class="flex gap-2" style="
                        margin-top: 10px;
                        font-size: 13px;
                        text-transform: lowercase;
                        word-break: break-all;
                        text-align: left;
                    ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#29b562" style="max-width: 20px; min-width: 20px; max-height: 20px; min-height: 20px;"> <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" /> </svg> {{ url('/').'/affiliate/'.Auth::user()->my_invite_code }}</button>



                    <h5 class="font-bold text-white mt-6">Convide por código:</h5>
                    <input type="hidden" id="referrer_id_code" value="{{ Auth::user()->my_invite_code }}">
                    <button type="button" data-clipboard-target="#referrer_id_code" id="copy-referrer-code" class="flex gap-2" style="
                        margin-top: 10px;
                        font-size: 13px;
                        text-transform: lowercase;
                        word-break: break-all;
                        text-align: left;
                    "><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#29b562" style="max-width: 20px; min-width: 20px; max-height: 20px; min-height: 20px;"> <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" /> </svg> {{ Auth::user()->my_invite_code }}</button>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
                    <script>

                        document.getElementById('copy-referrer').onclick = function copyToClipboard() {
                        var copiado = $("#referrer_id").val();
                        navigator.clipboard.writeText(copiado);
                        }

                        tippy('#copy-referrer', {
                        content: 'Link copiado!',
                        trigger: 'click',
                        });


                        document.getElementById('copy-referrer-code').onclick = function copyToClipboard() {
                        var copiado = $("#referrer_id_code").val();
                        navigator.clipboard.writeText(copiado);
                        }


                        tippy('#copy-referrer-code', {
                        content: 'Código copiado!',
                        trigger: 'click',
                        });
                    </script>
                    <style type="text/css">
                        .tippy-box {
                        background: #aee958 !important;
                        color: #000 !important;
                        font-weight: 800;
                        }

                        .tippy-arrow {
                            color: #aee958 !important;
                        }

                        .payment-notdisplay {
                        display: none;
                        }
                    </style>


                    <div class="referrer-data-counter block md:hidden">
                        <div class="referrer-data-counter">
                            @if (Auth::user()->bonus3_nivelhierarquico == 'master' || Auth::user()->bonus3_nivelhierarquico == 'supervisor' || Auth::user()->bonus3_nivelhierarquico == 'gerente' || Auth::user()->bonus3_nivelhierarquico == 'subgerente' )
                            <div class="grid grid-cols-1">
                                <div>
                                    <div class="grid md:grid-cols-6 gap-6 mb-16" style="margin-top: 20px;">
                                        <div class="col-span-3">
                                            <h4 class="text-2xl font-bold text-white">{{ $myReferrals }}</h4>
                                            <p class="text-sm text-white text-opacity-70">{{__("invitations.invited_guests")}}</p>
                                        </div>

                                        <div class="col-span-3">
                                            @if (Auth::user()->bonus3_nivelhierarquico == 'master')
                                                <h3 class="text-2xl font-bold text-white">Gerente Master</h3>
                                                <p class="text-sm text-white text-opacity-70">{{ __('show_heirarchy.my_heirarchy') }}</p>
                                            @else
                                                <h3 class="text-2xl font-bold text-white">Gerente</h3>
                                                <p class="text-sm text-white text-opacity-70">{{ __('show_heirarchy.my_heirarchy') }}</p>
                                            @endif
                                        </div>

                                        <div class="col-span-3">
                                            <h3 class="text-2xl font-bold text-white">{{ $my_percent }}%</h3>
                                            <p class="text-sm text-white text-opacity-70">Meu % Revenue Share (NGR)</p>
                                        </div>

                                        <div class="col-span-3">
                                            @if (Auth::user()->group_id == '1000' || Auth::user()->group_id == '1' || Auth::user()->group_id == '4')
                                            <h3 class="text-2xl font-bold text-white">50%</h3>
                                            @elseif (Auth::user()->group_id == '1001')
                                            <h3 class="text-2xl font-bold text-white">60%</h3>
                                            @elseif (Auth::user()->group_id == '1002')
                                            <h3 class="text-2xl font-bold text-white">70%</h3>
                                            @elseif (Auth::user()->group_id == '1003')
                                            <h3 class="text-2xl font-bold text-white">80%</h3>
                                            @elseif (Auth::user()->group_id == '1004')
                                            <h3 class="text-2xl font-bold text-white">90%</h3>
                                            @elseif (Auth::user()->group_id == '1005')
                                            <h3 class="text-2xl font-bold text-white">100%</h3>
                                            @endif
                                            <p class="text-sm text-white text-opacity-70">Minha Oferta CPA</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @else
                            <h4 class="text-2xl font-bold text-white">{{ $myReferrals }}</h4>
                            <p class="text-sm text-white text-opacity-70">{{__("invitations.invited_guests")}}</p>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-span-2 hidden md:block">
                <div class="referrer-data-counter">
                    <h5 class="font-bold text-white" style="margin-top: 40px; display: none;">{{__("invitations.your_account_statistics")}}</h5>
                    <div class="grid gap-4 md:grid-cols-3" >
                        <div class="tile gap-4">
                            <div class="flex align-center" style="align-items: center;">
                                <svg style="color: #a3a3a3" fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold text-white">{{$myReferrals}}</h4>
                                <p class="text-sm opacity-80">{{__("invitations.invited_guests")}}</p>
                            </div>
                        </div>

                        @if (Auth::user()->bonus3_nivelhierarquico == 'master' || Auth::user()->bonus3_nivelhierarquico == 'supervisor' || Auth::user()->bonus3_nivelhierarquico == 'gerente' || Auth::user()->bonus3_nivelhierarquico == 'subgerente' )
                        <div class="tile gap-4">
                            <div class="flex align-center" style="align-items: center;">
                                <svg style="color: #ffcb00" fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white capitalize">{{ $my_heirarchy }}</h3>
                                <p class="text-sm opacity-80">{{ __('show_heirarchy.my_heirarchy') }}</p>
                            </div>
                        </div>
                        <div class="tile gap-4">
                            <div class="flex align-center" style="align-items: center;">
                                <svg style="color: #0cb7d0" fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">{{ $my_percent }}%</h3>
                                <p class="text-sm opacity-80">% Rev. Share</p>
                            </div>

                        </div>
                        @endif
                    </div>

                    @if (Auth::user()->bonus3_nivelhierarquico == 'master' || Auth::user()->bonus3_nivelhierarquico == 'supervisor' || Auth::user()->bonus3_nivelhierarquico == 'gerente' || Auth::user()->bonus3_nivelhierarquico == 'subgerente' )
                    <div class="grid gap-4 md:grid-cols-3" style="margin-top: 20px;">
                        <div class="tile gap-4">
                            <div class="flex align-center" style="align-items: center;">
                                <svg style="color: #ff5656;" fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold text-white" style="align-items: center;">R$ {{ number_format(($perdas_dos_players__HYPETECH+$perdas_dos_players__NUX)*0.75, 2 , ',', '.') }}</h4>
                                <p class="text-sm opacity-80">Perda dos Players</p>
                            </div>
                        </div>
                        <div class="tile gap-4">
                            <div class="flex align-center" style="align-items: center;">
                                <svg style="color: #5dff56;" fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white capitalize">R$ {{ number_format(($ganho_dos_players__HYPETECH+$ganho_dos_players__NUX)*0.75, 2 , ',', '.') }}</h3>
                                <p class="text-sm opacity-80">Ganho dos Players</p>
                            </div>
                        </div>

                        <div class="tile gap-4">
                            <div class="flex align-center" style="align-items: center;">
                                <svg style="color: #c0ff56;" fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">R$ {{ number_format(($GGR*$my_percent/100)*0.75, 2,',','.') }}</h3>
                                <p class="text-sm opacity-80">Estimativa do ciclo</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>

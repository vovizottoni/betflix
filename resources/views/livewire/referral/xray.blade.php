
<div class="max-w-7xl mx-auto">


    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8 relative" style="z-index: 1;">
        <div class="grid lg:grid-cols-2 gap-4">
            <div>
                <h1 class="text-white text-xl lg:text-3xl font-bold">
                    Dashboard</h1>

            </div>
        </div>
    </div>

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
            <a class="tab tab-lg tab-bordered transition-all tab-active" style="color: #fff !important;" href="{{ route('player.myaffiliatesxray') }}">
                Dashboard
            </a>
            <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" href="{{url('player/mybonus')}}">
                    Extrato
                </a>
            @endif
    </div>

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

        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div class="col-span-12 lg:col-span-8">
                <div class="flex flex-col sm:flex-row sm:space-x-7">
                    <div class="mt-4 flex shrink-0 flex-col items-center sm:items-start">
                        <div class="mt-4">
                            <div class="flex items-center space-x-1">
                                <p class="text-3xl mx-auto md:mx-0 font-semibold text-gray-200">
                                    @if($RevenueShareTotal >= '0')
                                    {{ 'R$ '.number_format((($RevenueShareTotal*0.6)+$CpaTotal), 2, ',', '.') }}
                                    @else
                                    {{ 'R$ '.number_format((($RevenueShareTotal*1.4)+$CpaTotal), 2, ',', '.') }}
                                    @endif
                                </p>
                            </div>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                faturamento total bruto
                            </p>
                        </div>
                        <div class="mt-3 flex items-center space-x-2">
                            <div class="ax-transparent-gridline w-28">
                                <div style="min-height: 60px;">
                                    <div style="width: 112px; height: 60px;">
                                        <svg id="SvgjsSvg2419" width="112" height="60" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable hovering-zoom" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                            <g id="SvgjsG2421" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 10)">
                                                <defs id="SvgjsDefs2420">
                                                    <clipPath id="gridRectMask7gee0ax4i">
                                                        <rect id="SvgjsRect2426" width="119" height="48" x="-3.5" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="forecastMask7gee0ax4i"></clipPath>
                                                    <clipPath id="nonForecastMask7gee0ax4i"></clipPath>
                                                    <clipPath id="gridRectMarkerMask7gee0ax4i">
                                                        <rect id="SvgjsRect2427" width="116" height="49" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <line id="SvgjsLine2425" x1="-0.5" y1="0" x2="-0.5" y2="45" stroke="#ffffff1a" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="-0.5" y="0" width="1" height="45" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                                <g id="SvgjsG2445" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                    <g id="SvgjsG2446" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                                </g>
                                                <g id="SvgjsG2433" class="apexcharts-grid">
                                                    <g id="SvgjsG2435" class="apexcharts-gridlines-vertical"></g>
                                                    <line id="SvgjsLine2444" x1="0" y1="45" x2="112" y2="45" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                                    <line id="SvgjsLine2443" x1="0" y1="1" x2="0" y2="45" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                                </g>
                                                <g id="SvgjsG2428" class="apexcharts-line-series apexcharts-plot-series">
                                                    <g id="SvgjsG2429" class="apexcharts-series" seriesName="Sales" data:longestSeries="true" rel="1" data:realIndex="0">
                                                        <path id="SvgjsPath2432" d="M 0 15.57C 7.839999999999999 15.57 14.559999999999999 8.100000000000001 22.4 8.100000000000001C 30.24 8.100000000000001 36.96 40.41 44.8 40.41C 52.64 40.41 59.36 20.7 67.2 20.7C 75.03999999999999 20.7 81.75999999999999 38.07 89.6 38.07C 97.44 38.07 104.16 17.369999999999997 112 17.369999999999997" fill="none" fill-opacity="1" stroke="rgba(68,103,239,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMask7gee0ax4i)" pathTo="M 0 15.57C 7.839999999999999 15.57 14.559999999999999 8.100000000000001 22.4 8.100000000000001C 30.24 8.100000000000001 36.96 40.41 44.8 40.41C 52.64 40.41 59.36 20.7 67.2 20.7C 75.03999999999999 20.7 81.75999999999999 38.07 89.6 38.07C 97.44 38.07 104.16 17.369999999999997 112 17.369999999999997" pathFrom="M -1 45 L -1 45 L 22.4 45 L 44.8 45 L 67.2 45 L 89.6 45 L 112 45" fill-rule="evenodd"></path>
                                                        <g id="SvgjsG2430" class="apexcharts-series-markers-wrap" data:realIndex="0">
                                                            <g class="apexcharts-series-markers">
                                                                <circle id="SvgjsCircle2459" r="0" cx="0" cy="15.57" class="apexcharts-marker w157e1v2r no-pointer-events" stroke="#ffffff" fill="#4467ef" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG2431" class="apexcharts-datalabels" data:realIndex="0"></g>
                                                </g>
                                                <line id="SvgjsLine2454" x1="0" y1="0" x2="112" y2="0" stroke="#ffffff1a" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine2455" x1="0" y1="0" x2="112" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                                <g id="SvgjsG2456" class="apexcharts-yaxis-annotations"></g>
                                                <g id="SvgjsG2457" class="apexcharts-xaxis-annotations"></g>
                                                <g id="SvgjsG2458" class="apexcharts-point-annotations"></g>
                                                <rect id="SvgjsRect2460" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect>
                                                <rect id="SvgjsRect2461" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect>
                                            </g>
                                            <rect id="SvgjsRect2424" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                            <g id="SvgjsG2453" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                                            <g id="SvgjsG2422" class="apexcharts-annotations"></g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- @foreach ($bar_green as $item)
                        {{ $item->mes_ano }} - {{ $item->total }}
                    @endforeach --}}

                    <div class="ax-transparent-gridline grid w-full grid-cols-1">
                       <canvas id="vendaPorEstado"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2">

                    <div class="rounded-sm card-bg p-4">
                        <div class="flex gap-1 justify-between space-x-1">
                            <div>
                                <p class="text-xl font-semibold text-gray-200">
                                    {{ 'R$ '.number_format($CpaPaid, 2, ',', '.') }}
                                </p>
                                <p class="mt-1 text-xs text-white text-opacity-70">CPA Pago</p>
                            </div>
                            <div style="width:80px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="background: linear-gradient(70deg,#31bc69 -8%,#089e4e 96%); float: right; width: 40px; height: 40px;" class="primary-icon icons" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-sm card-bg p-4">
                        <div class="flex gap-1 justify-between space-x-1">
                            <div>
                                <p class="text-xl font-semibold text-gray-200">
                                    {{ 'R$ '.number_format($CpaOpened, 2, ',', '.') }}
                                </p>
                                <p class="mt-1 text-xs text-white text-opacity-70">CPA à receber</p>
                            </div>
                            <div style="width:80px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="background: linear-gradient(70deg,#31bc69 -8%,#089e4e 96%); float: right; width: 40px; height: 40px;"  class="primary-icon icons" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-sm card-bg p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-xl font-semibold text-gray-200">
                                    @if($RevenueShareTotal >= '0')
                                    {{ 'R$ '.number_format($RevenueSharePaid*0.6, 2, ',', '.') }}
                                    @else
                                    {{ 'R$ '.number_format($RevenueSharePaid*1.4, 2, ',', '.') }}
                                    @endif
                                </p>
                                <p class="mt-1 text-xs text-white text-opacity-70">Revenue share Pago</p>
                            </div>
                            <div style="width:80px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="background: linear-gradient(70deg,#31bc69 -8%,#089e4e 96%); float: right; width: 40px; height: 40px;" class="primary-icon icons" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-sm card-bg p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-xl font-semibold text-gray-200">
                                    @if($RevenueShareTotal >= '0')
                                    {{ 'R$ '.number_format($RevenueShareOpened*0.6, 2, ',', '.') }}
                                    @else
                                    {{ 'R$ '.number_format($RevenueShareOpened*1.4, 2, ',', '.') }}
                                    @endif
                                </p>
                                <p class="mt-1 text-xs text-white text-opacity-70">Revenue share à receber <span class="text-xs">(NGR)</span></p>
                            </div>
                            <div style="width:80px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="background: linear-gradient(70deg,#31bc69 -8%,#089e4e 96%); float: right; width: 40px; height: 40px;" class="primary-icon icons" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card card-bg col-span-12 lg:col-span-8">
                <div class="flex items-center justify-between py-3 px-4">
                    <h2 class="font-medium tracking-wide text-gray-200">
                        Resumo demográfico
                    </h2>
                </div>
                <div class="grid grid-cols-1 gap-y-4 pb-3 sm:grid-cols-3">
                    <div class="flex flex-col justify-between border-4 border-transparent px-4">
                        <div>
                            <p class="text-gray-200 font-medium">
                                Gênero
                            </p>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Identificação de publico
                            </p>
                            <div class="badge mt-2 bg-info/10 text-info dark:bg-info/15">
                                Masculino: {{ number_format($percentual_masculino, 2, ',', '.')}}%
                            </div>
                            <div class="badge mt-2 bg-secondary/10 text-secondary dark:bg-secondary-light/15 dark:text-secondary-light">
                                Feminino: {{ number_format($percentual_feminino, 2, ',', '.')}}%
                            </div>
                        </div>
                        <div>
                            <div class="mt-8">
                                <p class="font-inter">
                                    <span class="text-2xl white">
                                        @php
                                            $predominante = 'm';
                                            $texto_majoritariamente = '';
                                            $percentual_majoritario = '';
                                            if($percentual_masculino >= $percentual_feminino){
                                                $predominante = 'm';
                                                $texto_majoritariamente = 'Majoritáriamente Masculino';
                                                $percentual_majoritario = number_format($percentual_masculino, 2, ',', '.');
                                            }else{
                                                $predominante = 'f';
                                                $texto_majoritariamente = 'Majoritáriamente Feminino';
                                                $percentual_majoritario = number_format($percentual_feminino, 2, ',', '.');
                                            }
                                        @endphp
                                        {{ $percentual_majoritario.'%' }}
                                    </span>
                                </p>
                                <p class="mt-1 text-xs">{{ $texto_majoritariamente }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between border-4 border-transparent px-4">
                        <div>
                            <p class="text-gray-200 font-medium">
                                Faixa etária
                            </p>
                            <p class="text-xs text-white text-opacity-50">
                                Demografia etária
                            </p>
                            <div class="mt-8">
                                <p class="text-sm text-white/90"><b>18 a 25 anos:</b> {{ number_format($percent_18_25, 2, ',', '.') }}%</p>
                                <p class="text-sm text-white/90"><b>25 a 33 anos:</b> {{ number_format($percent_26_33, 2, ',', '.') }}%</p>
                                <p class="text-sm text-white/90"><b>33 a 40 anos:</b> {{ number_format($percent_34_40, 2, ',', '.') }}%</p>
                                <p class="text-sm text-white/90"><b>acima de 40 anos:</b> {{ number_format($percent_acima_40, 2, ',', '.') }}%</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between border-4 border-transparent px-4">
                        <div>
                            <p class="text-gray-200 font-medium">
                                Interesses
                            </p>
                            <p class="text-xs text-white text-opacity-50">
                                O que jogam
                            </p>

                            @foreach($interesses as $key => $item)
                            <div class="mt-2 flex space-x-1.5 w-full">
                                <div class="badge bg-base/10 text-sm text-base dark:bg-warning/15">
                                    @if($key == 0) 🔥 @endif
                                    {{ $item['name'] }}: {{ $item['perc'] }}%
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div>
                            <div class="mt-8">
                                <p class="mt-1 text-xs">Todos os interesses -></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4 px-4 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="font-medium tracking-wide text-gray-200">
                        Resumo de conversão
                    </h2>
                </div>
                <div class="mt-6">
                    <p>
                        <span class="text-3xl text-gray-200"></span>
                    </p>
                    <p class="text-sm text-white text-opacity-70">Total de registros</p>
                </div>
                <div class="mt-8 flex h-2 space-x-1">
                    <div class="w-5/12 rounded-full bg-green-600" x-tooltip.primary="'Exellent'"></div>
                    <div class="w-3/12 rounded-full bg-green-700" x-tooltip.success="'Very Good'"></div>
                    <div class="w-2/12 rounded-full bg-green-800" x-tooltip.info="'Good'"></div>
                    <div class="w-2/12 rounded-full bg-green-900" x-tooltip.warning="'Poor'"></div>
                </div>
                <!-- <div class="is-scrollbar-hidden mt-4 min-w-full overflow-x-auto">
                    <table class="w-full font-inter">
                        <tbody>
                            <tr>
                                <td class="whitespace-nowrap py-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="h-3.5 w-3.5 rounded-full border-2 border-red-700"></div>
                                        <p class="font-medium tracking-wide text-gray-200">
                                            Cliques no link
                                        </p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap py-2 text-right"></td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="h-3.5 w-3.5 rounded-full border-2 border-red-700"></div>
                                        <p class="font-medium tracking-wide text-gray-200">
                                            Cadastros efetivados
                                        </p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap py-2 text-right"></td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
            </div>
        </div>

        <div class="mt-4 grid md:grid-cols-3 gap-4 py-5 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div wire:ignore class="col-span-2">
                <div id="chartdiv" style="border: 1px solid #fff; border-radius: 10px; border: 1px solid #ffffff17; border-radius: 10px;"></div>  <?php // filter: grayscale(1); philipe monstrao ?>
            </div>
            <div class="col-span-1">
                <div class="px-4 pb-5 sm:px-5 w-full">
                <div class="mb-3 flex h-8 items-center justify-between">
                    <h2 class="font-medium tracking-wide text-white">
                    Resumo Geográfico
                    </h2>
                </div>
                <div>
                    {{-- <p> <span class="text-2xl text-white"> 1 </span> </p> --}}
                    <p class="text-sm text-white text-opacity-50">Brasil</p>
                </div>
                <div id="listaGeografico"> </div>
                <div class="mt-5 space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div id="chartdiv"></div>
                        </div>

                    @php
                    /*
                    <div class="flex items-center space-x-2">
                        <p class="text-sm text-white font-bold">
                        1
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img class="h-6 w-6" src="https://lineone.piniastudio.com/images/flags/australia-round.svg" alt="flag">
                        <p>Australia</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <p class="text-sm text-white font-bold">
                        0
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img class="h-6 w-6" src="https://lineone.piniastudio.com/images/flags/china-round.svg" alt="flag">
                        <p>China</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <p class="text-sm text-white font-bold">
                        0
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img class="h-6 w-6" src="https://lineone.piniastudio.com/images/flags/india-round.svg" alt="flag">
                        <p>India</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <p class="text-sm text-white font-bold">
                        0
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img class="h-6 w-6" src="https://lineone.piniastudio.com/images/flags/italy-round.svg" alt="flag">
                        <p>Italy</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <p class="text-sm text-white font-bold">
                        0
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img class="h-6 w-6" src="https://lineone.piniastudio.com/images/flags/japan-round.svg" alt="flag">
                        <p>Japan</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <p class="text-sm text-white font-bold">
                        0
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img class="h-6 w-6" src="https://lineone.piniastudio.com/images/flags/russia-round.svg" alt="flag">
                        <p>Russia</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <p class="text-sm text-white font-bold">
                        0
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img class="h-6 w-6" src="https://lineone.piniastudio.com/images/flags/spain-round.svg" alt="flag">
                        <p>Spain</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <p class="text-sm text-white font-bold">
                        0
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                    </div>
                    */
                    @endphp

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.umd.js"></script>
    <script>
    var vendaPorEstado = document.getElementById('vendaPorEstado');
    var barChart = new Chart(vendaPorEstado, {
      type: 'bar',
      data: {
        labels: [],
        datasets: [{
          label: '',
          data: [],
          backgroundColor: "#1fac5a",
          borderColor: "#1fac5a",
          borderWidth: 1.5
        },{
          label: '',
          data: [],
          backgroundColor: '#ac1f3d',
          borderColor: '#ac1f3d',
          borderWidth: 1.5
        }]
      },
    });
    barChart.data.labels = ['JAN', 'FEV', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
    barChart.data.datasets[0].data = [{{ implode(",", $bar_green) }}];
    barChart.data.datasets[1].data = [{{ implode(",", $bar_red) }}];
    barChart.update();
    </script>


    <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
    </style>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/data/countries2.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script>
        am5.ready(function() {

        var continents = {
          "AF": 0,
          "AN": 1,
          "AS": 2,
          "EU": 3,
          "NA": 4,
          "OC": 5,
          "SA": 6
        }

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");
        var colors = am5.ColorSet.new(root, {});


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);


        // Create the map chart
        // https://www.amcharts.com/docs/v5/charts/map-chart/
        var chart = root.container.children.push(am5map.MapChart.new(root, {
          panX: "rotateX",
          projection: am5map.geoMercator()
        }));


        // Create polygon series for the world map
        // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
        var worldSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
          geoJSON: am5geodata_worldLow,
          exclude: ["AQ"]
        }));

        worldSeries.mapPolygons.template.setAll({
          tooltipText: "{name}",
          interactive: true,
          fill: am5.color(0xaaaaaa),
          templateField: "polygonSettings"
        });

        worldSeries.mapPolygons.template.states.create("hover", {
          fill: am5.color(0xb30000)
        });

        worldSeries.mapPolygons.template.events.on("click", (ev) => {
          var dataItem = ev.target.dataItem;
          var data = dataItem.dataContext;
          var zoomAnimation = worldSeries.zoomToDataItem(dataItem);

          Promise.all([
            zoomAnimation.waitForStop(),
            am5.net.load("https://cdn.amcharts.com/lib/5/geodata/json/" + data.map + ".json", chart)
          ]).then((results) => {
            var geodata = am5.JSONParser.parse(results[1].response);

            countrySeries.setAll({
              geoJSON: geodata,
              fill: data.polygonSettings.fill
            });

            countrySeries.data.setAll(@php
                echo $resumo_grafico
            @endphp);

            countrySeries.show();
            worldSeries.hide(100);
            backContainer.show();

            resumoGeografico();
          });
        });

        // Create polygon series for the country map
        // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
        var countrySeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
          visible: false
        }));

        countrySeries.mapPolygons.template.setAll({
          tooltipText: "{name}: {value} players",
          interactive: true,
          fill: am5.color(0xaaaaaa)
        });

        countrySeries.mapPolygons.template.states.create("hover", {
          fill: am5.color(0xb30000)
        });


        // Set up data for countries
        var data = [];
        for(var id in am5geodata_data_countries2) {
          if (am5geodata_data_countries2.hasOwnProperty(id)) {
            var country = am5geodata_data_countries2[id];
            if (country.maps.length) {
              data.push({
                id: id,
                map: country.maps[0],
                polygonSettings: {
                //   fill: colors.getIndex(continents[country.continent_code]),
                  fill: am5.color(0x8d8d8d),
                }
              });
            }
          }
        }
        worldSeries.data.setAll(data);


        // Add button to go back to continents view
        var backContainer = chart.children.push(am5.Container.new(root, {
          x: am5.p100,
          centerX: am5.p100,
          dx: -10,
          paddingTop: 5,
          paddingRight: 10,
          paddingBottom: 5,
          y: 30,
          interactiveChildren: false,
          layout: root.horizontalLayout,
          cursorOverStyle: "pointer",
          background: am5.RoundedRectangle.new(root, {
            fill: am5.color(0xffffff),
            fillOpacity: 0.2
          }),
          visible: false
        }));

        var backLabel = backContainer.children.push(am5.Label.new(root, {
          text: "De volta ao mapa do mundo",
          centerY: am5.p50
        }));

        var backButton = backContainer.children.push(am5.Graphics.new(root, {
          width: 32,
          height: 32,
          centerY: am5.p50,
          fill: am5.color(0x555555),
          svgPath: "M16,1.466C7.973,1.466,1.466,7.973,1.466,16c0,8.027,6.507,14.534,14.534,14.534c8.027,0,14.534-6.507,14.534-14.534C30.534,7.973,24.027,1.466,16,1.466zM27.436,17.39c0.001,0.002,0.004,0.002,0.005,0.004c-0.022,0.187-0.054,0.37-0.085,0.554c-0.015-0.012-0.034-0.025-0.047-0.036c-0.103-0.09-0.254-0.128-0.318-0.115c-0.157,0.032,0.229,0.305,0.267,0.342c0.009,0.009,0.031,0.03,0.062,0.058c-1.029,5.312-5.709,9.338-11.319,9.338c-4.123,0-7.736-2.18-9.776-5.441c0.123-0.016,0.24-0.016,0.28-0.076c0.051-0.077,0.102-0.241,0.178-0.331c0.077-0.089,0.165-0.229,0.127-0.292c-0.039-0.064,0.101-0.344,0.088-0.419c-0.013-0.076-0.127-0.256,0.064-0.407s0.394-0.382,0.407-0.444c0.012-0.063,0.166-0.331,0.152-0.458c-0.012-0.127-0.152-0.28-0.24-0.318c-0.09-0.037-0.28-0.05-0.356-0.151c-0.077-0.103-0.292-0.203-0.368-0.178c-0.076,0.025-0.204,0.05-0.305-0.015c-0.102-0.062-0.267-0.139-0.33-0.189c-0.065-0.05-0.229-0.088-0.305-0.088c-0.077,0-0.065-0.052-0.178,0.101c-0.114,0.153,0,0.204-0.204,0.177c-0.204-0.023,0.025-0.036,0.141-0.189c0.113-0.152-0.013-0.242-0.141-0.203c-0.126,0.038-0.038,0.115-0.241,0.153c-0.203,0.036-0.203-0.09-0.076-0.115s0.355-0.139,0.355-0.19c0-0.051-0.025-0.191-0.127-0.191s-0.077-0.126-0.229-0.291c-0.092-0.101-0.196-0.164-0.299-0.204c-0.09-0.579-0.15-1.167-0.15-1.771c0-2.844,1.039-5.446,2.751-7.458c0.024-0.02,0.048-0.034,0.069-0.036c0.084-0.009,0.31-0.025,0.51-0.059c0.202-0.034,0.418-0.161,0.489-0.153c0.069,0.008,0.241,0.008,0.186-0.042C8.417,8.2,8.339,8.082,8.223,8.082S8.215,7.896,8.246,7.896c0.03,0,0.186,0.025,0.178,0.11C8.417,8.091,8.471,8.2,8.625,8.167c0.156-0.034,0.132-0.162,0.102-0.195C8.695,7.938,8.672,7.853,8.642,7.794c-0.031-0.06-0.023-0.136,0.14-0.153C8.944,7.625,9.168,7.708,9.16,7.573s0-0.28,0.046-0.356C9.253,7.142,9.354,7.09,9.299,7.065C9.246,7.04,9.176,7.099,9.121,6.972c-0.054-0.127,0.047-0.22,0.108-0.271c0.02-0.015,0.067-0.06,0.124-0.112C11.234,5.257,13.524,4.466,16,4.466c3.213,0,6.122,1.323,8.214,3.45c-0.008,0.022-0.01,0.052-0.031,0.056c-0.077,0.013-0.166,0.063-0.179-0.051c-0.013-0.114-0.013-0.331-0.102-0.203c-0.089,0.127-0.127,0.127-0.127,0.191c0,0.063,0.076,0.127,0.051,0.241C23.8,8.264,23.8,8.341,23.84,8.341c0.036,0,0.126-0.115,0.239-0.141c0.116-0.025,0.319-0.088,0.332,0.026c0.013,0.115,0.139,0.152,0.013,0.203c-0.128,0.051-0.267,0.026-0.293-0.051c-0.025-0.077-0.114-0.077-0.203-0.013c-0.088,0.063-0.279,0.292-0.279,0.292s-0.306,0.139-0.343,0.114c-0.04-0.025,0.101-0.165,0.203-0.228c0.102-0.064,0.178-0.204,0.14-0.242c-0.038-0.038-0.088-0.279-0.063-0.343c0.025-0.063,0.139-0.152,0.013-0.216c-0.127-0.063-0.217-0.14-0.318-0.178s-0.216,0.152-0.305,0.204c-0.089,0.051-0.076,0.114-0.191,0.127c-0.114,0.013-0.189,0.165,0,0.254c0.191,0.089,0.255,0.152,0.204,0.204c-0.051,0.051-0.267-0.025-0.267-0.025s-0.165-0.076-0.268-0.076c-0.101,0-0.229-0.063-0.33-0.076c-0.102-0.013-0.306-0.013-0.355,0.038c-0.051,0.051-0.179,0.203-0.28,0.152c-0.101-0.051-0.101-0.102-0.241-0.051c-0.14,0.051-0.279-0.038-0.355,0.038c-0.077,0.076-0.013,0.076-0.255,0c-0.241-0.076-0.189,0.051-0.419,0.089s-0.368-0.038-0.432,0.038c-0.064,0.077-0.153,0.217-0.19,0.127c-0.038-0.088,0.126-0.241,0.062-0.292c-0.062-0.051-0.33-0.025-0.367,0.013c-0.039,0.038-0.014,0.178,0.011,0.229c0.026,0.05,0.064,0.254-0.011,0.216c-0.077-0.038-0.064-0.166-0.141-0.152c-0.076,0.013-0.165,0.051-0.203,0.077c-0.038,0.025-0.191,0.025-0.229,0.076c-0.037,0.051,0.014,0.191-0.051,0.203c-0.063,0.013-0.114,0.064-0.254-0.025c-0.14-0.089-0.14-0.038-0.178-0.012c-0.038,0.025-0.216,0.127-0.229,0.012c-0.013-0.114,0.025-0.152-0.089-0.229c-0.115-0.076-0.026-0.076,0.127-0.025c0.152,0.05,0.343,0.075,0.622-0.013c0.28-0.089,0.395-0.127,0.28-0.178c-0.115-0.05-0.229-0.101-0.406-0.127c-0.179-0.025-0.42-0.025-0.7-0.127c-0.279-0.102-0.343-0.14-0.457-0.165c-0.115-0.026-0.813-0.14-1.132-0.089c-0.317,0.051-1.193,0.28-1.245,0.318s-0.128,0.19-0.292,0.318c-0.165,0.127-0.47,0.419-0.712,0.47c-0.241,0.051-0.521,0.254-0.521,0.305c0,0.051,0.101,0.242,0.076,0.28c-0.025,0.038,0.05,0.229,0.191,0.28c0.139,0.05,0.381,0.038,0.393-0.039c0.014-0.076,0.204-0.241,0.217-0.127c0.013,0.115,0.14,0.292,0.114,0.368c-0.025,0.077,0,0.153,0.09,0.14c0.088-0.012,0.559-0.114,0.559-0.114s0.153-0.064,0.127-0.166c-0.026-0.101,0.166-0.241,0.203-0.279c0.038-0.038,0.178-0.191,0.014-0.241c-0.167-0.051-0.293-0.064-0.115-0.216s0.292,0,0.521-0.229c0.229-0.229-0.051-0.292,0.191-0.305c0.241-0.013,0.496-0.025,0.444,0.051c-0.05,0.076-0.342,0.242-0.508,0.318c-0.166,0.077-0.14,0.216-0.076,0.292c0.063,0.076,0.09,0.254,0.204,0.229c0.113-0.025,0.254-0.114,0.38-0.101c0.128,0.012,0.383-0.013,0.42-0.013c0.039,0,0.216,0.178,0.114,0.203c-0.101,0.025-0.229,0.013-0.445,0.025c-0.215,0.013-0.456,0.013-0.456,0.051c0,0.039,0.292,0.127,0.19,0.191c-0.102,0.063-0.203-0.013-0.331-0.026c-0.127-0.012-0.203,0.166-0.241,0.267c-0.039,0.102,0.063,0.28-0.127,0.216c-0.191-0.063-0.331-0.063-0.381-0.038c-0.051,0.025-0.203,0.076-0.331,0.114c-0.126,0.038-0.076-0.063-0.242-0.063c-0.164,0-0.164,0-0.164,0l-0.103,0.013c0,0-0.101-0.063-0.114-0.165c-0.013-0.102,0.05-0.216-0.013-0.241c-0.064-0.026-0.292,0.012-0.33,0.088c-0.038,0.076-0.077,0.216-0.026,0.28c0.052,0.063,0.204,0.19,0.064,0.152c-0.14-0.038-0.317-0.051-0.419,0.026c-0.101,0.076-0.279,0.241-0.279,0.241s-0.318,0.025-0.318,0.102c0,0.077,0,0.178-0.114,0.191c-0.115,0.013-0.268,0.05-0.42,0.076c-0.153,0.025-0.139,0.088-0.317,0.102s-0.204,0.089-0.038,0.114c0.165,0.025,0.418,0.127,0.431,0.241c0.014,0.114-0.013,0.242-0.076,0.356c-0.043,0.079-0.305,0.026-0.458,0.026c-0.152,0-0.456-0.051-0.584,0c-0.127,0.051-0.102,0.305-0.064,0.419c0.039,0.114-0.012,0.178-0.063,0.216c-0.051,0.038-0.065,0.152,0,0.204c0.063,0.051,0.114,0.165,0.166,0.178c0.051,0.013,0.215-0.038,0.279,0.025c0.064,0.064,0.127,0.216,0.165,0.178c0.039-0.038,0.089-0.203,0.153-0.166c0.064,0.039,0.216-0.012,0.331-0.025s0.177-0.14,0.292-0.204c0.114-0.063,0.05-0.063,0.013-0.14c-0.038-0.076,0.114-0.165,0.204-0.254c0.088-0.089,0.253-0.013,0.292-0.115c0.038-0.102,0.051-0.279,0.151-0.267c0.103,0.013,0.243,0.076,0.331,0.076c0.089,0,0.279-0.14,0.332-0.165c0.05-0.025,0.241-0.013,0.267,0.102c0.025,0.114,0.241,0.254,0.292,0.279c0.051,0.025,0.381,0.127,0.433,0.165c0.05,0.038,0.126,0.153,0.152,0.254c0.025,0.102,0.114,0.102,0.128,0.013c0.012-0.089-0.065-0.254,0.025-0.242c0.088,0.013,0.191-0.026,0.191-0.026s-0.243-0.165-0.331-0.203c-0.088-0.038-0.255-0.114-0.331-0.241c-0.076-0.127-0.267-0.153-0.254-0.279c0.013-0.127,0.191-0.051,0.292,0.051c0.102,0.102,0.356,0.241,0.445,0.33c0.088,0.089,0.229,0.127,0.267,0.242c0.039,0.114,0.152,0.241,0.19,0.292c0.038,0.051,0.165,0.331,0.204,0.394c0.038,0.063,0.165-0.012,0.229-0.063c0.063-0.051,0.179-0.076,0.191-0.178c0.013-0.102-0.153-0.178-0.203-0.216c-0.051-0.038,0.127-0.076,0.191-0.127c0.063-0.05,0.177-0.14,0.228-0.063c0.051,0.077,0.026,0.381,0.051,0.432c0.025,0.051,0.279,0.127,0.331,0.191c0.05,0.063,0.267,0.089,0.304,0.051c0.039-0.038,0.242,0.026,0.294,0.038c0.049,0.013,0.202-0.025,0.304-0.05c0.103-0.025,0.204-0.102,0.191,0.063c-0.013,0.165-0.051,0.419-0.179,0.546c-0.127,0.127-0.076,0.191-0.202,0.191c-0.06,0-0.113,0-0.156,0.021c-0.041-0.065-0.098-0.117-0.175-0.097c-0.152,0.038-0.344,0.038-0.47,0.19c-0.128,0.153-0.178,0.165-0.204,0.114c-0.025-0.051,0.369-0.267,0.317-0.331c-0.05-0.063-0.355-0.038-0.521-0.038c-0.166,0-0.305-0.102-0.433-0.127c-0.126-0.025-0.292,0.127-0.418,0.254c-0.128,0.127-0.216,0.038-0.331,0.038c-0.115,0-0.331-0.165-0.331-0.165s-0.216-0.089-0.305-0.089c-0.088,0-0.267-0.165-0.318-0.165c-0.05,0-0.19-0.115-0.088-0.166c0.101-0.05,0.202,0.051,0.101-0.229c-0.101-0.279-0.33-0.216-0.419-0.178c-0.088,0.039-0.724,0.025-0.775,0.025c-0.051,0-0.419,0.127-0.533,0.178c-0.116,0.051-0.318,0.115-0.369,0.14c-0.051,0.025-0.318-0.051-0.433,0.013c-0.151,0.084-0.291,0.216-0.33,0.216c-0.038,0-0.153,0.089-0.229,0.28c-0.077,0.19,0.013,0.355-0.128,0.419c-0.139,0.063-0.394,0.204-0.495,0.305c-0.102,0.101-0.229,0.458-0.355,0.623c-0.127,0.165,0,0.317,0.025,0.419c0.025,0.101,0.114,0.292-0.025,0.471c-0.14,0.178-0.127,0.266-0.191,0.279c-0.063,0.013,0.063,0.063,0.088,0.19c0.025,0.128-0.114,0.255,0.128,0.369c0.241,0.113,0.355,0.217,0.418,0.367c0.064,0.153,0.382,0.407,0.382,0.407s0.229,0.205,0.344,0.293c0.114,0.089,0.152,0.038,0.177-0.05c0.025-0.09,0.178-0.104,0.355-0.104c0.178,0,0.305,0.04,0.483,0.014c0.178-0.025,0.356-0.141,0.42-0.166c0.063-0.025,0.279-0.164,0.443-0.063c0.166,0.103,0.141,0.241,0.23,0.332c0.088,0.088,0.24,0.037,0.355-0.051c0.114-0.09,0.064-0.052,0.203,0.025c0.14,0.075,0.204,0.151,0.077,0.267c-0.128,0.113-0.051,0.293-0.128,0.47c-0.076,0.178-0.063,0.203,0.077,0.278c0.14,0.076,0.394,0.548,0.47,0.638c0.077,0.088-0.025,0.342,0.064,0.495c0.089,0.151,0.178,0.254,0.077,0.331c-0.103,0.075-0.28,0.216-0.292,0.47s0.051,0.431,0.102,0.521s0.177,0.331,0.241,0.419c0.064,0.089,0.14,0.305,0.152,0.445c0.013,0.14-0.024,0.306,0.039,0.381c0.064,0.076,0.102,0.191,0.216,0.292c0.115,0.103,0.152,0.318,0.152,0.318s0.039,0.089,0.051,0.229c0.012,0.14,0.025,0.228,0.152,0.292c0.126,0.063,0.215,0.076,0.28,0.013c0.063-0.063,0.381-0.077,0.546-0.063c0.165,0.013,0.355-0.075,0.521-0.19s0.407-0.419,0.496-0.508c0.089-0.09,0.292-0.255,0.268-0.356c-0.025-0.101-0.077-0.203,0.024-0.254c0.102-0.052,0.344-0.152,0.356-0.229c0.013-0.077-0.09-0.395-0.115-0.457c-0.024-0.064,0.064-0.18,0.165-0.306c0.103-0.128,0.421-0.216,0.471-0.267c0.051-0.053,0.191-0.267,0.217-0.433c0.024-0.167-0.051-0.369,0-0.457c0.05-0.09,0.013-0.165-0.103-0.268c-0.114-0.102-0.089-0.407-0.127-0.457c-0.037-0.051-0.013-0.319,0.063-0.345c0.076-0.023,0.242-0.279,0.344-0.393c0.102-0.114,0.394-0.47,0.534-0.496c0.139-0.025,0.355-0.229,0.368-0.343c0.013-0.115,0.38-0.547,0.394-0.635c0.013-0.09,0.166-0.42,0.102-0.497c-0.062-0.076-0.559,0.115-0.622,0.141c-0.064,0.025-0.241,0.127-0.446,0.113c-0.202-0.013-0.114-0.177-0.127-0.254c-0.012-0.076-0.228-0.368-0.279-0.381c-0.051-0.012-0.203-0.166-0.267-0.317c-0.063-0.153-0.152-0.343-0.254-0.458c-0.102-0.114-0.165-0.38-0.268-0.559c-0.101-0.178-0.189-0.407-0.279-0.572c-0.021-0.041-0.045-0.079-0.067-0.117c0.118-0.029,0.289-0.082,0.31-0.009c0.024,0.088,0.165,0.279,0.19,0.419s0.165,0.089,0.178,0.216c0.014,0.128,0.14,0.433,0.19,0.47c0.052,0.038,0.28,0.242,0.318,0.318c0.038,0.076,0.089,0.178,0.127,0.369c0.038,0.19,0.076,0.444,0.179,0.482c0.102,0.038,0.444-0.064,0.508-0.102s0.482-0.242,0.635-0.255c0.153-0.012,0.179-0.115,0.368-0.152c0.191-0.038,0.331-0.177,0.458-0.28c0.127-0.101,0.28-0.355,0.33-0.444c0.052-0.088,0.179-0.152,0.115-0.253c-0.063-0.103-0.331-0.254-0.433-0.268c-0.102-0.012-0.089-0.178-0.152-0.178s-0.051,0.088-0.178,0.153c-0.127,0.063-0.255,0.19-0.344,0.165s0.026-0.089-0.113-0.203s-0.192-0.14-0.192-0.228c0-0.089-0.278-0.255-0.304-0.382c-0.026-0.127,0.19-0.305,0.254-0.19c0.063,0.114,0.115,0.292,0.279,0.368c0.165,0.076,0.318,0.204,0.395,0.229c0.076,0.025,0.267-0.14,0.33-0.114c0.063,0.024,0.191,0.253,0.306,0.292c0.113,0.038,0.495,0.051,0.559,0.051s0.33,0.013,0.381-0.063c0.051-0.076,0.089-0.076,0.153-0.076c0.062,0,0.177,0.229,0.267,0.254c0.089,0.025,0.254,0.013,0.241,0.179c-0.012,0.164,0.076,0.305,0.165,0.317c0.09,0.012,0.293-0.191,0.293-0.191s0,0.318-0.012,0.433c-0.014,0.113,0.139,0.534,0.139,0.534s0.19,0.393,0.241,0.482s0.267,0.355,0.267,0.47c0,0.115,0.025,0.293,0.103,0.293c0.076,0,0.152-0.203,0.24-0.331c0.091-0.126,0.116-0.305,0.153-0.432c0.038-0.127,0.038-0.356,0.038-0.444c0-0.09,0.075-0.166,0.255-0.242c0.178-0.076,0.304-0.292,0.456-0.407c0.153-0.115,0.141-0.305,0.446-0.305c0.305,0,0.278,0,0.355-0.077c0.076-0.076,0.151-0.127,0.19,0.013c0.038,0.14,0.254,0.343,0.292,0.394c0.038,0.052,0.114,0.191,0.103,0.344c-0.013,0.152,0.012,0.33,0.075,0.33s0.191-0.216,0.191-0.216s0.279-0.189,0.267,0.013c-0.014,0.203,0.025,0.419,0.025,0.545c0,0.053,0.042,0.135,0.088,0.21c-0.005,0.059-0.004,0.119-0.009,0.178C27.388,17.153,27.387,17.327,27.436,17.39zM20.382,12.064c0.076,0.05,0.102,0.127,0.152,0.203c0.052,0.076,0.14,0.05,0.203,0.114c0.063,0.064-0.178,0.14-0.075,0.216c0.101,0.077,0.151,0.381,0.165,0.458c0.013,0.076-0.279,0.114-0.369,0.102c-0.089-0.013-0.354-0.102-0.445-0.127c-0.089-0.026-0.139-0.343-0.025-0.331c0.116,0.013,0.141-0.025,0.267-0.139c0.128-0.115-0.189-0.166-0.278-0.191c-0.089-0.025-0.268-0.305-0.331-0.394c-0.062-0.089-0.014-0.228,0.141-0.331c0.076-0.051,0.279,0.063,0.381,0c0.101-0.063,0.203-0.14,0.241-0.165c0.039-0.025,0.293,0.038,0.33,0.114c0.039,0.076,0.191,0.191,0.141,0.229c-0.052,0.038-0.281,0.076-0.356,0c-0.075-0.077-0.255,0.012-0.268,0.152C20.242,12.115,20.307,12.013,20.382,12.064zM16.875,12.28c-0.077-0.025,0.025-0.178,0.102-0.229c0.075-0.051,0.164-0.178,0.241-0.305c0.076-0.127,0.178-0.14,0.241-0.127c0.063,0.013,0.203,0.241,0.241,0.318c0.038,0.076,0.165-0.026,0.217-0.051c0.05-0.025,0.127-0.102,0.14-0.165s0.127-0.102,0.254-0.102s0.013,0.102-0.076,0.127c-0.09,0.025-0.038,0.077,0.113,0.127c0.153,0.051,0.293,0.191,0.459,0.279c0.165,0.089,0.19,0.267,0.088,0.292c-0.101,0.025-0.406,0.051-0.521,0.038c-0.114-0.013-0.254-0.127-0.419-0.153c-0.165-0.025-0.369-0.013-0.433,0.077s-0.292,0.05-0.395,0.05c-0.102,0-0.228,0.127-0.253,0.077C16.875,12.534,16.951,12.306,16.875,12.28zM17.307,9.458c0.063-0.178,0.419,0.038,0.355,0.127C17.599,9.675,17.264,9.579,17.307,9.458zM17.802,18.584c0.063,0.102-0.14,0.431-0.254,0.407c-0.113-0.027-0.076-0.318-0.038-0.382C17.548,18.545,17.769,18.529,17.802,18.584zM13.189,12.674c0.025-0.051-0.039-0.153-0.127-0.013C13.032,12.71,13.164,12.725,13.189,12.674zM20.813,8.035c0.141,0.076,0.339,0.107,0.433,0.013c0.076-0.076,0.013-0.204-0.05-0.216c-0.064-0.013-0.104-0.115,0.062-0.203c0.165-0.089,0.343-0.204,0.534-0.229c0.19-0.025,0.622-0.038,0.774,0c0.152,0.039,0.382-0.166,0.445-0.254s-0.203-0.152-0.279-0.051c-0.077,0.102-0.444,0.076-0.521,0.051c-0.076-0.025-0.686,0.102-0.812,0.102c-0.128,0-0.179,0.152-0.356,0.229c-0.179,0.076-0.42,0.191-0.509,0.229c-0.088,0.038-0.177,0.19-0.101,0.216C20.509,7.947,20.674,7.959,20.813,8.035zM14.142,12.674c0.064-0.089-0.051-0.217-0.114-0.217c-0.12,0-0.178,0.191-0.103,0.254C14.002,12.776,14.078,12.763,14.142,12.674zM14.714,13.017c0.064,0.025,0.114,0.102,0.165,0.114c0.052,0.013,0.217,0,0.167-0.127s-0.167-0.127-0.204-0.127c-0.038,0-0.203-0.038-0.267,0C14.528,12.905,14.65,12.992,14.714,13.017zM11.308,10.958c0.101,0.013,0.217-0.063,0.305-0.101c0.088-0.038,0.216-0.114,0.216-0.229c0-0.114-0.025-0.216-0.077-0.267c-0.051-0.051-0.14-0.064-0.216-0.051c-0.115,0.02-0.127,0.14-0.203,0.14c-0.076,0-0.165,0.025-0.14,0.114s0.077,0.152,0,0.19C11.117,10.793,11.205,10.946,11.308,10.958zM11.931,10.412c0.127,0.051,0.394,0.102,0.292,0.153c-0.102,0.051-0.28,0.19-0.305,0.267s0.216,0.153,0.216,0.153s-0.077,0.089-0.013,0.114c0.063,0.025,0.102-0.089,0.203-0.089c0.101,0,0.304,0.063,0.406,0.063c0.103,0,0.267-0.14,0.254-0.229c-0.013-0.089-0.14-0.229-0.254-0.28c-0.113-0.051-0.241-0.28-0.317-0.331c-0.076-0.051,0.076-0.178-0.013-0.267c-0.09-0.089-0.153-0.076-0.255-0.14c-0.102-0.063-0.191,0.013-0.254,0.089c-0.063,0.076-0.14-0.013-0.217,0.012c-0.102,0.035-0.063,0.166-0.012,0.229C11.714,10.221,11.804,10.361,11.931,10.412zM24.729,17.198c-0.083,0.037-0.153,0.47,0,0.521c0.152,0.052,0.241-0.202,0.191-0.267C24.868,17.39,24.843,17.147,24.729,17.198zM20.114,20.464c-0.159-0.045-0.177,0.166-0.304,0.306c-0.128,0.141-0.267,0.254-0.317,0.241c-0.052-0.013-0.331,0.089-0.242,0.279c0.089,0.191,0.076,0.382-0.013,0.472c-0.089,0.088,0.076,0.342,0.052,0.482c-0.026,0.139,0.037,0.229,0.215,0.229s0.242-0.064,0.318-0.229c0.076-0.166,0.088-0.331,0.164-0.47c0.077-0.141,0.141-0.434,0.179-0.51c0.038-0.075,0.114-0.316,0.102-0.457C20.254,20.669,20.204,20.489,20.114,20.464zM10.391,8.802c-0.069-0.06-0.229-0.102-0.306-0.11c-0.076-0.008-0.152,0.06-0.321,0.06c-0.168,0-0.279,0.067-0.347,0C9.349,8.684,9.068,8.65,9.042,8.692C9.008,8.749,8.941,8.751,9.008,8.87c0.069,0.118,0.12,0.186,0.179,0.178s0.262-0.017,0.288,0.051C9.5,9.167,9.569,9.226,9.712,9.184c0.145-0.042,0.263-0.068,0.296-0.119c0.033-0.051,0.263-0.059,0.263-0.059S10.458,8.861,10.391,8.802z"
        }));

        backContainer.events.on("click", function() {
          chart.goHome();
          worldSeries.show();
          countrySeries.hide();
          backContainer.hide();
          document.getElementById('listaGeografico').style.display = 'none';
        });

        });

        const resumoGeografico = () => {

            var resumo_geografico = JSON.parse(JSON.stringify(
                @php
                    echo $resumo_grafico
                @endphp
            ));

            var items = '';
            Object.values(resumo_geografico).forEach(value => {
                if(value.value > 0){
                    items += `<div class="mt-2 flex space-x-1.5 w-full">
                                <div class="badge bg-base/10 text-sm text-base dark:bg-warning/15">
                                    <img src="${value.bandeira}"/> &middot; ${value.uf} &middot; ${value.value} players
                                </div>
                            </div>`;
                }
            })
            document.getElementById('listaGeografico').innerHTML = items;
            document.getElementById('listaGeografico').style.display = 'block';
        }
        </script>

    </div>
</div>

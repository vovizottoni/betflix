<!DOCTYPE html>
<html lang="en" class="" style="background: #fafafa;">

<head>
    {{ Vite::useBuildDirectory('/admin') }}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A site of many amazing games and bet games">

    <title>BrazaBet - Plataforma Administrativa</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/branding/favicon.png')}}">


    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">


    <!-- Scripts -->

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="main-grid"  style="min-height: 100vh;">


    <style>
        .menu-icon {
            background: #ffffff14;
            width: 30px !important;
            height: 30px !important;
            border-radius: 6px;
            color: #fff;
            transition: ease 0.2 all;
            border: 1px solid #ffffff0a;
        }

        .menu-list li:hover .menu-icon {
            background: #02850c !important;
            transition: ease 0.3 all;
        }

        span.menu-item-label {
            font-weight: 300;
            font-size: 14px;
        }

        .menu-list li:hover a .menu-item-label {color: #fff;font-weight: 400;}

        .gradient-card-green {
            background: linear-gradient(45deg, #66b617, #cee7ba);
            border: 0px solid green;
            color: green !important;
            width: 50px;
            text-align: center;
            height: 50px;
            font-size: 25px;
        }

        .gradient-card-yellow {
            background: linear-gradient(45deg, #e6cc2d, #ffe466);
            border: 0px solid green;
            color: green !important;
            width: 50px;
            text-align: center;
            height: 50px;
            font-size: 25px;
        }

        .gradient-card-red {
            background: linear-gradient(45deg, #e62d2d, #ff6666);
            border: 0px solid green;
            color: green !important;
            width: 50px;
            text-align: center;
            height: 50px;
            font-size: 25px;
        }

        .default-card {
            background: transparent;
            box-shadow: none;
            border: 2px solid #00000017;
        }
    </style>
    <nav id="navbar-main" class="navbar is-fixed-top">
        <div class="navbar-brand">
            <a class="navbar-item mobile-aside-button">
                <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
            </a>

        </div>

        @php
            $user = DB::table('users')
                ->where([['id', '=', Auth::user()->id]])
                ->first();
        @endphp
        <div class="dropdown dropdown-bottom dropdown-end">
            <label tabindex="0" class="navbar-link flex gap-2 btn btn-ghost remove-focus">

                <div class="is-user-name capitalize font-light"><span>{{ $user->name }}</span></div>
                <span class="icon"><i class="mdi mdi-chevron-down"></i></span>

            </label>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 w-52">
                <li>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();"
                        aria-label="Logout" class="navbar-item">
                        <span class="icon"><i class="mdi mdi-logout"></i></span>
                        <span class="text-sm">Desconectar</span>
                    </a>
                    <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <aside class="aside is-placed-left is-expanded" style="overflow-y: auto;">
        <div class="aside-tools">
            <img src="/assets/images/branding/horizontal-branding.png" class="h-6" alt="Logo">
        </div>
        <div class="menu is-menu-main">
            <!--

                Financeiro
                Usuários
                Programa de Afiliados
                Integrações

            -->
            <p class="menu-label mt-8">Usuários</p>
            <ul class="menu-list">
                <li class="--set-active-profile-html">
                    <a href="{{ route('admin.manageruser') }}">
                        <span class="icon menu-icon"><i class="mdi mdi-account-circle"></i></span>
                        <span class="menu-item-label">Gerenciamento de Usuários</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown">
                        <span class="icon menu-icon"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"></path>
</svg></span>
                        <span class="menu-item-label">Relatórios</span>
                        <span class="icon"><i class="mdi mdi-plus"></i></span>
                    </a>
                    <ul class="pl-[47px]">
                        <li>
                            <a href="{{ route('admin.dashboard.index') }}">
                                <span> Usuários </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="--set-active-profile-html">
                    <a href="{{ route('admin.kyc') }}">
                        <span class="icon menu-icon"><i class="mdi mdi-security"></i>
                        </span>
                        <span class="menu-item-label">Validação de Identidade</span>
                    </a>
                </li>
            </ul>
            <p class="menu-label mt-8">Financeiro</p>
            <ul class="menu-list">
                <li class="--set-active-profile-html">
                    <a href="{{ route('admin.home') }}">
                        <span class="icon menu-icon"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"></path></svg></span>
                        <span class="menu-item-label">Raio X</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown">
                        <span class="icon menu-icon"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"></path>
</svg></span>
                        <span class="menu-item-label">Relatórios</span>
                        <span class="icon"><i class="mdi mdi-plus"></i></span>
                    </a>
                    <ul class="pl-[47px]">
                        <li>
                            <a href="{{ route('admin.dashboard.finance') }}">
                                <span> Financeiro </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="dropdown">
                        <span class="icon menu-icon"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
</svg></span>
                        <span class="menu-item-label">Transações Gateway</span>
                        <span class="icon"><i class="mdi mdi-plus"></i></span>
                    </a>
                    <ul class="pl-[47px]">
                        <li>
                            <a href="{{ route('admin.transactions.pagstar') }}">
                                <span>Transações Fiat</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.transactions.coingate') }}">
                                <span>Transações Cripto</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="--set-active-profile-html">
                    <a href="{{ route('admin.cashout-pagstar.cashout-approval') }}?type=players"">
                        <span class="icon menu-icon"><svg fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
</svg></span>
                        <span class="menu-item-label">Revisão de Saques Jogadores</span>
                    </a>
                </li>

            </ul>
            <p class="menu-label mt-8">Bonificações e afiliados</p>
            <ul class="menu-list">

                <li class="--set-active-forms-html">
                    <a href="{{ route('admin.admim-group') }}">
                        <span class="icon menu-icon"><i class="mdi mdi-account-multiple"></i></span>
                        <span class="menu-item-label">Gestão de Grupos</span>
                    </a>
                </li>

                <li class="--set-active-forms-html">
                    <a href="{{ route('admin.cycle-view') }}">
                        <span class="icon menu-icon"><i class="mdi mdi-account-multiple"></i></span>
                        <span class="menu-item-label">Visão do Ciclo</span>
                    </a>
                </li>

                <li class="--set-active-forms-html">
                    <a href="{{ route('admin.bonus3') }}">
                        <span class="icon menu-icon"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"></path>
</svg></span>
                        <span class="menu-item-label">Gestão de Rev. Share</span>
                    </a>
                </li>

                <li>
                    <a class="dropdown">
                        <span class="icon menu-icon"><i class="mdi mdi-view-list"></i></span>
                        <span class="menu-item-label">Pagamentos</span>
                        <span class="icon"><i class="mdi mdi-plus"></i></span>
                    </a>
                    <ul>
                        <li class="active">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.cashout-pagstar.cashout-approval') }}?type=affiliated">
                                        <span class="mdi mdi-menu-right ml-2"></span>
                                        <span>Aprovação de Saques de Afiliados</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li class="--set-active-profile-html">
                    <a href="{{ route('admin.rollover-bonus1') }}">
                        <span class="icon menu-icon"><i class="mdi mdi-backup-restore"></i></span>
                        <span class="menu-item-label">Rollover</span>
                    </a>
                </li>
            </ul>
            <p class="menu-label mt-8">Cassino</p>
                <ul class="menu-list">
                    <li class="--set-active-profile-html">
                    <a href="{{ url('/admin/bets') }}">
                        <span class="icon menu-icon"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path>
                        </svg></span>
                        <span class="menu-item-label">Visão dos Jogos Customizados</span>
                    </a>
                </li>

                    <li class="--set-active-profile-html">
                    <a href="{{ route('admin.fungamess.provider') }}">
                        <span class="icon menu-icon"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 01-.657.643 48.39 48.39 0 01-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 01-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 00-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 01-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 00.657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 01-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 005.427-.63 48.05 48.05 0 00.582-4.717.532.532 0 00-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 00.658-.663 48.422 48.422 0 00-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 01-.61-.58v0z"></path>
                            </svg></span>
                        <span class="menu-item-label">Gestão de Provedoras e Jogos</span>
                    </a>
                </li>

                <li class="--set-active-profile-html">
                    <a href="{{ route('admin.fungamess.users') }}">
                        <span class="icon menu-icon"><svg fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"></path>
                        </svg></span>
                        <span class="menu-item-label">Restrições</span>
                    </a>
                </li>
                </ul>
            <p class="menu-label mt-8">Plataformas externas</p>
            <ul class="menu-list">
                <li class="--set-active-profile-html">
                    <a href="https://fungamess.games/admin/dashboard" target="_blank">
                        <span class="icon menu-icon"><i class="mdi mdi-gamepad-variant"></i></span>
                        <span class="menu-item-label">Grenciamento Casino</span>
                    </a>
                </li>
                <li class="--set-active-profile-html">
                    <a href="https://login.nuxgame.com/admin-sport" target="_blank">
                        <span class="icon menu-icon"><i class="mdi mdi-soccer"></i></span>
                        <span class="menu-item-label">Grenciamento SportBook</span>
                    </a>
                </li>
                <li class="--set-active-profile-html">
                    <a href="https://adm.pagstar.com/login" target="_blank">
                        <span class="icon menu-icon"><svg fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path>
                        </svg></span>
                        <span class="menu-item-label">Pagstar</span>
                    </a>
                </li>
                <li class="--set-active-profile-html">
                    <a href="https://web.istpay.com.br/login" target="_blank">
                        <span class="icon menu-icon"><svg fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path>
                        </svg></span>
                        <span class="menu-item-label">IstPay</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </aside>

    {{ $slot }}



    @livewireScripts

</body>

</html>

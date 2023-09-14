
<header class="top-0 fixed left-0" style="border-bottom: 1px solid #ffffff30; width: 100%; z-index: 999999; background: #090f1e;">
  <style type="text/css">


      a.logo {
          margin-top: 15px;
        }

      @media screen and (max-width: 768px) {
        .button.cashin {
          display: none;
        }

        a.logo {
          margin-top: 0 !important;
        }
      }

      a.logo img.fire-touch {
        opacity: 0;
        transition: all 0.3s ease;
      }

      a.logo:hover img.fire-touch {
        opacity: 1;
        transition: all 0.3s ease;
      }
  </style>
  <div class="flex justify-between items-center align-right gap-4 max-w-[100%]" style="padding: 10px 10px !important;">
    <label id="sideNavBtn" class="block md:hidden cursor-pointer sideNavBtn" for="" onclick="showHideSide()">
      <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
    </label>
    <div class="flex gap-20 justify-center items-center">
      <a
        @if (Auth::check()) href="/games" @else href="/" @endif
        class="md:max-w-[150px] logo relative -top-[2px] xs:-top-1"
      >
        <img src="{{asset('assets/images/branding/horizontal-branding.png')}}" style="max-height: 40px;">
        <img src="https://em-content.zobj.net/source/animated-noto-color-emoji/356/fire_1f525.gif" class="fire-touch" style="max-height: 40px; position: absolute; top: -10px; left: -13px;">
      </a>
      <div class="market-nav hidden lg:flex gap-8" style="align-items: center;">
          <a class="option" href="{{url('games')}}" style="justify-content: center; display: flex;">
            Cassino
          </a>
          <a class="option" href="{{url('providers/games/first-person-lobby-1006822')}}" style="justify-content: center; display: flex;">
            Live TV
            </a>
            {{--
            <a class="option" href="{{url('esportes')}}" style="justify-content: center; display: flex;">Esportes</a>
            --}}
          <a class="option" href="{{url('games/motograu')}}">
            <img src="https://hypetech.games/assets/images/games/brandings/motograu.png" style="width: 60px;">
          </a>
          <a class="option" href="{{url('games/foguetinho')}}">
            <img src="https://hypetech.games/assets/images/games/brandings/foguetinho.png" style="width: 60px;">
          </a>
          <a class="option" href="{{url('providers/games/aviator-1020440')}}" style="justify-content: center; display: flex;">
            <img src="https://1win.pro/img/aviator-game-logo.2fb50dc03.svg" style="width: 70px;">
          </a>
          <a class="option" href="{{url('providers/games/jetx-1002816')}}" style="justify-content: center; display: flex;">
            <img src="https://1win.pro/img/jetx.64787fc5c.svg" style="width: 40px;">
          </a>
        </div>
    </div>
    <div class="gap-4 flex">
      @if (Auth::check())
        <div class="flex">
          <div class="navbar mx-auto max-w-7xl lg:px-8 tablet:max-w-[80px] gap-4  ">

            <div class="flex gap-4 mx-0 md:mx-4">
              <div class="dropdown-end dropdown ml-1">
                <div class="form-control">
                  <div class="flex gap-4 cursor-pointer remove-focus">@livewire('header.balance')</div>
                </div>
              </div>
            </div>
            @include('components.ui.buttons.avatar-menu-button')

            <label for="depo-modal" style="cursor: pointer;" class="button cashin">{{ __('header.cash_in') }}</label>
          </div>


          @auth

                <!-- ---------------------------------------------------------------------------  -->
                <!-- Modal de cash-in -->
                <!------------------------------------------------------------------------------  -->
                <input
                  type="checkbox"
                  id="depo-modal"
                  class="modal-toggle"
                />
                <div class="modal">
                  <div class="custom-scroll modal-box relative full-modal md:mt-12 min-h-[100vh] sm:min-h-fit h-[100%] md:h-fit" style="border-radius: 20px;">
                    <label
                      for="depo-modal"
                      class="absolute top-8 right-8 rounded-sm"
                    >
                      <svg class="h-8 w-8 cursor-pointer text-white text-opacity-20" style="background: #ffffff0d; margin-top: 50px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                    </label>
                    <div
                      id="tabs-deposito"
                      class="mt-10 ml-auto mr-auto flex flex-col items-center gap-8"
                    >
                      <h1 class="payment-notdisplay text-2xl font-semibold">
                        {{ __('header.reload_your_account') }}</h1>
                      <div class="w-full">
                        @livewire('transactions.cash-in')
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ---------------------------------------------------------------------------  -->
                <!-- Modal de cash-out -->
                <!-- ---------------------------------------------------------------------------  -->
                <input
                  type="checkbox"
                  id="saque-modal"
                  class="modal-toggle"
                />
                <div class="modal">
                  <div class="custom-scroll modal-box relative full-modal md:mt-12 min-h-[100vh] sm:min-h-fit h-[100%] md:h-fit" style="border-radius: 20px;">
                    <label
                      for="saque-modal"
                      class="absolute top-8 right-8 rounded-sm"
                    >
                      <svg class="h-8 w-8 cursor-pointer text-white text-opacity-20" style="background: #ffffff0d;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                    </label>
                    <div class="w-full">
                      @livewire('transactions.cash-out')
                    </div>
                  </div>
                </div>

            @endauth


        </div>
      @else
        <ul class="menu menu-horizontal gap-4 flex">

          <li>
            @include('components.ui.buttons.signin-button')
          </li>

          <li>
            @include('components.ui.buttons.signup-button')
          </li>
        </ul>
      @endif
    </div>
  </div>
  <style type="text/css">
    .bg-shadow:after {
      content: '';
      width: 100%;
      height: 100%;
      position: absolute;
      background: linear-gradient(180deg, #000000e6 80%, transparent);
      top: -1px;
      z-index: -1;
    }

    .input-group :where(span) {
      background: #252d3e !important;
      border-radius: 3px 0px 0px 3px !important;
    }

    .market-nav a.option {
      font-size: 13px;
      font-weight: 500;
    }

    .button {
        color: #fff;
        font-weight: 600;
        font-size: 13px;
        -webkit-box-pack: center;
        justify-content: center;
        padding: 5px 20px;
        text-align: center;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        border-width: 0;
        min-height: 30px;
        cursor: pointer;
        -webkit-transition: all .1s;
        transition: all .1s;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        padding: 7px 30px;
        border-radius: 5px;
        margin: 5px 0;
    }


    .button.cashin {
        background-image: -webkit-linear-gradient(20deg,#31bc69 -8%,#089e4e 96%);
        background-image: linear-gradient(70deg,#31bc69 -8%,#089e4e 96%);
        border-style: none
    }

    .button.cashin:hover {
        opacity: .9
    }

    .button.cashin:before {
        content: "";
        position: absolute;
        bottom: 0;
        width: 92px;
        height: 92px;
        background-image: -webkit-radial-gradient(16.68% 41.55%,19.58% 37.96%,hsla(0,0%,100%,.6) 0,hsla(0,0%,100%,0) 100%);
        background-image: radial-gradient(19.58% 37.96% at 16.68% 41.55%,hsla(0,0%,100%,.6) 0,hsla(0,0%,100%,0) 100%);
        -webkit-animation: flare-2 5s ease-in-out infinite;
        animation: flare-2 5s ease-in-out infinite
    }

    @-webkit-keyframes flare-2 {
        0% {
            -webkit-transform: translateX(-115%) rotate(-45deg);
            transform: translateX(-115%) rotate(-45deg)
        }

        20% {
            -webkit-transform: translateX(140%) rotate(-45deg);
            transform: translateX(140%) rotate(-45deg)
        }

        to {
            -webkit-transform: translateX(140%) rotate(-45deg);
            transform: translateX(140%) rotate(-45deg)
        }
    }

    @keyframes flare-2 {
        0% {
            -webkit-transform: translateX(-115%) rotate(-45deg);
            transform: translateX(-115%) rotate(-45deg)
        }

        20% {
            -webkit-transform: translateX(140%) rotate(-45deg);
            transform: translateX(140%) rotate(-45deg)
        }

        to {
            -webkit-transform: translateX(140%) rotate(-45deg);
            transform: translateX(140%) rotate(-45deg)
        }
    }

    a.option.active:after {
      content: '';
      position: relative;
      width: 60px;
      left: -5px;
      height: 4px;
      background: linear-gradient(45deg, #096f5b, #01b07c);
      top: 11px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      display: block;
    }

    a.option {
      transform: scale(1);
      width: 60px;
    }

    a.option:hover {
      font-weight: 700 !important;
      transform: scale(1.05);
    }
  </style>
</header>
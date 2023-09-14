<div class="ml-2 flex-none gap-2">
  <style type="text/css">
    :where(.menu li) {
      color: #cbcbcb;
      font-weight: 500 !important;
      font-size: 12px !important;
    }
  </style>

  <div class="dropdown-end dropdown">
    <label tabindex="0" class="remove-focus btn-ghost flex bg-white bg-opacity-10 rounded-lg" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
      <div class="m-0.5 w-6 h-6 rounded-sm bg-white bg-opacity-10" style="border-radius: 50px">
        <svg class="w-4 h-4 mx-auto mt-1 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path clip-rule="evenodd" fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"></path>
        </svg>
      </div>

      <svg fill="currentColor" class="h-5 w-5 mt-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
      </svg>

    </label>
    <ul
      tabindex="0"
      class="dropdown-content menu menu-compact mt-3 w-52 rounded-md p-2 shadow"
      style="background: #fff;"
      >

      <li>
        <a href="{{ route('profile') }}">
          <svg class="h-4 w-4 opacity-80" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
          </svg>
          Conta
        </a>
      </li>
      <li>
        <label for="depo-modal">
          <svg class="h-4 w-4 opacity-80" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"></path>
          </svg>
          Depositar
        </label>
      </li>
      <li>
        <label for="saque-modal">
          <svg class="h-4 w-4 opacity-80" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"></path>
          </svg>
          Sacar
        </label>
      </li>
      @if (Auth::user()->bonus3_nivelhierarquico == 'master' || Auth::user()->bonus3_nivelhierarquico == 'supervisor' || Auth::user()->bonus3_nivelhierarquico == 'gerente' || Auth::user()->bonus3_nivelhierarquico == 'subgerente' )

      <li>
        <a href="{{ route('player.myinvitations') }}">
          <svg class="h-4 w-4 opacity-80" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
          </svg>
          Programa de Afiliados
        </a>
      </li>
      @endif

      <li>
        <a href="{{ route('player.account.transactions') }}">
          <svg class="h-4 w-4 opacity-80" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z"></path>
          </svg>
          Transações
        </a>
      </li>
      <li>
        <a href="{{ route('bets') }}">
          <svg class="h-4 w-4 opacity-80" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"></path>
          </svg>
          Histórico
        </a>
      </li>
      {{--
      <li>
        <a href="{{ route('player.mybonus') }}">
          <svg class="h-4 w-4 opacity-80" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z"></path>
            <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path>
          </svg>
          Extrato de Bônus
        </a>
      </li>
      --}}
      <li>
        <a href="{{ route('player.kyc') }}">
          <svg
            class="h-4 w-4 opacity-80"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
          >
            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path
              fill="currentColor"
              d="M256 0c4.6 0 9.2 1 13.4 2.9L457.7 82.8c22 9.3 38.4 31 38.3 57.2c-.5 99.2-41.3 280.7-213.7 363.2c-16.7 8-36.1 8-52.8 0C57.3 420.7 16.5 239.2 16 140c-.1-26.2 16.3-47.9 38.3-57.2L242.7 2.9C246.8 1 251.4 0 256 0zm0 66.8V444.8C394 378 431.1 230.1 432 141.4L256 66.8l0 0z"
            />
          </svg>
          Validar conta
        </a>
      </li>

      <hr class="mt-3 mb-3 opacity-40">

      <li>
        <a
          onclick="event.preventDefault(); document.getElementById('logout-form_').submit();">
          <svg
            class="h-4 w-4 opacity-80"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
            >
            </path>
          </svg>
          {{ __('header.logout') }}
        </a>
        <form
          id="logout-form_"
          action="{{ route('logout') }}"
          method="POST"
          style="display: none;"
        >
          {{ csrf_field() }}
        </form>
      </li>
    </ul>
  </div>
</div>

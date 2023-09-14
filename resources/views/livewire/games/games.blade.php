<div>

  <style type="text/css">
    .homepop-up {
        display: initial !important;
    }

    input#default-search {
        background: #ffffff12;
        border: 0px;
        font-size: 17px;
        border-radius: 3px;
        color: #fff !important;
    }

    input#default-search:focus {
      --tw-ring-color: transparent !important;
    }

    .grid-result-search {
      background: #1a202e !important;
    }

    button.text-white.absolute.right-2\.5.bottom-2\.5.bg-blue-700.hover\:bg-blue-800.font-medium.rounded-lg.text-sm.px-4.py-2 {
      background: #ffffff1c;
      border-radius: 3px;
      opacity: 0.5;
    }

    .bottom-gradient:after {
      content: '';
      background: linear-gradient(0deg, #171717, transparent);
      height: 70px;
      bottom: 0;
      position: absolute;
      width: 100%;
  }

  .video-container::before {
      content: "";
      position: absolute;
      z-index: 9;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: linear-gradient(0deg, #000000, #00000000);
    }

    .white-btn {
      background-color: #fff;
      box-shadow: 0 10px 35px rgb(0 0 0 / 20%);
      border-radius: 10px;
      font-style: normal;
      font-weight: 600;
      font-size: 18px;
      line-height: 15px;
      margin-top: auto;
      color: #000;
      white-space: nowrap;
      min-height: 45px;
      text-align: center;
    }

    .glow-btn.yellow {
        background: linear-gradient(107deg, rgb(255, 186, 0) 0%, rgb(255, 146, 0) 100%) !important;
        box-shadow: rgb(0 0 0 / 20%) 0px 4px 20px 0px;
    }

    .glow-btn.transparent {
      background: rgb(255 255 255 / 17%) !important;
      box-shadow: none;
    }

    .owl-controls {
      margin-top: -3px;
    }

    .col-span-4.md\:col-span-1.grid-card.flex.justify-between.p-4 {
        background: linear-gradient(45deg, #2563eb7a, transparent);
        border-radius: 13px !important;
        border: 2px solid #ffffff00;
    }

    a.col-span-2.md\:col-span-1.grid-card.flex.flex-col.justify-between.py-4.min-h-\[130px\] {
    min-height: 130px;
    }

    video#main-video {
    min-width: 100% !important;
    position: relative;
    width: 100% !important;
    max-width: 100% !important;
    max-height: 100% !important;
    height: 100%;
    opacity: 1;
    border-radius: 20px;
  }

  .video-backdrop:before {
      content: '';
      position: absolute;
      width: 100%;
      height: 250px;
      background: linear-gradient(45deg, #090f1e, transparent);
      z-index: 99;
  }

@-webkit-keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(calc(-250px * 7));
  }
}

@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(calc(-250px * 7));
  }
}

.backdrop:after {
    background: linear-gradient(58deg, #090f1e -10%, transparent 130%);
    content: '';
    width: 100%;
    height: 250px;
    position: absolute;
    z-index: 0;
}

.backdrop-bottom:after {
    background: linear-gradient(0deg, #090f1eba 0%, transparent 50%);
    content: '';
    width: 100%;
    height: 250px;
    position: absolute;
    z-index: 0;
}

  @media screen and (max-width: 500px) {
    .backdrop:after {
      height: 330px !important;
  }

  }

  </style>

<div class="main-section pt-16 md:pt-0">

  @auth
  <div class="grid px-2 xl:px-0">
  @livewire('fungamess.search')
  </div>
  @endauth

  <div class="grid grid-cols-1 md:grid-cols-4 pb-2 mt-4 md:mt-0 gap-y-4 md:gap-4 px-2 xl:px-0">

      <div class="col-span-full md:col-span-2 w-full flex p-0 owl-carousel main-banner">
        <a href="{{ url('providers/games/aviator-1020440') }}" class="item">
          <div class="relative flex flex-col items-center justify-end w-full h-[250px] rounded-xl overflow-clip">
            
            <img class="absolute w-full h-[250px] rounded-xl object-cover block md:hidden" src="{{asset('assets/images/banners/AviatorMobile.png')}}" alt="">
            <img class="absolute w-full h-[250px] rounded-xl object-cover hidden md:block" src="{{asset('assets/images/banners/AviatorDesktop.png')}}" alt="">

            <img src="{{asset('assets/images/branding/horizontal-branding.png')}}" class="max-w-[150px] absolute top-2">
            <div class="absolute w-full h-full px-2 pt-2 pb-8 flex flex-col justify-center items-center lg:items-end">
              

              <div class=" px-4 flex flex-col items-center text-center text-lg md:text-xl font-mont">
                <p class="font-extrabold uppercase">Voe alto com o Aviator Braza.</p>
                <div class="relative flex flex-col justify-center items-center mt-1">
                  <div class="px-2 py-[1px] bg-[#008C01] relative z-10 uppercase">Multiplicador 5000x ativado!</div>
                  <div class="h-5 w-[90%] bg-[#FFB001] relative z-0 -top-4"></div>
                </div>
              </div>

              

            </div>
          </div>
        </a>

        <a href="{{ url('providers/games/mines-1020445') }}" class="item">
            <div class="relative flex flex-col items-center justify-end w-full h-[250px] rounded-xl">


              <img class="absolute w-full h-[250px] rounded-xl object-cover block md:hidden" src="{{asset('assets/images/banners/MinesMobile.png')}}" alt="">
              <img class="absolute w-full h-[250px] rounded-xl object-cover hidden md:block" src="{{asset('assets/images/banners/MinesDesktop.png')}}" alt="">
              <img src="{{asset('assets/images/branding/horizontal-branding.png')}}" class="max-w-[150px] absolute top-2">
              <div class="absolute w-full h-full px-2 pt-2 pb-8 flex flex-col justify-center items-center lg:items-end">
                
  

                <div class="px-4 flex flex-col justify-center items-center text-center font-mont">

                  <p class="font-extrabold uppercase text-lg md:text-2xl lg:text-3xl">As minas foram colocadas!</p>   
                  <p class="px-2 py-[1px] uppercase text-sm md:text-a lg:text-lg">Prepare-se para vitórias explosivas com o Mines!</p>
                  <div class="h-[2px] w-[50%] bg-[#FFB001]"></div>
                  
                </div>
  
                
  
              </div>
            </div>
          </a>

          <a href="{{ url('providers/games/penalty-shoot-out-1005121') }}" class="item">
            <div class="relative flex flex-col items-center justify-end w-full h-[250px] rounded-xl">


              <img class="absolute w-full h-[250px] rounded-xl object-cover block md:hidden" src="{{asset('assets/images/banners/PenaltyMobile.png')}}" alt="">
              <img class="absolute w-full h-[250px] rounded-xl object-cover hidden md:block" src="{{asset('assets/images/banners/PenaltyDesktop.png')}}" alt="">
              <img src="{{asset('assets/images/branding/horizontal-branding.png')}}" class="max-w-[150px] absolute top-2">
              <div class="absolute w-full h-full px-2 pt-2 pb-8 flex flex-col justify-center items-center lg:items-end">
                
  


                <div class="px-4 flex flex-col items-center text-center text-lg md:text-xl font-mont">
                  <p class="font-extrabold uppercase text-2xl">Seja o camisa 10!</p>
                  <div class="relative flex flex-col justify-center items-center mt-1">
                    <div class="px-2 py-[1px] bg-[#008C01] relative z-10 uppercase">Bata o pênalti e comemore a vitória</div>
                    <div class="h-5 w-[90%] bg-[#FFB001] relative z-0 -top-4"></div>
                  </div>
                </div>
  
                
  
              </div>
            </div>
          </a>

          <a href="{{ url('providers/games/roleta-ao-vivo-1018110') }}" class="item">
            <div class="relative flex flex-col items-center justify-end w-full h-[250px] rounded-xl">


              <img class="absolute w-full h-[250px] rounded-xl object-cover block md:hidden" src="{{asset('assets/images/banners/RoletaMobile.png')}}" alt="">
              <img class="absolute w-full h-[250px] rounded-xl object-cover hidden md:block" src="{{asset('assets/images/banners/RoletaDesktop.png')}}" alt="">
              <img src="{{asset('assets/images/branding/horizontal-branding.png')}}" class="max-w-[150px] absolute top-2">
              <div class="absolute w-full h-full px-2 pt-2 pb-8 flex flex-col justify-center items-center lg:items-start">
                
  


                <div class="px-4 flex flex-col items-center text-center text-lg md:text-xl font-mont">
                  <p class="font-extrabold uppercase text-xl">O jogo que une a tradição do cassino </p>
                  <p class="font-extrabold uppercase text-xl"> com a animação do Brasil!</p>
                  <div class="relative flex flex-col justify-center items-center mt-1 w-fit">
                    <div class="px-2 py-[1px] bg-[#008C01] relative z-10 uppercase">Jogue agora a Roleta Brasileira!</div>
                    <div class="h-5 w-[90%] bg-[#FFB001] relative z-0 -top-4"></div>
                  </div>
                </div>
  
                
  
              </div>
            </div>
          </a>


        
      </div>

      <div class="col-span-2 grid grid-cols-2 gap-4">
          <a href="{{ url('providers/games/live-dragon-tiger-1001512') }}"> <div class="backdrop-bottom min-h-[250px] rounded-xl relative"
          style="background-image: url('https://lvbet-static.com/images/game-screenshots/pragmatic-live/blackjack-dragontiger-screen.jpg'); background-size: cover; background-position: 50%; height: 200px !important; align-content: flex-end; display: grid; padding: 20px;">
            <div class="relative" style="z-index: 1;">
              <p class="font-bold">Dragon Tiger</p>
              <p class="text-xs opacity-80">Pragmatic Play</p>
            </div>
          </div>
          </a>
          <a href="{{ url('providers/games/bac-bo-1006861') }}"> <div class="backdrop-bottom min-h-[250px] rounded-xl relative"
          style="background-image: url('https://livecasino24.com/wp-content/uploads/2021/12/bac-bo-live-evolution-uitgelegd.jpg'); background-size: cover; background-position: 50%; height: 200px !important; align-content: flex-end; display: grid; padding: 20px;">
            <div class="relative" style="z-index: 1;">
              <p class="font-bold">Bac Bo</p>
              <p class="text-xs opacity-80">Evolution Premium</p>
            </div>
          </div>
          </a>
      </div>

  </div>


 

  <div class="mx-auto px-2 xl:px-0">
    <div class="title mb-2 mt-6 flex justify-between">

      <h3 class="text-xl font-bold">Mais lucrativos</h3>

      <div class="owl-theme">
        <div class="owl-controls">
          <div id="populares" class="owl-nav">
          </div>
        </div>
      </div>

    </div>

    <div class="owl-carousel populares col-span-full w-full flex p-0">

      <!--
        Aviator

        MotoGrau

        Mines

        Fortune Tiger

        SpaceMan

        Penalty

        Burrinho

        Magnify Man

        JetX

      -->


      <a href="{{ url('providers/games/aviator-1020440') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://www.mktesportivo.com/wp-content/uploads/2023/03/avi2.jpeg" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Aviator</p>
        <p class="text-xs opacity-60">Spribe</p>
      </a>

      <a href="{{ url('providers/games/fortune-tiger-1009093') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://fungamess.games/images/games/ZxEnvHC2S2O39fFkXaiGnDNYXvKruGrjPR7o5oaG.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Fortune Tiger</p>
        <p class="text-xs opacity-60">Evoplay</p>
      </a>


      <a href="{{ url('providers/games/live-spaceman-1007025') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://nuxbet-dk2.pragmaticplay.net/game_pic/rec/325/1301.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Spaceman</p>
        <p class="text-xs opacity-60">Pragmatic Play</p>
      </a>

        <a href="{{ url('providers/games/mines-1020445') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
          <img src="https://www.betclip.net/images_games/spribe/mines.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
          <p class="text-sm font-bold mt-2 opacity-80">Mines</p>
          <p class="text-xs opacity-60">Spribe</p>
        </a>

        <a href="{{ url('games/motograu') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
          <img src="https://hypetech.games/assets/images/games/covers/moto-grau.jpg" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover !important; object-position: bottom;">
          <p class="text-sm font-bold mt-2 opacity-80">MotoGrau</p>
          <p class="text-xs opacity-60">Hypetech</p>
        </a>

        <a href="{{ url('providers/games/penalty-shoot-out-1005121') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
          <img src="https://fungamess.games/images/games/WiXsT2BBlFGVRi9qo5SG3zSrdUtkzUe0sGZQPGHk.jpg" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
          <p class="text-sm font-bold mt-2 opacity-80">Penalty Shoot Out</p>
          <p class="text-xs opacity-60">Evoplay</p>
        </a>
      

      <a href="{{ url('providers/games/jetx-1002816') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://poltronanerd.com.br/wp-content/uploads/2022/12/JetX-Game-O-que-e-isso.jpg" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Jet X</p>
        <p class="text-xs opacity-60">Pragmatic Play</p>
      </a>


      <a href="{{ url('games/foguetinho') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://betflix.global/assets/game-covers/hypetech/foguetinho.webp" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover !important; object-position: top;">
        <p class="text-sm font-bold mt-2 opacity-80">Foguetinho</p>
        <p class="text-xs opacity-60">Hypetech</p>
      </a>

      

      

      <a href="{{ url('providers/games/magnify-man-1009101') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://mstatic-ire1.mrslotty.com/CACHE/images/2436f9265ac7d8a72161af386ccac300.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Magnify Man</p>
        <p class="text-xs opacity-60">Evoplay</p>
      </a>


    </div>

  </div>

  <div class="mx-auto px-2 xl:px-0">
    <div class="title mb-2 mt-6 flex justify-between">

      <h3 class="text-xl font-bold">Melhores do ao-vivo</h3>

      <div class="owl-theme">
        <div class="owl-controls">
          <div id="melhor-aovivo" class="owl-nav">
          </div>
        </div>
      </div>

    </div>

    <div class="owl-carousel aovivo col-span-full w-full flex p-0">

      <a href="{{ url('providers/games/american-roulette-1005215') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://fungamess.games/images/games/jyZkuSWsfLVj92xc8mKG5ssH4hNlxiEuplcfaahr.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">American Roullete</p>
        <p class="text-xs opacity-60">Evolution</p>
      </a>

      <a href="{{ url('providers/games/live-dragon-tiger-1001512') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://nuxbet-dk2.pragmaticplay.net/game_pic/rec/325/1001.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Dragon Tiger</p>
        <p class="text-xs opacity-60">Pragmatic Play</p>
      </a>

      <a href="{{ url('providers/games/roleta-ao-vivo-1018110') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://www.betclip.net/images_games/evolutionnew/RoletaAoVivo.jpg" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Roleta Brasileira</p>
        <p class="text-xs opacity-60">Evolution</p>
      </a>

      <a href="{{ url('providers/games/bac-bo-1006861') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="	https://fungamess.games/images/games/vLcFuKBvDQK5dg5DFx3RvF1Un2telFmEOsWGnftC.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Bac Bo</p>
        <p class="text-xs opacity-60">Evolution</p>
      </a>

      <a href="{{ url('providers/games/football-studio-1006809') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://fungamess.games/images/games/V1I2XKGv3MoItpjaBvdZFqksVF6Y8JXmoyPz7Yp6.jpg" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Football Studio </p>
        <p class="text-xs opacity-60">Evolution</p>
      </a>

      <a href="{{ url('providers/games/live-boom-city-1013897') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://nuxbet-dk2.pragmaticplay.net/game_pic/rec/325/1401.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Boom City</p>
        <p class="text-xs opacity-60">Evolution</p>
      </a>

      <a href="{{ url('/providers/games/deal-or-no-deal-1006859') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://www.betclip.net/images_games/evolutionnew/evolution-deal-or-no-deal.jpg" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Deal or No Deal</p>
        <p class="text-xs opacity-60">Evolution</p>
      </a>

      

    </div>

  </div>

  <div class="mx-auto px-2 xl:px-0">
    <div class="title mb-2 mt-6 flex justify-between">

      <h3 class="text-xl md:text-xl font-bold">Slots mais divertidos</h3>

      <div class="owl-theme">
        <div class="owl-controls">
          <div id="slots-incriveis" class="owl-nav">
          </div>
        </div>
      </div>

    </div>

    <div class="owl-carousel slots col-span-full w-full flex p-0">

      <a href="{{ url('providers/games/fortune-tiger-1009093') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://fungamess.games/images/games/ZxEnvHC2S2O39fFkXaiGnDNYXvKruGrjPR7o5oaG.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Fortune Tiger</p>
        <p class="text-xs opacity-60">PG Soft</p>
      </a>

      <a href="{{ url('providers/games/gates-of-olympus-1000834') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://fungamess.games/images/games/jy3N0KI4SBVGLt0ya8n6XbQfAtNBi28T8fiioDeE.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Gates Of Olympus</p>
        <p class="text-xs opacity-60">Pragmatic Play</p>
      </a>

      <a href="{{ url('providers/games/bigger-bass-bonanza-1004362') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://fungamess.games/images/games/vY2XA7P89dcnb11Lw3eZpaPFfDOCSmznM2pAUBsR.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Bigger Bass Bonanza</p>
        <p class="text-xs opacity-60">Pragmatic Play</p>
      </a>

      <a href="{{ url('providers/games/sweet-bonanza-1000891') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://fungamess.games/images/games/wk7vXVvznxdYIReAN4V6lDiLWfMG0xDSfHk8r3iy.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Sweet Bonanza</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

      <a href="{{ url('providers/games/fruit-duel-1016732') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://fungamess.games/images/games/NCq6exsHGCUXY4PRyFb3dVp6LyyLsU8jU4seAfh7.jpg" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Fruit Duel</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

      <a href="{{ url('providers/games/joker-s-jewels-1000917') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 max-h-[130px]">
        <img src="https://fungamess.games/images/games/p6O81N6XDjfvHy1lyJdlkqHF8PGi3X3rFwPe7wj5.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Joker's Jewels</p>
        <p class="text-xs opacity-60">Pragmatic Play</p>
      </a>

      <a href="{{ url('providers/games/dragon-hatch-1008487') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://fungamess.games/images/games/6Pf5OOSEg6UbtskIzv3imDK0VxWJ6mteSewImE9g.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Dragon Hatch</p>
        <p class="text-xs opacity-60">PG Soft</p>
      </a>

    </div>

  </div>

  <div class="mx-auto px-2 xl:px-0">
    <div class="title mb-2 mt-6 flex justify-between">

      <h3 class="text-xl md:text-xl font-bold">Raspadinhas milionárias</h3>

      <div class="owl-theme">
        <div class="owl-controls">
          <div id="raspadinhas" class="owl-nav">
          </div>
        </div>
      </div>

    </div>

    <div class="owl-carousel raspadinhas col-span-full w-full flex p-0">

      <a href="{{ url('providers/games/chaos-crew-scratch-1016776') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://s3-eu-west-1.amazonaws.com/marketing-assets-83/games-prod/new/6ac8fa938fa74b6989f83f044828f34fa2531355/Games%20Catalog%20image/image.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Chaos Crew Scratch</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

      <a href="{{ url('providers/games/cash-scratch-1016779') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://s3-eu-west-1.amazonaws.com/marketing-assets-83/games-prod/new/1a82a53325cf7e31feb700b150bb830f28061ccf/Games%20Catalog%20image/image.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Cash Scratch</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

      <a href="{{ url('providers/games/shave-the-beard-1016812') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://s3-eu-west-1.amazonaws.com/marketing-assets-83/games-prod/new/3fc87a188d055f21961faf18f705399381935c05/Games%20Catalog%20image/image.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Shave the Beard</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

      <a href="{{ url('providers/games/diamond-rush-1016798') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://s3-eu-west-1.amazonaws.com/marketing-assets-83/games-prod/new/f094475885f2655531e81af5147a19306ef77b0b/Games%20Catalog%20image/image.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Diamond Rush</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

      <a href="{{ url('providers/games/scratchy-big-1016783') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://s3-eu-west-1.amazonaws.com/marketing-assets-83/games-prod/new/765939a3eab489747abef369c7c6f551a048e2ea/Games%20Catalog%20image/image.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Scratchy Big</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

      <a href="{{ url('providers/games/scratchy-1016781') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 max-h-[130px]">
        <img src="https://s3-eu-west-1.amazonaws.com/marketing-assets-83/games-prod/new/591c36b66f274a244f9fb3a4bfeb7a2eea8cb054/Games%20Catalog%20image/image.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Scratchy</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

      <a href="{{ url('providers/games/scratchy-mini-1016787') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://s3-eu-west-1.amazonaws.com/marketing-assets-83/games-prod/new/ed6ad60557fb8ddffd6cf1b749d9eade02ac4110/Games%20Catalog%20image/image.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Scratchy Mini</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

      <a href="{{ url('providers/games/football-scratch-1016775') }}" class="col-span-2 md:col-span-1 grid-card flex flex-col justify-between py-4 min-h-[130px]">
        <img src="https://s3-eu-west-1.amazonaws.com/marketing-assets-83/games-prod/new/7a4602764574747406514fb522e1c4e4c92b323a/Games%20Catalog%20image/image.png" class="min-h-[130px] max-h-[130px] rounded-xl" style="object-fit: cover; !important;">
        <p class="text-sm font-bold mt-2 opacity-80">Football Scratch</p>
        <p class="text-xs opacity-60">Hacksaw</p>
      </a>

    </div>

  </div>



  <div class="grid grid-cols-1 max-w-full" style="max-height: 200px;">
    @livewire('fungamess.providers')
  </div>


<style type="text/css">
  .cookie-consent-banner {
  position: fixed;
  bottom: 0;
  left: 0;
  z-index: 99999;
  box-sizing: border-box;
  width: 100%;
  background-color: #161616;
}
.cookie-consent-banner__copy {
  margin-bottom: 16px;
}
.cookie-consent-banner__cta {
  box-sizing: border-box;
  display: inline-block;
  padding: 11px 13px;
  border-radius: 2px;
  background-color: #2CE080;
  color: #FFF;
  text-decoration: none;
  text-align: center;
  font-weight: normal;
  font-size: 14px;
  line-height: 20px;
}
.cookie-consent-banner__cta--secondary {
  padding: 9px 13px;
  border: 2px solid #3A4649;
  background-color: transparent;
  color: #2CE080;
}
.cookie-consent-banner__cta:hover {
  background-color: #20BA68;
}
.cookie-consent-banner__cta--secondary:hover {
  border-color: #838F93;
  background-color: transparent;
  color: #22C870;
}
.carousel-top .owl-nav {
    position: relative;
    top: -55%;
    font-size: 110px;
    justify-content: space-between;
    display: flex;
}
.carousel-slot .owl-nav {
    position: relative;
    top: -150px;
    font-size: 110px;
    justify-content: space-between;
    display: flex;
}
svg.big-arrow {
    filter: drop-shadow(0px 4px 1px rgb(0 0 0 / 0.4));
}
svg.big-arrow:hover {
    filter: drop-shadow(0px 4px 1px rgb(0 0 0 / 1));
}
</style>

<script>
  $(document).ready(function(){
    $(".owl-carousel").owlCarousel();
  });

  
  $('.main-banner').owlCarousel({
  loop:true,
  lazyLoad:true,
  dots:false,
  margin:0,
  autoplay:true,
  autoplayTimeout:15000,
  autoplayHoverPause:false,
  responsive:{
      0:{
          items:1,
      }
  }
}),

$('.top-banner').owlCarousel({
  loop:true,
  margin:0,
  autoplay:true,
  autoplayTimeout:5000,
  autoplayHoverPause:false,
  responsive:{
      0:{
          items:1,
      }
  }
}),

$('.carousel-providers').owlCarousel({
  loop:false,
  margin:10,
  nav:true,
  navContainer: '#providers',
  autoplay:true,
  autoplayTimeout:5000,
  autoplayHoverPause:true,
  responsive:{
      0:{
          items:2,
      },
      450:{
          items:3,
      },
      600:{
          items:4
      },
      1000:{
          items:6
      },
      1600:{
          items: 8
      },
      2000:{
          items: 8
      }
  }
}),
$('.carousel-games').owlCarousel({
  loop:true,
  margin:10,
  nav:false,
  navContainer: '#games',
  autoplay:true,
  autoplayTimeout:5000,
  autoplayHoverPause:true,
  responsive:{
      0:{
          items:2,
      },
      450:{
          items:3,
      },
      600:{
          items:4
      },
      1000:{
          items:5
      },
      1600:{
          items: 6
      },
      2000:{
          items: 8
      }
  }
}),
$('.aovivo').owlCarousel({
  loop:false,
  margin:10,
  nav:true,
  navContainer: '#melhor-aovivo',
  autoplay:false,
  autoplayTimeout:5000,
  autoplayHoverPause:true,
  responsive:{
      0:{
          items:2,
      },
      450:{
          items:3,
      },
      600:{
          items:4
      },
      1000:{
          items:6
      },
      1600:{
          items: 8
      },
      2000:{
          items: 8
      }
  }
}),
$('.slots').owlCarousel({
  loop:false,
  margin:10,
  nav:true,
  navContainer: '#slots-incriveis',
  autoplay:false,
  autoplayTimeout:5000,
  autoplayHoverPause:true,
  responsive:{
      0:{
          items:2,
      },
      450:{
          items:3,
      },
      600:{
          items:4
      },
      1000:{
          items:6
      },
      1600:{
          items: 8
      },
      2000:{
          items: 8
      }
  }
}),
$('.populares').owlCarousel({
  loop:false,
  margin:10,
  nav:true,
  navContainer: '#populares',
  autoplay:false,
  autoplayTimeout:5000,
  autoplayHoverPause:true,
  responsive:{
      0:{
          items:2,
      },
      450:{
          items:3,
      },
      600:{
          items:4
      },
      1000:{
          items:6
      },
      1600:{
          items: 8
      },
      2000:{
          items: 8
      }
  }
}),
$('.raspadinhas').owlCarousel({
  loop:false,
  margin:10,
  nav:true,
  navContainer: '#raspadinhas',
  autoplay:false,
  autoplayTimeout:5000,
  autoplayHoverPause:true,
  responsive:{
      0:{
          items:2,
      },
      450:{
          items:3,
      },
      600:{
          items:4
      },
      1000:{
          items:6
      },
      1600:{
          items: 8
      },
      2000:{
          items: 8
      }
  }
}),
$('.carousel-ligas').owlCarousel({
  loop:false,
  margin:10,
  nav:true,
  navContainer: '#ligas-nav',
  autoplay:false,
  autoplayTimeout:5000,
  autoplayHoverPause:true,
  responsive:{
      0:{
          items:2,
      },
      450:{
          items:3,
      },
      600:{
          items:4
      },
      1000:{
          items:6
      },
      1600:{
          items: 8
      },
      2000:{
          items: 8
      }
  }
})
</script>
{{-- <script src="//code.jivosite.com/widget/1wVir9O6aN" async></script> --}}
<script>
  window.intercomSettings = {
    api_base: "https://api-iam.intercom.io",
    app_id: "vcnjrlkb"
  };
</script>

<script>
// We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/vcnjrlkb'
(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/vcnjrlkb';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>

</div>
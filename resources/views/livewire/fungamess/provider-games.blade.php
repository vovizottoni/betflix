<style type="text/css">
    .top-games-cover .content {
        padding: ;
    }

    .game_cover {
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-image: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
    background-size: cover;
    perspective-origin: 50% 50%;
    transform-style: preserve-3d;
    transform-origin: top center;
    will-change: transform;
    transform: skewX(0.001deg);
    transition: transform 0.35s ease-in-out;
    background-position: 50% 50% !important;
    }
</style>
<div class="w-full p-5 lg:px-8">
      <div class="grid grid-cols-1">
        <div class="flex gap-4 w-full justify-between sm:justify-start mt-[-30px] sm:mt-0 mb-10">
            <h1 class="col-span-full text-xl sm:text-4xl mt-3 capitalize font-bold z-10" style="max-width: 50%;"> {{$name}} </h1>
        </div>
        {{--}}
        <div class="mx-auto grid max-w-2xl grid-cols-2 gap-y-16 gap-x-8 text-center sm:grid-cols-3 md:grid-cols-4 lg:mx-0 lg:max-w-none lg:grid-cols-5 xl:grid-cols-6 slotgames">
            --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 xl:grid-gols-7 gap-4">
            @foreach ($games as $key => $game)
            <div class="card h-[160px]">
                <a href="{{ route('fgames.game', $game->game_code) }}" class="rounded-sm game_cover" style="background: url('{{$game->img}}'); background-size: cover;">
                    <div class="top-games-cover">
                        <div class="content">

                            <div class="mb-[-10px] sm:mb-[-10px] ml-[-10px] sm:ml-0 absolute bottom-[15px] w-10/12" style="z-index: 999 !important;">
                                <h5 class="font-medium text-sm text-white text-opacity-80">{{$game->name}}</h5>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-20" wire:ignore>

        <div class="flex gap-4 w-full justify-between sm:justify-start mt-[-30px] sm:mt-0z pb-6">
            <h1 class="col-span-full text-lg sm:text-xl mt-3 uppercase font-bold z-10"> Provedores 
            </h1>
            <div class="owl-theme">
                <div class="owl-controls">
                    <div id="providers" class="owl-nav"></div>
                </div>
            </div>
        </div>

          <ul role="list" class="mx-auto grid max-w-2xl grid-cols-2 gap-y-16 gap-x-8 text-center sm:grid-cols-3 md:grid-cols-4 lg:mx-0 lg:max-w-none lg:grid-cols-5 xl:grid-cols-8 owl-carousel carousel-providers slotgames">
            @foreach ($allProviders as $provider)
                <li class="rounded-sm bg-slate-200" style="filter: invert(1) grayscale(1);">
                    <a href="{{ route('fprovider.provider-games', [$this->slug($provider->name), $provider->id]) }}">
                        <img class="mx-auto h-24 p-6" src="{{$provider->logo}}" alt="" style="max-width: 120px;">
                        <p class="text-sm leading-6 text-black text-opacity-80"><b>{{ $provider->name }}</b>
                        <p class="text-xs leading-6 text-black text-opacity-80 pb-4"><b>{{ count($provider->games) }}</b> Games </p>
                    </a>
                </li>
                @endforeach
            </ul>
    </div>
    <script wire:ignore>
        $(document).ready(function(){
            var owlProviders = $(".carousel-providers")
            owlProviders.owlCarousel({
                loop:false,
                margin:10,
                nav:true,
                navContainer: '#providers',
                autoplay:true,
                // autoplayTimeout:5000,
                // autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:1,
                        stagePadding: 40
                    },
                    450:{
                        items:3,
                        stagePadding: 40
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
            });    
        });
    </script>
</div>
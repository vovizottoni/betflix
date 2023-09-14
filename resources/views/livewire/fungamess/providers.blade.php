<div class="w-full">

    <div class="mt-4" wire:ignore>

        <div class="flex gap-4 w-full justify-between items-center mt-[-30px] sm:mt-0z pb-6">
            <div class="flex gap-4" style="justify-content: space-between; width: 100%;">
                <h1 class="col-span-full text-lg sm:text-xl mt-3 font-bold z-10"> Provedoras parceiras
                </h1>
                <div class="owl-theme" id="controls" style="margin-top: 10px;">
                    <div class="owl-controls">
                        <div id="providers" class="owl-nav"></div>
                    </div>
                </div>
            </div>

            <button class="btn btn-square btn-sm bg-base-800 border-none hover:bg-base-700" id="swapLayout" style="z-index: 999; margin-right: 15px;">
                <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
            </button>

        </div>

            <div id="owl" class="block transition-all">
                <ul role="list" class="mx-auto grid max-w-2xl grid-cols-2 gap-y-16 gap-x-8 text-center sm:grid-cols-3 md:grid-cols-4 lg:mx-0 lg:max-w-none lg:grid-cols-5 xl:grid-cols-8 owl-carousel carousel-providers slotgames">
                @foreach ($allProviders as $provider)
                    <li class="" style="filter: invert(1) grayscale(1);">
                        <a href="{{ route('fprovider.provider-games', [$this->slug($provider->name), $provider->id]) }}">
                            <img loading="lazy" class="mx-auto h-24 p-6" src="{{$provider->logo}}" alt="" style="max-width: 120px;">
                            <p class="text-sm leading-6 text-black text-opacity-80"><b>{{ $provider->name }}</b>
                            <p class="text-xs leading-6 text-black text-opacity-80 pb-4"><b>{{$provider->qty_games }}</b> Games </p>

                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

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
            });
        });
    </script>
    <script>
        $("#swapLayout").click(
            function providers() {
            $("#providerGrid").toggleClass("hidden grid");
            $("#owl").toggleClass("hidden block");
            $("#controls").toggleClass("hidden");
        })
    </script>
</div>

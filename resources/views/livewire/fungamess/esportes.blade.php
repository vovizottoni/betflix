<div>
    <style type="text/css">

        .market-nav.mobile a.option.active {
            border-bottom: 2px solid #000 !important;
        }

        .market-nav a.option.active:hover {
            border-bottom: 2px solid #dc1b27 !important;
        }

        .market-nav a.option.sportbook {
            border-bottom: 2px solid #dc1b27 !important;
        }


        footer {
            display: none;
        }

        footer,
        .copyright {
            display: none !important;
        }

        .game-fscreen {
            margin: 0px auto;
            position: absolute;
            width: calc(100vw - 250px);
            max-width: 100vw;
            right: 0;
            top: 86px;
            height: 100svh;
        }

        @media screen and (max-width: 720px) {
                iframe {
                width: 100%;
                max-height: -webkit-fill-available !important;
                height: 100svh;
                max-height: 100shv;
                padding: 0 !important;
                border-radius: 0px;
                max-width: 100% !important;
                max-height: 100% !important;
            }

            .game-fscreen {
                margin: 0px auto;
                position: absolute;
                width: 100% !important;
                max-width: 100vw;
                right: 0;
                top: 0px;
            }

            nav,
            footer,
            .copyright {
                display: none !important;
            }

            .horizontal-mobile-menu,
            header {
                display: none;
            }
        }

    </style>
    <iframe wire:ignore class="game-fscreen" src="{{$link_iframe}}" width="100%" style="margin: 0 auto;" frameborder="0"></iframe> 
</div>
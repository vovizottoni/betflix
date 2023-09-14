<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background: #090f1e !important;">

<head>
    {{ Vite::useBuildDirectory('/user') }}
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,viewport-fit=cover,shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="only light">
    <title>BrazaBet</title>


    <!-- OG -->
    <meta property="og:title" content="BrazaBet" />
    <meta property="og:url" content="https://www.brazabet.net" />
    <meta property="og:title" content="BrazaBet" />
    <meta property="og:description"
        content="BrazaBet é o melhor lugar para apostas online no Brasil. Oferecemos uma ampla variedade de opções de apostas, além de promoções exclusivas e suporte ao cliente de alta qualidade. Com a nossa plataforma fácil de usar, você pode se divertir e ganhar dinheiro de forma segura e confiável!" />
    <meta property="og:image" content="https://brazabet.net/assets/images/branding/OG.jpg" />
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{ asset('assets/images/branding/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/images/branding/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/branding/favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/branding/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('assets/images/branding/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets/images/branding/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/branding/icons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/images/branding/icons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('assets/images/branding/icons/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200&display=swap"
        rel="stylesheet">
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"
        integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
        integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Tippy.js -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
    <!-- clipboard.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<style type="text/css">
    @media all and (display-mode: standalone) {
        .horizontal-mobile-menu {
            padding-bottom: 70px !important;
        }


    }

    .promotion-bar {
        display: none;
        z-index: 999 !important;
    }

    .red-badget {
        background-color: #e50914;
        border-radius: 17px;
        color: #fff;
        font-size: .7rem;
        font-weight: 800;
        margin: 0.2rem 0;
        padding: 0.075rem 0.5rem;
        text-transform: uppercase;
        height: fit-content;
    }

    .red-badget.green {
        background-color: #5cae4a !important;
    }

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch;
        height: 100%;
        max-height: 100vh;
        min-height: 100%;
    }

    label.btn.gap-2.bg-red-600.hover\:bg-red-700.border-none.remove-focus {
        background: #41761c !important;
    }


    .placeholder {
        animation: wave 1s infinite linear forwards;
        -webkit-animation: wave 1s infinite linear forwards;
        background: #000;
        background: linear-gradient(49deg, #242424 8%, #5c5c5c 18%, #242424 33%);
        background-size: 1800px;
    }

    @keyframes wave {
        0% {
            background-position: -468px 0
        }

        100% {
            background-position: 468px 0
        }
    }

    @-webkit-keyframes wave {
        0% {
            background-position: -468px 0
        }

        100% {
            background-position: 468px 0
        }
    }

    /* Avoid Chrome to see Safari hack */
    @supports (-webkit-touch-callout: none) {
        body {

            min-height: -webkit-fill-available;
        }

        .input:focus,
        textarea:focus,
        input:focus {
            outline: 0px !important;
        }

        .intercom-lightweight-app-launcher.intercom-launcher {
            bottom: 80px;
        }
    }

    .modal-box.terms {
        background: #fff;
        color: #0c1732;
    }



    li.provider-cards {
        background: #ffffff0f !important;
        border-radius: 7px !important;
        border: 1px solid #ffffff17 !important;
    }

    .main-section {
        max-width: 100vw !important;
    }
</style>

<body id="main" class="font-sans antialiased custom-scroll overflow-y-scroll text-white bg-[#090f1e]">
    <div>
        <div class="md:h-[85px]">
            @unless (\Route::current()->getName() == 'player.accounts')
                @include('components.layout.header')
            @endunless
        </div>
        <div class="content-box" style="width: 100%;">
            <div class="hidden lg:grid md:grid-cols-1" style="max-width: 100%; width: 250px;">
                <div class="main-menu fixed" style="height: 100%; border-right: 1px solid #ffffff30; width: 250px;">

                    <div class="" style="margin-top: 30px;">

                        <div style="padding: 15px 25px;">
                            @auth
                                <a href="{{ url('bonus') }}"
                                    style="display: block; text-align: center; background: linear-gradient(45deg, #00d6f7, #0869f0); width: fit-content; margin: 0 auto; padding: 8px 25px; border-radius: 5px; font-size: 13px; font-weight: 800; width: 100%; max-width: 100%; margin-bottom: 40px;">💵
                                    Ganhe $ Grátis</a>
                            @else
                                <a href="{{ url('register') }}"
                                    style="display: block; text-align: center; background: linear-gradient(45deg, #00d6f7, #0869f0); width: fit-content; margin: 0 auto; padding: 8px 25px; border-radius: 5px; font-size: 13px; font-weight: 800; width: 100%; max-width: 100%; margin-bottom: 40px;">💵
                                    Ganhe $ Grátis</a>
                            @endauth
                        </div>

                        <div class="mobile-market-nav gap-8">
                            <a class="flex gap-2 option uppercase text-xs font-medium casino"
                                style="justify-content: flex-start; height: fit-content !important; padding: 15px 25px; border-bottom: 1px solid #ffffff1c; width: 100%;"
                                href="{{ url('games') }}">
                                <svg width="20" height="15" viewBox="0 0 20 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_310:1614)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.9098 11.6999L8.50983 0.679922C8.46867 0.552431 8.40232 0.434509 8.31471 0.333157C8.2271 0.231805 8.12002 0.14909 7.99983 0.0899224C7.87947 0.0329628 7.74798 0.00341797 7.61483 0.00341797C7.48167 0.00341797 7.35018 0.0329628 7.22983 0.0899224L0.619826 2.88992C0.493193 2.94358 0.378991 3.02278 0.284356 3.12258C0.189721 3.22238 0.11669 3.34062 0.0698257 3.46992C-0.0297857 3.73762 -0.0297857 4.03222 0.0698257 4.29992L4.46983 15.2999C4.57246 15.5621 4.7734 15.7738 5.02983 15.8899C5.15209 15.9464 5.28515 15.9756 5.41983 15.9756C5.5545 15.9756 5.68757 15.9464 5.80983 15.8899L12.3698 13.0799C12.4946 13.0251 12.6069 12.9454 12.6997 12.8457C12.7926 12.746 12.8641 12.6283 12.9098 12.4999C13.0074 12.2422 13.0074 11.9577 12.9098 11.6999ZM9.06983 8.61992C8.93162 8.86983 8.73468 9.08235 8.496 9.23915C8.25732 9.39595 7.98407 9.49231 7.69983 9.51992L8.55983 10.2399L6.76983 10.9999L6.88983 9.85992C6.67818 10.0484 6.42277 10.181 6.14682 10.2456C5.87088 10.3102 5.58316 10.3048 5.30983 10.2299C3.30983 9.45992 4.59983 6.85992 5.59983 5.44992C7.27983 5.71992 9.84982 6.91992 9.06983 8.61992Z"
                                            fill="#8C9099"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.64 5.7698L11 1.5998C11.07 1.45195 11.1686 1.3194 11.29 1.2098C11.4911 1.05154 11.7452 0.976385 12 0.999805L19.1 2.0798C19.2361 2.09929 19.3668 2.14665 19.4838 2.21892C19.6008 2.29118 19.7016 2.3868 19.78 2.4998C19.9514 2.729 20.0267 3.01597 19.99 3.2998C19.7 5.8898 18.99 12.4698 18.65 15.0598C18.6206 15.3369 18.4843 15.5917 18.27 15.7698C18.1671 15.8558 18.0467 15.9182 17.9171 15.9528C17.7876 15.9873 17.652 15.9931 17.52 15.9698L11.33 14.9998L13.9 13.8998C14.359 13.6907 14.718 13.3102 14.9 12.8398C15.0853 12.3535 15.0853 11.8161 14.9 11.3298L14.56 10.4698C15.4643 10.0656 16.2545 9.44374 16.86 8.6598C17.156 8.28955 17.3397 7.84222 17.3893 7.37079C17.439 6.89936 17.3524 6.42358 17.14 5.9998C16.8902 5.70621 16.546 5.50872 16.1665 5.44121C15.7869 5.37369 15.3957 5.44037 15.06 5.62981C14.7971 5.35867 14.4491 5.18593 14.0742 5.14043C13.6993 5.09493 13.3201 5.17943 13 5.37981C12.8533 5.4823 12.7304 5.61535 12.64 5.7698Z"
                                            fill="#414952"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_310:1614">
                                            <rect width="20" height="16" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                Cassino
                            </a>
                            <a class="flex gap-2 option uppercase text-xs font-medium live"
                                style="justify-content: flex-start; height: fit-content !important; padding: 15px 25px; border-bottom: 1px solid #ffffff1c; width: 100%;"
                                href="{{ url('providers/games/first-person-lobby-1006822') }}">
                                <svg width="20" height="15" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M18.75 5H1.25C0.918479 5 0.600537 5.1317 0.366117 5.36612C0.131696 5.60054 0 5.91848 0 6.25L0 18.75C0 19.0815 0.131696 19.3995 0.366117 19.6339C0.600537 19.8683 0.918479 20 1.25 20H18.75C19.0815 20 19.3995 19.8683 19.6339 19.6339C19.8683 19.3995 20 19.0815 20 18.75V6.25C20 5.91848 19.8683 5.60054 19.6339 5.36612C19.3995 5.1317 19.0815 5 18.75 5ZM15 18.12C15 18.2854 14.935 18.4441 14.819 18.562C14.703 18.6798 14.5453 18.7474 14.38 18.75H1.88C1.71291 18.75 1.55267 18.6836 1.43452 18.5655C1.31637 18.4473 1.25 18.2871 1.25 18.12V6.88C1.25 6.71291 1.31637 6.55267 1.43452 6.43452C1.55267 6.31637 1.71291 6.25 1.88 6.25H14.38C14.5453 6.25262 14.703 6.32016 14.819 6.43802C14.935 6.55589 15 6.71463 15 6.88V18.12ZM17.5 15C17.2528 15 17.0111 14.9267 16.8055 14.7893C16.6 14.652 16.4398 14.4568 16.3451 14.2284C16.2505 13.9999 16.2258 13.7486 16.274 13.5061C16.3223 13.2637 16.4413 13.0409 16.6161 12.8661C16.7909 12.6913 17.0137 12.5722 17.2561 12.524C17.4986 12.4758 17.7499 12.5005 17.9784 12.5952C18.2068 12.6898 18.402 12.85 18.5393 13.0555C18.6767 13.2611 18.75 13.5028 18.75 13.75C18.75 14.0815 18.6183 14.3995 18.3839 14.6339C18.1495 14.8683 17.8315 15 17.5 15ZM17.5 10C17.2528 10 17.0111 9.92669 16.8055 9.78934C16.6 9.65199 16.4398 9.45676 16.3451 9.22835C16.2505 8.99995 16.2258 8.74861 16.274 8.50614C16.3223 8.26366 16.4413 8.04093 16.6161 7.86612C16.7909 7.6913 17.0137 7.57225 17.2561 7.52402C17.4986 7.47579 17.7499 7.50054 17.9784 7.59515C18.2068 7.68976 18.402 7.84998 18.5393 8.05554C18.6767 8.2611 18.75 8.50277 18.75 8.75C18.75 9.08152 18.6183 9.39946 18.3839 9.63388C18.1495 9.8683 17.8315 10 17.5 10Z"
                                            fill="#8C9099"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.64995 14.8C7.28311 14.9624 6.87832 15.0194 6.48091 14.9646C6.08351 14.9099 5.70921 14.7455 5.39995 14.49C3.87995 13 7.09995 9.39 8.12995 8.75C9.12995 9.39 12.3699 12.97 10.8499 14.49C10.5407 14.7455 10.1664 14.9099 9.76898 14.9646C9.37158 15.0194 8.96678 14.9624 8.59995 14.8L9.33995 16.25H6.90995L7.64995 14.8Z"
                                            fill="#414952"></path>
                                        <path
                                            d="M10.62 6.25003C10.4561 6.24677 10.2992 6.1826 10.18 6.07003L5.18003 1.07003C5.06455 0.95067 5 0.7911 5 0.625027C5 0.458955 5.06455 0.299385 5.18003 0.180027C5.29938 0.0645548 5.45895 0 5.62503 0C5.7911 0 5.95067 0.0645548 6.07003 0.180027L11.07 5.18003C11.1855 5.29938 11.2501 5.45895 11.2501 5.62503C11.2501 5.7911 11.1855 5.95067 11.07 6.07003C10.9483 6.18492 10.7874 6.24927 10.62 6.25003Z"
                                            fill="#8C9099"></path>
                                        <path
                                            d="M10.62 6.25001C10.4561 6.24675 10.2992 6.18258 10.18 6.07001C10.0646 5.95065 10 5.79108 10 5.62501C10 5.45894 10.0646 5.29937 10.18 5.18001L13.93 1.43001C14.0498 1.32086 14.207 1.26204 14.369 1.26579C14.531 1.26954 14.6853 1.33557 14.7999 1.45015C14.9145 1.56473 14.9805 1.71905 14.9842 1.88104C14.988 2.04304 14.9292 2.20025 14.82 2.32001L11.07 6.07001C10.9483 6.18491 10.7874 6.24925 10.62 6.25001Z"
                                            fill="#8C9099"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="20" height="20" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                Live TV
                            </a>
                            {{--
                                <a class="flex gap-2 option uppercase text-xs font-medium sportbook" style="justify-content: flex-start; height: fit-content !important; padding: 15px 25px; border-bottom: 1px solid #ffffff1c; width: 100%;" href="{{url('esportes')}}">
                                    <svg width="20" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_3563_7195)">
                                            <path d="M4.53003 2.72996C5.17161 1.83216 5.97542 1.06226 6.90003 0.459961C5.61221 0.881038 4.42441 1.56172 3.41003 2.45996C3.55244 2.54705 3.70768 2.61117 3.87003 2.64996C4.08778 2.69276 4.30837 2.7195 4.53003 2.72996Z" fill="#8C9099"></path>
                                            <path d="M5.80005 2.78C7.54807 2.70392 9.28708 2.48655 11 2.13C12.9719 1.73021 15.0197 1.96475 16.85 2.8C15.0844 1.09431 12.7531 0.0976949 10.3 0C10.2672 0.0547884 10.2237 0.102469 10.1722 0.140246C10.1207 0.178023 10.0622 0.205138 10 0.22C8.36595 0.611093 6.89647 1.50678 5.80005 2.78Z" fill="#8C9099"></path>
                                            <path d="M18.85 13.8001C18.369 13.0798 17.7825 12.4359 17.11 11.8901C14.9212 10.11 12.4321 8.73513 9.76 7.83005C8.01574 7.20818 6.1964 6.82144 4.35 6.68005C4.35 6.80005 4.28 6.93005 4.25 7.06005C5.30422 7.53753 6.18707 8.32617 6.78 9.32005C11.19 16.0301 14.63 17.1601 16.28 17.2301H16.77C17.7108 16.3348 18.4683 15.2649 19 14.0801L18.85 13.8001Z" fill="#414952"></path>
                                            <path d="M11.2899 3.63004C9.31767 4.05524 7.30743 4.27971 5.28995 4.30004L5.06995 4.71004C6.88439 4.90456 8.66986 5.31065 10.3899 5.92004C13.2973 6.90807 16.006 8.40465 18.3899 10.34C18.871 10.751 19.319 11.199 19.7299 11.68C19.8388 11.1261 19.9024 10.5643 19.9199 10C19.9195 8.624 19.637 7.26266 19.0899 6.00004C16.9999 4.44004 13.6499 3.18004 11.2899 3.63004Z" fill="#414952"></path>
                                            <path d="M5.08994 10.44C4.78784 9.94969 4.398 9.51917 3.93994 9.17004V9.81004C3.86994 13.69 5.30994 17.47 7.50994 19.23L8.39994 19.87C10.4479 20.2108 12.5512 19.8848 14.3999 18.94C12.1299 18.24 8.84994 16.16 5.08994 10.44Z" fill="#8C9099"></path>
                                            <path d="M2.34002 3.5C1.99238 3.90746 1.67804 4.34219 1.40002 4.8C2.00812 4.69648 2.62325 4.63964 3.24002 4.63H3.48002C3.56002 4.47 3.63002 4.3 3.71002 4.14C3.29037 4.05441 2.89026 3.89165 2.53002 3.66L2.34002 3.5Z" fill="#414952"></path>
                                            <path d="M1.88999 9.76996V9.57996C1.75848 9.75142 1.64458 9.93568 1.54999 10.13C1.11323 11.0248 0.877717 12.0044 0.859985 13V14.22C1.53951 15.7013 2.5691 16.9951 3.85999 17.99C2.49547 15.4695 1.81619 12.6351 1.88999 9.76996Z" fill="#8C9099"></path>
                                            <path d="M2 7H2.19L2.25 6.75C1.71665 6.78348 1.18764 6.86718 0.67 7L0.34 7.1C0.178232 7.6525 0.0644761 8.21793 0 8.79C0.453518 7.99111 1.15589 7.36248 2 7Z" fill="#414952"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3563_7195">
                                                <rect width="19.92" height="20" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    Esportes
                                </a>
                                --}}
                        </div>

                        <div class="px-8 mt-4 py-4 flex gap-4">
                            <h3 class="font-bold text-xs uppercase flex">Mais acessados hoje</h3>
                        </div>

                        <div class="p-8 pt-2">
                            <div class="games-list grid gap-2">
                                <a href="{{ url('providers/games/live-dragon-tiger-1001512') }}"
                                    class="game flex gap-4">
                                    <p class="font-bold text-xl top-games-count">1</p>
                                    <div>
                                        <p class="font-bold text-sm" style="align-self: center;">Dragon Tiger</p>
                                        <p class="text-[10px]">Evolution</p>
                                    </div>
                                </a>
                                <a href="{{ url('providers/games/mines-1020445') }}" class="game flex gap-4">
                                    <p class="font-bold text-xl top-games-count">2</p>
                                    <div>
                                        <p class="font-bold text-sm" style="align-self: center;">Mines</p>
                                        <p class="text-[10px]">Spribe</p>
                                    </div>
                                </a>
                                <a href="{{ url('providers/games/roleta-ao-vivo-1018110') }}"
                                    class="game flex gap-4">
                                    <p class="font-bold text-xl top-games-count">3</p>
                                    <div>
                                        <p class="font-bold text-sm" style="align-self: center;">Roleta Brasileira</p>
                                        <p class="text-[10px]">Evolution</p>
                                    </div>
                                </a>
                                <a href="{{ url('providers/games/bac-bo-1006861') }}" class="game flex gap-4">
                                    <p class="font-bold text-xl top-games-count">4</p>
                                    <div>
                                        <p class="font-bold text-sm" style="align-self: center;">Bac Bo</p>
                                        <p class="text-[10px]">Evolution</p>
                                    </div>
                                </a>
                                <a href="{{ url('providers/games/live-spaceman-1007025') }}" class="game flex gap-4">
                                    <p class="font-bold text-xl top-games-count">5</p>
                                    <div>
                                        <p class="font-bold text-sm" style="align-self: center;">Spaceman</p>
                                        <p class="text-[10px]">Pragmatic</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


            <div class="content col-span-full lg:col-span-1 mx-auto w-full">
                @if (Route::is('fgames.esportes'))
                    <div>
                    @else
                        <main>
                @endif
                {{ $slot }}
                @if (Route::is('fgames.esportes'))
            </div>
        @else
            </main>
            @endif

            <footer>


                <div
                    class="px-1 bg-[#090F1E] text-gray-500 flex flex-col justify-center items-center pb-12 mt-10 max-w-[1400px] sm:max-w-[600px] lg:max-w-[1400px] mx-auto">
                    <div class="flex gap-4 items-center justify-center w-full col-span-full mb-8">
                        <img src="{{ asset('/assets/images/branding/horizontal-branding.png') }}" class="h-8">
                        <div class="h-px bg-gradient-to-r from-white/50 to-transparent w-full"></div>
                    </div>

                    <div class="footer pt-8 pb-4 w-full">

                        <div>
                            <h1 class="text-white">Suporte 24/7</h1>
                            <p class="text-xs">Entre em contato se você ainda tiver dúvidas!</p>

                            <div class="flex gap-4 text-base-400 mt-4">
                                <a href="https://www.instagram.com/brazabet.br" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-8 social-icon"
                                        viewBox="0 0 448 512">
                                        <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path
                                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                    </svg>
                                </a>
                            </div>

                        </div>


                        <div>
                            <p class="footer-title">Suporte</p>
                            <label for="payments"><a class="link link-hover">Dúvidas sobre pagamentos</a></label>
                            <p class="link link-hover cursor-not-allowed">Parcerias</p>
                        </div>

                        <div>
                            <p class="footer-title">Informações</p>
                            <p class="link link-hover cursor-not-allowed">Sobre a casa</p>
                            <p class="link link-hover cursor-not-allowed">{{ __('app.bonuses_and_sales') }}</p>
                            <p class="link link-hover cursor-not-allowed">Canal do Telegram</p>
                        </div>

                        <div>
                            <p class="footer-title">Legal</p>
                            <label for="terms"><a
                                    class="link link-hover">{{ __('app.terms_of_service') }}</a></label>
                                    <label for="privacy"><a
                                        class="link link-hover">Política de Privacidade</a></label>
                                        <label for="risk"><a
                                            class="link link-hover">Jogo Respos&aacute;vel</a></label>
                        </div>

                        <div>
                            {{-- <p class="footer-title">Status</p>
                                @if (!Auth::check())
                                <div class="flex text-base-600">
                                    <svg class="pulse red " x="0px" y="0px" viewBox="30 30 50 50" style="width: 25px;">
                                        <circle class="pulse-disk" cx="50" cy="50" />
                                        <circle class="pulse-circle" cx="50" cy="50" stroke-width="2" />
                                        <circle class="pulse-circle-2" cx="50" cy="50"  stroke-width="2" />
                                    </svg>
                                    {{__("app.inactive_to_play")}}
                                </div>
                                @endif
                                @auth
                                <div class="flex text-base-600">
                                    <svg class="pulse green" x="0px" y="0px" viewBox="30 30 50 50" style="width: 25px;">
                                        <circle class="pulse-disk" cx="50" cy="50" />
                                        <circle class="pulse-circle" cx="50" cy="50" stroke-width="2" />
                                        <circle class="pulse-circle-2" cx="50" cy="50"  stroke-width="2" />
                                    </svg>
                                    {{__("app.active_to_play")}}
                                </div>
                                @if (Auth::user()->kyc_status == 'not_verified')
                                <div class="flex text-base-600">
                                    <svg class="pulse red" x="0px" y="0px" viewBox="30 30 50 50" style="width: 25px;">
                                        <circle class="pulse-disk" cx="50" cy="50" />
                                        <circle class="pulse-circle" cx="50" cy="50" stroke-width="2" />
                                        <circle class="pulse-circle-2" cx="50" cy="50"  stroke-width="2" />
                                    </svg>
                                    {{__("app.kyc_not_verified")}}
                                </div>
                                @elseif ((Auth::user()->kyc_status == 'verified'))
                                <div class="flex text-base-600">
                                    <svg class="pulse green" x="0px" y="0px" viewBox="30 30 50 50" style="width: 25px;">
                                        <circle class="pulse-disk" cx="50" cy="50" />
                                        <circle class="pulse-circle" cx="50" cy="50" stroke-width="2" />
                                        <circle class="pulse-circle-2" cx="50" cy="50"  stroke-width="2" />
                                    </svg>
                                    {{__("app.kyc_verified")}}
                                </div>
                                @elseif ((Auth::user()->kyc_status == 'under_verification'))
                                <div class="flex text-base-600">
                                    <svg class="pulse yellow" x="0px" y="0px" viewBox="30 30 50 50" style="width: 25px;">
                                        <circle class="pulse-disk" cx="50" cy="50" />
                                        <circle class="pulse-circle" cx="50" cy="50" stroke-width="2" />
                                        <circle class="pulse-circle-2" cx="50" cy="50"  stroke-width="2" />
                                    </svg>
                                    {{__("app.kyc_under_analysis")}}
                                </div>
                                @elseif ((Auth::user()->kyc_status == 'failed_verification'))
                                <div class="flex text-base-600">
                                    <svg class="pulse red" x="0px" y="0px" viewBox="30 30 50 50" style="width: 25px;">
                                        <circle class="pulse-disk" cx="50" cy="50" />
                                        <circle class="pulse-circle" cx="50" cy="50" stroke-width="2" />
                                        <circle class="pulse-circle-2" cx="50" cy="50"  stroke-width="2" />
                                    </svg>
                                    {{__("app.kyc_verification_failed")}}
                                </div>
                                @endif
                                @endauth --}}
                            {{-- <!--
                                    <a class="link link-hover flex">
                                        <svg class="pulse purple" x="0px" y="0px" viewBox="30 30 50 50" style="width: 25px;">
                                            <circle class="pulse-disk" cx="50" cy="50" />
                                            <circle class="pulse-circle" cx="50" cy="50" stroke-width="2" />
                                            <circle class="pulse-circle-2" cx="50" cy="50"  stroke-width="2" />
                                        </svg>
                                        Em verificação
                                    </a>

                                    <a class="link link-hover flex">
                                        <svg class="pulse green" x="0px" y="0px" viewBox="30 30 50 50" style="width: 25px;">
                                            <circle class="pulse-disk" cx="50" cy="50" />
                                            <circle class="pulse-circle" cx="50" cy="50" stroke-width="2" />
                                            <circle class="pulse-circle-2" cx="50" cy="50"  stroke-width="2" />
                                        </svg>
                                        Verificada
                                    </a>
                                    --> --}}
                            @include('components.ui.buttons.select-language-button')
                        </div>
                    </div>


                </div>
                <div class="flex gap-4 items-center justify-center w-full col-span-full">
                    <div class="h-px bg-gradient-to-r from-white/50 to-transparent w-full"></div>
                </div>

            </footer>

            <div class="copyright grid grid-cols-5">
                <p class="col-span-5 md:text-center opacity-50 max-w-4xl py-6 px-8 md:px-0 text-sm mx-auto">© 2023
                    BrazaBet é membro da CIGA (Curação Internet Gaming Association), que estabelece os requerimentos
                    para a Licença de Gambling, e é registrado sob a licença 8048/JAZ.</p>
            </div>
        </div>
    </div>


    <div class="horizontal-mobile-menu block md:hidden p-2 py-2 z-50"
        style="background: #060B16; position: fixed; bottom: 0; width: 100%; height: 62px; box-shadow: 0px -13px 20px 0px #060B16;">
        <div class="grid grid-cols-5">
            <div class="text-center opacity-[0.4]">
                <a href="{{ url('games') }}">
                    <div class="text-center mx-auto w-full mt-[-5px]">
                        <svg fill="none" class="w-5 5-6 mx-auto" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold mt-[3px]" style="line-height: 12px;">Jogos<br>Lucrativos</p>
                </a>
            </div>
            <div class="text-center opacity-[0.4]">
                <a href="{{ url('providers/games/first-person-lobby-1006822') }}">
                    <div class="text-center mx-auto w-full mt-[-5px]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 5-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold mt-[3px]" style="line-height: 12px;">Cassino<br>Ao vivo</p>
                </a>
            </div>
            <div class="text-center">
                <a href="{{ route('games') }} ">
                    <img src="{{ asset('/assets/images/branding/favicon.png') }}" onclick="vibrate()"
                        style="width: 40px; margin: 0 auto; margin-top: -5px;">
                </a>
            </div>
            <label for="depo-modal" class="text-center opacity-[0.4] mt-[-5px]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mx-auto">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg>
                <p class="text-xs font-semibold mt-[2px]" style="line-height: 12px;">Depósito<br>Instantâneo</p>
            </label>
            <div class="text-center opacity-[0.4]">
                <a>
                    <div class="text-center mx-auto w-full mt-[-5px]">
                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold mt-[2px]" style="line-height: 12px;">N da Sorte<br><span
                            style="background: #5dfff0; color: #000; border-radius: 5px; padding: 0 2px; font-size: 9px;">Em
                            Breve</span></p>
                </a>
            </div>
        </div>
    </div>

    @stack('modals')
    @livewireScripts
    @stack('scripts')

    <div id="mySidenav" onclick="showHideSide()" class="sidenav -left-[100vw]">
        <a href="javascript:void(0)" class="sideNavBtn absolute right-4 top-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 fill-current" viewBox="0 0 512 512">
                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
            </svg>
        </a>
        <div class="">

            <div style="padding: 15px 25px;">
                <a @if (Auth::check()) href="/games" @else href="/" @endif
                    class="md:max-w-[150px] logo relative">
                    <img src="{{ asset('assets/images/branding/horizontal-branding.png') }}"
                        style="max-height: 40px;">
                    <img src="https://em-content.zobj.net/source/animated-noto-color-emoji/356/fire_1f525.gif"
                        class="fire-touch" style="max-height: 40px; position: absolute; top: -10px; left: -13px;">
                </a>
            </div>

            <div class="mobile-market-nav gap-8">
                <a class="flex shrink-0 gap-2 option uppercase text-xs font-medium casino"
                    style="justify-content: flex-start; height: fit-content !important; padding: 15px 25px; border-bottom: 1px solid #ffffff1c; width: 100%;"
                    href="{{ url('games') }}">
                    <svg width="20" height="15" viewBox="0 0 20 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_310:1614)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.9098 11.6999L8.50983 0.679922C8.46867 0.552431 8.40232 0.434509 8.31471 0.333157C8.2271 0.231805 8.12002 0.14909 7.99983 0.0899224C7.87947 0.0329628 7.74798 0.00341797 7.61483 0.00341797C7.48167 0.00341797 7.35018 0.0329628 7.22983 0.0899224L0.619826 2.88992C0.493193 2.94358 0.378991 3.02278 0.284356 3.12258C0.189721 3.22238 0.11669 3.34062 0.0698257 3.46992C-0.0297857 3.73762 -0.0297857 4.03222 0.0698257 4.29992L4.46983 15.2999C4.57246 15.5621 4.7734 15.7738 5.02983 15.8899C5.15209 15.9464 5.28515 15.9756 5.41983 15.9756C5.5545 15.9756 5.68757 15.9464 5.80983 15.8899L12.3698 13.0799C12.4946 13.0251 12.6069 12.9454 12.6997 12.8457C12.7926 12.746 12.8641 12.6283 12.9098 12.4999C13.0074 12.2422 13.0074 11.9577 12.9098 11.6999ZM9.06983 8.61992C8.93162 8.86983 8.73468 9.08235 8.496 9.23915C8.25732 9.39595 7.98407 9.49231 7.69983 9.51992L8.55983 10.2399L6.76983 10.9999L6.88983 9.85992C6.67818 10.0484 6.42277 10.181 6.14682 10.2456C5.87088 10.3102 5.58316 10.3048 5.30983 10.2299C3.30983 9.45992 4.59983 6.85992 5.59983 5.44992C7.27983 5.71992 9.84982 6.91992 9.06983 8.61992Z"
                                fill="#8C9099"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.64 5.7698L11 1.5998C11.07 1.45195 11.1686 1.3194 11.29 1.2098C11.4911 1.05154 11.7452 0.976385 12 0.999805L19.1 2.0798C19.2361 2.09929 19.3668 2.14665 19.4838 2.21892C19.6008 2.29118 19.7016 2.3868 19.78 2.4998C19.9514 2.729 20.0267 3.01597 19.99 3.2998C19.7 5.8898 18.99 12.4698 18.65 15.0598C18.6206 15.3369 18.4843 15.5917 18.27 15.7698C18.1671 15.8558 18.0467 15.9182 17.9171 15.9528C17.7876 15.9873 17.652 15.9931 17.52 15.9698L11.33 14.9998L13.9 13.8998C14.359 13.6907 14.718 13.3102 14.9 12.8398C15.0853 12.3535 15.0853 11.8161 14.9 11.3298L14.56 10.4698C15.4643 10.0656 16.2545 9.44374 16.86 8.6598C17.156 8.28955 17.3397 7.84222 17.3893 7.37079C17.439 6.89936 17.3524 6.42358 17.14 5.9998C16.8902 5.70621 16.546 5.50872 16.1665 5.44121C15.7869 5.37369 15.3957 5.44037 15.06 5.62981C14.7971 5.35867 14.4491 5.18593 14.0742 5.14043C13.6993 5.09493 13.3201 5.17943 13 5.37981C12.8533 5.4823 12.7304 5.61535 12.64 5.7698Z"
                                fill="#414952"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_310:1614">
                                <rect width="20" height="16" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                    Cassino
                </a>
                <a class="flex shrink-0 gap-2 option uppercase text-xs font-medium live"
                    style="justify-content: flex-start; height: fit-content !important; padding: 15px 25px; border-bottom: 1px solid #ffffff1c; width: 100%;"
                    href="{{ url('providers/games/first-person-lobby-1006822') }}">
                    <svg width="20" height="15" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                            <path
                                d="M18.75 5H1.25C0.918479 5 0.600537 5.1317 0.366117 5.36612C0.131696 5.60054 0 5.91848 0 6.25L0 18.75C0 19.0815 0.131696 19.3995 0.366117 19.6339C0.600537 19.8683 0.918479 20 1.25 20H18.75C19.0815 20 19.3995 19.8683 19.6339 19.6339C19.8683 19.3995 20 19.0815 20 18.75V6.25C20 5.91848 19.8683 5.60054 19.6339 5.36612C19.3995 5.1317 19.0815 5 18.75 5ZM15 18.12C15 18.2854 14.935 18.4441 14.819 18.562C14.703 18.6798 14.5453 18.7474 14.38 18.75H1.88C1.71291 18.75 1.55267 18.6836 1.43452 18.5655C1.31637 18.4473 1.25 18.2871 1.25 18.12V6.88C1.25 6.71291 1.31637 6.55267 1.43452 6.43452C1.55267 6.31637 1.71291 6.25 1.88 6.25H14.38C14.5453 6.25262 14.703 6.32016 14.819 6.43802C14.935 6.55589 15 6.71463 15 6.88V18.12ZM17.5 15C17.2528 15 17.0111 14.9267 16.8055 14.7893C16.6 14.652 16.4398 14.4568 16.3451 14.2284C16.2505 13.9999 16.2258 13.7486 16.274 13.5061C16.3223 13.2637 16.4413 13.0409 16.6161 12.8661C16.7909 12.6913 17.0137 12.5722 17.2561 12.524C17.4986 12.4758 17.7499 12.5005 17.9784 12.5952C18.2068 12.6898 18.402 12.85 18.5393 13.0555C18.6767 13.2611 18.75 13.5028 18.75 13.75C18.75 14.0815 18.6183 14.3995 18.3839 14.6339C18.1495 14.8683 17.8315 15 17.5 15ZM17.5 10C17.2528 10 17.0111 9.92669 16.8055 9.78934C16.6 9.65199 16.4398 9.45676 16.3451 9.22835C16.2505 8.99995 16.2258 8.74861 16.274 8.50614C16.3223 8.26366 16.4413 8.04093 16.6161 7.86612C16.7909 7.6913 17.0137 7.57225 17.2561 7.52402C17.4986 7.47579 17.7499 7.50054 17.9784 7.59515C18.2068 7.68976 18.402 7.84998 18.5393 8.05554C18.6767 8.2611 18.75 8.50277 18.75 8.75C18.75 9.08152 18.6183 9.39946 18.3839 9.63388C18.1495 9.8683 17.8315 10 17.5 10Z"
                                fill="#8C9099"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.64995 14.8C7.28311 14.9624 6.87832 15.0194 6.48091 14.9646C6.08351 14.9099 5.70921 14.7455 5.39995 14.49C3.87995 13 7.09995 9.39 8.12995 8.75C9.12995 9.39 12.3699 12.97 10.8499 14.49C10.5407 14.7455 10.1664 14.9099 9.76898 14.9646C9.37158 15.0194 8.96678 14.9624 8.59995 14.8L9.33995 16.25H6.90995L7.64995 14.8Z"
                                fill="#414952"></path>
                            <path
                                d="M10.62 6.25003C10.4561 6.24677 10.2992 6.1826 10.18 6.07003L5.18003 1.07003C5.06455 0.95067 5 0.7911 5 0.625027C5 0.458955 5.06455 0.299385 5.18003 0.180027C5.29938 0.0645548 5.45895 0 5.62503 0C5.7911 0 5.95067 0.0645548 6.07003 0.180027L11.07 5.18003C11.1855 5.29938 11.2501 5.45895 11.2501 5.62503C11.2501 5.7911 11.1855 5.95067 11.07 6.07003C10.9483 6.18492 10.7874 6.24927 10.62 6.25003Z"
                                fill="#8C9099"></path>
                            <path
                                d="M10.62 6.25001C10.4561 6.24675 10.2992 6.18258 10.18 6.07001C10.0646 5.95065 10 5.79108 10 5.62501C10 5.45894 10.0646 5.29937 10.18 5.18001L13.93 1.43001C14.0498 1.32086 14.207 1.26204 14.369 1.26579C14.531 1.26954 14.6853 1.33557 14.7999 1.45015C14.9145 1.56473 14.9805 1.71905 14.9842 1.88104C14.988 2.04304 14.9292 2.20025 14.82 2.32001L11.07 6.07001C10.9483 6.18491 10.7874 6.24925 10.62 6.25001Z"
                                fill="#8C9099"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="20" height="20" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                    Live TV
                </a>
                {{--
                        <a class="flex gap-2 option uppercase text-xs font-medium sportbook" style="justify-content: flex-start; height: fit-content !important; padding: 15px 25px; border-bottom: 1px solid #ffffff1c; width: 100%;" href="{{url('esportes')}}">
                            <svg width="20" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_3563_7195)">
                                    <path d="M4.53003 2.72996C5.17161 1.83216 5.97542 1.06226 6.90003 0.459961C5.61221 0.881038 4.42441 1.56172 3.41003 2.45996C3.55244 2.54705 3.70768 2.61117 3.87003 2.64996C4.08778 2.69276 4.30837 2.7195 4.53003 2.72996Z" fill="#8C9099"></path>
                                    <path d="M5.80005 2.78C7.54807 2.70392 9.28708 2.48655 11 2.13C12.9719 1.73021 15.0197 1.96475 16.85 2.8C15.0844 1.09431 12.7531 0.0976949 10.3 0C10.2672 0.0547884 10.2237 0.102469 10.1722 0.140246C10.1207 0.178023 10.0622 0.205138 10 0.22C8.36595 0.611093 6.89647 1.50678 5.80005 2.78Z" fill="#8C9099"></path>
                                    <path d="M18.85 13.8001C18.369 13.0798 17.7825 12.4359 17.11 11.8901C14.9212 10.11 12.4321 8.73513 9.76 7.83005C8.01574 7.20818 6.1964 6.82144 4.35 6.68005C4.35 6.80005 4.28 6.93005 4.25 7.06005C5.30422 7.53753 6.18707 8.32617 6.78 9.32005C11.19 16.0301 14.63 17.1601 16.28 17.2301H16.77C17.7108 16.3348 18.4683 15.2649 19 14.0801L18.85 13.8001Z" fill="#414952"></path>
                                    <path d="M11.2899 3.63004C9.31767 4.05524 7.30743 4.27971 5.28995 4.30004L5.06995 4.71004C6.88439 4.90456 8.66986 5.31065 10.3899 5.92004C13.2973 6.90807 16.006 8.40465 18.3899 10.34C18.871 10.751 19.319 11.199 19.7299 11.68C19.8388 11.1261 19.9024 10.5643 19.9199 10C19.9195 8.624 19.637 7.26266 19.0899 6.00004C16.9999 4.44004 13.6499 3.18004 11.2899 3.63004Z" fill="#414952"></path>
                                    <path d="M5.08994 10.44C4.78784 9.94969 4.398 9.51917 3.93994 9.17004V9.81004C3.86994 13.69 5.30994 17.47 7.50994 19.23L8.39994 19.87C10.4479 20.2108 12.5512 19.8848 14.3999 18.94C12.1299 18.24 8.84994 16.16 5.08994 10.44Z" fill="#8C9099"></path>
                                    <path d="M2.34002 3.5C1.99238 3.90746 1.67804 4.34219 1.40002 4.8C2.00812 4.69648 2.62325 4.63964 3.24002 4.63H3.48002C3.56002 4.47 3.63002 4.3 3.71002 4.14C3.29037 4.05441 2.89026 3.89165 2.53002 3.66L2.34002 3.5Z" fill="#414952"></path>
                                    <path d="M1.88999 9.76996V9.57996C1.75848 9.75142 1.64458 9.93568 1.54999 10.13C1.11323 11.0248 0.877717 12.0044 0.859985 13V14.22C1.53951 15.7013 2.5691 16.9951 3.85999 17.99C2.49547 15.4695 1.81619 12.6351 1.88999 9.76996Z" fill="#8C9099"></path>
                                    <path d="M2 7H2.19L2.25 6.75C1.71665 6.78348 1.18764 6.86718 0.67 7L0.34 7.1C0.178232 7.6525 0.0644761 8.21793 0 8.79C0.453518 7.99111 1.15589 7.36248 2 7Z" fill="#414952"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_3563_7195">
                                        <rect width="19.92" height="20" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                            Esportes
                        </a>
                        --}}
            </div>

            <div class="px-8 mt-4 py-4 flex shrink-0 gap-4">
                <h3 class="font-bold text-xs uppercase flex">Mais acessados hoje</h3>
            </div>

            <div class="p-8 pt-2 flex shrink-0">
                <div class="games-list grid gap-2">
                    <a href="{{ url('providers/games/live-dragon-tiger-1001512') }}" class="game flex gap-4">
                        <p class="font-bold text-xl top-games-count">1</p>
                        <div>
                            <p class="font-bold text-sm" style="align-self: center;">Dragon Tiger</p>
                            <p class="text-[10px]">Evolution</p>
                        </div>
                    </a>
                    <a href="{{ url('providers/games/mines-1020445') }}" class="game flex gap-4">
                        <p class="font-bold text-xl top-games-count">2</p>
                        <div>
                            <p class="font-bold text-sm" style="align-self: center;">Mines</p>
                            <p class="text-[10px]">Spribe</p>
                        </div>
                    </a>
                    <a href="{{ url('providers/games/roleta-ao-vivo-1018110') }}" class="game flex gap-4">
                        <p class="font-bold text-xl top-games-count">3</p>
                        <div>
                            <p class="font-bold text-sm" style="align-self: center;">Roleta Brasileira</p>
                            <p class="text-[10px]">Evolution</p>
                        </div>
                    </a>
                    <a href="{{ url('providers/games/bac-bo-1006861') }}" class="game flex gap-4">
                        <p class="font-bold text-xl top-games-count">4</p>
                        <div>
                            <p class="font-bold text-sm" style="align-self: center;">Bac Bo</p>
                            <p class="text-[10px]">Evolution</p>
                        </div>
                    </a>
                    <a href="{{ url('providers/games/live-spaceman-1007025') }}" class="game flex gap-4">
                        <p class="font-bold text-xl top-games-count">5</p>
                        <div>
                            <p class="font-bold text-sm" style="align-self: center;">Spaceman</p>
                            <p class="text-[10px]">Pragmatic</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script>
        function showHideSide() {
            document.getElementById("mySidenav").classList.toggle("-left-[100vw]")
            document.getElementById("mySidenav").classList.toggle("left-0")

        }
    </script>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="terms" class="modal-toggle" />
    <div class="modal modal-bottom">
        <label for="terms" class="fixed right-4 top-2"
            style="background: #ffffffeb; border-radius: 3px; padding: 10px;">
            <svg class="w-6 h-6 text-black cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </label>
        <div class="modal-box terms" style="background: #fff !important;">
            <div class="flex flex-col justify-center max-w-4xl mx-auto  text-justify">
                <p class="text-xs opacity-80"><span class="font-bold">
                        <p class="font-bold text-2xl text-center capitalize mb-20">Termos de Uso</p>
                        
                        
                        <p class="mb-10 text-sm font-semibold">ESTES TERMOS E CONDI&Ccedil;&Otilde;ES S&Atilde;O TRADUZIDOS DO INGL&Ecirc;S PARA O
                            PORTUGU&Ecirc;S. QUALQUER TRADU&Ccedil;&Atilde;O PARA OUTRO IDIOMA &Eacute; APENAS PARA
                            CONVENI&Ecirc;NCIA DO LEITOR. EM CASO DE QUALQUER CONFLITO OU INCONSIST&Ecirc;NCIA, A
                            VERS&Atilde;O EM INGL&Ecirc;S PREVALECER&Aacute; SOBRE QUALQUER VERS&Atilde;O TRADUZIDA.</p>
                        
                        <p  class="font-semibold text-base mb-6 mt-4">1. Introdu&ccedil;&atilde;o</p>
                        
                        <p class="pl-1 mb-4 text-sm">1.1. Ao usar, visitar e/ou acessar qualquer parte do site BrazaBet e/ou qualquer
                            subdom&iacute;nio, site ou aplicativo m&oacute;vel que possu&iacute;mos ou operamos (o
                            &ldquo;Site&rdquo;) e/ou registrar uma conta no Site, voc&ecirc; concorda em estar vinculado
                            por estes Termos e Condi&ccedil;&otilde;es, nossa Pol&iacute;tica de Privacidade, nossa
                            Pol&iacute;tica de Cookies e quaisquer outras regras aplic&aacute;veis aos nossos produtos
                            de apostas ou jogos dispon&iacute;veis no Site (juntos os &apos;Termos&apos;), e
                            considera-se que aceitou e entendeu todos os Termos.</p>
                        
                        <p class="pl-1 mb-4 text-sm">1.2. Voc&ecirc; deve ler os Termos com aten&ccedil;&atilde;o, caso n&atilde;o concorde com
                            eles e/ou n&atilde;o possa aceit&aacute;- los, por favor, n&atilde;o use, visite ou acesse o
                            Site.</p>
                        
                        <p class="pl-1 mb-4 text-sm">1.3. Estes Termos podem ser alterados por n&oacute;s de tempos em tempos por qualquer motivo
                            (incluindo conformidade com a legisla&ccedil;&atilde;o aplic&aacute;vel ou requisitos dos
                            reguladores). A vers&atilde;o atual dos Termos estar&aacute; dispon&iacute;vel no Site. Se
                            voc&ecirc; continuar a usar o Site ap&oacute;s essas altera&ccedil;&otilde;es entrarem em
                            vigor, considera-se que voc&ecirc; aceitou essas altera&ccedil;&otilde;es nos Termos.</p>
                        
                        <p class="pl-1 mb-4 text-sm">1.4. Refer&ecirc;ncia a &rdquo;voc&ecirc;&rdquo;, &rdquo;seu&rdquo;, &rdquo;cliente&rdquo;,
                            &rdquo;usu&aacute;rio&rdquo; ou &rdquo;jogador&rdquo; significa qualquer pessoa que use o
                            Site ou quaisquer servi&ccedil;os dispon&iacute;veis nele e/ou qualquer cliente registrado
                            do Site.</p>
                        
                        <p class="pl-1 mb-4 text-sm">1.5. A refer&ecirc;ncia a &ldquo;jogos&rdquo; significa Cassino, Cassino ao Vivo, Apostas
                            Esportivas, cartas e outros jogos que possam ser disponibilizados de tempos em tempos no
                            Site. BrazaBet se reserva o direito de adicionar e remover Jogos do Site a seu
                            pr&oacute;prio crit&eacute;rio.</p>
                        
                        <p  class="font-semibold text-base mb-6 mt-4">2. Sua Conta</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.1. Requerimentos Legais</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.1.1. Refer&ecirc;ncia &agrave; &ldquo;Conta&rdquo; significa uma conta registrada por
                            voc&ecirc; no Site ap&oacute;s aceitar e concordar com estes Termos. Ao registrar uma Conta,
                            voc&ecirc; declara que tem mais de 18 anos ou uma idade m&iacute;nima legal superior,
                            conforme estipulado na jurisdi&ccedil;&atilde;o de sua resid&ecirc;ncia de acordo com as
                            leis aplic&aacute;veis a voc&ecirc;. &Eacute; de sua exclusiva responsabilidade saber se os
                            servi&ccedil;os dispon&iacute;veis no Site s&atilde;o legais no pa&iacute;s de sua
                            resid&ecirc;ncia. Pessoas menores de 18 anos n&atilde;o est&atilde;o autorizadas a usar o
                            Site e/ou quaisquer servi&ccedil;os nele dispon&iacute;veis.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.1.2. Voc&ecirc; n&atilde;o tem permiss&atilde;o para se registrar no site e usar nossos
                            servi&ccedil;os se for residente de Aruba, Austr&aacute;lia, Bonaire, Cura&ccedil;ao,
                            Fran&ccedil;a, Ir&atilde;, Iraque, Holanda, Saba, Espanha, St Maarten, Statia, EUA ou
                            depend&ecirc;ncias dos EUA, Reino Unido. Reservamo-nos o direito de recusar clientes de
                            quaisquer outros pa&iacute;ses al&eacute;m das jurisdi&ccedil;&otilde;es acima mencionadas,
                            a nosso crit&eacute;rio.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.2. Cadastro de Conta</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.2.1. Para fazer apostas, jogar e depositar dinheiro, voc&ecirc; precisa registrar a conta
                            no site.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.2.2. Para registrar a Conta, voc&ecirc; deve fornecer informa&ccedil;&otilde;es completas e
                            atualizadas, incluindo n&uacute;mero de celular, endere&ccedil;o de e-mail, nome de
                            usu&aacute;rio, senha e outras informa&ccedil;&otilde;es obrigat&oacute;rias solicitadas no
                            formul&aacute;rio de registro.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.2.3. Ao registrar a conta no site, voc&ecirc; concorda em especificar seu nome legal.
                            Podemos tomar medidas para verificar a exatid&atilde;o das informa&ccedil;&otilde;es
                            fornecidas. Voc&ecirc; n&atilde;o tem permiss&atilde;o para alterar esses dados, mas
                            h&aacute; casos em que voc&ecirc; pode solicitar individualmente a altera&ccedil;&atilde;o
                            de dados entrando em contato com o suporte ao cliente do site, como um erro honesto etc.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.2.4. Se voc&ecirc; escolher ou receber um nome de usu&aacute;rio, senha ou qualquer outra
                            informa&ccedil;&atilde;o como parte de nossos procedimentos de seguran&ccedil;a, voc&ecirc;
                            deve tratar essas informa&ccedil;&otilde;es como confidenciais e n&atilde;o deve
                            divulg&aacute;-las a terceiros. N&atilde;o nos responsabilizamos por qualquer abuso ou uso
                            indevido de sua conta por terceiros devido &agrave; sua divulga&ccedil;&atilde;o,
                            intencional ou acidental, ativa ou passiva, de seus detalhes de login a terceiros.
                            N&oacute;s nunca pediremos que voc&ecirc; revele sua senha e nunca iniciaremos contato com
                            voc&ecirc; para solicitar os joggers de mem&oacute;ria associados &agrave; sua senha.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.2.5. Funcion&aacute;rios, ex-funcion&aacute;rios de prestadores de servi&ccedil;os e/ou
                            pessoas afiliadas n&atilde;o est&atilde;o autorizados a registrar as contas no Site e
                            n&atilde;o podem explorar os servi&ccedil;os e promo&ccedil;&otilde;es dispon&iacute;veis no
                            mesmo. As mesmas regras se aplicam aos membros da fam&iacute;lia dos mencionados acima. A
                            viola&ccedil;&atilde;o desta regra resultar&aacute; no encerramento permanente da conta e as
                            referidas contas ser&atilde;o consideradas fraudulentas. Quaisquer ganhos derivados de tais
                            atividades ser&atilde;o considerados perdidos pelo titular da conta e somente o valor
                            depositado ser&aacute; devolvido ao titular da conta.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.2.6. Voc&ecirc; n&atilde;o pode transferir, vender ou penhorar sua conta para outra pessoa.
                            Esta proibi&ccedil;&atilde;o inclui a transfer&ecirc;ncia de quaisquer ativos de valor de
                            qualquer tipo, incluindo, mas n&atilde;o se limitando &agrave; propriedade de contas,
                            ganhos, dep&oacute;sitos, apostas, direitos e/ou reivindica&ccedil;&otilde;es relacionadas a
                            esses ativos, legais, comerciais ou outros. A proibi&ccedil;&atilde;o de tais
                            transfer&ecirc;ncias tamb&eacute;m inclui, mas n&atilde;o se limita a
                            onera&ccedil;&atilde;o, penhor, cess&atilde;o, usufruto, negocia&ccedil;&atilde;o,
                            corretagem, hipoteca e/ou doa&ccedil;&atilde;o em coopera&ccedil;&atilde;o com um
                            fiduci&aacute;rio ou qualquer outro terceiro, empresa, pessoa f&iacute;sica ou
                            jur&iacute;dica, funda&ccedil;&atilde;o e /ou associa&ccedil;&atilde;o de qualquer forma.
                        </p>
                        
                        <p class="pl-1 mb-4 text-sm">2.3. Problemas na Conta</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.3.1. Se voc&ecirc; esquecer sua senha ou achar que algu&eacute;m conhece detalhes de seus
                            dados pessoais, al&eacute;m disso, se voc&ecirc; suspeitar que outro usu&aacute;rio
                            est&aacute; tirando vantagem injusta por meio de trapa&ccedil;a ou conluio, voc&ecirc; deve
                            relatar a suspeita para n&oacute;s.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.3.2. Reservamo-nos o direito de declarar qualquer aposta ou transa&ccedil;&atilde;o anulada
                            parcial ou totalmente se, a nosso crit&eacute;rio, considerarmos &oacute;bvio que ocorreu
                            qualquer uma das seguintes circunst&acirc;ncias:</p>
                        
                        <p class="pl-1 mb-4 text-sm">1) o titular da conta ou pessoas associadas ao titular da conta podem influenciar direta ou
                            indiretamente o resultado de um evento;</p>
                        
                        <p class="pl-1 mb-4 text-sm">2) o titular da conta e/ou pessoas associadas ao titular da conta est&atilde;o direta ou
                            indiretamente evitando as regras do site;</p>
                        
                        <p class="pl-1 mb-4 text-sm">3) o resultado de um evento ou aposta foi direta ou indiretamente afetado por atividade
                            criminosa;</p>
                        
                        <p class="pl-1 mb-4 text-sm">4) as chances de um evento foram alteradas significativamente devido a um an&uacute;ncio
                            p&uacute;blico em rela&ccedil;&atilde;o ao evento;</p>
                        
                        <p class="pl-1 mb-4 text-sm">5) foram feitas apostas que n&atilde;o seriam aceitas de outra forma, mas foram aceitas
                            durante os per&iacute;odos em que o Site foi afetado por problemas t&eacute;cnicos;</p>
                        
                        <p class="pl-1 mb-4 text-sm">6) devido a um erro, como erro, erro de impress&atilde;o, erro t&eacute;cnico, erro humano,
                            for&ccedil;a maior ou outro, as apostas foram oferecidas, colocadas e/ou aceitas devido a
                            esse erro.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.3.3. Quando fechamos ou suspendemos uma Conta por qualquer motivo, nos reservamos o direito
                            de fechar quaisquer Contas futuras que possam ser registradas pela mesma pessoa,dispositivo,
                            endere&ccedil;o ou que possam usar as mesmas carteiras de pagamento ou cart&otilde;es de
                            cr&eacute;dito e anular/cancelar todas as apostas e transa&ccedil;&otilde;es dessas Contas.
                        </p>
                        
                        <p class="pl-1 mb-4 text-sm">2.3.4. Oferecemos autentica&ccedil;&atilde;o de dois fatores (2FA) como
                            prote&ccedil;&atilde;o adicional contra o uso n&atilde;o autorizado de sua conta. Voc&ecirc;
                            &eacute; respons&aacute;vel por manter suas informa&ccedil;&otilde;es de login confidenciais
                            e garantir que elas n&atilde;o possam ser acessadas por outra pessoa.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4. Ao registar a Conta no Site compromete-se, declara e garante que:</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.1. Voc&ecirc; tem mais de 18 anos de idade ou idade m&iacute;nima legal de maioridade,
                            conforme estipulado nas leis da jurisdi&ccedil;&atilde;o aplic&aacute;vel a voc&ecirc; e, de
                            acordo com as leis aplic&aacute;veis a voc&ecirc;, voc&ecirc; tem permiss&atilde;o para
                            participar dos Jogos oferecidos no Site.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.2. Voc&ecirc; usar&aacute; este Site e sua Conta &uacute;nica e exclusivamente para fins
                            de sua participa&ccedil;&atilde;o genu&iacute;na nos Jogos e n&atilde;o para quaisquer
                            opera&ccedil;&otilde;es financeiras ou outras; sua participa&ccedil;&atilde;o nos Jogos
                            ser&aacute; estritamente em sua capacidade pessoal n&atilde;o profissional apenas por
                            motivos recreativos e de entretenimento.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.3. Voc&ecirc; participa dos Jogos em seu pr&oacute;prio nome e n&atilde;o em nome de
                            qualquer outra pessoa;</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.4. Voc&ecirc; n&atilde;o reside em Cura&ccedil;ao, Fran&ccedil;a, Ir&atilde;, Iraque,
                            Holanda, Cor&eacute;ia do Norte, Cingapura, Espanha, Portugal, St Maarten, Statia, EUA ou
                            depend&ecirc;ncias dos EUA, Ucr&acirc;nia, Reino Unido.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.5. Todas as informa&ccedil;&otilde;es que voc&ecirc; fornece &agrave; BrazaBet s&atilde;o
                            verdadeiras, completas e corretas, e voc&ecirc; deve nos notificar imediatamente de qualquer
                            altera&ccedil;&atilde;o dessas informa&ccedil;&otilde;es.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.6. Voc&ecirc; &eacute; o &uacute;nico respons&aacute;vel por relatar e contabilizar
                            quaisquer impostos aplic&aacute;veis a voc&ecirc; sob as leis relevantes para quaisquer
                            ganhos que voc&ecirc; receba da BrazaBet.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.7. Todo o dinheiro que voc&ecirc; deposita em sua conta n&atilde;o est&aacute;
                            contaminado com nenhuma ilegalidade e, em particular, n&atilde;o se origina de nenhuma
                            atividade ou fonte ilegal.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.8. Voc&ecirc; entende que ao participar dos Jogos voc&ecirc; corre o risco de perder
                            dinheiro depositado em sua Conta.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.9. Voc&ecirc; n&atilde;o deve se envolver em nenhuma atividade fraudulenta, colusiva ou
                            outra atividade ilegal em rela&ccedil;&atilde;o &agrave; sua participa&ccedil;&atilde;o ou
                            de terceiros em qualquer um dos Jogos e n&atilde;o deve usar m&eacute;todos ou
                            t&eacute;cnicas assistidas por software ou dispositivos de hardware para sua
                            participa&ccedil;&atilde;o em qualquer um dos jogos. A BrazaBet se reserva o direito de
                            invalidar ou encerrar sua conta ou invalidar sua participa&ccedil;&atilde;o em um jogo no
                            caso de tal comportamento.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.10. Em rela&ccedil;&atilde;o a dep&oacute;sitos e saques de fundos de e para sua Conta,
                            voc&ecirc; deve usar apenas os &nbsp;instrumentos financeiros que sejam v&aacute;lidos e que
                            perten&ccedil;am legalmente a voc&ecirc;.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.11. O software de computador que disponibilizamos para voc&ecirc; &eacute; de propriedade
                            da BrazaBet ou outros terceiros e protegido por direitos autorais e outras leis de
                            propriedade intelectual. Voc&ecirc; s&oacute; pode usar o software para uso pessoal e
                            recreativo de acordo com todas as regras, termos e condi&ccedil;&otilde;es aqui
                            estabelecidos e de acordo com todas as leis, regras e regulamentos aplic&aacute;veis.</p>
                        
                        <p class="pl-1 mb-4 text-sm">2.4.12. Os jogos jogados no Site devem ser jogados da mesma maneira que os jogos jogados em
                            qualquer outro ambiente. Voc&ecirc; deve ser cort&ecirc;s com outros jogadores e
                            representantes da BrazaBet e deve evitar coment&aacute;rios rudes ou obscenos, inclusive em
                            salas de bate-papo.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">3. Contas M&uacute;ltiplas</p>
                        
                        <p class="pl-1 mb-4 text-sm">3.1. Voc&ecirc; pode se inscrever (registrar) e usar apenas uma conta no site.</p>
                        
                        <p class="pl-1 mb-4 text-sm">3.2. Apenas uma conta para cada domic&iacute;lio, endere&ccedil;o IP e computador ou
                            dispositivo &eacute; permitida. Se dois ou mais usu&aacute;rios compartilharem o mesmo
                            domic&iacute;lio, endere&ccedil;o IP e computador ou dispositivo, devemos ser informados
                            antecipadamente pelos respectivos titulares das contas.</p>
                        
                        <p class="pl-1 mb-4 text-sm">3.3. Se voc&ecirc; se inscrever ou tentar registrar mais de uma conta, por qualquer motivo,
                            poderemos bloquear ou fechar uma ou todas as suas contas a nosso crit&eacute;rio.
                            Tamb&eacute;m podemos anular todas as apostas que foram feitas nas Contas duplicadas,
                            bloquear b&ocirc;nus e presentes e anular solicita&ccedil;&otilde;es de saque. Al&eacute;m
                            disso, quaisquer retornos, ganhos ou b&ocirc;nus obtidos ou acumulados durante o ciclo de
                            vida da conta duplicada ser&atilde;o perdidos.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">4. Pagamentos</p>
                        
                        <p class="pl-1 mb-4 text-sm">4.1. Quando o resultado de um Jogo do qual voc&ecirc; participa for determinado ou, quando
                            aplic&aacute;vel, a BrazaBet confirmou o resultado relevante de um evento e liquidou os
                            mercados; todos os ganhos estar&atilde;o dispon&iacute;veis em sua conta.</p>
                        
                        <p class="pl-1 mb-4 text-sm">4.2. Se a BrazaBet creditar por engano em sua Conta ganhos que n&atilde;o pertencem a
                            voc&ecirc;, seja devido a um erro t&eacute;cnico ou humano ou de outra forma, o valor
                            permanecer&aacute; propriedade da BrazaBet e o valor ser&aacute; deduzido de sua Conta. Se
                            antes da BrazaBet tomar conhecimento do erro, voc&ecirc; retirou fundos que n&atilde;o lhe
                            pertencem, sem preju&iacute;zo de outros recursos e a&ccedil;&otilde;es que possam estar
                            dispon&iacute;veis em lei, o valor pago erroneamente constituir&aacute; uma d&iacute;vida
                            por voc&ecirc; com a BrazaBet. Em caso de cr&eacute;dito incorreto, voc&ecirc; &eacute;
                            obrigado a notificar a BrazaBet imediatamente.</p>
                        
                        <p class="pl-1 mb-4 text-sm">4.3. A BrazaBet realizar&aacute; procedimentos adicionais de verifica&ccedil;&atilde;o e
                            identifica&ccedil;&atilde;o para qualquer retirada ou se reserva o direito de realizar tais
                            procedimentos de verifica&ccedil;&atilde;o em qualquer n&iacute;vel de retirada. Todas as
                            transa&ccedil;&otilde;es ser&atilde;o verificadas para evitar a lavagem de dinheiro.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">5. Encerramento da Conta</p>
                        
                        <p class="pl-1 mb-4 text-sm">5.1. Voc&ecirc; pode encerrar sua Conta a qualquer momento e solicitar a retirada do saldo da
                            Conta, sujeito &agrave; dedu&ccedil;&atilde;o das taxas de retirada relevantes. Para fechar
                            sua conta, voc&ecirc; deve primeiro cancelar todas as apostas abertas, se aplic&aacute;vel,
                            e entrar em contato com o suporte ao cliente do site. O encerramento efetivo da Conta
                            corresponder&aacute; ao encerramento da BrazaBet.</p>
                        
                        <p class="pl-1 mb-4 text-sm">5.2. O m&eacute;todo de reembolso ser&aacute; a nosso crit&eacute;rio absoluto.</p>
                        
                        <p class="pl-1 mb-4 text-sm">5.3. BrazaBet reserva-se o direito de encerrar a sua Conta e reembolsar-lhe o saldo
                            &apos;Dispon&iacute;vel para levantamento&apos;, sujeito &agrave; dedu&ccedil;&atilde;o das
                            taxas de levantamento relevantes, a crit&eacute;rio absoluto da BrazaBet e sem qualquer
                            obriga&ccedil;&atilde;o de indicar uma raz&atilde;o ou dar aviso pr&eacute;vio</p>
                        
                        <p class="pl-1 mb-4 text-sm">5.4. A BrazaBet reserva-se o direito de cancelar e remover qualquer valor de b&ocirc;nus
                            concedido a voc&ecirc; se n&atilde;o for usado dentro de 1 m&ecirc;s a partir da data de
                            concess&atilde;o.</p>
                        
                        <p class="pl-1 mb-4 text-sm">5.5. A BrazaBet reserva-se o direito de recusar um pedido de levantamento em caso de fraude,
                            caso em que uma Conta ser&aacute; suspensa e o pagamento n&atilde;o processado.</p>
                        
                        <p class="pl-1 mb-4 text-sm">5.6. A BrazaBet revisar&aacute; todas as contas de jogadores e as classificar&aacute; a seu
                            crit&eacute;rio. Assim que um jogador for classificado como &ldquo;ca&ccedil;ador de
                            b&ocirc;nus&rdquo; ou &ldquo;abusador de b&ocirc;nus&rdquo;, todos os ganhos e b&ocirc;nus
                            ser&atilde;o anulados e a conta ser&aacute; suspensa e o pagamento n&atilde;o processado.
                        </p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">6. Informa&ccedil;&otilde;es Pessoais</p>
                        
                        <p class="pl-1 mb-4 text-sm">6.1. Atividade Criminal No caso de qualquer irregularidade (incluindo suspeita de tentativa
                            de lavagem de dinheiro ou fraude) foi detectada, a BrazaBet reserva-se o direito de fechar
                            Contas e/ou relatar sobre atividades criminosas ou outras atividades suspeitas fornecidas
                            atrav&eacute;s de uma ou v&aacute;rias Contas para autoridades reguladoras ou de
                            aplica&ccedil;&atilde;o da lei relevantes existentes. Todos os saldos da conta dos
                            infratores ser&atilde;o bloqueados, os saques ser&atilde;o anulados, os dep&oacute;sitos e
                            ganhos ser&atilde;o perdidos.</p>
                        
                        <p class="pl-1 mb-4 text-sm">6.2. Conluio e trapa&ccedil;a. A BrazaBet &eacute; eleg&iacute;vel para desativar as contas
                            dos usu&aacute;rios e perder os saldos de suas contas (incluindo dep&oacute;sitos e ganhos)
                            se eles forem notados de ganhos, tentando obter uma vantagem de negociar
                            informa&ccedil;&otilde;es de seus cart&otilde;es ou estabelecer um acordo de colus&atilde;o
                            com outros usu&aacute;rios para tirar vantagem injusta. Essas vantagens podem consistir em
                            despejo e transfer&ecirc;ncia de fichas, discuss&atilde;o de uma m&atilde;o durante o jogo,
                            m&uacute;ltiplos usando uma &uacute;nica conta. A BrazaBet fornece o exame rigoroso do jogo
                            por meios manuais e automatizados e investiga todas as reclama&ccedil;&otilde;es de
                            usu&aacute;rios relacionadas. Al&eacute;m disso, a BrazaBet fornece an&aacute;lises de
                            jogabilidade e contas de forma proativa e aleat&oacute;ria.</p>
                        
                        <p class="pl-1 mb-4 text-sm">6.3. Atividade fraudulenta. Uma vez que a BrazaBet notou uma atividade fraudulenta, ilegal,
                            desonesta ou impr&oacute;pria (incluindo o uso de VPN, proxy ou servi&ccedil;o similar que
                            mascara ou manipula a identifica&ccedil;&atilde;o de sua localiza&ccedil;&atilde;o real, ou
                            fazer apostas, apostas ou jogos de p&ocirc;quer por meio de terceiros ou em nome de
                            terceiros) no site, podemos bloquear a conta do usu&aacute;rio com a perda de todos os
                            saldos da conta sem notifica&ccedil;&atilde;o pr&eacute;via. Nesses casos, a BrazaBet
                            reserva-se o direito de denunciar atividades fraudulentas &agrave;s autoridades reguladoras
                            e policiais existentes, incluindo, entre outros, bancos, empresas de cart&atilde;o de
                            cr&eacute;dito e/ou qualquer pessoa ou entidade que tenha o direito legal de tais
                            informa&ccedil;&otilde;es e/ou tomar medidas legais contra tal usu&aacute;rio.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">7. Jogos Interrompidos e Abortados</p>
                        
                        <p class="pl-1 mb-4 text-sm">7.1. Atividade criminal. No caso em que qualquer irregularidade (incluindo suspeita de
                            tentativa de lavagem de dinheiro ou fraude) tenha sido notada, a BrazaBet reserva-se o
                            direito de fechar Contas e/ou relatar sobre atividades criminosas ou outras atividades
                            suspeitas fornecidas atrav&eacute;s de uma ou v&aacute;rias Contas para as respectivas
                            autoridades reguladoras ou de aplica&ccedil;&atilde;o da lei existentes. Todos os saldos da
                            conta dos infratores ser&atilde;o bloqueados, os saques ser&atilde;o anulados, os
                            dep&oacute;sitos e ganhos ser&atilde;o perdidos.</p>
                        
                        
                        <p class="pl-1 mb-4 text-sm">7.2. Conluio e trapa&ccedil;a. A BrazaBet &eacute; eleg&iacute;vel para desativar as contas
                            dos usu&aacute;rios e perder os saldos de suas contas (incluindo dep&oacute;sitos e ganhos)
                            se eles forem notados de ganhos, tentando obter uma vantagem de negociar
                            informa&ccedil;&otilde;es de seus cart&otilde;es ou estabelecer um acordo de conluio com
                            outros usu&aacute;rios para tomar uma vantagem injusta. Essas vantagens podem consistir em
                            despejo e transfer&ecirc;ncia de fichas, discuss&atilde;o de uma m&atilde;o durante o jogo,
                            m&uacute;ltiplos usu&aacute;rios usando uma &uacute;nica conta. A BrazaBet fornece o exame
                            rigoroso do jogo por meios manuais e automatizados e investiga todas as
                            reclama&ccedil;&otilde;es de usu&aacute;rios relacionadas. Al&eacute;m disso, a BrazaBet
                            fornece an&aacute;lises de jogabilidade e contas de forma proativa e aleat&oacute;ria.</p>
                        
                        <p class="pl-1 mb-4 text-sm">7.3. Atividade Fraudulenta. Uma vez que a BrazaBet notou uma atividade fraudulenta, ilegal,
                            desonesta ou impr&oacute;pria (incluindo o uso de VPN, proxy ou servi&ccedil;o similar que
                            mascara ou manipula a identifica&ccedil;&atilde;o de sua localiza&ccedil;&atilde;o real, ou
                            fazendo apostas, apostas ou jogos de p&ocirc;quer por meio de terceiros ou em nome de um
                            terceiro) no site, podemos bloquear a conta do usu&aacute;rio com a perda de todos os saldos
                            da conta sem notifica&ccedil;&atilde;o pr&eacute;via. Nesses casos, a BrazaBet reserva-se o
                            direito de denunciar atividades fraudulentas &agrave;s autoridades reguladoras e policiais
                            existentes, incluindo, entre outros, bancos, empresas de cart&atilde;o de cr&eacute;dito
                            e/ou qualquer pessoa ou entidade que tenha o direito legal de tais informa&ccedil;&otilde;es
                            e/ou tomar medidas legais contra tal usu&aacute;rio.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">8. Chat Ao Vivo</p>
                        
                        <p class="pl-1 mb-4 text-sm">8.1. Como parte do uso do site, a BrazaBet pode fornecer a voc&ecirc; um recurso de chat,
                            moderado por n&oacute;s e sujeito a controles. Reservamo-nos o direito de revisar o chat e
                            manter um registro de todas as declara&ccedil;&otilde;es feitas em tal
                            instala&ccedil;&atilde;o. Seu uso do chat deve ser para fins recreativos e de
                            socializa&ccedil;&atilde;o e est&aacute; sujeito &agrave;s seguintes regras.</p>
                        
                        <p class="pl-1 mb-4 text-sm">8.2. Voc&ecirc; n&atilde;o deve fazer declara&ccedil;&otilde;es sexualmente expl&iacute;citas
                            ou grosseiramente ofensivas, incluindo express&otilde;es de intoler&acirc;ncia, racismo,
                            &oacute;dio ou palavr&otilde;es.</p>
                        
                        <p class="pl-1 mb-4 text-sm">8.3. Voc&ecirc; n&atilde;o deve fazer declara&ccedil;&otilde;es que sejam abusivas,
                            difamat&oacute;rias, assediantes ou ofensivas ao Site ou &agrave; BrazaBet.</p>
                        
                        <p class="pl-1 mb-4 text-sm">8.4. Voc&ecirc; n&atilde;o deve fazer declara&ccedil;&otilde;es que anunciem, promovam ou de
                            outra forma se relacionem com quaisquer outras entidades online.</p>
                        
                        <p class="pl-1 mb-4 text-sm">8.5. Voc&ecirc; n&atilde;o deve fazer declara&ccedil;&otilde;es sobre a BrazaBet, o Site ou
                            qualquer outro site da Internet conectado &agrave; BrazaBet que sejam falsos e/ou maliciosos
                            e/ou prejudiciais &agrave; BrazaBet</p>
                        
                        <p class="pl-1 mb-4 text-sm">8.6. Voc&ecirc; n&atilde;o deve conspirar atrav&eacute;s do chat. Quaisquer chats suspeitos
                            ser&atilde;o relatados &agrave; autoridade reguladora ou pol&iacute;cia relevante.</p>
                        
                        <p class="pl-1 mb-4 text-sm">8.7. No caso de voc&ecirc; violar qualquer uma das disposi&ccedil;&otilde;es acima
                            relacionadas ao recurso de chat, a BrazaBet ter&aacute; o direito de remover o chat ou
                            encerrar imediatamente sua conta. Ap&oacute;s tal rescis&atilde;o, a BrazaBet
                            reembolsar&aacute; a voc&ecirc; quaisquer fundos que possam estar em sua conta al&eacute;m
                            de qualquer valor que possa ser devido a n&oacute;s nesse momento (se houver).</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">9. Jogos interrompidos e abortados</p>
                        
                        <p class="pl-1 mb-4 text-sm">9.1. A BrazaBet n&atilde;o &eacute; respons&aacute;vel por qualquer tempo de inatividade,
                            interrup&ccedil;&otilde;es no servidor, atrasos ou qualquer dist&uacute;rbio t&eacute;cnico
                            ou pol&iacute;tico na jogabilidade. Os reembolsos podem ser dados exclusivamente a
                            crit&eacute;rio da BrazaBet.</p>
                        
                        <p class="pl-1 mb-4 text-sm">9.2. A BrazaBet n&atilde;o se responsabiliza por quaisquer danos ou perdas que sejam
                            considerados ou alegadamente decorrentes de ou em conex&atilde;o com o Site ou seu
                            conte&uacute;do, incluindo, sem limita&ccedil;&atilde;o, atrasos ou
                            interrup&ccedil;&otilde;es na opera&ccedil;&atilde;o ou transmiss&atilde;o, perda ou
                            corrup&ccedil;&atilde;o de dados, comunica&ccedil;&atilde;o ou falha de linhas, uso indevido
                            do Site ou de seu conte&uacute;do por qualquer pessoa ou quaisquer erros ou omiss&otilde;es
                            no conte&uacute;do.</p>
                        
                        <p class="pl-1 mb-4 text-sm">9.3. Em caso de mau funcionamento do sistema do cassino, todas as apostas ser&atilde;o
                            anuladas.</p>
                        
                        <p class="pl-1 mb-4 text-sm">9.4. No caso de um jogo ser iniciado, mas abortado devido a uma falha do sistema, a BrazaBet.
                            reembolsar&aacute; o valor apostado no jogo a voc&ecirc; creditando-o em sua conta ou, se
                            uma conta n&atilde;o existir mais, pagando-o a voc&ecirc; de forma aprovada; e se voc&ecirc;
                            tiver um cr&eacute;dito acumulado no momento em que o Jogo falhou, credite em sua Conta o
                            valor monet&aacute;rio do cr&eacute;dito ou, se uma Conta n&atilde;o existir mais, pague a
                            voc&ecirc; de maneira aprovada.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">10. Deveres</p>
                        
                        <p class="pl-1 mb-4 text-sm">10.1. A BrazaBet reserva-se o direito de ceder ou transferir legalmente seus direitos e
                            obriga&ccedil;&otilde;es sob os Termos. Voc&ecirc; n&atilde;o deve ceder ou transferir seus
                            direitos e obriga&ccedil;&otilde;es sob estes Termos.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">11. Reclama&ccedil;&otilde;es</p>
                        
                        <p class="pl-1 mb-4 text-sm">11.1. Se voc&ecirc; tiver uma reclama&ccedil;&atilde;o, pode enviar um e-mail para o suporte
                            ao cliente do site em <a data-fr-linked="true"
                                href="mailto:support@BrazaBet.com.br">support@BrazaBet.com.br</a></p>
                        
                        <p class="pl-1 mb-4 text-sm">11.2. A BrazaBet envidar&aacute; os melhores esfor&ccedil;os para resolver um assunto
                            relatado prontamente.</p>
                        
                        <p class="pl-1 mb-4 text-sm">11.3. Se voc&ecirc; tiver alguma d&uacute;vida em rela&ccedil;&atilde;o a qualquer
                            transa&ccedil;&atilde;o, entre em contato com a BrazaBet em <a data-fr-linked="true"
                                href="mailto:support@BrazaBet.com.br">support@BrazaBet.com.br</a> com os detalhes da
                            consulta. Analisaremos quaisquer transa&ccedil;&otilde;es questionadas ou contestadas. Nosso
                            julgamento &eacute; final.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">12. Acordo e Admissibilidade</p>
                        
                        <p class="pl-1 mb-4 text-sm">12.1. Estes Termos, a Pol&iacute;tica de Privacidade, a Pol&iacute;tica de Cookies e qualquer
                            documento expressamente referido neles e quaisquer diretrizes ou regras publicadas no Site
                            constituem o acordo e entendimento integral entre voc&ecirc; e a BrazaBet com
                            rela&ccedil;&atilde;o a este Site e salvo no caso de fraude ele substitui todas as
                            comunica&ccedil;&otilde;es e propostas anteriores ou contempor&acirc;neas, sejam
                            eletr&ocirc;nicas, orais ou escritas, entre voc&ecirc; e a BrazaBet com
                            rela&ccedil;&atilde;o a este site.</p>
                        
                        <p class="pl-1 mb-4 text-sm">12.2. Uma vers&atilde;o impressa destes Termos e de qualquer notifica&ccedil;&atilde;o dada
                            em formato eletr&ocirc;nico ser&aacute; admiss&iacute;vel em processos judiciais ou
                            administrativos baseados ou relacionados a estes Termos na mesma medida e sujeito &agrave;s
                            mesmas condi&ccedil;&otilde;es que outros documentos e registros comerciais originalmente
                            gerados e mantidos em formul&aacute;rio impresso.</p>
                        
                        <p class="pl-1 mb-4 text-sm">12.3. Se qualquer disposi&ccedil;&atilde;o destes Termos for considerada ilegal ou
                            inexequ&iacute;vel, tal disposi&ccedil;&atilde;o ser&aacute; separada destes Termos e todas
                            as outras disposi&ccedil;&otilde;es permanecer&atilde;o em vigor sem serem afetadas por tal
                            rescis&atilde;o.</p>
                        
                        <p class="pl-1 mb-4 text-sm">12.4. No caso de inconsist&ecirc;ncia de conte&uacute;do textual entre as vers&otilde;es
                            lingu&iacute;sticas, prevalecer&aacute; a vers&atilde;o em ingl&ecirc;s do Site.</p>
                        
                        <p class="pl-1 mb-4 text-sm">12.5. Estes Termos s&atilde;o regidos pelas leis de Cura&ccedil;ao e as partes concordam com
                            a jurisdi&ccedil;&atilde;o dos tribunais de Cura&ccedil;ao e com as regras de arbitragem de
                            acordo com a lei aplic&aacute;vel.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">13. Direitos Autorais</p>
                        
                        <p class="pl-1 mb-4 text-sm">13.1. Somos os &uacute;nicos propriet&aacute;rios da marca comercial BrazaBet e do logotipo
                            da BrazaBet. Qualquer uso n&atilde;o autorizado da marca registrada BrazaBet e do logotipo
                            BrazaBet pode resultar em processo judicial.</p>
                        
                        <p class="pl-1 mb-4 text-sm">13.2. BrazaBet.com &eacute; o localizador uniforme de recursos do site operado pela BrazaBet
                            e nenhum uso n&atilde;o autorizado pode ser feito deste URL em outro site ou plataforma
                            digital sem nosso consentimento pr&eacute;vio por escrito.</p>
                        
                        <p class="pl-1 mb-4 text-sm">13.3. A BrazaBet &eacute; a propriet&aacute;ria ou a licenciada leg&iacute;tima dos direitos
                            da tecnologia, software e sistemas de neg&oacute;cios usados neste site.</p>
                        
                        <p class="pl-1 mb-4 text-sm">13.4. O conte&uacute;do e a estrutura das p&aacute;ginas do site da BrazaBet pertencem
                            &agrave; BrazaBet, todos os direitos reservados. Os direitos autorais deste site, incluindo
                            todos os textos, gr&aacute;ficos, c&oacute;digos, arquivos e links, pertencem &agrave;
                            BrazaBet e o site n&atilde;o pode ser reproduzido, transmitido ou armazenado no todo ou em
                            parte sem nosso consentimento por escrito. Seu registro e uso de nosso sistema, portanto,
                            n&atilde;o conferem nenhum direito &agrave; propriedade intelectual contida em nosso
                            sistema.</p>
                        
                        <p class="pl-1 mb-4 text-sm">13.5. Os links para o site e qualquer uma das p&aacute;ginas nele contidas n&atilde;o podem
                            ser inclu&iacute;dos em nenhum outro site sem o consentimento pr&eacute;vio por escrito da
                            BrazaBet.</p>
                        
                        <p class="pl-1 mb-4 text-sm">13.6. Voc&ecirc; concorda em n&atilde;o usar nenhum dispositivo autom&aacute;tico ou manual
                            para monitorar as p&aacute;ginas do site ou qualquer conte&uacute;do nelas.</p>
                        
                        <p class="pl-1 mb-4 text-sm">13.7. Qualquer uso n&atilde;o autorizado ou reprodu&ccedil;&atilde;o pode ser processado.</p>
                        
                        <p class="font-semibold text-base mb-6 mt-4">14. NetEnt</p>
                        
                        <p class="pl-1 mb-4 text-sm">1. Restri&ccedil;&atilde;o Absoluta a NetEnt n&atilde;o permitir&aacute; que os Jogos de
                            Cassino NetEnt sejam fornecidos a qualquer entidade que opere em qualquer uma das
                            jurisdi&ccedil;&otilde;es abaixo (independentemente de os Jogos de Cassino NetEnt estarem ou
                            n&atilde;o sendo fornecidos pela entidade nessa jurisdi&ccedil;&atilde;o) sem as
                            licen&ccedil;as apropriadas. B&eacute;lgica, Bulg&aacute;ria, Col&ocirc;mbia,
                            Cro&aacute;cia, Rep&uacute;blica Checa, Dinamarca, Est&oacute;nia, Fran&ccedil;a,
                            It&aacute;lia, Let&oacute;nia, Litu&acirc;nia, M&eacute;xico, Portugal, Rom&eacute;nia,
                            Espanha, Su&eacute;cia, Su&iacute;&ccedil;a, Reino Unido, Estados Unidos da Am&eacute;rica.
                        </p>
                        
                        <p class="pl-1 mb-4 text-sm">2. Territ&oacute;rios na Lista Negra Todos os Jogos de Cassino NetEnt n&atilde;o podem ser
                            oferecidos nos seguintes territ&oacute;rios: Afeganist&atilde;o, Alb&acirc;nia,
                            Arg&eacute;lia, Angola, Austr&aacute;lia, Bahamas, Botsuana, B&eacute;lgica,
                            Bulg&aacute;ria, Col&ocirc;mbia, Cro&aacute;cia, Rep&uacute;blica Tcheca, Dinamarca,
                            Est&ocirc;nia, Equador, Eti&oacute;pia, Fran&ccedil;a, Gana, Guiana, Hong Kong,
                            It&aacute;lia, Ir&atilde;, Iraque, Israel, Kuwait, Let&ocirc;nia, Litu&acirc;nia,
                            M&eacute;xico, Nam&iacute;bia, Nicar&aacute;gua, Cor&eacute;ia do Norte, Paquist&atilde;o,
                            Panam&aacute;, Filipinas, Portugal, Rom&ecirc;nia, Cingapura, Espanha, Su&eacute;cia,
                            Su&iacute;&ccedil;a, Sud&atilde;o, S&iacute;ria, Taiwan, Trinidad e Tobago, Tun&iacute;sia,
                            Uganda, Reino Unido, Estados Unidos da Am&eacute;rica, I&ecirc;men, Zimb&aacute;bue.</p>
                        
                        <p class="pl-1 mb-4 text-sm">3. Territ&oacute;rios de Jogos de Marca da Lista Negra Os seguintes Jogos Bradados da NetEnt
                            t&ecirc;m algumas restri&ccedil;&otilde;es adicionais al&eacute;m dos Territ&oacute;rios da
                            Lista Negra estabelecidos acima: 3.1 Al&eacute;m das jurisdi&ccedil;&otilde;es estabelecidas
                            no par&aacute;grafo 2, o slot de v&iacute;deo Planet of the Apes n&atilde;o deve ser
                            oferecido nos seguintes territ&oacute;rios: Azerbaij&atilde;o, China, &Iacute;ndia,
                            Mal&aacute;sia, Qatar, R&uacute;ssia, Tail&acirc;ndia, Turquia, Ucr&acirc;nia.</p>
                        
                        <p class="pl-1 mb-4 text-sm">3.2 Al&eacute;m das jurisdi&ccedil;&otilde;es estabelecidas no par&aacute;grafo 2, o Vikings
                            Video Slot n&atilde;o deve ser oferecido nas seguintes jurisdi&ccedil;&otilde;es:
                            Azerbaij&atilde;o, Camboja, Canad&aacute;, China, Fran&ccedil;a, &Iacute;ndia,
                            Indon&eacute;sia, Laos, Mal&aacute;sia, Mianmar, Papua Nova Guin&eacute;, Catar,
                            R&uacute;ssia, Coreia do Sul, Tail&acirc;ndia, Turquia, Ucr&acirc;nia, Estados Unidos da
                            Am&eacute;rica.</p>
                        
                        <p class="pl-1 mb-4 text-sm">3.3 Al&eacute;m das jurisdi&ccedil;&otilde;es estabelecidas no par&aacute;grafo 2, o Narcos
                            Video Slot n&atilde;o deve ser oferecido nos seguintes territ&oacute;rios: Indon&eacute;sia,
                            Coreia do Sul.</p>
                        
                        <p class="pl-1 mb-4 text-sm">3.4 Al&eacute;m das jurisdi&ccedil;&otilde;es estabelecidas no par&aacute;grafo 2, o Street
                            Fighter Video Slot n&atilde;o deve ser oferecido nos seguintes territ&oacute;rios: Anguilla,
                            Antigua &amp; Barbuda, Argentina, Aruba, Barbados, Bahamas, Belize, Bermuda, Bol&iacute;via,
                            Bonaire, Brasil, British Ilhas Virgens, Canad&aacute;, Ilhas Cayman, China, Chile, Ilha
                            Clipperton, Col&ocirc;mbia, Costa Rica, Cuba, Cura&ccedil;ao, Dominica, Rep&uacute;blica
                            Dominicana, El Salvador, Groenl&acirc;ndia, Granada, Guadalupe, Guatemala, Guiana, Haiti,
                            Honduras, Jamaica, Jap&atilde;o, Martinica, M&eacute;xico, Montserrat, Ilha Navassa,
                            Paraguai, Peru, Porto Rico, Saba, S&atilde;o Bartolomeu, S&atilde;o Eust&aacute;quio,
                            S&atilde;o Crist&oacute;v&atilde;o e Nevis, Santa L&uacute;cia, S&atilde;o Martinho,
                            S&atilde;o Martinho, S&atilde;o Pedro e Miquelon, S&atilde;o Vicente e Granadinas, Sul
                            Coreia, Suriname, Ilhas Turks e Caicos, Estados Unidos da Am&eacute;rica, Uruguai, Ilhas
                            Virgens Americanas, Venezuela.</p>
                        
                        <p class="pl-1 mb-4 text-sm">3.5 Al&eacute;m das jurisdi&ccedil;&otilde;es estabelecidas no par&aacute;grafo 2, o Fashion
                            TV Video Slot n&atilde;o deve ser oferecido nos seguintes territ&oacute;rios: Cuba,
                            Jord&acirc;nia, Turquia, Ar&aacute;bia Saudita.</p>
                        
                        <p class="pl-1 mb-4 text-sm">4. Monstros Universais (Dracula, Creature from the Black Lagoon, Phantoms Curse e The
                            Invisible Man) s&oacute; podem ser jogados nos seguintes territ&oacute;rios:</p>
                        
                        <p class="pl-1 mb-4 text-sm">Andorra, &Aacute;ustria, Arm&ecirc;nia, Azerbaij&atilde;o, Bielorr&uacute;ssia, B&oacute;snia
                            e Herzegovina, Chipre, Finl&acirc;ndia, Ge&oacute;rgia, Alemanha, Gr&eacute;cia, Hungria,
                            Isl&acirc;ndia, Irlanda, Liechtenstein, Luxemburgo, Malta, Mold&aacute;via, M&ocirc;naco,
                            Montenegro, Holanda, Maced&ocirc;nia do Norte, Noruega, Pol&ocirc;nia, R&uacute;ssia, San
                            Marino, S&eacute;rvia, Eslov&aacute;quia, Eslov&ecirc;nia, Turquia e Ucr&acirc;nia.</p>
                        
                        <p class="pl-1 mb-4 text-sm">19. O cliente do cliente est&aacute; proibido de transferir ou vender suas contas para outra
                            pessoa. Esta proibi&ccedil;&atilde;o inclui a transfer&ecirc;ncia de quaisquer ativos de
                            valor de qualquer tipo, como, no entanto, n&atilde;o limitado &agrave; propriedade de
                            contas, ganhos, dep&oacute;sitos, apostas, direitos e/ou reclama&ccedil;&otilde;es
                            relacionadas a esses ativos, legais, comerciais ou outros. A proibi&ccedil;&atilde;o de tais
                            transfer&ecirc;ncias tamb&eacute;m inclui, mas n&atilde;o se limita a
                            onera&ccedil;&atilde;o, penhor, cess&atilde;o, usufruto, negocia&ccedil;&atilde;o,
                            corretagem, hipoteca e/ou doa&ccedil;&atilde;o em coopera&ccedil;&atilde;o com um
                            fiduci&aacute;rio ou qualquer outro terceiro, empresa, pessoa f&iacute;sica ou
                            jur&iacute;dica, funda&ccedil;&atilde;o e /ou associa&ccedil;&atilde;o de qualquer forma ou
                            forma.</p>
                </p>
            </div>
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="payments" class="modal-toggle" />
    <div class="modal modal-bottom">
        <label for="payments" class="fixed right-4 top-2"
            style="background: #ffffffeb; border-radius: 3px; padding: 10px;">
            <svg class="w-6 h-6 text-black cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </label>
        <div class="modal-box payments" style="background: #fff !important;">
            <div class="flex flex-col justify-center max-w-4xl mx-auto  text-justify text-black">
                
                <p class="text-xs opacity-80"><span class="font-bold">
                    <h1 class="font-bold text-2xl text-center capitalize mb-20">D&Uacute;VIDAS SOBRE PAGAMENTO</h1>
                    
                    
                    
                    <table class="min-w-full divide-y divide-gray-300 mb-20">
                        <thead class="bg-gray-100">
                            <tr>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 capitalize">Agência Financeira</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900  capitalize">M&eacute;todo de Pagamento</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900  capitalize">Taxa</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900  capitalize">Prazo De Entrega</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900  capitalize">Valor M&iacute;nimo</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900  capitalize">Valor M&aacute;ximo</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900  capitalize">Informa&ccedil;&otilde;es</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">ISTPAY</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Pix</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Gratuito</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Imediato</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">R$40</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">R$5000</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Transfer&ecirc;ncia banc&aacute;ria</td>
                            </tr>
            
                            
                        </tbody>
                        </table>
                    
                    
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-lg mb-10">REGRAS DE DEP&Oacute;SITOS</p>
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">POSSO DEPOSITAR POR CONTA BANC&Aacute;RIA DE PESSOA JUR&Iacute;DICA?</p>
                    
                    <p dir="ltr" class="pl-1 mb-10 text-sm">&Eacute; poss&iacute;vel realizar o dep&oacute;sito por pessoa jur&iacute;dica, mas com o limite di&aacute;rio estipulado em R$1.000. Se ultrapassado este limite, o valor &eacute; estornado automaticamente para sua conta.</p>
                  
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">COMO FA&Ccedil;O PARA DEPOSITAR VIA PIX?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Selecione PIX na lista de formas de pagamento dispon&iacute;veis. Em seguida, ser&aacute; gerado o c&oacute;digo QR que poder&aacute; usar para fazer a leitura do pagamento PIX.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">POSSO DEPOSITAR DE OUTRO BANCO?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Sim, pode depositar de qualquer banco, por ser uma forma de pagamento fornecida pelo Banco Central, voc&ecirc; pode usar um banco diferente para realizar o pagamento.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">QUAIS S&Atilde;O OS LIMITES M&Iacute;NIMO E M&Aacute;XIMO DE DEP&Oacute;SITO?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">O limite m&iacute;nimo &eacute; de R$40,00 e o m&aacute;ximo R$5.000, para a Istpay.</p>
                    
                    
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">EM QUANTO TEMPO O DINHEIRO CAI NA MINHA CONTA?</p>
                    <p dir="ltr" class="pl-1 mb-1 text-sm">O dinheiro cai na conta automaticamente ap&oacute;s fazer o pagamento.</p>
                    
                    
                    
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Importante: Em rar&iacute;ssimas ocasi&otilde;es o seu dep&oacute;sito via pix pode sofrer um atraso de at&eacute; 2 horas. Esse atraso n&atilde;o vem da BRAZABET, vem da burocracia dos bancos e dos sistemas envolvidos. Estamos aqui para te dar todo o suporte necess&aacute;rio at&eacute; que o seu dep&oacute;sito seja aprovado e enviado. Caso o problema persista ap&oacute;s o per&iacute;odo de 2 horas, favor entrar em contato com nossa equipe.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">MEU DEP&Oacute;SITO VAI SER CREDITADO INSTANTANEAMENTE, MESMO NOS FINAIS DE SEMANA?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Sim, o dinheiro entra na sua conta nos finais de semana. Basta fazer o PIX no valor exato informado em um prazo de at&eacute; 3 horas atrav&eacute;s do seu banco na internet.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">FIZ UM PAGAMENTO PELO PIX, MAS N&Atilde;O GEREI O QR NO SITE, O QUE ACONTECE COM O MEU DEP&Oacute;SITO?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Para que seu dep&oacute;sito seja creditado em sua conta, voc&ecirc; deve transferir desde seu banco online com o c&oacute;digo QR gerado no site. Em caso de deposito incorreto, a devolu&ccedil;&atilde;o dos dep&oacute;sitos &eacute; de 24 a 48 horas &uacute;teis. Entre em contato com a nossa Central de Atendimento ao Cliente com o comprovante de pagamento para que seu dep&oacute;sito seja devolvido para a conta de origem.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">EM CASO DE FAZER UM DEP&Oacute;SITO INCORRETO, QUANTO TEMPO LEVA PARA SER ESTORNADO?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">O tempo de devolu&ccedil;&atilde;o dos dep&oacute;sitos &eacute; de 24 a 48 horas &uacute;teis, ap&oacute;s o envio do comprovante e a confirma&ccedil;&atilde;o dos dados para devolu&ccedil;&atilde;o.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">&Eacute; POSS&Iacute;VEL DEPOSITAR PELO CELULAR?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Sim, &eacute; poss&iacute;vel. As formas de pagamento est&atilde;o dispon&iacute;veis em seu computador ou telefone celular.</p>
                    
                    
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">SOLICITEI UMA RETIRADA, MAS O VALOR AINDA N&Atilde;O FOI TRANSFERIDO.</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Todas as retiradas s&atilde;o aprovadas pela nossa equipe de revis&atilde;o interna, que pode levar at&eacute; 2 dias &uacute;teis. Uma vez que processamos sua retirada.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">EU REQUISITEI UMA RETIRADA, MAS AGORA EU QUERO RETORNAR O DINHEIRO PARA A MINHA CONTA BRAZABET.</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Em casos excepcionais, ainda &eacute; poss&iacute;vel cancelar a transa&ccedil;&atilde;o, dependendo de quanto falta para o processamento da retirada. Entre em contato com nossa equipe de suporte ao cliente indicando o motivo do cancelamento de sua retirada.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">QUAL O LIMITE DE SAQUE?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Limite m&iacute;nimo de R$80,00 para Istpay.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">QUANTOS SAQUES EU POSSO FAZER?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">S&oacute; &eacute; permitido realizar um saque por dia, independente do valor solicitado.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">H&Aacute; ALGUMA RESTRI&Ccedil;&Atilde;O ANTES QUE EU POSSA FAZER UMA RETIRADA?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Se voc&ecirc; recebeu dinheiro complementar ou b&ocirc;nus em sua conta, voc&ecirc; deve cumprir qualquer restri&ccedil;&atilde;o de b&ocirc;nus contida na oferta e / ou com os Termos e Condi&ccedil;&otilde;es do site. Se voc&ecirc; n&atilde;o cumpriu essas restri&ccedil;&otilde;es, n&atilde;o poder&aacute; retirar qualquer montante at&eacute; que as restri&ccedil;&otilde;es de b&ocirc;nus tenham sido atendidas.</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">COMO POSSO VERIFICAR O STATUS DA MINHA RETIRADA?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Fa&ccedil;a login na sua conta e v&aacute; em configura&ccedil;&otilde;es, selecione &quot;Transa&ccedil;&otilde;es Financeiras&quot; e, em seguida, clique em &apos;Saque&apos; para verificar o status de cada retirada</p>
                    
                    
                    
                    <p dir="ltr" class="font-semibold text-base mb-1">FIZ O MEU SAQUE O DINHEIRO CAIU NA MINHA CONTA BANC&Aacute;RIA, LOGO EM SEGUIDA EU EFETUEI A DEVOLU&Ccedil;&Atilde;O DO SAQUE, O QUE ACONTECE?</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">O tempo de devolu&ccedil;&atilde;o dos saques estornados &eacute; de 24 a 48 horas &uacute;teis, ap&oacute;s o envio do comprovante e a confirma&ccedil;&atilde;o dos dados para devolu&ccedil;&atilde;o.</p>
                    
                    
                    
                </p>
            </div>
        </div>
    </div>


    <input type="checkbox" id="login-modal" class="modal-toggle" />
    <label for="login-modal" class="modal items-center cursor-pointer">
        <div class=" max-w-md" for="">
            Login
        </div>
    </label>

    <input type="checkbox" id="register-modal" class="modal-toggle" />
    <label for="register-modal" class="modal items-center cursor-pointer text-white">
        <div class=" max-w-md text-white" for="">
            Register
        </div>
    </label>

    <input type="checkbox" id="risk" class="modal-toggle" />
    <div class="modal modal-bottom">
        <label for="risk" class="fixed right-4 top-2"
            style="background: #ffffffeb; border-radius: 3px; padding: 10px;">
            <svg class="w-6 h-6 text-black cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </label>
        <div class="modal-box" style="background: #fff !important;">
            <div class="flex flex-col justify-center max-w-4xl mx-auto text-black">
                <h3 class="font-bold text-2xl text-center capitalize mb-20">JOGO RESPONS&Aacute;VEL</h3>
                    <p class="font-semibold text-base mb-4">JOGO RESPONS&Aacute;VEL</p>

                    <p class="pl-1 mb-2 text-sm">a. Jogar enquanto menores de 18 anos &eacute; uma ofensa criminal, e levamos muito a s&eacute;rio nossas responsabilidades de impedir o acesso de menores de 18 anos. A BrazaBet reserva-se o direito de solicitar documenta&ccedil;&atilde;o de prova de idade de qualquer usu&aacute;rio a qualquer momento e quaisquer ganhos ser&atilde;o confiscados se, ap&oacute;s a conclus&atilde;o da verifica&ccedil;&atilde;o de idade, o cliente for menor de idade.</p>
                    
                    <p class="pl-1 mb-2 text-sm">b.&nbsp;Incentivamos nossos usu&aacute;rios a desfrutar de jogos de azar de maneira respons&aacute;vel. No entanto, reconhecemos que o jogo pode se tornar viciante e pode levar a problemas de jogo ou at&eacute; mesmo v&iacute;cio para algumas pessoas. Para garantir que os usu&aacute;rios joguem com responsabilidade, oferecemos uma variedade de ferramentas que podem ser usadas para controlar o jogo, como diferentes tipos de limites ou pausas curtas. Para mais informa&ccedil;&otilde;es, consulte a nossa p&aacute;gina de Jogo Respons&aacute;vel.</p>
    
                    <p class="pl-1 mb-2 text-sm">c. Para definir ou gerenciar os limites do Jogo Respons&aacute;vel, voc&ecirc; deve fazer login na sua Conta. Se voc&ecirc; achar que controlar seu jogo com as ferramentas dispon&iacute;veis n&atilde;o &eacute; suficiente, recomendamos que voc&ecirc; considere uma pausa ou autoexclus&atilde;o.</p>
                    
                    <p class="pl-1 mb-2 text-sm">d. A autoexclus&atilde;o permite que voc&ecirc; se suspenda de usar nossos servi&ccedil;os.</p>
                    
                    <p class="pl-1 mb-2 text-sm">BrazaBet tem os seguintes per&iacute;odos efetivos dispon&iacute;veis para autoexclus&atilde;o:</p>
                    
                    <p class="pl-2 text-sm">(a) 24 horas</p>
                    
                    <p class="pl-2 text-sm">(b) Tr&ecirc;s dias</p>
                    
                    <p class="pl-2 text-sm">(c) Uma semana</p>
                    
                    <p class="pl-2 text-sm">(d) 30 dias</p>
                    
                    <p class="pl-2 mb-3 text-sm">(e) Per&iacute;odo indefinido</p>
                    
                    <p class="pl-1 mb-2 text-sm">Para excluir por um per&iacute;odo indefinido, voc&ecirc; ser&aacute; solicitado a entrar em contato diretamente conosco atrav&eacute;s do suporte.</p>
                    
                    <p class="pl-1 mb-2 text-sm">e. &Eacute; sua responsabilidade aderir a qualquer acordo de autoexclus&atilde;o, embora tenhamos prazer em ajudar colocando endere&ccedil;os e dispositivos na lista negra sempre que poss&iacute;vel (observe que isso nem sempre &eacute; poss&iacute;vel devido a restri&ccedil;&otilde;es t&eacute;cnicas).</p>
                    
                    <p class="pl-1 mb-2 text-sm">f. A efic&aacute;cia de qualquer acordo de auto-exclus&atilde;o depende em grande parte do seu empenho em gerir o seu pr&oacute;prio comportamento. Uma exclus&atilde;o ser&aacute; mais efetiva se voc&ecirc; concordar em n&atilde;o tentar se registrar novamente. Esteja ciente de que a exclus&atilde;o n&atilde;o deve funcionar como um substituto para voc&ecirc; gerenciar seu pr&oacute;prio comportamento ou como uma garantia total para impedi-lo de continuar jogando.</p>
                    
                    <p class="pl-1 mb-2 text-sm">g. Durante um per&iacute;odo de autoexclus&atilde;o, todas as tentativas ser&atilde;o aplicadas para impedir que voc&ecirc; crie uma conta duplicada, e qualquer conta detectada com um link claro para uma conta em autoexclus&atilde;o ser&aacute; fechada ap&oacute;s a detec&ccedil;&atilde;o, e quaisquer saldos n&atilde;o utilizados restantes ser&atilde;o devolvidos &agrave; fonte de dep&oacute;sito original.</p>
                    
                    <p class="pl-1 mb-2 text-sm">h. Uma solicita&ccedil;&atilde;o por escrito deve ser enviada ao suporte ao cliente, caso voc&ecirc; deseje cancelar uma autoexclus&atilde;o ou reabrir sua conta. Informamos que a BrazaBet se reserva o direito de manter as contas fechadas ou negar um pedido de reabertura, a fim de manter a seguran&ccedil;a de um jogador, conforme decis&atilde;o tomada pelo nosso Departamento de Jogo Respons&aacute;vel.</p>
                    
                    <p class="pl-1 mb-2 text-sm">i. Ao aceitar estes Termos, voc&ecirc; reconhece e confirma que n&atilde;o est&aacute; exclu&iacute;do do nosso servi&ccedil;o. Portanto, nenhum dep&oacute;sito, perda ou ganho ser&aacute; devido/reembolsado a voc&ecirc; se associado a uma conta adicional/duplicada criada de forma fraudulenta, exceto para saldos restantes n&atilde;o utilizados de dep&oacute;sitos, que ser&atilde;o reembolsados integralmente. Para investigar completamente esses casos, os Departamentos de Jogo Respons&aacute;vel ou Fraude da BrazaBet t&ecirc;m o direito de solicitar formas adicionais de documenta&ccedil;&atilde;o, como, entre outros, identifica&ccedil;&atilde;o em m&atilde;os e verifica&ccedil;&atilde;o por telefone/voz.</p>
                    
                    <p class="pl-1 mb-2 text-sm">j. Ao jogar ou usar os servi&ccedil;os de jogos de azar da Brazabet, voc&ecirc; reconhece que est&aacute; jogando com base ou apostando em eventos sujeitos a sorte e chance e que, atrav&eacute;s do uso do servi&ccedil;o e/ou software, voc&ecirc; est&aacute; sujeito ao risco de perder dinheiro. Assim, voc&ecirc; aceita que quaisquer perdas sofridas s&atilde;o de sua exclusiva responsabilidade.</p>
                    
                    <p class="pl-1 mb-2 text-sm">k. Nossos sites incluem links para organiza&ccedil;&otilde;es externas de terceiros e informa&ccedil;&otilde;es que podem ser &uacute;teis para jogadores problem&aacute;ticos que precisam de mais assist&ecirc;ncia de profissionais. Se voc&ecirc; acha que pode estar desenvolvendo um v&iacute;cio ou problema em jogos de azar, recomendamos que voc&ecirc; consulte essas organiza&ccedil;&otilde;es. Por favor, entre em contato conosco diretamente caso sinta que o jogo afetou sua vida de forma negativa ou reconhe&ccedil;a que voc&ecirc; tem algum problema de jogo. A fim de proteger o bem-estar das pessoas afetadas por problemas de jogo que est&atilde;o em uma situa&ccedil;&atilde;o cr&iacute;tica e expressam pensamentos suicidas aos nossos agentes por meio de comunica&ccedil;&atilde;o direta, nos reservamos o direito de entrar em contato com as autoridades locais relevantes para buscar uma a&ccedil;&atilde;o imediata.</p>
                    
                    <p class="pl-1 mb-2 text-sm">l. Observe que o &apos;tempo ocioso&apos; &eacute; atingido ap&oacute;s 40 minutos sem atividade, momento em que os usu&aacute;rios ser&atilde;o desconectados automaticamente. &Eacute; responsabilidade dos usu&aacute;rios individuais manter a seguran&ccedil;a de suas contas, certificando-se de que ningu&eacute;m mais tenha acesso &agrave;s suas senhas ou detalhes de login. Recomendamos que os usu&aacute;rios sempre saiam se o dispositivo estiver potencialmente acess&iacute;vel por outras pessoas, especialmente menores de idade ou pessoas com problemas de jogo conhecidos.</p>
                    
                    <p class="pl-1 mb-2 text-sm">m. Se no momento de solicitar a autoexclus&atilde;o ainda houver apostas pendentes, cujo resultado ainda n&atilde;o seja conhecido, as apostas que vencerem posteriormente ter&atilde;o os ganhos enviados assim que o evento for liquidado.</p>
                    
                    <p class="pl-1 mb-2 text-sm">n. Se o usu&aacute;rio tiver motivos para acreditar que uma pessoa menor de 18 anos est&aacute; acessando nossos servi&ccedil;os, entre em contato conosco imediatamente. Nossa equipe de suporte pode ser contatada por e-mail: [endere&ccedil;o de e-mail] ou pelo LiveChat em nosso site.</p>
                    
                    <p class="pl-1 mb-2 text-sm">o. Esteja ciente de que todos os dados confidenciais relacionados a problemas de jogo ou exclus&atilde;o devem ser coletados e mantidos em registros para realizar nossas fun&ccedil;&otilde;es estatut&aacute;rias relacionadas aos indiv&iacute;duos afetados.</p>
                    
                    <p class="pl-1 mb-10 text-sm">p. A BrazaBet monitora todos os canais de comunica&ccedil;&atilde;o e revisa minuciosamente todos os documentos enviados. Com base nas informa&ccedil;&otilde;es fornecidas ou comunicadas pelo jogador, a BrazaBet reserva-se o direito de suspender a conta do jogador se o jogador apresentar sinais de problemas de jogo.</p>
                   
                    <p class="font-semibold text-base mb-1">Transfer&ecirc;ncia de conta</p>
                    
                    <p class="pl-1 mb-10 text-sm">Voc&ecirc; est&aacute; proibido de transferir ou vender sua Conta para outra pessoa. Esta proibi&ccedil;&atilde;o inclui a transfer&ecirc;ncia de quaisquer ativos de valor de qualquer tipo, como, no entanto, n&atilde;o limitado &agrave; propriedade de contas, ganhos, dep&oacute;sitos, apostas, direitos e/ou reclama&ccedil;&otilde;es relacionadas a esses ativos, legais, comerciais ou outros. A proibi&ccedil;&atilde;o de tais transfer&ecirc;ncias tamb&eacute;m inclui, mas n&atilde;o se limita a onera&ccedil;&atilde;o, penhor, cess&atilde;o, usufruto, negocia&ccedil;&atilde;o, corretagem, hipoteca e/ou doa&ccedil;&atilde;o em coopera&ccedil;&atilde;o com um fiduci&aacute;rio ou qualquer outro terceiro, empresa, pessoa f&iacute;sica ou jur&iacute;dica, funda&ccedil;&atilde;o e /ou associa&ccedil;&atilde;o de qualquer forma ou forma.</p>
                    
            </div>
        </div>
    </div>

    <input type="checkbox" id="privacy" class="modal-toggle" />
    <div class="modal modal-bottom">
        <label for="privacy" class="fixed right-4 top-2"
            style="background: #ffffffeb; border-radius: 3px; padding: 10px;">
            <svg class="w-6 h-6 text-black cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </label>
        <div class="modal-box" style="background: #fff !important;">
            <div class="flex flex-col justify-center max-w-4xl mx-auto text-black">
                <h3 class="font-bold text-2xl text-center capitalize mb-20">Politica de Privacidade</h3>
                <p dir="ltr"  class="font-semibold text-base mb-1">KYC E POL&Iacute;TICA DE PRIVACIDADE BRAZABET</p>
                
                <p dir="ltr" class="pl-1 mb-1 text-sm">Na BrazaBet, uma das nossas principais prioridades &eacute; a privacidade dos nossos clientes. Este documento de Pol&iacute;tica de Privacidade cont&eacute;m tipos de informa&ccedil;&otilde;es que s&atilde;o coletadas e processadas pela BrazaBet e como as usamos.</p>
                
                <p dir="ltr" class="pl-1 mb-1 text-sm">Se voc&ecirc; tiver d&uacute;vidas adicionais ou precisar de mais informa&ccedil;&otilde;es sobre nossa Pol&iacute;tica de Privacidade, entre em contato conosco pelo e-mail support@BrazaBet.com.</p>
                
                <p dir="ltr" class="pl-1 mb-10 text-sm">Esta Pol&iacute;tica de Privacidade aplica-se &agrave;s nossas atividades de processamento de dados e &eacute; v&aacute;lida para todos os nossos clientes no que diz respeito &agrave;s informa&ccedil;&otilde;es que partilharam com a BrazaBet. Esta pol&iacute;tica &eacute; aplic&aacute;vel a qualquer informa&ccedil;&atilde;o coletada online e offline.</p>
                
                <p dir="ltr" class="font-semibold text-base mb-1" >CONSENTIMENTO</p>
                <p dir="ltr" class="pl-1 mb-10 text-sm">Ao usar nossos servi&ccedil;os, voc&ecirc; concorda com nossa Pol&iacute;tica de Privacidade e concorda com seus termos.</p>
                
                <p dir="ltr" class="font-semibold text-base mb-1">INFORMA&Ccedil;&Otilde;ES QUE COLETAMOS</p>
                <p dir="ltr" class="pl-1 mb-1 text-sm">As informa&ccedil;&otilde;es pessoais que voc&ecirc; deve fornecer e as raz&otilde;es pelas quais voc&ecirc; &eacute; solicitado a fornec&ecirc;-las ser&atilde;o esclarecidas para voc&ecirc; no momento em que solicitarmos que voc&ecirc; forne&ccedil;a suas informa&ccedil;&otilde;es pessoais.</p>
                
                <p dir="ltr" class="pl-1 mb-1 text-sm">Se voc&ecirc; entrar em contato diretamente com a BrazaBet, podemos receber informa&ccedil;&otilde;es adicionais sobre voc&ecirc;, como seu nome, endere&ccedil;o de e-mail, n&uacute;mero de telefone, o conte&uacute;do da mensagem e/ou anexos que voc&ecirc; nos enviar e qualquer outra informa&ccedil;&atilde;o que voc&ecirc; decida fornecer.</p>
                
                <p dir="ltr" class="pl-1 mb-10 text-sm">Quando voc&ecirc; se registra em uma conta, podemos solicitar suas informa&ccedil;&otilde;es de contato, incluindo itens como nome, documentos, endere&ccedil;o, endere&ccedil;o de e-mail e n&uacute;mero de telefone.</p>
                
                <p dir="ltr" class="font-semibold text-base mb-1">COMO USAMOS SUAS INFORMA&Ccedil;&Otilde;ES</p>
                <p dir="ltr" class="pl-1 mb-1 text-sm">Usamos as informa&ccedil;&otilde;es que coletamos de v&aacute;rias maneiras, incluindo:</p>
                
                <ul class="pl-2 mb-2">
                    <p dir="ltr" class="pl-1 text-sm">Fornecer, operar e manter nosso site.</p>
                    <p dir="ltr" class="pl-1 text-sm">Melhorar, personalizar e expandir nosso site.</p>
                    <p dir="ltr" class="pl-1 text-sm">Compreender e analisar como voc&ecirc; usa nosso site.</p>
                    <p dir="ltr" class="pl-1 text-sm">Desenvolver novos produtos, servi&ccedil;os, recursos e funcionalidades.</p>
                    <p dir="ltr" class="pl-1 text-sm">Comunicar-se com voc&ecirc;, diretamente ou por meio de um de nossos parceiros, inclusive para atendimento ao cliente, para fornecer atualiza&ccedil;&otilde;es e outras informa&ccedil;&otilde;es relacionadas ao site e para fins promocionais e de marketing.</p>
                    <p dir="ltr" class="pl-1 text-sm">Enviar-lhe e-mails.</p>
                    <p dir="ltr" class="pl-1 mb-10 text-sm">Encontrar e prevenir fraudes.</p>
                </ul>
                
                
                
                <p dir="ltr" class="font-semibold text-base mb-1">COOKIES DO SITE</p>
                
                <p dir="ltr" class="pl-1 mb-10 text-sm">Como qualquer outro site, o site BrazaBet usa &apos;cookies&apos;. Esses cookies s&atilde;o usados para armazenar informa&ccedil;&otilde;es, incluindo as prefer&ecirc;ncias dos visitantes e as p&aacute;ginas do site que o visitante acessou ou visitou. As informa&ccedil;&otilde;es s&atilde;o usadas para otimizar a experi&ecirc;ncia dos usu&aacute;rios, personalizando o conte&uacute;do de nossa p&aacute;gina da web com base no tipo de navegador dos visitantes e/ou outras informa&ccedil;&otilde;es.</p>
                
                <p dir="ltr" class="font-semibold text-base mb-1">POL&Iacute;TICAS DE PRIVACIDADE DE TERCEIROS</p>
                <p dir="ltr" class="pl-1 mb-1 text-sm">A Pol&iacute;tica de Privacidade da BrazaBet n&atilde;o se aplica a outros anunciantes ou sites. Assim, aconselhamos que consulte as respectivas Pol&iacute;ticas de Privacidade desses servidores de an&uacute;ncios de terceiros para obter informa&ccedil;&otilde;es mais detalhadas. Pode incluir suas pr&aacute;ticas e instru&ccedil;&otilde;es sobre como desativar determinadas op&ccedil;&otilde;es.</p>
                
                <p dir="ltr" class="pl-1 mb-10 text-sm">Voc&ecirc; pode optar por desabilitar os cookies atrav&eacute;s das op&ccedil;&otilde;es individuais do seu navegador. Para saber informa&ccedil;&otilde;es mais detalhadas sobre o gerenciamento de cookies com navegadores espec&iacute;ficos, pode ser encontrada nos respectivos sites dos navegadores.</p>
                
                <p dir="ltr" class="font-semibold text-base mb-1">DIREITOS DE PROTE&Ccedil;&Atilde;O DE DADOS</p>
                
                <p dir="ltr" class="pl-1 mb-1 text-sm">Gostar&iacute;amos de ter certeza de que voc&ecirc; est&aacute; totalmente ciente de todos os seus direitos de prote&ccedil;&atilde;o de dados.</p>
                
                <p dir="ltr" class="pl-1 mb-1 text-sm">Todo usu&aacute;rio tem direito ao seguinte:</p>
                
                <ul class="pl-2 mb-2">
                    <li dir="ltr" class="pl-1 text-sm">O direito de acesso &ndash; Voc&ecirc; tem o direito de solicitar c&oacute;pias de seus dados pessoais. Podemos cobrar uma pequena taxa por este servi&ccedil;o.</li>
                    <li dir="ltr" class="pl-1 text-sm">O direito de retifica&ccedil;&atilde;o &ndash; Voc&ecirc; tem o direito de solicitar que corrijamos qualquer informa&ccedil;&atilde;o que voc&ecirc; acredite estar imprecisa. Voc&ecirc; tamb&eacute;m tem o direito de solicitar que completemos as informa&ccedil;&otilde;es que voc&ecirc; acredita estarem incompletas. Ressaltamos que qualquer retifica&ccedil;&atilde;o passar&aacute; por processo de an&aacute;lise.</li>
                    <li dir="ltr" class="pl-1 text-sm">O direito de n&atilde;o divulga&ccedil;&atilde;o &ndash; Voc&ecirc; tem o direito de solicitar que n&atilde;o divulguemos seus dados pessoais ap&oacute;s t&ecirc;-lo concedido previamente, sob certas condi&ccedil;&otilde;es.</li>
                    <li dir="ltr" class="pl-1 text-sm">O direito de restringir o processamento &ndash; Voc&ecirc; tem o direito de solicitar que restrinjamos o processamento de seus dados pessoais, sob certas condi&ccedil;&otilde;es.</li>
                    <li dir="ltr" class="pl-1 text-sm">O direito de se opor ao processamento &ndash; Voc&ecirc; tem o direito de se opor ao nosso processamento de seus dados pessoais, sob certas condi&ccedil;&otilde;es.</li>
                    <li dir="ltr" class="pl-1 text-sm">O direito &agrave; portabilidade de dados &ndash; Voc&ecirc; tem o direito de solicitar que transfiramos os dados que coletamos para outra organiza&ccedil;&atilde;o, ou diretamente para voc&ecirc;, sob certas condi&ccedil;&otilde;es.</li>
                    
                </ul>
                <p dir="ltr" class="pl-1 mb-10 text-sm">Se voc&ecirc; fizer uma solicita&ccedil;&atilde;o, temos um m&ecirc;s para responder. Se voc&ecirc; deseja exercer algum desses direitos, entre em contato conosco.</p>

                
                
                <p dir="ltr" class="font-semibold text-base mb-1">INFORMA&Ccedil;&Otilde;ES PARA CRIAN&Ccedil;AS</p>
                
                
                <p dir="ltr" class="pl-1 mb-1 text-sm">Outra parte da prioridade da BrazaBet &eacute; adicionar prote&ccedil;&atilde;o para crian&ccedil;as durante o uso da internet. Incentivamos os pais e respons&aacute;veis a observar, participar e/ou monitorar e orientar suas atividades online.</p>
                
                <p dir="ltr" class="pl-1 mb-10 text-sm">A BrazaBet n&atilde;o coleta intencionalmente quaisquer Informa&ccedil;&otilde;es Pessoais Identific&aacute;veis de crian&ccedil;as menores de 18 anos. Se voc&ecirc; acha que seu filho forneceu esse tipo de informa&ccedil;&otilde;es em nosso site, recomendamos que voc&ecirc; entre em contato conosco imediatamente e faremos nossos melhores esfor&ccedil;os para remover prontamente essas informa&ccedil;&otilde;es de nossos registros. A BrazaBet ressalta que n&atilde;o tolera, recepciona, promove, incentiva ou fomenta o jogo de apostas esportivas ou qualquer jogo oferecido no site para menores de 18 anos.</p>
                
                
            </div>
        </div>
    </div>
    <script>
        var side = $("#sideNav-id")

        $(".toggleSide").click(function() {
            side.toggleClass("w-screen w-0");
        })
    </script>

    <script src="https://unpkg.com/sweet-scroll/sweet-scroll.min.js"></script>
    <script type="text/javascript">
        document.getElementById('main').onclick = function clear() {}
    </script>
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1630997884034834');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1630997884034834&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QG319XVY2G"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-QG319XVY2G');
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-268823267-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-268823267-1');
    </script>
</body>

</html>
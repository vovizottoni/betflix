<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background: #252539;">


        {{
            Vite::useBuildDirectory('/user')
          }}

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>BrazaBet</title>
        

        <!-- OG -->
        <meta property="og:title" content="BrazaBet" />
        <meta property="og:url" content="https://www.brazabet.net" />
        <meta property="og:title" content="BrazaBet" />
        <meta property="og:description" content="BrazaBet é o melhor lugar para apostas online no Brasil. Oferecemos uma ampla variedade de opções de apostas, além de promoções exclusivas e suporte ao cliente de alta qualidade. Com a nossa plataforma fácil de usar, você pode se divertir e ganhar dinheiro de forma segura e confiável!" />
        <meta property="og:image" content="https://brazabet.net/assets/images/branding/OG.jpg" />
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="{{asset('assets/images/branding/icons/browserconfig.xml')}}">
        <meta name="theme-color" content="#ffffff">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/branding/icons/apple-touch-icon.png')}}">
        <link rel="icon" type="image/x-icon" href="{{asset('assets/images/branding/favicon.png')}}">
        <link rel="icon" type="image/x-icon" href="{{asset('assets/images/branding/favicon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/branding/icons/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/branding/icons/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('assets/images/branding/icons/site.webmanifest')}}">
        <link rel="mask-icon" href="{{asset('assets/images/branding/icons/safari-pinned-tab.svg')}}" color="#5bbad5">
        <link rel="shortcut icon" href="{{asset('assets/images/branding/icons/favicon.ico')}}">
    

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <style type="text/css">
        html {
              color: #fff !important;
            }
        .w-full.sm\:max-w-md.shadow-md.overflow-hidden.sm\:rounded-lg.bg-\[\#0e1830\].rounded-md.px-4.sm\:px-16.py-16 {
            margin-top: 80px !important;
            background: #13142af7 !important;
        }

        .checkbox, .checkbox:checked, .checkbox[checked=true], .checkbox[aria-checked=true], [type=text]:focus, [type=email]:focus, [type=url]:focus, [type=password]:focus, [type=number]:focus, [type=date]:focus, [type=datetime-local]:focus, [type=month]:focus, [type=search]:focus, [type=tel]:focus, [type=time]:focus, [type=week]:focus, [multiple]:focus, textarea:focus, select:focus {

            border-color: 2px solid #ffffffb3 !important;
        }

        option {
            color: #000 !important;
        }

        .auth-bg {
            background: url('assets/images/backgrounds/bg-provisorio.jpg');
            background-size: cover;
            background-position: 100% 100%;
        }

        input#email,
        input#password,
        input#my_invite_code,
        input#cpf,
        input#birth_date,
        input#name,
        input#invite_code {
            background: #ffffff0d !important; width: 100%; border-radius: 5px !important; border: 1px solid #ffffff14 !important; height: 50px !important; font-size: 14px !important;
        }
    </style>
    <body class="relative grid md:grid-cols-2 lg:grid-cols-3">

        <div class="font-sans text-base-300 antialiased bg-[#090f1e]" style="position: relative; z-index: 1 !important;">

            {{ $slot }}

        </div>

        <div class="auth-bg col-span-2">
        </div>


        <script>
            function mascaraDataAniversario(inputData) {
              inputData.value = inputData.value.replace(/\D/g, '');
              inputData.value = inputData.value.replace(/(\d{2})(\d)/, '$1/$2');
              inputData.value = inputData.value.replace(/(\d{2})(\d)/, '$1/$2');
              inputData.value = inputData.value.replace(/(\d{4})\d+?$/, '$1');
            }
        </script>

        <script>
            $(function() {
            $("#cpf").on("keyup", function(event) {
                var value = $(this).val();
                $(this).val(value.replace(/[^0-9]/g, ""));
            });
            });
        </script>
        @yield('scripts')
    </body>

</html>

<div class="mx-auto px-6 lg:px-8">

    <div class="py-10 hidden">
            <h1 class="text-5xl font-bold">Promoções e Bônus</h1>
            <p class="">Confira nossas promoções e bônus ativos, e obtenha o máximo de benefícios possíveis para você e seus amigos.</p>
      </div>


    <div class="justify-center grid {{--md:max-w-3xl md:mx-auto--}} md:grid-cols-2 gap-8 py-24 max-w-6xl mx-auto">
        <label for="promo-modal2" class="bonus-card" style="background-image: url(https://1win.pro/img/express-bonus.fe5063ef-477.png),linear-gradient(103.36deg, rgb(253, 187, 78), rgb(245, 103, 25)); background-position: 100%; background-size: contain; background-repeat: repeat-y; box-shadow: rgb(245 103 25) 0px 26px 80px -20px;">
            <div class="p-6" style="max-width: 100%; width: 400px;">
                <h3 class="text-4xl">Bônus para afiliados</h3>
                <p class="mt-5 text-sm">Fature alto sempre que você convidar um novo amigo para a BrazaBet. <b>Você ganha</b> e <b>ele também</b>!</p>
                    <div class="absolute bottom-0 mb-6 rounded-md" style="padding: 10px; background: #00000024">
                        <svg class="w-6 h-6"fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </div>
            </div>
        </label>

    </div>

    <style type="text/css">
        .step-badge {
            padding: 4px 12.5px;
            background: -webkit-linear-gradient(99.83deg,#fdc63d -48.63%,#ff9815 97.54%);
            background: linear-gradient(99.83deg,#fdc63d -48.63%,#ff9815 97.54%);
            box-shadow: 0 6px 22px rgb(218 128 5 / 30%);
            border-radius: 3px;
            font-weight: 700;
            font-size: 11px;
            line-height: 1.29;
            letter-spacing: -.15px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .step-badge.gray {
            background: rgba(9,15,30,.1) !important;
            color: #090f1e !important;
            box-shadow: none;
        }

        .point {
            padding-left: 20px;
        }

        .point:before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            position: absolute;
            margin-top: 4px;
            margin-left: -20px;
        }

        .point.green:before {
            background: -webkit-linear-gradient(237.63deg,#089e4e -31.69%,#31bc69 103.31%);
            background: linear-gradient(212.37deg,#089e4e -31.69%,#31bc69 103.31%);
        }

        .point.blue:before {
            background: -webkit-linear-gradient(179.92deg,#0098f8 .07%,#2e6df2 32.32%,#7f5efb 65.6%,#6e88ff 99.93%);
            background: linear-gradient(179.92deg,#0098f8 .07%,#2e6df2 32.32%,#7f5efb 65.6%,#6e88ff 99.93%);
        }

        .modal {
            background-color: #000000a3 !important;
        }
    </style>

    {{-- Modais --}}
    <input type="checkbox" id="promo-modal1" class="modal-toggle" />
    <div class="modal modal-bottom">

        <img src="assets/bonus/06.png" alt="" class="absolute top-12 z-50 right-14 md:top-24 md:right-36 w-32">
        <img src="assets/bonus/02.png" alt="" class="absolute top-12 z-50 left-2 md:top-24 md:left-36 w-32">

        <label for="promo-modal1" class="fixed right-4 top-2" style="background: #ffffffeb; border-radius: 3px; padding: 10px;">
            <svg class="w-6 h-6 text-black cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </label>
        <div class="modal-box pt-16 flex flex-col gap-16 items-center relative modal-bonus">

            <div class="hero relative max-w-fit">
                <div class="hero-content text-center">
                  <div class="max-w-md">
                    <h1 class="font-bold text-5xl text-[56px]">Bônus de primeiro depósito</h1>
                    <p class="text-lg py-6">Novos clientes, ao realizarem o seu primeiro depósito na BrazaBet são premiados com <b>até R$ 1.000,00 em bônus</b>!</p>
                    @auth
                    <a href="#" style="background-image: -webkit-linear-gradient(350.17deg,#fdc63d -48.63%,#ff9815 97.54%); background-image: linear-gradient(99.83deg,#fdc63d -48.63%,#ff9815 97.54%); box-shadow: 0 12px 24px rgb(255 166 33 / 35%); border-radius: 3px; padding: 15px 35px; font-weight: 700; font-size: 16px; line-height: 1.25;">Você já participou desta promoção!</a>
                    @else
                    <a href="{{url('/register')}}" style="background-image: -webkit-linear-gradient(350.17deg,#fdc63d -48.63%,#ff9815 97.54%); background-image: linear-gradient(99.83deg,#fdc63d -48.63%,#ff9815 97.54%); box-shadow: 0 12px 24px rgb(255 166 33 / 35%); border-radius: 3px; padding: 15px 35px; font-weight: 700; font-size: 16px; line-height: 1.25;">Registrar e receber Bônus</a>
                    @endif
                  </div>
                </div>

                <img src="assets/bonus/01.png" class="absolute top-0 right-0 w-6" alt="">
                <img src="assets/bonus/07.png" class="absolute top-80 right-12 w-8" alt="">
                <img src="assets/bonus/03.png" class="absolute top-72 left-0 w-16" alt="">
                <img src="assets/bonus/05.png" class="absolute top-16 right-8 w-16" alt="">
                <img src="assets/bonus/08.png" class="absolute top-16 left-16 w-18" alt="">

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 max-w-3xl gap-16">
                <h1 class="text-3xl font-bold col-span-full text-center mb-8">Garanta seu bônus em passos simples:</h1>

                <img class="rounded-lg order-2 md:order-1 mx-auto md:mx-0" src="/assets/bonus/deposito/passo-1.png" alt="">
                <div class="flex flex-col items-center md:items-start gap-4 relative order-1 md:order-2">
                    <div class="step-badge">1º Passo</div>
                    <h3 class="text-2xl" style="letter-spacing: 0.7px; font-weight: 600;">Realize o depósito</h3>
                    <p>Realize o seu primeiro depósito com valor mínimo de R$ 50,00 e máximo de R$ 1.000,00.</p>
                </div>

                <div class="flex flex-col items-center md:items-start gap-4 relative order-3">
                    <div class="step-badge">2º Passo</div>
                    <h3 class="text-2xl" style="letter-spacing: 0.7px; font-weight: 600;">Receba o bônus de 100% automaticamente</h3>
                    <p>Realize o seu primeiro depósito com valor mínimo de R$ 50,00 e máximo de R$ 1.000,00.</p>
                </div>
                <img class="rounded-lg order-4 mx-auto md:mx-0" src="/assets/bonus/deposito/passo-2.png" alt="">

                <div class="flex flex-col md:flex-row justify-between order-5 relative border-2 border-spacing-3 border-dashed border-gray-300 rounded-lg col-span-full p-5 gap-16">

                    <div class="flex flex-col justify-center items-center md:items-start w-full md:w-7/12">
                        <div class="step-badge gray">Exemplo</div>
                        <p class="text-center md:text-left mt-4 mb-2 text-sm">Após o registro você realizou um depósito  de <span class="whitespace-nowrap">R$ 50,00</span>, instantâneamente você também vai receber mais R$ 50,00 extras em bônus.</p>
                        <p class="text-sm point green pt-2">Conta principal: <span class="font-bold">R$ 50,00</span></p>
                        <p class="text-sm point blue pt-2">Conta de bônus: <span class="font-bold">R$ 50,00</span>*</p>
                    </div>

                    <img class="rounded-lg order-10 mx-auto md:mx-0" src="/assets/bonus/deposito/exemplo.png" alt="">

                </div>


                <img class="rounded-lg order-7 md:order-6 mx-auto md:mx-0" src="/assets/bonus/deposito/passo-3.png" alt="">
                <div class="flex flex-col items-center md:items-start order-6 md:order-7 gap-4 relative">
                    <div class="step-badge">3º Passo</div>
                    <h3 class="text-2xl" style="letter-spacing: 0.7px; font-weight: 600;">Selecione o Saldo bônus</h3>
                    <p>Para Apostar os fundos de bônus, selecione a sua carteira de bônus através do widget de saldos</p>
                </div>

                <div class="flex flex-col items-center md:items-start order-8 gap-4 relative">
                    <div class="step-badge">4º Passo</div>
                    <h3 class="text-2xl" style="letter-spacing: 0.7px; font-weight: 600;">Receba seu lucro</h3>
                    <p class="text-center md:text-left">Receba os lucros das apostas realizada no seu saldo principal, e faça o que quiser com ele</p>
                </div>
                <img class="rounded-lg order-9 mx-auto md:mx-0" src="/assets/bonus/deposito/passo-4.png" alt="">

            </div>


            <div class="divider"></div>

            <div class="max-w-3xl">
                <p class="opacity-50 text-xs">1. O valor mínimo do depósito elegível para o bônus é de R$ 50,00. | 2. O valor máximo do bônus pago é de R$ 1.000,00. | 3. A oferta de bônus está disponível exclusivamente para novos clientes. | 4. O dinheiro apostado da conta de bônus para a conta principal fica imediatamente disponível para circulação. | 5. A BrazaBet reserva-se o direito de realizar uma verificação adicional do titular da conta ou restringir a participação do jogador nessa promoção a qualquer momento.</p>
            </div>
        </div>



    </div>

    <input type="checkbox" id="promo-modal2" class="modal-toggle" />
    <div class="modal modal-bottom">

        <img src="assets/bonus/06.png" alt="" class="absolute top-12 z-50 right-14 md:top-24 md:right-36 w-32">
        <img src="assets/bonus/02.png" alt="" class="absolute top-12 z-50 left-2 md:top-24 md:left-36 w-32">


        <label for="promo-modal2" class="fixed right-4 top-2" style="background: #ffffffeb; border-radius: 3px; padding: 10px;">
            <svg class="w-6 h-6 text-black cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </label>


        <div class="modal-box pt-16 flex flex-col gap-16 items-center relative modal-bonus">

            <div class="hero relative max-w-fit">
                <div class="hero-content text-center">
                  <div class="max-w-md">
                    <h1 class="font-bold text-5xl text-[56px]">Indique amigos e ganhe!</h1>
                    <p class="text-lg py-6">Sempre que você convida um novo amigo para a BrazaBet, <b>você ganha</b> e <b>ele também</b>!</p>
                    @auth
                    <a href="{{ route('player.myinvitations') }}" style="background-image: -webkit-linear-gradient(350.17deg,#fdc63d -48.63%,#ff9815 97.54%); background-image: linear-gradient(99.83deg,#fdc63d -48.63%,#ff9815 97.54%); box-shadow: 0 12px 24px rgb(255 166 33 / 35%); border-radius: 3px; padding: 15px 35px; font-weight: 700; font-size: 16px; line-height: 1.25;">Indique novos amigos</a>
                    @else
                    <a href="{{url('/register')}}" style="background-image: -webkit-linear-gradient(350.17deg,#fdc63d -48.63%,#ff9815 97.54%); background-image: linear-gradient(99.83deg,#fdc63d -48.63%,#ff9815 97.54%); box-shadow: 0 12px 24px rgb(255 166 33 / 35%); border-radius: 3px; padding: 15px 35px; font-weight: 700; font-size: 16px; line-height: 1.25;">Registre-se e indique novos amigos</a>
                    @endif
                  </div>
                </div>


                <img src="assets/bonus/01.png" class="absolute top-0 right-0 w-6" alt="">
                <img src="assets/bonus/07.png" class="absolute top-56 right-12 w-8" alt="">
                <img src="assets/bonus/03.png" class="absolute top-60 left-8 w-16" alt="">
                <img src="assets/bonus/05.png" class="absolute top-16 right-8 w-16" alt="">
                <img src="assets/bonus/08.png" class="absolute top-16 left-8 w-18" alt="">


            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 max-w-3xl gap-16">
                <h1 class="text-3xl font-bold col-span-full text-center mb-8">Garanta seu bônus em passos simples:</h1>
                <img class="rounded-lg order-2 md:order-1 mx-auto md:mx-0" src="/assets/bonus/afiliado/passo-1.png" alt="">
                <div class="flex flex-col items-center md:items-start gap-4 relative order-1 md:order-2">
                    <div class="step-badge">1º Passo</div>
                    <h3 class="text-2xl" style="letter-spacing: 0.7px; font-weight: 600;">Compartilhe seu código de convite</h3>
                    <p>Envie seu código de convite para que seu amigo possa utilizá-lo no momento do cadastro na plataforma</p>
                </div>
                <div class="flex flex-col items-center md:items-start gap-4 relative order-3">
                    <div class="step-badge">2º Passo</div>
                    <h3 class="text-2xl" style="letter-spacing: 0.7px; font-weight: 600;">Verifique seus afiliados</h3>
                    <p>Você poderá verificar os usuários que utilizaram o seu código de convite na página de afiliados</p>
                </div>
                <img class="rounded-lg order-4 mx-auto md:mx-0" src="/assets/bonus/afiliado/passo-2.png" alt="">
                <img class="rounded-lg order-6 md:order-5 mx-auto md:mx-0" src="/assets/bonus/afiliado/passo-3.png" alt="">
                <div class="flex flex-col items-center md:items-start order-5 md:order-6 gap-4 relative">
                    <div class="step-badge">3º Passo</div>
                    <h3 class="text-2xl" style="letter-spacing: 0.7px; font-weight: 600;">Receba seu bônus</h3>
                    <p>Quando seu amigo realizar o seu primeiro depósito, você receberá um bônus de R$ 25,00. O valor mínimo do depósito elegível é de R$ 50,00.</p>
                </div>
                <div class="flex flex-col items-center md:items-start order-7 gap-4 relative">
                    <div class="step-badge">4º Passo</div>
                    <h3 class="text-2xl" style="letter-spacing: 0.7px; font-weight: 600;">Seu convidado também receberá bônus</h3>
                    <p>Você já pode utilizar o seu bônus para apostar</p>
                </div>
                <img class="rounded-lg order-8 mx-auto md:mx-0" src="/assets/bonus/afiliado/passo-4.png" alt="">

            </div>

            <div class="divider"></div>

            <div class="max-w-3xl">
                <p class="opacity-50 text-xs">1. Seu amigo deve ter depositado pelo menos 50.00 BRL para receber o prêmio do convite. | 2. Você não pode criar novas contas na Blaze e se inscrever através do seu próprio link para receber a recompensa. O programa Indique um Amigo é feito para nossos jogadores convidarem amigos para a plataforma Blaze. Qualquer outro uso deste programa é estritamente proibido. | 3. A BrazaBet pode suspender ou encerrar o programa Indique um Amigo ou a capacidade do usuário de participar dele a qualquer momento, por qualquer motivo. Nos reservamos o direito de suspender as contas ou remover o saldo em dinheiro, se observarmos qualquer atividade que julgarmos abusiva, fraudulenta ou que viole os Termos de Serviço. Nos reservamos o direito de revisar e investigar todas as atividades de indicação e de suspender contas ou modificar as referências a nosso critério, conforme considerado justo e apropriado.</p>
            </div>


        </div>
    </div>
</div>

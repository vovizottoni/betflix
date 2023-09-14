<div>
    <?php
    $depositStatus = getMetaValue("deposit_status", false);
    $whiteList = joinByCommas(getMetaValue("disabled_deposit_exception", ""));
    $email = Auth::user()->email;

    if (!$depositStatus && in_array($email, $whiteList)) {
        $depositStatus = true;
    }

    ?>
    @if(!$depositStatus)
        <h3 class="text-lg font-bold">Nenhum método de pagamento disponível no momento</h3>

    @else

        @if (empty($request_completed_coingate) && empty($qrCodePIX) && empty($keyPIX) && empty($coingate_error))
            <div wire:loading.remove wire:target="cashinPIX,coinGateCashin" class="w-full bg-transparent my-6" style="margin-top: 70px;">
                {{-- botão PIX --}}
                <a id="btn-pix" wire:click.prevent="selectTabPIX()"
                   class="text-white gap-4 flex transition-all ease-in rounded-md p-2 {{ $abaAtiva=='pix'?'tab-active':'' }} mb-2"
                   style="background: #ffffff05; border: 1px solid #ffffff0f;">
                    @if ($abaAtiva=='pix')
                        <div class="selector-selected"
                             style="width: 20px; height: 20px; background: #1bb019; padding: 5px !important; border: 5px solid #4e4e4e; margin: 3px; border-radius: 50px; cursor: pointer;"></div>
                    @else
                        <div class="selector-selected"
                             style="width: 20px; height: 20px; background: #494747; padding: 5px !important; border: 5px solid #4e4e4e; margin: 3px; border-radius: 50px; cursor: pointer;"></div>
                    @endif
                    <img class="w-6 h-6" src="{{asset('assets/images/payment-methods/pixIcon.png')}}">
                    <div>
                        <h3 class="font-bold">{{__("cashin.opcao_pix")}}</h3>
                        {{--
                        <p class="text-xs"><b class="font-bold">{{__("cashin.confirmation")}}:</b><span class="opacity-50"> {{__("cashin.instantaneous")}}</span><br><b class="font-bold">{{__("cashin.transaction_fee")}}</b> <span class="opacity-50">0%</span></p>
                        --}}
                    </div>
                </a>
                {{-- botão CoinGate --}}
                {{--
                <a id="btn-credit" wire:click.prevent="selectTabCoingate()" class="text-white gap-4 flex transition-all ease-in rounded-md p-2 {{ $abaAtiva=='coingate'?'tab-active':'' }} " style="background: #ffffff05; border: 1px solid #ffffff0f;">
                    @if ($abaAtiva=='coingate')
                    <div class="selector-selected" style="width: 20px; height: 20px; background: #1bb019; padding: 5px !important; border: 5px solid #4e4e4e; margin: 15px; border-radius: 50px; cursor: pointer;"></div>
                    @else
                    <div class="selector-selected" style="width: 20px; height: 20px; background: #494747; padding: 5px !important; border: 5px solid #4e4e4e; margin: 15px; border-radius: 50px; cursor: pointer;"></div>
                    @endif
                    <img class="w-12 h-12" src="{{asset('assets/images/payment-methods/coingate.jpeg')}}">
                    <div>
                        <h3 class="font-bold">{{__("cashin.coin_gate")}}</h3>
                        <p class="text-xs"><b class="font-bold">{{__("cashin.confirmation")}}:</b><span class="opacity-50"> {{__("cashin.instantaneous")}}</span><br><b class="font-bold">{{__("cashin.transaction_fee")}}</b> <span class="opacity-50">1%</span></p>
                    </div>
                </a>
                --}}
            </div>
        @endif
        <!-- Mensagens de erro -->
        @if ($msgError)
            <div class="alert alert-error shadow-lg min-w-full rounded-md mb-6">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-xs break-all">{{$msgError}}</span>
                </div>
            </div>
        @endif
        <form>
            <!-- PIX  -->
            <!-- PIX  -->
            @if ($abaAtiva == 'pix' && empty($pagstar_payment_credit_card_page) && empty($qrCodePIX) && empty($keyPIX))
                <div id="tab-pix" wire:loading.remove.loading.delay wire:target="cashinPIX"
                     class="rounded-lg flex flex-col w-full gap-4">
                    <div class="form-control w-full hidden">
                        <label class="label">
                            <span class="text-white font-bold text-xs text-opacity-75">{{ __('cashin.account_id_session') }}:</span>
                        </label>
                        <!-- Captura account_id da sessao-->
                        <input type="text" value="{{ $details_account_id->name }}" disabled
                               class="input input-bordered w-full disabled:bg-base-700 border-none text-white text-opacity-75"/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="text-white font-bold text-sm text-opacity-75">{{ __('cashin.quantidade_desejada') }}:</span>
                        </label>
                        <label class="input-group">
                            <span class="bg-[#070c19] text-white font-bold">R$</span>
                            <input type="text" wire:model="value_" placeholder="0,00"
                                   onchange="@this.set('value_', this.value);" wire:ignore id="value_ID"
                                   class="input input-bordered text-white bg-base-700 w-full"/>
                            <!-- Hack for livewire with mask: onchange="@this.set('value_', this.value);" wire:ignore -->
                        </label>
                        @error('value_') <span class="error text-red-700">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <button wire:click.prevent="PutValueInQuantity({{ '8000' }})" id="button_price_10_ID"
                                class="btn bg-base-700 border-none text-white hover:text-green-600">
                            <span class="font-black mr-1">{{ __('cashin.moeda') }}</span>80,00
                        </button>
                        <button wire:click.prevent="PutValueInQuantity({{ '15000' }})" id="button_price_20_ID"
                                class="btn bg-base-700 border-none text-white hover:text-green-600">
                            <span class="font-black mr-1">{{ __('cashin.moeda') }}</span>150,00
                        </button>
                        <button wire:click.prevent="PutValueInQuantity({{ '30000' }})" id="button_price_50_ID"
                                class="btn bg-base-700 border-none text-white hover:text-green-600">
                            <span class="font-black mr-1">{{ __('cashin.moeda') }}</span>300,00
                        </button>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                <span class="text-white font-bold text-sm text-opacity-75">{{ __('cashin.seu_nome') }}:
                </span>
                        </label>
                        <input type="text" wire:model="name" onchange="@this.set('name', this.value);" wire:ignore
                               id="name_ID" placeholder="{{ __('cashin.digite_aqui') }}" minlength="6" maxlength="40"
                               class="input input-bordered text-white w-full bg-base-700"/>
                        <!-- Hack for livewire with mask: onchange="@this.set('name', this.value);" wire:ignore -->
                        @error('name') <span class="error text-red-700">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control w-full hidden">
                        <label class="label">
                <span class="text-white font-bold">{{ __('cashin.seu_documento') }}
                </span>
                        </label>
                        <input type="text" value="{{ $document }}" disabled
                               class="input input-bordered w-full disabled:bg-base-700 border-none text-white text-opacity-75"/>
                    </div>
                    <button type="button" wire:click.prevent="cashinPIX()" wire:loading.attr="disabled"
                            class="w-fit self-end capitalize flex gap-4 rounded-sm btn btn-block border-none mt-8 text-white disabled:text-base-100" style="background: #239953;">
                        {{__("cashin.click_here_to_make")}}
                        <svg fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                        </svg>
                    </button>
                </div>
            @endif
            <!-- PIX  -->
            <!-- PIX  -->
            <!-- PIX PAGAMENTO -->
            <div wire:loading.delay wire:target="cashinPIX" class="w-full">
                <div class="loading ml-auto mr-auto mb-4 mt-12 w-[100px]"></div>
                <div
                    class="ml-auto mr-auto mb-4 text-center text-sm font-bold mb-12">{{ __('cashin.gerando_pix') }}</div>
                <style type="text/css">
                    .payment-notdisplay {
                        display: none;
                    }
                </style>
            </div>
            @if ($qrCodePIX && $keyPIX)

                <div wire:poll.2750ms>
                    @if(!$this->depositIsPaid())
                        <div class="w-full">
                            {{-- O QR code vai aparecer aqui --}}
                            <img class="ml-auto mr-auto" src="{{ $qrCodePIX }}" alt=""
                                 style="width: 180px; border-radius: 3px;">
                        </div>
                        <br>
                        <!-- <p class="text-center py-4"><span
                                class="fonr-bold">{{__("cashin.deposit_request_successfully")}}</span> {{__("cashin.scan_the_qr")}}
                        </p> -->

                        <div class="w-full" style="max-width: 100% !important;">
                            {{--
                              <input type="hidden" id="pix_key" value="{{ $keyPIX }}">
                              <button type="button" readonly class="pix-copy w-100 cursor-pointer justify-center" style="max-width: 100% !important; background: #2e2e2e; border-radius: 3px !important; color: #fff9; font-size: 13px;">
                                <span>{{ $keyPIX }}</span>
                              </button>
                              <button type="button" data-clipboard-target="#pix_key" id="copy-pix" class="flex gap-4" style="margin-top: 10px; color: #aee959 !important; background: #ffffff21; padding: 10px; border-radius: 3px; font-weight: 600; text-transform: uppercase; font-size: 13px; line-height: 26px; width: 100%;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                {{ __('cashin.copiar_chave_pix') }}
                              </button>
                            --}}

                            <style type="text/css">
                                #tippy-3 {
                                    z-index: 99999999 !important;
                                }
                            </style>

                            <div class="w-full" style="max-width: 100% !important;">
                            <input type="hidden" id="pix_key" value="{{ $keyPIX }}">
                            <button type="button" readonly class="pix-copy w-100 cursor-pointer justify-center" style="max-width: 100% !important; background: #2e2e2e; border-radius: 3px !important; color: #fff9; font-size: 13px;">
                                <span>{{ $keyPIX }}</span>
                            </button>
                            <button type="button" data-clipboard-target="#pix_key" id="copy-pix" class="flex gap-4"
                                    style="margin-top: 10px; color: #aee959 !important; background: #ffffff0d; padding: 10px; border-radius: 3px; font-weight: 600; text-transform: uppercase; font-size: 13px; line-height: 26px; width: 100%;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                {{ __('cashin.copiar_chave_pix') }}
                            </button>
                            <ol class="list-decimal list-inside" style="font-size: 13px; padding: 20px; border: 1px dashed; border-radius: 9px; margin-top: 25px">
                            <p class="font-bold" style="font-size: 15px; color: #fff; margin-bottom: 10px">Instruções para pagamento:</p>
                            <p><span class="font-bold" style="color: #aee958;">1.</span> Copie o código acima</p>
                            <p><span class="font-bold" style="color: #aee958;">2.</span> Abra seu app de pagamento</p>
                            <p><span class="font-bold" style="color: #aee958;">3.</span> Abra a opção Pix em seu App do Banco</p>
                            <p><span class="font-bold" style="color: #aee958;">4.</span> Cole o código na opção PIX COPIA E COLA ou no campo informado pelo seu Banco</p>
                            </ol>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
                            <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/esm/popper.js"></script>
                            <script src="https://unpkg.com/tippy.js@6.3.1/dist/tippy-bundle.umd.js"></script>
                            <script>
                                $(document).ready(function () {
                                    var copyPixBtn = document.getElementById('copy-pix');
                                    var pixKey = $("#pix_key").val();
                                    var tippyInstance = tippy(copyPixBtn, {
                                        content: 'Link copiado!',
                                        trigger: 'manual',
                                        zIndex: 99999999,
                                        position: 'absolute',
                                        placement: 'top',
                                        popperOptions: {
                                            modifiers: [
                                                {
                                                    name: 'offset',
                                                    options: {
                                                        offset: [0, 8],
                                                    },
                                                },
                                            ],
                                        },
                                    });

                                    copyPixBtn.addEventListener('click', function () {
                                        navigator.clipboard.writeText(pixKey).then(function () {
                                            tippyInstance.show();
                                            setTimeout(function () {
                                                tippyInstance.hide();
                                            }, 1500);
                                        });
                                    });
                                });
                            </script>
                        </div>



                        </div>

                    @else
                        <style type="text/css">
                            .svg-success {
                                display: inline-block;
                                vertical-align: top;
                                height: 100px;
                                width: 100px;
                                opacity: 1;
                                overflow: visible;
                            }

                            @keyframes success-tick {
                                0% {
                                    stroke-dashoffset: 16px;
                                    opacity: 1
                                }

                                100% {
                                    stroke-dashoffset: 31px;
                                    opacity: 1
                                }
                            }

                            @keyframes success-circle-outline {
                                0% {
                                    stroke-dashoffset: 72px;
                                    opacity: 1
                                }

                                100% {
                                    stroke-dashoffset: 0px;
                                    opacity: 1
                                }
                            }

                            @keyframes success-circle-fill {
                                0% {
                                    opacity: 0;
                                }

                                100% {
                                    opacity: 1;
                                }
                            }

                            .success-tick {
                                fill: none;
                                stroke-width: 1px;
                                stroke: #ffffff;
                                stroke-dasharray: 15px, 15px;
                                stroke-dashoffset: -14px;
                                animation: success-tick 450ms ease 1400ms forwards;
                                opacity: 0;
                            }

                            .success-circle-outline {
                                fill: none;
                                stroke-width: 1px;
                                stroke: #81c038;
                                stroke-dasharray: 72px, 72px;
                                stroke-dashoffset: 72px;
                                animation: success-circle-outline 300ms ease-in-out 800ms forwards;
                                opacity: 0;
                            }

                            .success-circle-fill {
                                fill: #81c038;
                                stroke: none;
                                opacity: 0;
                                animation: success-circle-fill 300ms ease-out 1100ms forwards;
                            }
                            @media screen and (-ms-high-contrast: active), screen and (-ms-high-contrast: none) {
                                .success-tick {
                                    stroke-dasharray: 0;
                                    stroke-dashoffset: 0;
                                    animation: none;
                                    opacity: 1;
                                }

                                .success-circle-outline {
                                    stroke-dasharray: 0;
                                    stroke-dashoffset: 0;
                                    animation: none;
                                    opacity: 1;
                                }

                                .success-circle-fill {
                                    animation: none;
                                    opacity: 1;
                                }
                            }

                            }

                            .hidden {
                                display: none !important;
                            }


                        </style>
                        <div class="p-2 pb-12 flex flex-col text-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-success mx-auto mt-12"
                                 viewBox="0 0 24 24">
                                <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                                    <circle class="success-circle-outline" cx="12" cy="12" r="11.5"/>
                                    <circle class="success-circle-fill" cx="12" cy="12" r="11.5"/>
                                    <polyline class="success-tick" points="17,8.5 9.5,15.5 7,13"/>
                                </g>
                            </svg>
                            <h3 class="font-bold text-lg pt-6">Depósito confirmado com sucesso!</h3>
                            <p class="opacity-75">Já confirmamos o seu pagamento e ele já foi creditado em sua carreira! Clique no botão abaixo e bora se divertir!</p>
                            <a href="javascript:window.location.href=window.location.href" style="margin-top: 20px; border-radius: 3px; border: 2px solid #fff; padding: 10px
                               20px;">Clique para recarregar seu saldo</a>
                        </div>

                    @endif


                </div>

                <style type="text/css">
                    .tippy-box {
                        background: #aee958 !important;
                        color: #000 !important;
                        font-weight: 800;
                    }

                    .tippy-arrow {
                        color: #aee958 !important;
                    }

                    .payment-notdisplay {
                        display: none;
                    }
                </style>
            @endif
            <!-- PIX PAGAMENTO -->
            <!-- COINGATE  -->
            <!-- COINGATE  -->
            {{-- modal coingate --}}
            @if (empty($coingate_error) && ($abaAtiva == 'coingate') && empty($request_completed_coingate))
                <div wire:loading.remove.loading.delay wire:target="coinGateCashin" id="tab-coingate"
                     class="rounded-lg p-2 flex-col w-full gap-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="text-white opacity-75 font-bold">{{ __('cashin.quantidade_desejada') }}</span>
                        </label>
                        <label class="input-group">
                            <span class="bg-base-900">R$</span>
                            <input type="text" placeholder="0,00" wire:model="coingate_amount"
                                   onchange="@this.set('coingate_amount', this.value);" wire:ignore
                                   id="coingate_amount_id" class="input input-bordered bg-base-700 w-full"/>
                            <!-- Hack for livewire with mask: onchange="@this.set('valuecc_', this.value);" wire:ignore -->
                        </label>
                        @error('coingate_amount') <span class="error text-red-700">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="grid grid-cols-3 gap-2">
                        <button wire:click.prevent="PutValueInQuantityCoingate({{ '1000' }})" id="button_pricecc_10_ID"
                                class="btn bg-base-700 border-none hover:bg-base-800"><span
                                class="font-black mr-1">{{ __('cashin.moeda') }}</span>10
                        </button>
                        <button wire:click.prevent="PutValueInQuantityCoingate({{ '2000' }})" id="button_pricecc_20_ID"
                                class="btn bg-base-700 border-none hover:bg-base-800"><span
                                class="font-black mr-1">{{ __('cashin.moeda') }}</span>20
                        </button>
                        <button wire:click.prevent="PutValueInQuantityCoingate({{ '5000' }})" id="button_pricecc_50_ID"
                                class="btn bg-base-700 border-none hover:bg-base-800"><span
                                class="font-black mr-1">{{ __('cashin.moeda') }}</span>50
                        </button>
                        <button wire:click.prevent="PutValueInQuantityCoingate({{ '10000' }})"
                                id="button_pricecc_100_ID" class="btn bg-base-700 border-none hover:bg-base-800"><span
                                class="font-black mr-1">{{ __('cashin.moeda') }}</span>100
                        </button>
                        <button wire:click.prevent="PutValueInQuantityCoingate({{ '50000' }})"
                                id="button_pricecc_500_ID" class="btn bg-base-700 border-none hover:bg-base-800"><span
                                class="font-black mr-1">{{ __('cashin.moeda') }}</span>500
                        </button>
                        <button wire:click.prevent="PutValueInQuantityCoingate({{ '100000' }})"
                                id="button_pricecc_1000_ID" class="btn bg-base-700 border-none hover:bg-base-800"><span
                                class="font-black mr-1">{{ __('cashin.moeda') }}</span>1000
                        </button>
                        <button wire:click.prevent="PutValueInQuantityCoingate({{ '200000' }})"
                                id="button_pricecc_2000_ID" class="btn bg-base-700 border-none hover:bg-base-800"><span
                                class="font-black mr-1">{{ __('cashin.moeda') }}</span>2000
                        </button>
                        <button wire:click.prevent="PutValueInQuantityCoingate({{ '500000' }})"
                                id="button_pricecc_5000_ID" class="btn bg-base-700 border-none hover:bg-base-800"><span
                                class="font-black mr-1">{{ __('cashin.moeda') }}</span>5000
                        </button>
                        <button wire:click.prevent="PutValueInQuantityCoingate({{ '1000000' }})"
                                id="button_pricecc_10000_ID" class="btn bg-base-700 border-none hover:bg-base-800"><span
                                class="font-black mr-1">{{ __('cashin.moeda') }}</span>10000
                        </button>
                    </div>

                    <button type="button" wire:click.prevent="coinGateCashin()" wire:loading.attr="disabled"
                            class="btn btn-block bg-red-700 hover:bg-red-900 border-none mt-8">{{ __('cashin.gerar') }}</button>
                </div>
            @endif
            {{-- animação de loading na tela --}}
            <div wire:loading.delay wire:target="coinGateCashin" class="w-full">
                <div class="loading ml-auto mr-auto mb-4 mt-12"></div>
                <div
                    class="ml-auto mr-auto mb-4 text-center font-bold mb-12">{{ __('Gerando um pagamento a ser efetuado via CoinGate') }}</div>
                <style type="text/css">
                    .payment-notdisplay {
                        display: none;
                    }
                </style>
            </div>
            {{-- se der tudo certo na requisição de pagamento, carrega um iframe --}}
            @if ($request_completed_coingate)
                <div>
                    <p class="text-center py-4"><span
                            class="fonr-bold">{{__("cashin.coingate_deposit_request_successfully")}}</span></p>
                    <br>
                    <div class="flex justify-center items-center">
                        <a class="text-center text-md underline" all href="{{ $coingate_payment_url }}"
                           target="_blank">{{__('cashin.click_here_link')}}</a>
                    </div>
                </div>
            @endif
            {{-- se der erro na requisição, mostra mensagem de erro --}}
            @if ($coingate_error)
                <div>
                    <p class="text-center py-4"><span
                            class="fonr-bold">{{__('cashin.error')}}</span> {{__('cashin.try_again')}}</p>
                </div>
            @endif
        </form>
        
        <!-- JS/JQUERY -->
        <script type="text/javascript">
            // -----------------------------------------------------------------------------------------------------------------------------
            // -----------------------------------------------------------------------------------------------------------------------------
            //jAVASCRIPT DEFINIDO AQUI PARA CARREGAMENTO INICIAL DA VIEW

            //maskmoney
            $("#value_ID").maskMoney({
                prefix: "",
                affixesStay: false,
                decimal: ",",
                thousands: ".",
                allowZero: false,
                allowNegative: false
            });
            $("#coingate_amount_id").maskMoney({
                prefix: "",
                affixesStay: false,
                decimal: ",",
                thousands: ".",
                allowZero: false,
                allowNegative: false
            });


            //only alfanumeric caracters and length [6-50]
            $.mask.definitions['Q'] = "[A-Za-z0-9 ]";

            //Document CPF mask
            //$("#document_ID").mask("999.999.999-99");


            $(document).ready(function () {

                //focus after click button price
                window.livewire.on('focus-in-button-quantity', function () {
                    $("#value_ID").focus();
                });

                //focus after click button price cc
                window.livewire.on('focus-in-button-quantity-coingate', function () {
                    $("#coingate_amount_id").focus();
                });


            });
            // -----------------------------------------------------------------------------------------------------------------------------
            // -----------------------------------------------------------------------------------------------------------------------------


            //##################################################################################################################################################################################################################
            //##################################################################################################################################################################################################################
            //o momento callback dehydrate() é executando sempre apos um render e ele dispara o contentChanged para dar um refresh no JS
            document.addEventListener('contentChanged', function (e) {

                //maskmoney
                $("#value_ID").maskMoney({
                    prefix: "",
                    affixesStay: false,
                    decimal: ",",
                    thousands: ".",
                    allowZero: false,
                    allowNegative: false
                });
                $("#coingate_amount_id").maskMoney({
                    prefix: "",
                    affixesStay: false,
                    decimal: ",",
                    thousands: ".",
                    allowZero: false,
                    allowNegative: false
                });


                //only alfanumeric caracters and length [6-50]
                $.mask.definitions['Q'] = "[A-Za-z0-9 ]";

                //Document CPF mask
                //$("#document_ID").mask("999.999.999-99");


                $(document).ready(function () {

                    //focus after click button price
                    window.livewire.on('focus-in-button-quantity', function () {
                        $("#value_ID").focus();
                    });

                    //focus after click button price cc
                    window.livewire.on('focus-in-button-quantitycc', function () {
                        $("#coingate_amount_id").focus();
                    });


                });

            });
            //##################################################################################################################################################################################################################
            //##################################################################################################################################################################################################################

        </script>

    @endif

</div>

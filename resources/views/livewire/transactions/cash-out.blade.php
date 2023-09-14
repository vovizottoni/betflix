<div>
    @if(Auth::user()->rollover_bonus1_opcao <> 's' || Auth::user()->cpf == '00000000000' || Auth::user()->cpf == '0')
    <div>

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
        @if($cashoutActive)

            <div class="mt-10 ml-auto mr-auto flex flex-col items-center gap-8">


                <form class="w-full">

                    @if ($msgRetornoSaquePIX)
                        <div wire:poll.visible>
                            <?php
                                $status = $this->getWithdrawStatus();
                            ?>
                            <div class="p-2 pb-12 flex flex-col text-center gap-4">
                                @if($status=='processing')
                                    <svg class="svg-success mx-auto mt-12" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h3 class="font-bold text-lg pt-6">Por favor, aguarde...</h3>
                                    <p class="opacity-75">Estamos realizando o processamento da sua solicitação, e  isso pode demorar alguns minutos.</p>
                                @elseif($status=='paid')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-success mx-auto mt-12"
                                         viewBox="0 0 24 24">
                                        <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                                            <circle class="success-circle-outline" cx="12" cy="12" r="11.5"/>
                                            <circle class="success-circle-fill" cx="12" cy="12" r="11.5"/>
                                            <polyline class="success-tick" points="17,8.5 9.5,15.5 7,13"/>
                                        </g>
                                    </svg>
                                    <h3 class="font-bold text-lg pt-6">{{ __('cashout.msgRetornoSaquePIX') }}</h3>
                                    <p class="opacity-75">Sua solicitação de saque foi realizada e aprovada com sucesso, e estará disponível em sua conta bancária nos próximos minutos</p>

                                    <div class="dollarDollarBillYall moreMoneyMoreProblems">
                                        <div class="dollar-50"></div>
                                        <div class="dollar-49"></div>
                                        <div class="dollar-48"></div>
                                        <div class="dollar-47"></div>
                                        <div class="dollar-46"></div>
                                        <div class="dollar-45"></div>
                                        <div class="dollar-44"></div>
                                        <div class="dollar-43"></div>
                                        <div class="dollar-42"></div>
                                        <div class="dollar-41"></div>
                                        <div class="dollar-40"></div>
                                        <div class="dollar-39"></div>
                                        <div class="dollar-38"></div>
                                        <div class="dollar-37"></div>
                                        <div class="dollar-36"></div>
                                        <div class="dollar-35"></div>
                                        <div class="dollar-34"></div>
                                        <div class="dollar-33"></div>
                                        <div class="dollar-32"></div>
                                        <div class="dollar-31"></div>
                                        <div class="dollar-30"></div>
                                        <div class="dollar-29"></div>
                                        <div class="dollar-28"></div>
                                        <div class="dollar-27"></div>
                                        <div class="dollar-26"></div>
                                        <div class="dollar-25"></div>
                                        <div class="dollar-24"></div>
                                        <div class="dollar-23"></div>
                                        <div class="dollar-22"></div>
                                        <div class="dollar-21"></div>
                                        <div class="dollar-20"></div>
                                        <div class="dollar-19"></div>
                                        <div class="dollar-18"></div>
                                        <div class="dollar-17"></div>
                                        <div class="dollar-16"></div>
                                        <div class="dollar-15"></div>
                                        <div class="dollar-14"></div>
                                        <div class="dollar-13"></div>
                                        <div class="dollar-12"></div>
                                        <div class="dollar-11"></div>
                                        <div class="dollar-10"></div>
                                        <div class="dollar-9"></div>
                                        <div class="dollar-8"></div>
                                        <div class="dollar-7"></div>
                                        <div class="dollar-6"></div>
                                        <div class="dollar-5"></div>
                                        <div class="dollar-4"></div>
                                        <div class="dollar-3"></div>
                                        <div class="dollar-2"></div>
                                        <div class="dollar-1"></div>
                                        <div class="dollar-0"></div>
                                    </div>
                                @elseif($status=='compliance')
                                    <svg style="color: red" class="svg-success mx-auto mt-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                    </svg>
                                    <h3 class="font-bold text-lg pt-6">Análise de Compliance</h3>
                                    <p class="opacity-75" >Seus dados de saque estão sendo analisados pelo compliance, e este processo pode levar <b class="font-bold">até 2 horas</b>. Volte novamente e tente realizar seu saque PIX novamente após este prazo, e caso não obtenha sucesso, entre em contato com o suporte e solicite a troca de titularidade da sua conta.</p>
                                @endif
                            </div>
                        </div>

                    @endif

                    <div class="<?php if($msgRetornoSaquePIX) echo'hidden'; ?>">
                        @if($haveWithdrawal == '0')
                            @if ($showDiv)
                                <div class="first-withdrawal" >
                                    <h2 class="text-base font-bold mt-8 text-center">Este é seu primeiro saque, leia atentamente as instruções antes de realizá-lo:</h2>
                                    <div class="flex gap-4 mt-8">
                                        <div style="background: #00c1ff4d; width: 30px !important; min-width: 30px; max-width: 30px; height: 30px; border-radius: 3px; padding: 4px; border: 1px solid #1099cc;">
                                                <svg fill="none" stroke="#1099cc" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs">Apenas primeiros saques para CPFs passam por processo de compliance, que pode levar de 15 minutos a 2 horas. Nas próximas retiradas este processo não precisará ser realizado novamente.</p>
                                    </div>
                                    <div class="flex gap-4 mt-4">
                                        <div style="background: #00c1ff4d; width: 30px !important; min-width: 30px; max-width: 30px; height: 30px; border-radius: 3px; padding: 4px; border: 1px solid #1099cc;">
                                                <svg fill="none" stroke="#1099cc" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs">Não são aprovados saques para titulares PIX menores de 18 anos.</p>
                                    </div>
                                    <div class="flex gap-4 mt-4">
                                        <div style="background: #00c1ff4d; width: 30px !important; min-width: 30px; max-width: 30px; height: 30px; border-radius: 3px; padding: 4px; border: 1px solid #1099cc;">
                                                <svg fill="none" stroke="#1099cc" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs">Não são aprovados saques para pessoas que possuem restrições na receita federal ou processos criminais</p>
                                    </div>
                                    <div class="flex gap-4 mt-4">
                                        <div style="background: #00c1ff4d; width: 30px !important; min-width: 30px; max-width: 30px; height: 30px; border-radius: 3px; padding: 4px; border: 1px solid #1099cc;">
                                                <svg fill="none" stroke="#1099cc" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs">Não são aprovados saques para dados que tenham divergência. Ex: Data de nascimento ou nome do titular incorretos ou mal preenchidos</p>
                                    </div>
                                    <div class="flex gap-4 mt-4">
                                        <div style="background: #00c1ff4d; width: 30px !important; min-width: 30px; max-width: 30px; height: 30px; border-radius: 3px; padding: 4px; border: 1px solid #1099cc;">
                                                <svg fill="none" stroke="#1099cc" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs">Os valores depositados devem ser movimentados 2x antes de serem retirados, e isso pode impactar no valor Disponível para retirada.</p>
                                    </div>
                                    <div wire:click="closeWithdrawalRules" style="margin-top: 40px; background: linear-gradient(45deg, #37be60, #45d73d); padding: 10px; border-radius: 3px; color: black; font-weight: bold; text-align: center;">
                                        Clique aqui para realizar o saque
                                    </div>
                                </div>
                            @else
                            <div style="margin-bottom: 100px;">

                                @if ($msgError)
                                    <div class="error-block p-6">
                                        <span>{{ $msgError }}</span>
                                    </div>
                                @endif

                                <div id="tab-pix" class="p-2 flex flex-col gap-4">
                                    <div class="flex gap-4">
                                        <div class="flex gap-4"
                                             style="border-bottom: 1px solid #ffffff30; padding-bottom: 15px; width: -webkit-fill-available;">
                                            <svg class="w-8 h-8" style="color: #1fcb1f" fill="none" stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
                                            </svg>
                                            <div>
                                                <h3 class="text-lg font-bold">
                                                    @if($amount_available <= '0')
                                                    R$ 0,00
                                                    @else
                                                    R$ {{number_format($amount_available,2,',','.')}}
                                                    @endif</h3>
                                                <p class="text-xs opacity-70">Disponível para retirada</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-4"
                                             style="border-bottom: 1px solid #ffffff30; padding-bottom: 15px; width: -webkit-fill-available;">
                                            <svg class="w-8 h-8" style="color: orange;" fill="none" stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3"></path>
                                            </svg>
                                            <div>
                                                <h3 class="text-lg font-bold">
                                                    R$ {{number_format($details_account_id->balance,2,',','.')}}</h3>
                                                <p class="text-xs opacity-70">Saldo Total</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-control">
                                          <label class="label">
                                            <span class="text-white font-bold text-sm text-opacity-75">Titular da Conta:
                                            </span>
                                          </label>

                                          <!-- Captura account_id da sessao-->
                                          <input type="text" value="{{ $details_account_id->name }}" disabled class="input input-bordered border-none text-white" />

                                      </div>

                                      <div class="form-control">
                                          <label class="label">
                                              <span class="text-white font-bold text-sm text-opacity-75">{{__("cashout.pix_key")}} (CPF):
                                              </span>
                                          </label>
                                          <input type="text" value="{{ $document }}" disabled class="input input-bordered border-none text-white bg-base-700" />
                                      </div>

                                    <div class="form-control">
                                        <label class="label">
                                            <span
                                                class="text-white font-bold text-sm text-opacity-75">{{ __('cashout.quantidade_desejada') }}</span>
                                        </label>
                                        <label class="input-group">
                                            <span class="bg-base-900 text-white">{{ __('cashout.simbolo_moeda') }}</span>
                                            <input type="text" wire:model="value_" onchange="@this.set('value_', this.value);"
                                                   wire:ignore id="value_ID_cashout" placeholder="0,00"
                                                   class="input input-bordered text-white bg-base-700 w-full"/>
                                            <!-- Hack for livewire with mask: onchange="@this.set('value_', this.value);" wire:ignore -->
                                        </label>

                                        @error('value_')
                                        <div class="error-block p-2 mt-2">
                                            <span class="text-xs">{{ $message }}</span>
                                        </div>
                                        @enderror


                                    </div>

                                </div>

                                <div class="form-control hidden">
                                    <label class="label">
                                      <span class="text-white font-bold">{{ __('cashout.seu_documento') }}
                                      </span>
                                    </label>
                                    <input type="text" value="{{ $document }}" disabled
                                           class="input input-bordered border-none text-white bg-base-700"/>
                                </div>


                                <button type="button" wire:click.prevent="cashoutPIX()" wire:loading.attr="disabled"
                                        style="margin-top: 40px; background: linear-gradient(45deg, #37be60, #45d73d); padding: 10px; border-radius: 3px; color: black; font-weight: bold; text-align: center; width: 100%; display: flex; justify-content: center; column-gap: 10px;">{{__("cashout.click_to_make")}}
                                    <svg fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>

                            </div>
                            @endif
                        @else
                        <div style="margin-bottom: 100px;">

                                @if ($msgError)
                                    <div class="error-block p-6">
                                        <span>{{ $msgError }}</span>
                                    </div>
                                @endif

                                <div id="tab-pix" class="p-2 flex flex-col gap-4">
                                    <div class="flex gap-4">
                                        <div class="flex gap-4"
                                             style="border-bottom: 1px solid #ffffff30; padding-bottom: 15px; width: -webkit-fill-available;">
                                            <svg class="w-8 h-8" style="color: #1fcb1f" fill="none" stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
                                            </svg>
                                            <div>
                                                <h3 class="text-lg font-bold">
                                                    @if($amount_available <= '0')
                                                    R$ 0,00
                                                    @else
                                                    R$ {{number_format($amount_available,2,',','.')}}
                                                    @endif</h3>
                                                <p class="text-xs opacity-70">Disponível para retirada</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-4"
                                             style="border-bottom: 1px solid #ffffff30; padding-bottom: 15px; width: -webkit-fill-available;">
                                            <svg class="w-8 h-8" style="color: orange;" fill="none" stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3"></path>
                                            </svg>
                                            <div>
                                                <h3 class="text-lg font-bold">
                                                    R$ {{number_format($details_account_id->balance,2,',','.')}}</h3>
                                                <p class="text-xs opacity-70">Saldo Total</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-control">
                                          <label class="label">
                                            <span class="text-white font-bold text-sm text-opacity-75">Titular da Conta:
                                            </span>
                                          </label>

                                          <!-- Captura account_id da sessao-->
                                          <input type="text" value="{{ $details_account_id->name }}" disabled class="input input-bordered border-none text-white" />

                                      </div>

                                      <div class="form-control">
                                          <label class="label">
                                              <span class="text-white font-bold text-sm text-opacity-75">{{__("cashout.pix_key")}} (CPF):
                                              </span>
                                          </label>
                                          <input type="text" value="{{ $document }}" disabled class="input input-bordered border-none text-white bg-base-700" />
                                      </div>

                                    <div class="form-control">
                                        <label class="label">
                                            <span
                                                class="text-white font-bold text-sm text-opacity-75">{{ __('cashout.quantidade_desejada') }}</span>
                                        </label>
                                        <label class="input-group">
                                            <span class="bg-base-900 text-white">{{ __('cashout.simbolo_moeda') }}</span>
                                            <input type="text" wire:model="value_" onchange="@this.set('value_', this.value);"
                                                   wire:ignore id="value_ID_cashout" placeholder="0,00"
                                                   class="input input-bordered text-white bg-base-700 w-full"/>
                                            <!-- Hack for livewire with mask: onchange="@this.set('value_', this.value);" wire:ignore -->
                                        </label>

                                        @error('value_')
                                        <div class="error-block p-2 mt-2">
                                            <span class="text-xs">{{ $message }}</span>
                                        </div>
                                        @enderror


                                    </div>

                                </div>

                                <div class="form-control hidden">
                                    <label class="label">
                                      <span class="text-white font-bold">{{ __('cashout.seu_documento') }}
                                      </span>
                                    </label>
                                    <input type="text" value="{{ $document }}" disabled
                                           class="input input-bordered border-none text-white bg-base-700"/>
                                </div>


                                <button type="button" wire:click.prevent="cashoutPIX()" wire:loading.attr="disabled"
                                        style="margin-top: 40px; background: linear-gradient(45deg, #37be60, #45d73d); padding: 10px; border-radius: 3px; color: black; font-weight: bold; text-align: center; width: 100%; display: flex; justify-content: center; column-gap: 10px;">{{__("cashout.click_to_make")}}
                                    <svg fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>

                            </div>
                        @endif
                    </div>
                </form>
            </div>

            <div wire:loading.delay.longest>
                <div class="loading ml-auto mr-auto mb-4 mt-12"></div>
                <div class="ml-auto mr-auto mb-4 text-center font-bold mb-12">{{ __('cashin.gerando_pix') }}</div>
            </div>
        @else
            <h1 class="font-bold text-center text-xl">Nosso Gatway de saque está em período de manutenção programada.
                Tente novamente em até uma hora. Estamos trabalhando para melhor atende-los.</h1>
        @endif

    </div>
    @endif

<!-- JS/JQUERY -->
<script type="text/javascript">

    //maskmoney
    $("#value_ID_cashout").maskMoney({
        prefix: "",
        affixesStay: false,
        decimal: ",",
        thousands: ".",
        allowZero: false,
        allowNegative: false
    });

</script>
</div>
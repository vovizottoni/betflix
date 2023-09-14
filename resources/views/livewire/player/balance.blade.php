<div>
    <div class="dropdown-content card-compact w-52 rounded-md p-2 shadow mt-2" style="background: #fff;">
        <div>
            <div class="form-control">
                <label for="balance" class="label">
                    <div class="flex flex-col justify-start">
            <span
                class="label-text text-base font-bold"
                style="color: #090f1e;"
            >
              R$
              {{ number_format($balance, 2, ',', '.') }}
            </span>

                        <span
                            class="text-xs font-bold text-black opacity-50" style="color: #090f1e;">Saldo
              Real
            </span>
                    </div>
                    <button wire:click.prevent="changeBalanceUsed('balance')" name="balance" id="balance" class="btn btn-circle btn-sm group">
                        @if($balanceUsed == 'balance')
                            <svg class="h-6 w-6 fill-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M243.8 339.8C232.9 350.7 215.1 350.7 204.2 339.8L140.2 275.8C129.3 264.9 129.3 247.1 140.2 236.2C151.1 225.3 168.9 225.3 179.8 236.2L224 280.4L332.2 172.2C343.1 161.3 360.9 161.3 371.8 172.2C382.7 183.1 382.7 200.9 371.8 211.8L243.8 339.8zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                        @else
                            <svg class="h-6 w-6 fill-base-400 group-hover:fill-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                        @endif


                    </button>

                </label>

                <label for="balanceBonus" class="label">
                    <div class="flex flex-col justify-start">
            <span
                class="label-text text-base font-bold" style="color: #090f1e;"
            >R$
              {{ number_format($balanceBonus, 2, ',', '.') }}</span>
                        <span
                            class="text-xs font-bold text-black opacity-50" style="color: #090f1e;">Saldo
              Bônus
            </span>
                    </div>

                    <button wire:click.prevent="changeBalanceUsed('balanceBonus')" name="balanceBonus" id="balanceBonus" class="btn btn-circle btn-sm group">
                        @if($balanceUsed == 'balanceBonus')
                            <svg class="h-6 w-6 fill-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M243.8 339.8C232.9 350.7 215.1 350.7 204.2 339.8L140.2 275.8C129.3 264.9 129.3 247.1 140.2 236.2C151.1 225.3 168.9 225.3 179.8 236.2L224 280.4L332.2 172.2C343.1 161.3 360.9 161.3 371.8 172.2C382.7 183.1 382.7 200.9 371.8 211.8L243.8 339.8zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                        @else
                            <svg class="h-6 w-6 fill-base-400 group-hover:fill-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                        @endif


                    </button>

                </label>

            </div>

            {{-- se player participar do rollover, mostra o progresso --}}
            @if ($rollover_active == 's' && $total_value_rollover )
                <div class="form-control" style="cursor: not-allowed;">
                    <p class="border-t border-gray-100 pt-4 text-xs font-black text-white opacity-50">{{__('balance.rollover_progress')}}</p>
                    <p class="font-semibold mt-2 text-xs text-white opacity-50 text-right">
                        {{number_format($current_value_rollover, 2, ',', '.')}} / {{number_format($total_value_rollover, 2, ',', '.')}}
                    </p>
                    <progress class="mt-1 progress progress-success w-56" value="{{$current_value_rollover}}" max="{{$total_value_rollover}}"></progress>
                </div>
            @endif

            {{--
            <button>
              <label
                for="depo-modal"
                class="auth-btn mx-auto mt-4 w-full border-none font-bold uppercase text-black hover:bg-green-900"
                style="background: #2CE080; width: 100%; min-width: 100%; max-width: 100%; padding: 10px 25px; margin-top: 10px; font-size: 13px; display: block;"
              >
                Depositar Fundos
              </label>
            </button>
            --}}
        </div>
    </div>
</div>

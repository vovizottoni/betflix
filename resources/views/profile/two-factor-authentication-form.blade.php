<x-jet-action-section>
    <x-slot name="title">
        {{__("profile.google_authenticator")}}
    </x-slot>

    <x-slot name="description">
        {{__("profile.add_additional_security")}}
    </x-slot>

    <x-slot name="content">
        <style type="text/css">
            
            .svg2fa svg {
                text-align: center !important;
                margin: 0 auto;
                margin-top: 40px;
                border-radius: 5px;
            }
        </style>
        <h3 class="text-lg font-bold text-white">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{__("profile.complete_enabling_two_factor")}}
                @else
                    {{__("profile.you_enabled_two_factor")}}
                @endif
            @else
                {{__("profile.you_not_enabled_two_factor")}}
            @endif
        </h3>

        <div class="mt-3 w-full text-sm text-white">
            <p class="text-white text-opacity-75">
                {{__("profile.when_two_factor_authentication")}}.
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mx-auto mt-4 w-full text-sm">
                    <p class="font-semibold text-white">
                        @if ($showingConfirmation)
                            {{__("profile.to_finish_activating_two_factor")}}
                        @else
                            {{__("profile.two_factor_authentication_enabled")}}
                        @endif
                    </p>
                </div>

                <div class="mt-4 svg2fa">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 w-full text-sm text-white text-center">
                    <p class="font-semibold">
                        {{__("profile.configuration_key")}} {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-jet-label for="code" style="text-align: center;" value="{{ __('Código gerado no Google Authenticator:') }}" />

                        <x-jet-input id="code" type="text" name="code" class="block w-1/2 mx-auto mt-3 mb-2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model.defer="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-jet-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 w-full text-sm">
                    <p class="font-semibold text-white">
                        {{__("profile.store_these_recovery_codes")}}
                    </p>
                </div>

                <div class="grid gap-1 w-full mt-4 px-4 py-4 font-mono text-sm rounded-sm" style="background: #ffffff0f;">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5 flex gap-4">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{__("profile.enable")}}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{__("profile.generate_new_recovery_codes")}}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @elseif ($showingConfirmation)
                    <x-jet-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-jet-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{__("profile.confirm")}}
                        </x-jet-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{__("profile.show_recovery_codes")}}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-secondary-button wire:loading.attr="disabled">
                            {{__("profile.cancel")}}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-danger-button wire:loading.attr="disabled">
                            {{__("profile.disable")}}
                        </x-jet-danger-button>
                    </x-jet-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-jet-action-section>

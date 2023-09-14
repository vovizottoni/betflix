<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-white" x-show="! recovery">
                {{ __('auth.please_confirm_access_your_account') }}
            </div>

            <div class="mb-4 text-sm text-white" x-show="recovery">
                {{ __('auth.confirm_access_your_account') }}
            </div>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-jet-label for="code" value="{{ __('auth.authentication_code') }}:" />
                    <x-jet-input id="code" class="block mt-1 w-full text-white" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-jet-label for="recovery_code" value="{{ __('auth.recovery_code') }}" />
                    <x-jet-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <button type="button" class="text-sm text-white text-opacity-70 hover:text-base-500 cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('auth.use_a_recovery_code') }}
                    </button>

                    <button type="button" class="text-sm text-base-300 hover:text-base-100 underline cursor-pointer"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('auth.use_an_authentication_code') }}
                    </button>

                    <x-jet-button class="ml-4">
                        {{ __('auth.confirm_access') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>

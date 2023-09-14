<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title" class="text-white font-bold">
        {{__("profile.profile_information")}}
    </x-slot>

    <x-slot name="description">
        {{__("profile.update_your_profile")}}

        <img src="https://img.freepik.com/free-icon/user_318-159711.jpg" class="hidden md:block" style="width: 200px; border-radius: 20px; margin-top: 40px;">
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <img src="https://img.freepik.com/free-icon/user_318-159711.jpg" class="rounded-xl my-6 w-48 block md:hidden mx-auto">
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{__('profile.name')}} "/>
            <x-jet-input id="name" type="text" class="mt-1 block w-full cursor-not-allowed" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full cursor-not-allowed" wire:model.defer="state.email" disabled="disabled" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{__("profile.your_email_address_not_verified")}}

                    <button type="button" class="underline text-sm text-base-300 hover:text-base-100" wire:click.prevent="sendEmailVerification">
                        {{__("profile.click_here_resend")}}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{__("profile.a_new_verification_link")}}
                    </p>
                @endif
            @endif
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="CPF" value="{{ __('CPF/CNPJ') }}" />
            {{-- @php
                dd(formatCPF_CNPJ(Auth::user()->cpf));
            @endphp --}}
            {{-- <x-jet-input id="cpf" type="text" class="mt-1 block w-full cursor-not-allowed" wire:model.defer="state.cpf" disabled="disabled"/> --}}
            <input id="cpf" type="text" value={{{ formatCPF_CNPJ(Auth::user()->cpf) }}} style="background: transparent; border: 0; border-bottom: 2px solid #ffffffb3;" class="mt-1 block w-full cursor-not-allowed" disabled/>
            
        </div>
        <script>
            // Adiciona máscara de CPF e limita a entrada a apenas números
            document.getElementById('cpf').addEventListener('input', function (e) {
                // Remove tudo o que não é dígito
                var newValue = e.target.value.replace(/\D/g, '');

                // Limita o número de caracteres do CPF para 11
                newValue = newValue.substring(0, 11);

                // Formata o CPF
                newValue = newValue.replace(/(\d{3})(\d)/, '$1.$2');
                newValue = newValue.replace(/(\d{3})(\d)/, '$1.$2');
                newValue = newValue.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

                // Atualiza o valor do campo de entrada
                e.target.value = newValue;
            });
        </script>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="birth_date" value="Data de Nascimento" />
            <x-jet-input id="birth_date" type="date" class="block mt-1 w-full cursor-not-allowed" wire:model.defer="state.birth_date" autocomplete="birth_date" disabled="disabled"/>
            <x-jet-input-error for="birth_date" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{__("profile.updated_profile")}}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{__("profile.update_profile")}}
        </x-jet-button>
    </x-slot>



</x-jet-form-section>

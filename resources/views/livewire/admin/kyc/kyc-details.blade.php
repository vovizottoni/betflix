<div>
    <div class="page-header">
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>{{ __('admin_kyc.kyc_viewing_and_approval') }}</b>
    </div>

    {{ App\Http\Livewire\Admin\Kyc\KycDetails::setId($userKyc->user_id) }}


    <div class="flex gap-4 justify-center mt-5">
        <div class="form-control">
            <label class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full" aria-label="First Name">
                {{ __('kyc.first_name') }}</label>
            <div class="">
                <input readonly="" aria-label="First Name" class="border-gray-300 rounded-md" type="text"
                    value="{{ $userKyc->kyc_first_name }}">
            </div>
        </div>

        <div class="form-control">
            <label class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full" aria-label="Last Name">
                {{ __('kyc.last_name') }}
            </label>
            <div class="">
                <input readonly="" type="text" value="{{ $userKyc->kyc_last_name }}" aria-label="Last Name"
                    class=" border-gray-300 rounded-md">
            </div>
        </div>
    </div>

    <div class="flex gap-4 justify-center my-3">
        <div class="form-control" aria-label="Control Form">
            <label class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full"
                aria-label="Phone Number">
                {{ __('kyc.phone_number') }}
            </label>
            <div class="">
                <input readonly="" type="text" value="{{ $userKyc->kyc_phone_number }}" aria-label="Phone Number"
                    class=" border-gray-300 rounded-md">
            </div>
        </div>

        <div class="form-control">
            <label class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full" aria-label="Date Birth">
                {{ __('kyc.date_birth') }}
            </label>
            <div class="">
                <input readonly="" type="text" value="{{ $userKyc->kyc_date_birth }}" aria-label="Date Birth"
                    class=" border-gray-300 rounded-md">
            </div>
        </div>
    </div>

    <div class="flex gap-4 justify-center my-3">
        <div class="form-control">
            <label for="" class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full"
                aria-label="Address">
                {{ __('kyc.address_1') }}
            </label>
            <div class="">
                <input readonly="" type="text" value="{{ $userKyc->kyc_address_1 }}" aria-label="Address"
                    class=" border-gray-300 rounded-md">
            </div>
        </div>

        <div class="form-control">
            <label for="" class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full"
                aria-label="Second Address">
                {{ __('kyc.address_2') }}
            </label>
            <div class="">
                <input readonly="" type="text" value="{{ $userKyc->kyc_address_2 }}" aria-label="Second Address"
                    class=" border-gray-300 rounded-md">
            </div>
        </div>
    </div>


    <div class="flex gap-4 justify-center my-3">
        <div class="form-control ">
            <label for="" class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full"
                aria-label="City">
                {{ __('kyc.city') }}
            </label>
            <div class="">
                <input readonly="" type="text" value="{{ $userKyc->kyc_city }}" aria-label="City"
                    class=" border-gray-300 rounded-md ">
            </div>
        </div>

        <div class="form-control">
            <label for="" class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full"
                aria-label="State">
                {{ __('kyc.state') }}
            </label>
            <div class="">
                <input readonly="" type="text" value="{{ $userKyc->kyc_state }}" aria-label="State"
                    class=" border-gray-300 rounded-md">
            </div>
        </div>
    </div>

    <div class="flex gap-4 justify-center my-3">
        <div class="form-control">
            <label for="" class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full"
                aria-label="Nationality">
                {{ __('kyc.nationality') }}
            </label>
            <div class="">
                <input readonly="" type="text" value="{{ $userKyc->kyc_nationality }}" aria-label="Nationality"
                    class=" border-gray-300 rounded-md">
            </div>
        </div>

        <div class="form-control ">
            <label for="" class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full"
                aria-label="Zip">
                {{ __('kyc.zip') }}
            </label>
            <div class="">
                <input readonly="" type="text" value="{{ $userKyc->kyc_zip }}" aria-label="Zip"
                    class=" border-gray-300 rounded-md">
            </div>
        </div>
    </div>

    {{-- Para que exibe as imagens, primeiro verifica qual tem e adiciona as divs baseados em quantas tem --}}
    <div class="flex gap-4 justify-center my-3">
        @if ($userKyc->kyc_passport_path)
            <div>
                <img src="{{ asset('storage/' . $userKyc->kyc_passport_path) }}">
            </div>
        @endif

        @if ($userKyc->kyc_identification_path_one)
            <div>
                <img src="{{ asset('storage/' . $userKyc->kyc_identification_path_one) }}">
            </div>
            <div>
                <img src="{{ asset('storage/' . $userKyc->kyc_identification_path_two) }}">
            </div>
        @endif

        @if ($userKyc->kyc_drive_path)
            <div>
                <img src="{{ asset('storage/' . $userKyc->kyc_drive_path) }}">
            </div>
        @endif

        @if ($userKyc->kyc_selfie_doc_path)
            <div>
                <img src="{{ asset('storage/' . $userKyc->kyc_selfie_doc_path) }}">
            </div>
        @endif
    </div>



    {{-- Parte "Atualizar Status" --}}
    @if ($userKyc->kyc_status == 'under_verification')
        <div class="flex gap-4 justify-center my-3">
            <div class="form-control"><br><br>
                <label class="inline-flex items-center text-xl font-medium text-gray-700 sm:h-full">
                    {{ __('admin_kyc.update_status') }}
                </label><br>
            </div>
        </div>

        <div class="flex gap-4 justify-center my-3">
            <div class="form-control">
                <label for="" class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full">
                    {{ __('admin_kyc.name') }}
                </label>
                <div class="">
                    <input readonly="" type="text" value="{{ $userKyc->user->name }}"
                        class="block w-full max-w-lg text-sm border border-gray-300 rounded-md sm:max-w-xs">
                </div>
            </div>
            <div class="form-control">
                <label for="" class="inline-flex items-center text-sm font-medium text-gray-700 sm:h-full">
                    {{ __('admin_kyc.status') }}
                </label>
                <div class="">
                    {{-- Nesse input trata o valor que vem do banco antes de exibir --}}
                    <input readonly="" type="text"
                        @if ($userKyc->kyc_status == 'not_verified') value="{{ __('admin_kyc.not_verified') }}" @endif
                        @if ($userKyc->kyc_status == 'verified') value="{{ __('admin_kyc.verified') }} " @endif
                        @if ($userKyc->kyc_status == 'under_verification') value="{{ __('admin_kyc.under_verification') }}" @endif
                        @if ($userKyc->kyc_status == 'failed_verification') value="{{ __('admin_kyc.failed_verification') }}  " @endif
                        class="block w-full max-w-lg text-sm border border-gray-300 rounded-md sm:max-w-xs">
                </div>
            </div>
        </div>


        <div class="flex gap-4 justify-center my-3">
            <div>
                <label>{{ __(' Ação') }}</label>
                <select wire:model="new_status" class="block w-full sm:w-40 sm:text-sm rounded-md">
                    <option value="">{{ __('admin_kyc.nothing_to_do') }}</option>
                    <option value="verified"> {{ __('admin_kyc.accept') }}</option>
                    <option value="failed_verification"> {{ __('admin_kyc.decline') }}</option>
                </select>
            </div>
        </div>

        <div class="flex gap-4 justify-center my-3">
            @if ($new_status == 'failed_verification')
                <div>
                    <label class="label">
                        <span class="label-text"> {{ __('admin_kyc.reason') }}</span>
                    </label>
                </div>

                <div class="">
                    <input wire:model='reason' type="text" value="{{ $reason }}"
                        class="block w-full max-w-lg text-sm border border-gray-300 rounded-md sm:max-w-xs">
                    @error('reason')
                        <span class="error text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <a href="#reason_1" wire:click="setReason(1)">
                        {{ __('admin_kyc.the_name_does_not_match') }}</a><br>
                    <a href="#reason_2" wire:click="setReason(2)"> {{ __('admin_kyc.expired_document') }}</a><br>
                    <a href="#reason_2" wire:click="setReason(3)">
                        {{ __('admin_kyc.uploaded_images_are_not_clear') }}</a><br>
                    <a href="#reason_3" wire:click="setReason(4)">
                        {{ __('admin_kyc.mentioned_document_incorrect') }}</a><br>
                    <a href="#reason_4" wire:click="setReason(5)"> {{ __('admin_kyc.documents_not_valid') }}</a><br>
                    <a href="#reason_5" wire:click="setReason(6)"> {{ __('admin_kyc.same_document_image') }}</a><br>
                    <a href="#reason_6" wire:click="setReason(7)">
                        {{ __('admin_kyc.document_underage_person') }}</a><br>
                    <a href="#reason_7" wire:click="setReason(8)"> {{ __('admin_kyc.selfie_is_invalid') }}</a><br>
                </div>
            @endif
        </div>



        <div class="flex gap-4 justify-center my-3 pb-10">

            <button type="button" onclick="preview()"
                class="text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                {{ __('Voltar') }}
            </button>


            <button type="button" wire:click="store_kyc_verification({{ $userKyc->user_id }})"
                class="text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                {{ __('Realizar Ação') }}
            </button>

            <div wire:loading.delay.long wire:target="store_kyc_verification">
                Salvando . . .
            </div>
        </div>


    @endif

    @if ($userKyc->kyc_status == 'verified')
        <div><br><br>
            <div class="flex gap-4 justify-center my-3">
                <b>{{ __('KYC já verificado.') }}</b><br>
            </div>

            <div class="flex gap-4 justify-center my-3">
                <button type="button" onclick="preview()"
                    class="text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    {{ __('Voltar') }}
                </button>
            </div>
        </div>
    @endif

    @if ($userKyc->kyc_status == 'failed_verification')
        <div><br><br>
            <div class="flex gap-4 justify-center my-3">
                <b>{{ __('KYC rejeitado e aguardando correção do usuário') }}</b><br>
            </div>

            <div class="flex gap-4 justify-center my-3">
                <button type="button" onclick="preview()"
                    class="text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    {{ __('Voltar') }}
                </button>
            </div>
        </div>
    @endif



    <script>
        //volta para pagina anterior
        function preview() {
            history.back();
        }
    </script>
</div>

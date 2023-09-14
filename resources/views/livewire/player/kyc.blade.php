
<div class="py-20 max-w-3xl ml-auto mr-auto">

  <h1 class="mb-6 text-xl lg:text-3xl font-bold -mt-20">Validar Conta</h1>


    @if (Auth::user()->canUploadKycDocs())

        @if ($status == 'failed_verification')
            <label>{{__("kyc.verification_rejected")}}</label>
            <label>{{$user->kyc_reason}}</label><br>
            <label>{{__("kyc.please_fill_again")}}</label><br><br>
        @endif

        <!--Formulario -->
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 place-items-stretch">
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text"> {{__("kyc.first_name")}}* </span>
                </label>
                <input wire:model.defer="first_name" aria-label="First Name" class="input input-bordered w-full " type="text"/>
                @error('first_name') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.last_name")}}* </span>
                </label>
                <input wire:model.defer="last_name"  aria-label="Last Name" class="input input-bordered w-full " type="text"/>
                @error('last_name') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.phone_number")}}* </span>
                </label>
                <input wire:model="phone_number"  aria-label="Phone Number" onchange="@this.set('phone_number', this.value);" wire:ignore id="phone_number_id"class="input input-bordered w-full " type="text"/>
                @error('phone_number') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.date_birth")}}* </span>
                </label>
                <input wire:model.defer="date_birth" aria-label="Birth Date" class="input input-bordered w-full " type="date"/>
                @error('date_birth') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.address_1")}} </span>
                </label>
                <input wire:model.defer="address_1" aria-label="Address" class="input input-bordered w-full " type="text"/>
                @error('address_1') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.address_2")}} </span>
                </label>
                <input wire:model.defer="address_2" aria-label="Second Address" class="input input-bordered w-full " type="text"/>
                @error('address_2') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.city")}}* </span>
                </label>
                <input wire:model.defer="city" aria-label="City" class="input input-bordered w-full " type="text"/>
                @error('city') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.state")}}*  </span>
                </label>
                <input wire:model.defer="state" aria-label="State" class="input input-bordered w-full " type="text" />
                @error('state') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.nationality")}}* </span>
                </label>
                <input wire:model.defer="nationality" aria-label="Nationality" class="input input-bordered w-full " type="text"/>
                @error('nationality') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.zip")}}* </span>
                </label>
                <input wire:model="zip" aria-label="Zip Code" onchange="@this.set('zip', this.value);" wire:ignore id="zip_id" class="input input-bordered w-full " type="text"/>
                @error('zip') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="form-control w-full ">
                <label class="label">
                    <span class="label-text"> {{__("kyc.nif")}}*

                        <span class="ml-1 h-5 w-5 group cursor-pointer relative inline-block top-1">
                            <svg class="h-5 w-5 text-blue-info" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="opacity-0 w-60 bg-black text-white text-center text-xs rounded-lg absolute z-10 group-hover:opacity-100 bottom-full left-1/2 p-2 pointer-events-none transform -translate-x-1/2">
                                {{__('kyc.information_icon')}}
                                <svg class="absolute text-black h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"></polygon></svg>
                            </div>
                        </span>

                    </span>


                </label>

                <!-- icone de informação do campo ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

                <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                <input wire:model.defer="nif" aria-label="Document" class="input input-bordered w-full " type="text"/>
                @error('nif') <span class="error text-red-700">{{ $message }}</span> @enderror
            </div>
        </div>

        <!--Upload documentos -->
        <div class="mt-20">
            <h2 class="text-xl text-center">{{__("kyc.document_upload")}}</h2>

            <span class="ml-1 h-5 w-5 group cursor-pointer relative inline-block">
                <div class="opacity-0 w-60 bg-black text-white text-center text-xs rounded-lg absolute z-10 group-hover:opacity-100 bottom-full left-1/2 p-2 pointer-events-none transform -translate-x-1/2">
                    {{__('kyc.information_icon_upload')}}
                    <svg class="absolute text-white h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"></polygon></svg>
                </div>
            </span>

            {{-- tabs --}}
            <div class="tabs-kyc">
                <button id="defaultOpen" class="btn-links <?php if($tabFileUploadAtiva == 1){ echo ' active'; } ?>" wire:click="changeTabFileUploadAtiva(1)" > {{__("kyc.passport")}} </button>
                <button class="btn-links <?php if($tabFileUploadAtiva == 2){ echo ' active'; } ?>" wire:click="changeTabFileUploadAtiva(2)" > {{__("kyc.id")}}</button>
                <button class="btn-links <?php if($tabFileUploadAtiva == 3){ echo ' active'; } ?>" wire:click="changeTabFileUploadAtiva(3)" > {{__("kyc.drivers_license")}} </button>
            </div>

              <!-- Tab content -->
            @if ($tabFileUploadAtiva == 1)
                <div id="passport" class="tab-kyc" style="display: flex !important;">
                    <label class="label-text">{{__("kyc.upload_passport")}}</label>
                    <input type="file" class="file-input file-input-bordered file-input-warning w-full max-w-sm" aria-label="Input Warning" wire:model.defer="passport_path">
                    @error('passport_path') <span class="error text-red-700">{{ $message }}</span> @enderror
                </div>
            @endif

            @if ($tabFileUploadAtiva == 2)
                <div id="id" class="tab-kyc" style="display: flex !important;">
                    <label class="label-text">{{__("kyc.upload_front_id")}}</label>
                    <input type="file" class="file-input file-input-bordered file-input-warning w-full max-w-sm" aria-label="Input Warning" wire:model.defer="identification_path_one">
                    @error('identification_path_one') <span class="error text-red-700">{{ $message }}</span> @enderror

                    <label class="label-text">{{__("kyc.upload_back_id")}}</label>
                    <input type="file" class="file-input file-input-bordered file-input-warning w-full max-w-sm" aria-label="Input Warning" wire:model.defer="identification_path_two">
                    @error('identification_path_two') <span class="error text-red-700">{{ $message }}</span> @enderror
                </div>
            @endif

            @if ($tabFileUploadAtiva == 3)
                <div id="license" class="tab-kyc" style="display: flex !important;" >
                    <label class="label-text">{{__("kyc.upload_drive")}}</label>
                    <input type="file" class="file-input file-input-bordered file-input-warning w-full max-w-sm" aria-label="Input Warning" wire:model.defer="drive_path">
                    @error('drive_path') <span class="error text-red-700">{{ $message }}</span> @enderror
                </div>
            @endif
        </div>

        <!-- Upload selfie-->
        <div class="mt-4">
            <label class="label">
                <span class="label-text"> {{__("kyc.upload_selfie")}}</span>
            </label>
            <input type="file" class="file-input file-input-bordered file-input-warning w-full max-w-sm" aria-label="Input Warning" wire:model.defer="selfie_doc_path">
            @error('selfie_doc_path') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>

        <!-- botões-->
        <div>

            <button wire:loading.remove wire.target='store' wire:loading.remove wire.target='store' onclick="preview()" class="z-10 inline-flex items-center justify-center px-4 py-2 bg-black-700 border border-transparent rounded font-semibold text-lg text-white tracking-widest normal-case" style="letter-spacing: 0; margin-top: 40px;">{{__("kyc.previous")}}</button>
            <button wire:loading.remove wire.target='store' wire:click="store()" class="z-10 inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded font-semibold text-lg text-white tracking-widest hover:bg-red-900 normal-case" style="background: linear-gradient(45deg, #00d6f7, #0869f0); letter-spacing: 0; margin-top: 40px;">{{__("kyc.save")}}</button>
  
            
            <button wire:loading.remove wire.target='store' wire:loading.remove wire.target='store' onclick="preview()" class="z-10 inline-flex items-center justify-center px-4 py-2 bg-black-700 border border-transparent rounded font-semibold text-lg text-white tracking-widest hover:bg-red-900 normal-case" style="letter-spacing: 0; margin-top: 40px;">{{__("kyc.previous")}}</button>
            <button wire:loading.remove wire.target='store' wire:click="store()" class="z-10 inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded font-semibold text-lg text-white tracking-widest hover:bg-red-900 normal-case" style="letter-spacing: 0; margin-top: 40px;">{{__("kyc.save")}}</button>


            <div wire:loading.delay.long wire:target="store" class="mt-10">
                {{__('kyc.sending')}}
            </div>
        </div>
    @endif

    @if ($status == 'under_verification')
        <h1>{{__("kyc.under_verification")}}</h1>
    @endif

    @if ($status == 'verified')
        <h1>{{__("kyc.verified")}}</h1>
    @endif

    <script>//volta para pagina anterior
        function preview()
        {
            history.back();
        }
    </script>

    <script type="text/javascript">//mascaras nos campos
        $("#phone_number_id").mask('(99) 99999-9999');
        $("#zip_id").mask('99999-999');
    </script>

</div>


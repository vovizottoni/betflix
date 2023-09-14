<div class="">
    <script>window.location = '/games';</script>

    <!-- Componente livewire -->

    <style type="text/css">
        .bg-black.text-gray-500.flex.justify-center.pb-12,
        .copyright,
        .horizontal-mobile-menu,
        footer {
            display: none;
        }


    </style>

    <div class="flex flex-col items-center justify-around min-h-screen pt-24">

        <h2 class="text-5xl text-center mx-auto">Quem está jogando?</h2>

         <!-- Mensagens de erro -->
         @if (session()->has('message'))
            <div class="alert alert-success shadow-lg hidden">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session('message') }}</span>
                </div>
            </div>
         @endif

        <div class="py-4 flex justify-center -mb-20 hidden">
            <div class="form-control">
                <input wire:model='searchTerm' type="text" placeholder="Pesquisar" class="input bg-base-900 input-bordered max-w-xs" />
            </div>
        </div>


        @php
            $n = count($account_return);


            $classe_n_colunas = '';

            if($n < 4){
                $classe_n_colunas = ' flex justify-center gap-8 ';
            }else{
                $classe_n_colunas = ' grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 items-top';
            }

            //dd($classe_n_colunas);

        @endphp

        <div class="{{  $classe_n_colunas  }} w-full max-w-5xl gap-8 px-9 pb-3 items-start overflow-scroll h-80">

            @foreach ($account_return as $account)
                <a href="#" wire:click.prevent="selectAccountID({{ $account->id }})" class="group flex flex-col justify-center items-center gap-4">
                    <div class="avatar">
                        <div class="w-48 transition-transform border-4 rounded-lg border-transparent group-hover:border-4 group-hover:border-base-300">
                            <img src="{{ asset($account->photo) }}" alt="Account Photo" class="" />
                        </div>
                    </div>
                    <p  class="text-base w-44 text-white font-semibold group-hover:text-base-400 text-center">{{$account->name}}</p>
                </a>
            @endforeach

        </div>

        <label for="configs" style="color:white;" class="btn modal-button btn-outline rounded-none text-base-200 hover:bg-base-200 hover:text-base-900" aria-label="Manage Accounts">{{__("accounts.manage_accounts")}}</label>





        <input type="checkbox" id="configs" class="modal-toggle" />
        <div class="modal" id="modal-id">
            <div class="modal-box bg-base-800">
                <label for="configs" class="absolute right-2 top-2 cursor-pointer text-base-700 hover:text-base-900 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path wire:click = 'closeWindow'fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                </label>
                <h3 class="font-bold text-lg mb-8">{{__("accounts.settings")}}</h3>
                <div>
                    <div class="w-full grid md:grid-cols-2 gap-4">

                        <select wire:model="idAccount" wire:change= "changeAccount" class="select w-full bg-base-700 hover:bg-base-900 border-none">
                            <option selected>{{__("accounts.select_account")}}</option>
                            @foreach ($account_return as $account)
                                <option value={{$account->id}}>{{$account->name}}</option>
                            @endforeach
                        </select>

                        <button class="btn gap-2 bg-base-700 hover:bg-base-900 text-green-500 border-none" wire:click="create()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="currentColor" d="M352 128c0 70.7-57.3 128-128 128s-128-57.3-128-128S153.3 0 224 0s128 57.3 128 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
                            {{__("accounts.add_account")}}
                        </button>

                    </div>
                    @if ($name)
                        <form action="" method="post" class="mt-8 flex flex-col justify-center gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-white font-bold">Avatar</span>
                                </label>
                                <label for="avatar-modal" class="label cursor-pointer w-24">
                                    <div class="avatar">
                                        <div class="w-24 rounded-xl relative">
                                            <div class="fixed left-24 rounded-full bg-base-600 h-6 w-6 flex justify-center items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="currentColor" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                                            </div>
                                            @if ($this->photo == '')
                                                <img src="{{asset('assets/images/avatars/avatar-1.jpeg')}}" alt="Avatar" />
                                            @else
                                                <img src="{{ asset($this->photo) }}" />
                                            @endif
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text text-white font-bold">{{__("accounts.name")}}</span>
                                </label>
                                <input wire:model.defer="name" type="text" value="Apostador" class="input input-bordered w-full bg-base-700" />
                                @error('name') <span class="error  text-red-700">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text text-white font-bold">{{__("accounts.description")}}</span>
                                </label>
                                <textarea rows="2" cols="150" wire:model="description" type="text" value="Apostador para cliente 1" class="input input-bordered w-full bg-base-700"> </textarea>
                                @error('description') <span class="error">{{ $message }}</span> @enderror
                            </div>

                        </form>
                    @endif


                </div>

                <div class="grid grid-cols-2 items-start mt-12 gap-4">

                    <div class="gap-2">
                        @if ($this->idAccount)
                            <label for="delete-account"  class="btn w-full bg-base-700 border-none hover:bg-red-900">{{__("accounts.deactivate_account")}}</label>
                        @endif
                    </div>

                    <label class="btn bg-green-500 text-black hover:bg-green-600 border-none" wire:click='store' >{{__("accounts.save_profile")}}</label>
                </div>
                <div class="mt-8 text-center">
                    <label for="disabled-account" class="text-xs text-white text-opacity-50 hover:text-opacity-100">{{__("accounts.view_disabled_accounts")}}</label>
                </div>

            </div>
        </div>

        <input type="checkbox" id="delete-account" class="modal-toggle" />
        <div class="modal" id="modal-confirm-delete">
            <div class="modal-box" id="modal-deleted">
                <h3 class="font-bold text-lg">{{__("accounts.are_you_sure_deactivate")}}</h3>
                <p class="py-4">{{__("accounts.after_deactivated")}}</p>

                <div class="w-full flex justify-end gap-4 mt-8">
                    <label for="delete-account" class="btn w-full bg-base-700 hover:bg-base-900 border-none">{{__("accounts.cancel")}}</label>
                    <button wire:click='destroy' class="btn w-full bg-red-700 border-none hover:bg-red-900">{{__("accounts.confirm")}}</button>
                </div>
            </div>
        </div>

        <input type="checkbox" id="disabled-account" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-11/12 max-w-3xl ">

                <label for="disabled-account" class="absolute right-2 top-2 cursor-pointer text-base-700 hover:text-base-900 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                </label>
                <h3 class="font-bold text-lg mb-8">{{__("accounts.deactivate_account")}}</h3>
                <div class="overflow-x-auto h-custom custom-scroll overflow-Y-scroll rounded-lg">
                    <table class="table w-full">
                        <!-- head -->
                        <thead class="">
                            <tr>
                                <th>{{__("accounts.name")}}</th>
                                <th>{{__("accounts.description")}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="max-h-96">
                            <!-- row 1 -->
                            @foreach ($account_disabled as $account)
                                <tr>
                                    <td>{{$pos1++}}</td>
                                    <td>{{$account->name}}</td>
                                    <td>
                                        <button wire:click="reactive({{ $account->id }})" class="btn"> {{__("accounts.reactivate")}} </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @if (session()->has('deleted'))
                            <br>
                            <div class="alert alert-success shadow-lg">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span>{{ session('deleted') }}</span>
                                </div>
                            </div>
                        @endif

                    </table>
                </div>
            </div>
        </div>


        <input type="checkbox" id="avatar-modal" class="modal-toggle" />
        <div class="modal" id="modalAvatar">
            <div class="modal-box relative max-w-2xl">
                <label  for="avatar-modal" class="absolute right-2 top-2 cursor-pointer text-base-700 hover:text-base-900 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                </label>
                <h3 class="text-lg font-bold">{{__("accounts.select_an_avatar")}}</h3>
                <form class="mt-10 avatar-box custom-scroll">
                    <label wire:click="selectImage('/assets/images/avatars/avatar-1.jpeg')"  aria-label="avatar" class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-1.jpeg')}}" alt="Avatar"/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-2.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-2.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-3.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-3.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-4.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-4.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-5.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-5.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-6.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-6.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-7.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-7.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-8.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-8.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-9.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-9.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-10.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-10.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-11.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-11.jpeg')}}" alt=""/>
                    </label>
                    <label wire:click="selectImage('/assets/images/avatars/avatar-12.jpeg')"class="avatar-selection">
                        <input type="radio" name="avatar">
                        <img src="{{asset('assets/images/avatars/avatar-12.jpeg')}}" alt=""/>
                    </label>
                </form>
                <div class="w-full mt-10 flex justify-end">
                    <label class="btn bg-base-700 hover:bg-base-900 border-none" wire:click="storeImageSelected()">{{__("accounts.choose")}}</label>
                </div>
            </div>
        </div>
    </div>

    <script>

        function closeModalAvatarManually(){

            //document.getElementById('modalAvatar').classList.remove("modal-open");
            //return;
            document.getElementById("avatar-modal").checked = false;

        }

        window.addEventListener('closeModal', event => {
            document.getElementById('modal-id').style.visibility ='hidden';
        })
        window.addEventListener('closeModalChooseImage', event => {
            //document.getElementById('modalAvatar').style.visibility = "hidden";


            closeModalAvatarManually()
        })





    </script>
</div>
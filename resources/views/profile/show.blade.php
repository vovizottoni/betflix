<x-app-layout>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto px-6 md:px-32 lg:px-8 relative">
            <h1 class="mb-6 text-xl lg:text-3xl font-bold -mt-12">Conta</h1>

            <div class="tabs mb-16">
                <a id="defaultOpen" class="tab tab-lg tab-bordered transition-all tab-active" style="color: #fff !important;" onclick="openTab(event, 'profile')">{{__("profile.data")}}</a>
                <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" onclick="openTab(event, 'security')">{{__("profile.safety")}}</a>
                <a class="tab tab-lg tab-bordered transition-all" style="color: #fff !important;" onclick="openTab(event, 'sessions')">{{__("profile.sessions")}}</a>
            </div>

            <div id="profile" class="tabcontent transition-all">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')

                @endif

            </div>

            <div id="security" class="tabcontent transition-all">
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.update-password-form')
                    </div>
                    <x-jet-section-border />
                @endif



                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                @endif
            </div>

            <div class="tabcontent transition-all" id="sessions">
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>
            </div>

            {{-- @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif --}}
        </div>
    </div>



    <input type="checkbox" id="avatar-modal-profile" class="modal-toggle" />
    <div class="modal" id="modalAvatar">
        <div class="modal-box relative max-w-2xl">
            <label  for="avatar-modal-profile" class="absolute right-2 top-2 cursor-pointer text-base-700 hover:text-base-900 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
            </label>
            <h3 class="text-lg font-bold">{{__("profile.select_an_avatar")}}</h3>
            <form class="mt-10 avatar-box custom-scroll">
                <label wire:click="selectImage('/assets/images/avatars/avatar-1.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-1.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-2.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-2.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-3.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-3.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-4.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-4.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-5.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-5.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-6.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-6.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-7.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-7.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-8.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-8.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-9.jpeg')"class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-9.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-10.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-10.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-11.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-11.jpeg')}}" alt=""/>
                </label>
                <label wire:click="selectImage('/assets/images/avatars/avatar-12.jpeg')" aria-label="Avatar" class="avatar-selection">
                    <input type="radio" name="avatar">
                    <img src="{{asset('assets/images/avatars/avatar-12.jpeg')}}" alt=""/>
                </label>
            </form>
            <div class="w-full mt-10 flex justify-end">
                <label class="btn bg-base-700 hover:bg-base-900 border-none" wire:click="storeImageSelected()">{{__("profile.choose")}}</label>
            </div>
        </div>
    </div>

    <script>

        document.getElementById("defaultOpen").click();

        function openTab(e, tabId) {
            var content = document.getElementsByClassName("tabcontent")
            var tablinks = document.getElementsByClassName("tab-bordered")


            for (var i = 0; i < content.length; i++) {
                content[i].classList.add("hidden")
            }

            for (var i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" tab-active",  " ");
            }

            document.getElementById(tabId).classList.remove("hidden")
            e.currentTarget.classList.add("tab-active")
        }



    </script>
</x-app-layout>

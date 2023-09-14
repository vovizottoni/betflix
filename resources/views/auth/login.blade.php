<x-guest-layout>
    <x-jet-authentication-card class="bg-base-900">
        
            <a @if (Auth::check()) href="/games" @else href="/" @endif class="w-full logo relative block mb-20">
                <img class="mx-auto" src="{{asset('assets/images/branding/horizontal-branding.png')}}" style="max-height: 40px;">
            </a>
        

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        

        <form method="POST" class="flex flex-col gap-1" action="{{ route('login') }}">
            @csrf

            

            <p class="font-bold text-xl mb-6 text-white">{{ __('auth.login') }}</p>

            

            <div>
                <x-jet-input id="email" class="text-white text-opacity-50 block mt-1 w-full" type="email" name="email"
                             :value="old('email')" required autofocus placeholder="Email"
                             style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"/>
            </div>

            <div>
                <x-jet-input id="password" class="text-white text-opacity-50 block mt-1 w-full" type="password"
                             name="password" required autocomplete="current-password"
                             placeholder="{{__('auth.password')}}"
                             style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"/>
            </div>

            <div>
                @include("components.captcha-box")
            </div>
            <div class="mt-8">
                <x-jet-button>
                    {{ __('auth.login') }}
                </x-jet-button>
            </div>


            <div class="block mb-4 mt-3 flex justify-between items-center">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember"/>
                    <span class="ml-2 text-sm text-white text-opacity-70">{{ __('auth.remember_me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-white text-opacity-70" href="{{ route('password.request') }}">
                        {{__("auth.recover_password")}}
                    </a>
                @endif
            </div>

            <div class="items-center justify-between mt-24">
                <p class="text-white text-opacity-70"
                   style="font-size: 16px; font-weight: 400;">{{__("auth.new_around_here")}} <a
                        href="{{ route('register') }}"
                        class="text-white hover:text-opacity-70">{{__("auth.register_now")}}</a></p>

                <p class="mt-4 text-xs text-white text-opacity-50">{{__("auth.this_page_is_protected")}}</p>
            </div>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>

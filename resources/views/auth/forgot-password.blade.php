<x-guest-layout>
    <x-jet-authentication-card>
        <a @if (Auth::check()) href="/games" @else href="/" @endif class="w-full logo relative block mb-20">
            <img class="mx-auto" src="{{asset('assets/images/branding/horizontal-branding.png')}}" style="max-height: 40px;">
        </a>

        <p class="font-bold text-xl mb-6 text-white">{{__("auth.need_help")}}</p>

        <div class="mb-12 text-sm text-white text-opacity-80">
            {{__("auth.enter_your_email_address")}}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-input id="email" class="block mt-1 w-full" type="email"
                             placeholder="{{__('auth.enter_your_email')}}" name="email" :value="old('email')" required
                             autofocus
                             style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"/>
            </div>
            <div>
                @include("components.captcha-box")
            </div>
            <div class="mt-12 flex items-center justify-center mt-4">

                <x-jet-button>
                    {{__("auth.reset_password_by_email")}}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

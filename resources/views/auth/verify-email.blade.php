<x-guest-layout>
    <x-jet-authentication-card>
        <a @if (Auth::check()) href="/games" @else href="/" @endif class="w-full logo relative block mb-20">
            <img class="mx-auto" src="{{asset('assets/images/branding/horizontal-branding.png')}}" style="max-height: 40px;">
        </a>

        <div class="mb-4 text-lg text-center text-white">
            {{ __('auth.before_continuing') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('auth.a_new_verification_link') }}
            </div>
        @endif

        <div class="mt-4 items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        Reenviar Email de Verificação
                    </x-jet-button>
                </div>
            </form>
        </div>

        <div class="flex pt-5 items-center justify-between">
            <a href="{{ route('profile.show') }}" style="background: linear-gradient(45deg, #00d6f7, #0869f0) !important; text-transform: capitalize !important; padding: 16px; font-size: 16px; font-weight: 600;" class="'inline-flex items-center justify-center px-4 py-2 bg-red-700 rounded font-semibold text-sm text-white w-full hover:bg-red-900'">
                {{ __('auth.edit_profile') }}
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf

                <x-jet-button type="submit" class="underline text-sm text-base-300 hover:text-base-100 ml-2 text-white">
                    {{ __('auth.log_out') }}
                </x-jet-button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>

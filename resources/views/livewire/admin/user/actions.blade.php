<div>
    <label for="modal-{{ $row->id }}"
        class="cursor-pointer inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
        Gerenciar
    </label>

    <input type="checkbox" id="modal-{{ $row->id }}" class="modal-toggle" />
    <label for="my-modal-4" class="modal cursor-pointer">
    <div class="modal-box relative" for="">
        <div class="flex justify-between mb-8">
            <h3 class="text-lg font-bold mb-2">Gerenciar usuários</h3>
            <label for="modal-{{ $row->id }}" class="text-2xl">X</label>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <label class="internal-option" class="button small red" for="change-password-{{ $row->id }}">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-10 h-10 mx-auto mb-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"></path>
            </svg>
            <p>
            {{ __('admin_user_index.change_password') }}
            </p>
            </label>
            <label class="internal-option" class="button small blue" for="confirm-ban-{{ $row->id }}">
            <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Bloqueio
            </label>
            <label class="internal-option" for="edit-user-{{ $row->id }}">
            <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"></path>
            </svg>
            Alterar dados
            </label>
            <label class="internal-option" class="button small red" for="change-cpf-{{ $row->id }}">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"></path>
            </svg>
            Alterar CPF
            </label>
            <label class="internal-option" class="button small green" for="group-change-{{ $row->id }}">
            <svg fill="none" stroke="currentColor" class="w-10 h-10 mx-auto mb-2" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
            </svg>
            {{ __('admin_user_index.change_group') }}
            </label>
            <label class="internal-option" class="button small blue"for="two-factor-check-{{ $row->id }}">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-10 h-10 mx-auto mb-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33"></path>
            </svg>
            Google 2FA
            </label>
            {{--
            <label class="btn" class="button small blue" for="transactions-{{ $row->id }}">
            Exibir Transações
            </label>
            <label class="btn" class="button small blue" for="bets-{{ $row->id }}" >
            Exibir Apostas
            </label>
            --}}
        </div>
    </label>
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Modal {{ $row->id }}</h3>
            <div class="modal-action">
                <label for="modal-{{ $row->id }}" class="btn">Close 1</label>
            </div>
        </div>
    </div>


    {{-- MODAL EDITAR GRUPO USUÁRIO --}}
    <input type="checkbox" id="group-change-{{ $row->id }}" class="modal-toggle z-50" />
    <div id='modal_group' class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-dark-700">{{ __('admin_user_index.change_group') }}</h3>
            <p class="py-4">{{ __('admin_user_index.change_group_description') }}</p>
            <form action="{{ route('admin.manageruser.actions.update_group', $row->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <select name="group_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Selecione um grupo:</option>
                        @foreach ($groups as $item)
                        <option value="{{ $item->id }}" {{ $row->group_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class='modal-action flex items-center justify-end'>
                    <label class="label cancel-btn cursor-pointer" for="group-change-{{ $row->id }}">
                    {{ __('admin_user_index.cancel_modal_change') }}
                    </label>
                    <button type="submit" class="label save-btn cursor-pointer" for="group-change-{{ $row->id }}">
                    {{ __('admin_user_index.confirm_modal_change') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL ALTERAR 2FA --}}

    <input type="checkbox" id="two-factor-check-{{ $row->id }}" class="modal-toggle z-50" />
    <div class="modal">
        <div class="modal-box">
            <div>
                <h3 class="font-bold text-lg">{{ __('admin_user_index.two_factor_title') }}</h3>

                @if ($row->two_factor_confirmed_at)
                    <form action="{{ route('admin.manageruser.actions.update_2fa', $row->id) }}" method="POST">
                        @csrf
                        <div class='modal-action flex items-center justify-between'>
                            <label class="label cancel-btn cursor-pointer" for="two-factor-check-{{ $row->id }}">
                                {{ __('admin_user_index.cancel_modal_change') }}
                            </label>
                            <button type="submit" class="label save-btn cursor-pointer"
                                for="two-factor-check-{{ $row->id }}">
                                {{ __('admin_user_index.two_factor_check') }}
                            </button>
                        </div>
                    </form>
                @else
                    <p class="py-6">
                        {{ __('admin_user_index.two_factor_inexistent') }}
                    </p>
                    <label class="label cancel-btn cursor-pointer" for="two-factor-check-{{ $row->id }}">
                        {{ __('admin_user_index.cancel_modal_change') }}
                    </label>
                @endif
            </div>
        </div>
    </div>

    {{-- MODAL EDITAR SENHA USUÁRIO --}}
    <input type="checkbox" id="change-password-{{ $row->id }}" class="modal-toggle z-50" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-dark-700">{{ __('admin_user_index.change_password') }}</h3>
            <p class="py-4">{{ __('admin_user_index.change_password_description') }}</p>
            <form action="{{ route('admin.manageruser.actions.update_password', $row->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Senha" required autocomplete="off">
                </div>
                <div class='modal-action flex items-center justify-end'>
                    <label class="label cancel-btn cursor-pointer"for="change-password-{{ $row->id }}">
                    {{ __('admin_user_index.cancel_modal_change') }}
                    </label>
                    <button type="submit" class="label save-btn cursor-pointer">
                    {{ __('admin_user_index.confirm_modal_change') }} →
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- MODAL EDITAR CPF USUÁRIO --}}
    <input type="checkbox" id="change-cpf-{{ $row->id }}" class="modal-toggle z-50" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-dark-700">Alterar CPF</h3>
            <p class="py-4">Alterar CPF do Usuário</p>
            <form action="{{ route('admin.manageruser.actions.update_cpf', $row->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="cpf"
                        class="cpf bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Senha" required autocomplete="off" value="{{ $row->cpf }}">
                </div>
                <div class='modal-action flex items-center justify-end'>
                    <label class="label cancel-btn cursor-pointer"for="change-cpf-{{ $row->id }}">
                    {{ __('admin_user_index.cancel_modal_change') }}
                    </label>
                    <button type="submit" class="label save-btn cursor-pointer">
                    {{ __('admin_user_index.confirm_modal_change') }} →
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- MODAL EDITAR USUARIO --}}
    <input type="checkbox" id="edit-user-{{ $row->id }}" class="modal-toggle z-50" />
    <div id="modal-edit-class-for-close" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-dark-700">{{ __('admin_user_index.edit_user_title') }}</h3>
            <p class="py-4">{{ __('admin_user_index.edit_user_description') }}</p>
            <form action="{{ route('admin.manageruser.actions.update_user', $row->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="relative text-gray-600 focus-within:text-gray-400">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <i class="mdi mdi-account"></i>
                        </span>
                        <input type="text" name="name" value="{{ $row->name }}"
                            class="pl-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Nome" autocomplete="off">
                    </div>
                    <div class="relative text-gray-600 focus-within:text-gray-400 mt-3">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <span class="mdi mdi-email"></span>
                        </span>
                        <input type="text" name="email" value="{{ $row->email }}"
                            class="pl-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="E-mail" autocomplete="off">
                    </div>
                    <div class="relative text-gray-600 focus-within:text-gray-400 mt-3">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <span class="mdi mdi-calendar"></span>
                        </span>
                        <input type="text" name="birth_date_" value="{{ \Carbon\Carbon::parse($row->birth_date)->format('d/m/Y') }}"
                            class="date pl-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="E-mail" autocomplete="off">
                    </div>
                </div>
                <div class='modal-action flex items-center justify-between'>
                    <label class="label cancel-btn cursor-pointer" for="edit-user-{{ $row->id }}">
                    {{ __('admin_user_index.cancel_modal_change') }}
                    </label>
                    <button type="submit" class="label save-btn cursor-pointer">
                    {{ __('admin_user_index.confirm_modal_change') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- MODAL CONFIRMAR BAN --}}
    <input type="checkbox" id="confirm-ban-{{ $row->id }}" class="modal-toggle z-50" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{ __('admin_user_index.confirm_change') }}</h3>
            <p class="py-4 text-slate-700">{{ __('admin_user_index.description_confirm_change') }}</p>
            <div class="modal-action flex items-center justify-between">
                <label class="label cancel-btn cursor-pointer" for="confirm-ban-{{ $row->id }}">
                {{ __('admin_user_index.cancel_modal_change') }}
                </label>
                <form action="{{ route('admin.manageruser.actions.update_status', $row->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="label save-btn cursor-pointer">
                    @if ($row->active === 's')
                    {{ __('admin_user_index.to_ban') }}
                    @else
                    {{ __('admin_user_index.remove_ban') }}
                    @endif
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EXIBIR TRANSAÇÕES --}}
    <input type="checkbox" id="transactions-{{ $row->id }}" class="modal-toggle z-50" />
    <div class="modal">
        <div class="modal-box p-4 flex">
            <div class="modal-action flex items-center justify-between">
                @livewire('admin.user.show-bets', ['transactionID' => $row->id])
            </div>
            <label for="transactions-{{ $row->id }}" class="modal-close absolute top-0 right-0 p-4">
                <svg class="w-6 h-6 text-gray-500 hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </label>
        </div>
    </div>

    {{-- MODAL EXIBIR APOSTAS --}}
    <input type="checkbox" id="bets-{{ $row->id }}" class="modal-toggle z-50" />
    <div class="modal">
        <div class="modal-box p-4 flex">
            <div class="modal-action flex items-center justify-between">
                @livewire('admin.user.show-apostas', ['betId' => $row->id])
            </div>
            <label for="bets-{{ $row->id }}" class="modal-close absolute top-0 right-0 p-4">
                <svg class="w-6 h-6 text-gray-500 hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </label>
        </div>
    </div>
</div>
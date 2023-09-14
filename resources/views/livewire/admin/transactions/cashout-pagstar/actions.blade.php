<label for="modal-{{ $row->id }}"
    class="cursor-pointer inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
    Gerenciar
</label>

<input type="checkbox" id="modal-{{ $row->id }}" class="modal-toggle" />
<label for="my-modal-4" class="modal cursor-pointer">
    <label class="modal-box w-fit relative grid grid-cols-2 gap-2" for="">
        <h3 class="text-lg font-bold mb-2 text-white">Ações</h3>

        <a href="{{ route('admin.cashout-pagstar.cashout-approval.actions.cashoutApproved', $row->id) }}"
            class="btn col-span-full" style="background: #01c301;color: white;border: solid 1px #37ff37;width: 280px;"
            for="group-change-{{ $row->id }}">
            Aprovar Saque
        </a>
        <label class="btn col-span-full" class="button"
            style="background: #c3053a;color: white;border: solid 1px #ff4949;width: 280px;"
            for="confirm-denied-{{ $row->id }}">
            Negar Saque
        </label>
    </label>
    <div class="modal-action mt-1">
        <label for="modal-{{ $row->id }}" class="btn bg-danger">Fechar</label>
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


{{-- MODAL CONFIRMAR DENIED --}}

<input type="checkbox" id="confirm-denied-{{ $row->id }}" class="modal-toggle z-50" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg text-dark-700">Negar Saque</h3>
        <p class="py-4 text-slate-100">Escolha uma opção para negar o saque?</p>

        <form action="{{ route('admin.cashout-pagstar.cashout-approval.actions.cashoutDenied', $row->id) }}"
            method="POST">
            @csrf
            <div class="modal-body">
                <div>
                    <select name="type_reversal" required="true"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1">Sem Estorno</option>
                        <option value="2">Com Estorno</option>
                    </select>
                </div>
            </div>

            <div class="modal-action flex items-center justify-end">
                <label class="label cancel-btn cursor-pointer" for="confirm-denied-{{ $row->id }}">
                    {{ __('admin_user_index.cancel_modal_change') }}
                </label>
                <button type="submit" class="label text-white cursor-pointer">
                    CONFIRMAR
                </button>
            </div>
        </form>
    </div>
</div>

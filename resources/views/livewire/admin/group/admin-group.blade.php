<div>
  <div class="page-header">
    <div class="flex flex-col items-center justify-between space-y-3 md:flex-row md:space-y-0">
      <div>
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>{{ __('admin_group.group_title') }}</b>
      </div>
    </div>
  </div>

  <div class="has-table card">
    <div>
      <form>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 items-end justify-center px-6 py-4 sm:justify-start">

          <div class="form-control">
            <label class="label flex items-center justify-start">
              <span class="label-text">{{ __('admin_group.groups') }}</span>
            </label>
            <input type="text" placeholder="{{ __('admin_group.search') }}" class="input-bordered input"
              wire:model="searchTerm" />
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text">Data de criação inicial</span>
            </label>
            <input type="date" wire:model.lazy="created_at__from" id="created_at__from_ID" value=""
              class="input">
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text">Data de criação final</span>
            </label>
            <input type="date" wire:model.lazy="created_at__to" id="created_at__to_ID" value=""
              class="input w-full max-w-xs">
          </div>

          <div class="form-control">
            <label class="label" for="label flex items-center justify-start">
              Tipo:
            </label>
            <select wire:model="tipo_search" class="select select-bordered">
              <option value="">Selecione uma Opção</option>
              <option value="padrao">Padrão</option>
              <option value="nao-padrao">Não Padrao</option>
            </select>
          </div>

          <div class="form-control">
            <label class="label" for="label flex items-center justify-start">
              Status P.D:
            </label>
            <select wire:model="bonus1_status_search" class="select select-bordered">
              <option value="">Selecione uma Opção</option>
              <option value="active">Ativo</option>
              <option value="inactive">Inativo</option>
            </select>
          </div>

          <div class="form-control">
            <label class="label" for="label flex items-center justify-start">
              Status CPA:
            </label>
            <select wire:model="bonus2_status_search" class="select select-bordered">
              <option value="">Selecione uma Opção</option>
              <option value="active">Ativo</option>
              <option value="inactive">Inativo</option>
            </select>
          </div>
          <div class="col-span-full grid grid-cols-3 flex-wrap items-end justify-center gap-3">
            <button class="btn" wire:click='resetFilters'>{{ __('admin_user_index.clear_filters') }}</button>
            <a class="btn" href='{{ route('admin.register-group') }}'>Cadastrar novo
              Grupo</a>
                <a class="btn" href='{{ route('admin.payment-group') }}'>Exibir pagamento de grupos</a>
          </div>
        </div>

        <div>
          @if (session()->has('message_delete'))
            <div class="alert alert-success shadow-lg">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('message_delete') }}</span>
              </div>
            </div>
          @endif
        </div>

        <div>
          @if (session()->has('message_group'))
            <div class="alert alert-success shadow-lg">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 stroke-current" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('message_group') }}</span>
              </div>
            </div>
          @endif
        </div>
      </form>
    </div>
    <div class="grid md:grid-cols-3 justify-center gap-8 p-6">

      @foreach ($groups as $group)

        @php
          $number_user_by_group = '';
          if (!empty($group->id)) {
              $number_user_by_group = DB::table('users')
                  ->where('group_id', '=', $group->id)
                  ->count();
          }
        @endphp

      <div class="overflow-hidden rounded-lg">
        <div class="px-6 py-8 bg-white sm:p-8 sm:pb-6" style="background: #e7ebef;">
            <div wire:key="user-{{ $group->id }}"class="flex items-baseline text-2xl font-extrabold">{{ $group->name }}</div>
            <p class="mt-5 text-lg text-gray-500">
                <b>{{ $number_user_by_group }}</b> usuários
                <p class="text-xs opacity-[70]">{{ $group->description }}</p>
            </p>
        </div>
        <div class="flex flex-col justify-between flex-1 px-6 pt-6 pb-8 space-y-6 bg-gray-50 sm:p-10 sm:pt-6">
            <ul class="space-y-2">
                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus1_status') }} : {{ $obj->formata_group_bonusstatus($group->bonus1_status) }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus1_piso') }} : {{ $group->bonus1_piso_integer }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus1_teto') }} : {{ $group->bonus1_teto_integer }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus1_percentual') }} : {{ $group->bonus1_percentual_valor_integer }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus1_destino') }} : {{ $obj->formata_group_destino($group->bonus1_destino) }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus2_status') }} : {{ $obj->formata_group_bonusstatus($group->bonus2_status) }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    Bonificação em dois níveis : {{ $group->bonus2_two_levels }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    Percentual do Superior : {{ $group->bonus2_percentual_superior_integer }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus2_piso') }} : {{ $group->bonus2_piso_integer }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus2_teto') }} : {{ $group->bonus2_teto_integer }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus2_percentual') }} : {{ $group->bonus2_percentual_valor_integer }}
                  </p>
                </li>

                <li class="flex items-start">
                  <div class="flex-shrink-0">
                      <svg class="w-6 h-6 text-green-500" x-description="Heroicon name: outline/check" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <p class="ml-3 text-sm text-gray-700">
                    {{ __('admin_group.bonus2_destino') }} : {{ $obj->formata_group_destino($group->bonus2_destino) }}
                  </p>
                </li>

            </ul>
            <div class="buttons justify-between w-full">
              <label wire:click='storeGroup({{ $group->id }})' class="button small blue gap-2 px-4" for="edit-group" style="background: #8080804f; border: 1px solid #0000001c; color: #000000b0; font-weight: 700; line-height: 18px;">
                <svg class="text-white w-5 h-5" style="color: #000000b0 !important" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                  <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                    <p>Editar grupo</p>
                </svg>
              </label>
              <label wire:click="storeGroup({{ $group->id }})" class="button small blue gap-2 px-4" for="confirm-delete" style="background: #8080804f; border: 1px solid #0000001c; color: #000000b0; font-weight: 700; line-height: 18px;">
                <span class="icon w-4 h-4"><i class="mdi mdi-trash-can"></i></span><p>Remover grupo</p>
              </label>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    {{ $groups->links() }}



  </div>



  {{-- MODAL CONFIRMAR DESATIVAR GRUPO --}}

  <input type="checkbox" id="confirm-delete" class="modal-toggle z-50" />
  <div class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold">
        {{ __('admin_group.confirm_delete_title') }}</h3>
      <p class="py-4">{{ __('admin_group.confirm_delete_description') }}</p>
      <div class="modal-action flex items-center justify-end">
        <label wire:click="$set('confirmingItemBan__', false)" for="confirm-delete"
          class="btn-error btn">{{ __('admin_group.cancel') }}</label>
        <label wire:click="destroy()" for="confirm-delete"
          class="btn-success btn">{{ __('admin_group.disable') }}</label>
      </div>
    </div>
  </div>

  {{-- MODAL EDITAR  GRUPO --}}

  <input type="checkbox" id="edit-group" class="modal-toggle z-50" />
  <div id="modal-edit-class-for-close" class="<?php if ($errors->any()) {
      echo ' modal-open';
  } ?> modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold">{{ __('admin_group.group_title') }}</h3>
      <p class="py-4">{{ __('admin_group.change_data_groups_description') }}
      </p>
      <div>
        <div class="card-content">
          <form>
            <div class="field">
              <div class="field-body">
                <div class="mb-4">
                  <label
                    class="mb-2 block text-sm font-bold text-gray-700">{{ __('admin_register-group.name') }}</label>
                  <div class="field-body">
                    <div class="field">
                      <input wire:model.defer='name' class="input" type="text">
                    </div>
                    @error('name')
                      <span class="error text-red-700">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="mb-4">
                  <label class="mb-2 block text-sm font-bold text-gray-700">Tipo:</label>
                  {{$tipo}}
                </div>
                <div class="mb-4">
                  <label
                    class="mb-2 block text-sm font-bold text-gray-700">{{ __('admin_register-group.description') }}</label>
                  <div class="field-body">
                    <div class="field">
                      <textarea wire:model.defer='description' name="" id="" cols="30" rows="3"></textarea>
                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <label
                    class="mb-2 block text-sm font-bold text-gray-700">{{ __('admin_group.status_bonus1') }}</label>
                  <select wire:model.defer="bonus1_status">
                    <option selected value="">
                      {{ __('admin_group.select_option') }}</option>
                    <option value="active">{{ __('admin_group.active') }}
                    </option>
                    <option value='inactive'>{{ __('admin_group.inactive') }}
                    </option>
                  </select>
                  @error('bonus1_status')
                    <span class="error text-red-700">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-4">
                  <label class="mb-2 block text-sm font-bold text-gray-700" for="">P.D Piso </label>
                  <input id='bonus1_piso' type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"placeholder="1-50000" wire:model.defer='bonus1_piso_integer' >
                    Digite apenas números inteiros
                </div>
                <div class="mb-4">
                  <label class="mb-2 block text-sm font-bold text-gray-700" for="">P.D Teto </label>
                  <input id='bonus1_teto' onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" placeholder="1-50000" wire:model.defer='bonus1_teto_integer'>
                    Digite apenas números inteiros
                </div>
                <div class="mb-4">
                  <label class="mb-2 block text-sm font-bold text-gray-700" for="">P.D Percentual</label>
                  <input id="bonus_1_percentual" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="1-100"
                    wire:model.defer='bonus1_percentual_valor_integer'>
                    Digite apenas números inteiros
                </div>
                <div class="mb-4">
                  <label
                    class="mb-2 block text-sm font-bold text-gray-700">{{ __('admin_group.bonus1_destino_modal') }}</label>
                  <select wire:model.defer="bonus1_destino">
                    <option selected value="">
                      {{ __('admin_group.select_option') }}</option>
                    <option value="balanceNormal">
                      {{ __('admin_group.balanceNormal') }}</option>
                    <option value='balanceBonus'>
                      {{ __('admin_group.balanceBonus') }}</option>
                  </select>
                  @error('bonus1_destino')
                    <span class="error text-red-700">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-4">
                  <label class="mb-2 block text-sm font-bold text-gray-700"
                    for="">{{ __('admin_group.status_bonus2') }}</label>
                  <select wire:model.defer="bonus2_status">
                    <option selected value="">
                      {{ __('admin_group.select_option') }}</option>
                    <option value="active">{{ __('admin_group.active') }}
                    </option>
                    <option value='inactive'>{{ __('admin_group.inactive') }}
                    </option>
                  </select>
                  @error('bonus2_status')
                    <span class="error text-red-700">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-4">
                  <label class="mb-2 block text-sm font-bold text-gray-700" for="">CPA Piso </label>
                  <input id='bonus2_piso' type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="1-50000" wire:model.defer='bonus2_piso_integer'>
                    Digite apenas números inteiros
                </div>

                <div class="mb-4">
                  <label class="mb-2 block text-sm font-bold text-gray-700" for="">CPA Teto </label>
                  <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" id='bonus2_teto' type="text" placeholder="1-50000" wire:model.defer='bonus2_teto_integer'>
                    Digite apenas números inteiros
                </div>

                <div class="mb-4">
                  <label class="mb-2 block text-sm font-bold text-gray-700"
                    for="">{{ __('admin_group.bonus2_percentual_modal') }}</label>
                  <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="1-100"
                    id="bonus_2_percentual"
                    wire:model.defer='bonus2_percentual_valor_integer'>
                    Digite apenas números inteiros
                </div>
                <div class="mb-4">
                  <label class="mb-2 block text-sm font-bold text-gray-700"
                    for="">{{ __('admin_group.bonus2_destino_modal') }}</label>
                  <select wire:model.defer="bonus2_destino">
                    <option selected value="">
                      {{ __('admin_group.select_option') }}</option>
                    <option value="balanceNormal">
                      {{ __('admin_group.balanceNormal') }}</option>
                    <option value='balanceBonus'>
                      {{ __('admin_group.balanceBonus') }}</option>
                  </select>
                  @error('bonus2_destino')
                    <span class="error text-red-700">{{ $message }}</span>
                  @enderror
                </div>

              </div>
            </div>
          </form>
        </div>
        <div class='modal-action flex items-center justify-end'>
          <label wire:click="editGroup" for="edit-group"
            class="btn-success btn">{{ __('admin_user_index.confirm_modal_change') }}</label>
          <label wire:click="cancelEditUser()" for="edit-group"
            class="btn-error btn">{{ __('admin_user_index.cancel_modal_change') }}</label>
        </div>
      </div>
    </div>
  </div>

  <input type="checkbox" id="change-password" class="modal-toggle z-50" />
  <div class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold">
        {{ __('admin_user_index.change_password') }}</h3>
      <p class="py-4">
        {{ __('admin_user_index.change_password_description') }}</p>
      <div class="modal-action flex items-center justify-end">
        <div class="card-content">
          <form>
            <div class="field">
              <div class="field-body">
                <div class="field">
                  <div>
                    <input class="input" type="text" placeholder="Password" wire:model='new_password_user'>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class='modal-action flex items-center justify-end'>
        <label wire:key="label-cancel-change-password" wire:click="$set('confirmingItemBan__', false)"
          for="change-password" class="btn-error btn">{{ __('admin_user_index.cancel_modal_change') }}</label>
        <label wire:key="label-confirm-change-password" wire:click="editPassword()" for="change-password"
          class="btn-success btn">{{ __('admin_user_index.confirm_modal_change') }}</label>
      </div>
    </div>
  </div>

  {{-- MODAL DE AVISO PARA NÃO DESATIVAR GRUPO PADRAO --}}

  <label for="my-modal-3" id="mymodal2" class="hidden"></label>

  <input type="checkbox" id="my-modal-3" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box relative">
      <label for="my-modal-3" class="btn-sm btn-circle btn absolute right-2 top-2">✕</label>
      <h3 class="text-lg font-bold">Não é possível desativar grupos padrões!
      </h3>
      <p class="py-4">Infelizmente não é possível desativar grupos do tipo
        Padrão!</p>
    </div>
  </div>

  <script>
    //##################################################################################################################################################################################################################
    //##################################################################################################################################################################################################################
    //o momento callback dehydrate() é executando sempre apos um render e ele dispara o contentChanged para dar um refresh no JS
    document.addEventListener('close-modal-from-cancel', function(e) {
      document.getElementById("edit-user").checked = false;


    });

    window.addEventListener('open-modal-group-padrao', event => {

      document.getElementById('mymodal2').click();
    });

    const bonus2_teto = document.getElementById("bonus2_teto");
    bonus2_teto.addEventListener("keypress", function(e) {
    if(e.key === ",") {
      e.preventDefault();
  }
    if(e.key === ".") {
      e.preventDefault();
  }

  });

  const bonus2_piso = document.getElementById("bonus2_piso");
  bonus2_piso.addEventListener("keypress", function(e) {
    if(e.key === ",") {
      e.preventDefault();
  }
    if(e.key === ".") {
      e.preventDefault();
  }

  });

  const bonus1_teto = document.getElementById("bonus1_teto");
  bonus1_teto.addEventListener("keypress", function(e) {
    if(e.key === ",") {
      e.preventDefault();
  }
    if(e.key === ".") {
      e.preventDefault();
  }

  });

  const bonus1_piso = document.getElementById("bonus1_piso");
  bonus1_piso.addEventListener("keypress", function(e) {
    if(e.key === ",") {
      e.preventDefault();
  }
    if(e.key === ".") {
      e.preventDefault();
  }

  });

  const bonus_1_percentual = document.getElementById("bonus_1_percentual");
  bonus_1_percentual.addEventListener("keypress", function(e) {
    if(e.key === ",") {
      e.preventDefault();
  }
    if(e.key === ".") {
      e.preventDefault();
  }

  });

  const bonus_2_percentual = document.getElementById("bonus_2_percentual");
  bonus_2_percentual.addEventListener("keypress", function(e) {
    if(e.key === ",") {
      e.preventDefault();
  }
    if(e.key === ".") {
      e.preventDefault();
  }

  });



  </script>

</div>

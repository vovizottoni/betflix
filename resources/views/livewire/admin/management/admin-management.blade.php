<div class="min-h-screen-without-header p-10">

  <h1 class="mb-8 text-4xl">{{ __('Gerenciamento de administradores') }}</h1>
  
  {{-- filters --}}
  <div class="mb-20">

    {{-- filter date_from --}}
    <div class=""\>
      <label class="">
        <span
          class="">De:</span>
      </label>
      <input class="" wire:model="filter_from" type="date">
    </div> 

    {{-- filter date to --}}
    <div class="">
      <label class="">
        <span
          class="">Até:</span>
      </label>
      <input class="" wire:model="filter_to" type="date">
    </div> 

    {{-- filter name --}}
    <div>
      <input class="" type="text" placeholder="Search Name" wire:model="searchName" />
    </div>

  </div>

  {{-- botão "Create New" --}}
  <div>
    <label class="btn" for='create-admin' wire:click='resetFieldsAdmin()'>
      Create New
    </label>
  </div>

  {{-- linha separadora --}}
  <hr class="mt-5 mb-10" />

  <table>
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Data de criação</th>
      </tr>
    </thead>

    <tbody>
      @if (!$users->isEmpty())
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ date('d/m/Y',strtotime($user->created_at)) }}</td>
            <td>
              <button class="btn"
                wire:click="changeUserActive({{ $user->id }})">
                @if ($user->active == 's')
                  Desativar
                @else
                  Ativar
                @endif
              </button>
            </td>
            <td>
              <label class="btn" wire:click="fillEditFields({{ $user->id }})" for='edit-admin'>
                Editar
              </label>
            </td>
          </tr>
        @endforeach
      @else
        <p>
          Nenhum administrador encontrado
        </p>
      @endif
    </tbody>
  </table>

  {{-- modal de criação --}}
  <input type="checkbox" id="create-admin" class="modal-toggle z-50" />
    <div class="modal <?php if($errors->any() && $is_create) { echo ' modal-open';} ?>">
      <div class="modal-box">
        <h3 class="font-bold text-lg">Adicionar Administrador</h3>
        <p class="py-4">Adicione as informações do novo Administrador</p>
        <div class="modal-action flex items-center justify-end">
          <div class="card-content">
            <form>
              <div class="field">
                <div class="field-body">
                  <div class="field">
                    <div>

                      <label>Nome</label>
                      <input class="input" type="text"  wire:model='name'>
                        @error('name')<span class="label-text text-red-600">{{ $message }}</span> @enderror

                      <label>Email</label>
                      <input class="input" type="text"  wire:model='email'>
                        @error('email')<span class="label-text text-red-600">{{ $message }}</span> @enderror

                      <label>Senha</label>
                      <input class="input" type="password"  wire:model='password'>
                        @error('password')<span class="label-text text-red-600">{{ $message }}</span> @enderror

                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class='modal-action flex items-center justify-end'>
            <label wire:click="closeModalCreate()" for="create-admin" class="btn btn-error">Fechar</label>
            <label wire:click="createNewAdmin()" for="create-admin"  class="btn btn-success">Salvar</label>
        </div>
      </div>
    </div>


  {{-- modal de edição --}}
  <input type="checkbox" id="edit-admin" class="modal-toggle z-50" />
        <div class="modal <?php if($errors->any() && !$is_create) { echo ' modal-open';} ?> " >
          <div class="modal-box">
            <h3 class="font-bold text-lg">Editar Administrador</h3>
            <p class="py-4">Edite as informações dos Administradores</p>
            <div class="modal-action flex items-center justify-end">
              <div class="card-content">
                <form>
                  <div class="field">
                    <div class="field-body">
                      <div class="field">
                        <div>
                          <label>Nome</label>
                          <input class="input" type="text"  wire:model='name'>
                            @error('name')<span class="label-text text-red-600">{{ $message }}</span> @enderror

                          <label>Email</label>
                          <input class="input" type="text"  wire:model='email'>
                            @error('email')<span class="label-text text-red-600">{{ $message }}</span> @enderror
                            
                          <label>Senha</label>
                          <input class="input" type="password"  wire:model='password' placeholder="Só preencha se quiser editar">
                            @error('password')<span class="label-text text-red-600">{{ $message }}</span> @enderror

                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class='modal-action flex items-center justify-end'>
                <label wire:click='closeModalEdit()' for="edit-admin" class="btn btn-error">Fechar</label>
                <label wire:click="edit({{$user_id}})" for="edit-admin"  class="btn btn-success" >Editar</label>
            </div>
          </div>
        </div>
        {{$users->links()}}

  <script>
    //fecha as modais
    document.addEventListener('close-modal-edit', function(e){
      document.getElementById("edit-admin").checked = false;
    });

    document.addEventListener('close-modal-create', function(e){
      document.getElementById("create-admin").checked = false;
    });
  </script>
</div>

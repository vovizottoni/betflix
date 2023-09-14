<?php

namespace App\Http\Livewire\Admin\Management;

use Livewire\Component;

//libs utilizadas
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//rules utilizadas
use Laravel\Fortify\Rules\Password;

//models utilizadas
use App\Models\User;

//paginação
use Livewire\WithPagination;


class AdminManagement extends Component
{
    //pagination
    use WithPagination;

    //atributos filtros
    public $filter_name;
    public $filter_from;
    public $filter_to;
    public $searchName;

    //atributos formulários
    public $name;
    public $email;
    public $password;

    public $user_id;
    public $is_create = FALSE;
    

    //reseta os campos
    private function resetInputFields()
    {
        $this->reset();
    }

    //reseta os campos para a criação de um novo admim
    public function resetFieldsAdmin()
    {
        $this->resetInputFields();
    }

    //validação do name
    public function validateName()
    {
        //criando um array com o nome para validar
        $input = [
            'name' => $this->name,
        ];

        //validando o nome
        Validator::make($input, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ])->validate();
    }

    //validação do email
    public function validateEmail()
    {
        //criando um array com o email para validar
        $input = [
            'email' => $this->email,
        ];
        
        //validando o email
        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ])->validate(); 
    }

    //validação da senha
    public function validatePassword()
    {
        //criando um array com a senha para validar
        $input = [
            'password' => $this->password,
        ];
        
        //validando a senha
        Validator::make($input, [
            'password' => ['required', 'string', new Password,],
        ])->validate();
        
    }

    //cria um novo admin
    public function createNewAdmin()
    {        
        $this->is_create = TRUE;
        
        //validando os campos
        $this->validateName();
        $this->validateEmail();
        $this->validatePassword();

        //salvando no bd o novo admin
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'cpf' => '39635270216',//cpf padrão para todos os administradores
            'role' => 'admin',
            'kyc_status' => 'not_verified',
            'active' => 's',
        ]);

        //resetando os campos
        $this->resetInputFields();

        //fechando a modal
        $this->closeModalCreate();

        $this->is_create = FALSE;
    }

    //preencher campos para edição
    public function fillEditFields($user_id)
    {
        $user = User::where([['id', '=', $user_id]])->select('name', 'email')->first();
        $this->name = $user->name;
        $this->email = $user->email;

        $this->user_id = $user_id;
    }

    //editar o usuário
    public function edit($user_id)
    {   
        $user = User::where([['id', '=', $user_id]])->select('password', 'email')->first();
        
        //validando o nome
        $this->validateName();
        
        //validando o email
        if(!($this->email == $user->email)){
            $this->validateEmail();
        }

        //se não digitar nenmhuma senha, busca a atual no banco. Se digitar faz a validação, encripta salva no bd
        if(!$this->password){
            $this->password = $user->password;
        }else{
            $this->validatePassword();
            $this->password = Hash::make($this->password);
        }

        //salvando no banco
        User::where([['id', '=', $user_id]])->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        //resetando os campos
        $this->resetInputFields();

        //fechando a modal
        $this->closeModalEdit();
    }

    //mudar o state do usuário (active == n or active == s)
    public function changeUserActive($user_id)
    {
        $user = User::where([['id', '=', $user_id]])->select('active')->first();
        
        if($user->active == 's'){
            User::where([['id', '=', $user_id]])->update(['active' => 'n']);                
        }else{
            User::where([['id', '=', $user_id]])->update(['active' => 's']);                
        }
    }

    // função para fechar modal de edição após validação
    public function closeModalEdit()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('close-modal-edit');
    }

    // função para fechar modal de criação após validação
    public function closeModalCreate()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('close-modal-create');
    }

    public function render()
    {
        //criando array que acumula os filtros
        $filters = [];

        //filter date_from
        if($this->filter_from){
            $filters[] = ['created_at', '>=', $this->filter_from];
        }
        
        //filter date_to
        if($this->filter_to){
            $to = Carbon::create($this->filter_to)->addDays(1);
            $filters[] = ['created_at', '<', $to];
        }

        //filter name
        if($this->searchName){
            $searchName = '%'.$this->searchName.'%';
            $filters[] = ['name', 'like', $searchName];
        }

        //filter role == admin
        $filters[] = ['role', '=', 'admin'];
        $users = User::where($filters)->select('id', 'name', 'email', 'created_at', 'active')->orderBy('created_at', 'desc')->paginate(40);

        return view('livewire.admin.management.admin-management',[
            'users' => $users,
        ]);
    }

}

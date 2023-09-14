<?php

namespace App\Http\Livewire\Player;

use Livewire\Component;
use Livewire\WithPagination;


//models utilizadas
use App\Models\Account;


//Libs utilizadas
use Illuminate\Support\Facades\Auth;


class Accounts extends Component
{
    //ATRIBUTOS TELA DE PESQUISA
    use WithPagination;

    public $searchTerm;
    public $confirmingItemDeletion = false;

    //ATRIBUTOS TELA DE CADASTRO/EDIÇÃO de contas
    public $idAccount; //primary key
    public $user_id;   //foreign key
    public $name;
    public $description;
    public $photo;

    public $pos1 = 1;
    public $msgsucess;

    public $chooseImage;
    public $createClicked;


    protected $rules = [
        'name' => 'required|min:6|max:50|unique:accounts,name',// validação do campo de nomes
        'description' => 'max:150'
    ];
    //listeners

    //Acao para trocar account de um user logado
    public function selectAccountID($account_id)
    {

        if ($account_id) {


            //verificacao seguranca: account_id tem que ser do usuario logado
            $verificacao = Account::where([['users_id', '=', Auth::user()->id], ['id', '=', $account_id]])->first();

            if ($verificacao) { // account_id é desse usuario, PROSSEGUE


                //Adiciona esta $account_id como a account escolhida Pelo user Logado
                session()->put('account_id', $account_id);

                //direciona para Home de usuario Logado
                return redirect('games');

            } else {

                auth()->guard('web')->logout();
                return redirect()->route('/');
            }


        } else {

            return;

        }


    }


    public function create() //abrir modal para cadastro ----
    {
        $this->createClicked = 'clicked';
        $this->resetInputFields();
        $this->name = __("accounts.new_account");;
        $this->description = __("accounts.add_the_description");
        $this->photo = 'assets/images/avatars/avatar-1.jpeg';


        //dd($createClicked);
    }

    public function changeAccount() //ALTERAÇÃO SELECTED -- CARREGAR NAME E DESCRIPTION
    {

        $changeSelect = Account::where(['id' => $this->idAccount])->first();
        if ($changeSelect) {
            $this->name = $changeSelect->name;
            $this->description = $changeSelect->description;
            $this->photo = $changeSelect->photo;
        }
    }

    public function closeWindow()
    {
        $this->resetInputFields();
        $this->resetValidation();
    }


    private function resetInputFields() //reseta os campos
    {
        $this->reset();

    }

    public function store()  //PROCESSAMENTO do cadastrar ou editar: updateOrCreate
    {


        //Se for update, name tem que ser unique, mas desconsiderando id que está sendo atualizado (idAccount)
        if ($this->idAccount) {
            $this->rules['name'] = 'required|max:50|unique:accounts,name,' . $this->idAccount;
        }


        $this->validate();


        //se for update
        //se for update
        if ($this->idAccount) {

            Account::updateOrCreate(['id' => $this->idAccount], [
                'name' => $this->name,
                'description' => $this->description,
                'photo' => $this->photo,
                'users_id' => Auth::user()->id
            ]);


            //se for create
            //se for create
        } else {

            Account::updateOrCreate(['id' => $this->idAccount], [
                'name' => $this->name,
                'description' => $this->description,
                'photo' => $this->photo,
                'balance' => 0.0,
                'balanceBonus' => 0.0,
                'balanceUSD' => 0.0,
                'balanceUSDBonus' => 0.0,
                'users_id' => Auth::user()->id
            ]);

        }


        //Se for update, volta name validate para estado inicial
        if ($this->idAccount) {
            $this->rules['name'] = 'required|max:50|unique:accounts,name';
        }

        //resetar campos
        $this->resetInputFields();
        //despacha para o js evento de fechar modal
        $this->dispatchBrowserEvent('closeModal');

        //recarregar página
        return redirect(request()->header('Referer'));


    }

    public function selectImage($v1 = '')
    {

        $this->chooseImage = $v1;

    }

    public function storeImageSelected()
    {

        Account::where('photo')->update([
            'photo' => $this->chooseImage
        ]);

        $this->photo = $this->chooseImage;
        $this->dispatchBrowserEvent('closeModalChooseImage');
        //dd($this->chooseImage);


    }


    public function confirmingItemDeletion()//CONFIRMA SE É PARA DELETAR CONTA
    {

        $this->confirmingItemDeletion = $this->idAccount;

    }

    public function destroy()// DELETA CONTA
    {

        Account::where([['id', "=", $this->idAccount]])->delete();

        $this->confirmingItemDeletion = false;


        session()->flash('message', 'Conta Desativada');

        return redirect(request()->header('Referer'));


    }

    public function reactive($id)//REATIVA A CONTA
    {

        Account::withTrashed()->where([['id', "=", $id]])->restore();

        session()->flash('deleted', 'Conta reativada');
    }

    public function mount()
    {
        //verificacao seguranca: account_id tem que ser do usuario logado
        $account = Account::where([['users_id', '=', Auth::user()->id]])->first();

        //Adiciona esta $account_id como a account escolhida Pelo user Logado
        session()->put('account_id', $account->id);
    }

    public function render()
    {


        $searchTerm = '%' . $this->searchTerm . '%'; //busca de contas cadastradas
        return view('livewire.player.accounts', [
            'account_disabled' => Account::onlyTrashed()
            ->where('users_id', Auth::user()->id)
            ->get(),//lista contas deletadas
            'account_return' => Account::where([['name', 'like', $searchTerm], ['users_id', '=', Auth::user()->id]])->orderBy('name')->get()
        ]);
    }
}

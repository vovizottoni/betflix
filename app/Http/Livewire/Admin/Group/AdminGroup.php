<?php

namespace App\Http\Livewire\Admin\Group;

use App\Models\Group;
use App\Models\User;
use Livewire\Component;

use App\util\Util;


//pagination
use Livewire\WithPagination;

class AdminGroup extends Component
{


    use WithPagination;

    public $confirmingItemBan__ = false;

    //FILTROS
    public $status;
    public $searchTerm;
    public $created_at__from;
    public $created_at__to;
    public $from;
    public $to;
    public $tipo_search;
    public $bonus1_status_search;
    public $bonus2_status_search;

    //modal edição

    public $id_group;
    public $created_at;
    public $bonus1_status;
    public $bonus1_percentual_valor_integer;
    public $bonus1_destino;
    public $bonus2_status;
    public $bonus2_percentual_valor_integer;
    public $bonus2_destino;
    public $bonus2_two_levels;
    public $bonus2_percentual_superior_integer;

    public $name;
    public $description;
    public $tipo;
    public $bonus1_teto_integer;
    public $bonus1_piso_integer;
    public $bonus2_piso_integer;
    public $bonus2_teto_integer;



    protected $rules = [
        'name' => 'required',
        'bonus1_status' => 'required',
        'bonus1_destino' => 'required',
        'bonus2_status' => 'required',
        'bonus2_destino' => 'required',
        'tipo' => 'required',

    ];

    public function mount()
    {



    }


    public function confirmingItemBan($id) //CONFIRMAR BAN
    {


        $this->confirmingItemBan__ = $id;
    }



    public function resetFilters() //reseta os campos
    {
        $this->resetFilters();

        //limpar filtros

    }

    public function storeGroup($id) // pegar user pelo id
    {


        $group_aux = Group::where([['id', '=', $id]])->first();
        $this->name = $group_aux->name;
        $this->id_group = $id;
        $this->tipo = $group_aux->tipo;
        $this->bonus1_teto_integer = $group_aux->bonus1_teto_integer;
        $this->bonus1_piso_integer = $group_aux->bonus1_piso_integer;
        $this->bonus2_piso_integer = $group_aux->bonus2_piso_integer;
        $this->bonus2_teto_integer = $group_aux->bonus2_teto_integer;
        $this->bonus2_two_levels = $group_aux->bonus2_two_levels;
        $this->bonus2_percentual_superior_integer = $group_aux->bonus2_percentual_superior_integer;



        $this->description = $group_aux->description;
        $this->created_at = $group_aux->created_at;
        $this->bonus1_status = $group_aux->bonus1_status;
        $this->bonus1_percentual_valor_integer = $group_aux->bonus1_percentual_valor_integer;
        $this->bonus1_destino = $group_aux->bonus1_destino;
        $this->bonus2_status = $group_aux->bonus2_status;
        $this->bonus2_percentual_valor_integer = $group_aux->bonus2_percentual_valor_integer;
        $this->bonus2_destino = $group_aux->bonus2_destino;

    }

    public function editGroup() // editar email e nome do usuário
    {

        $this->validate();

        $group_aux = User::where([['id', '=', $this->id_group]])->first();

        Group::where([['id', '=', $this->id_group]])->update([
            'name' => $this->name,
            'tipo' => $this->tipo = 'nao-padrao',
            'description' => $this->description,
            'bonus1_status' => $this->bonus1_status,
            'bonus1_percentual_valor_integer' => $this->bonus1_percentual_valor_integer,
            'bonus1_destino' => $this->bonus1_destino,
            'bonus2_status' => $this->bonus2_status,
            'bonus2_two_levels' => $this->bonus2_two_levels,
            'bonus2_destino' => $this->bonus2_destino,
            'bonus1_piso_integer' => $this->bonus1_piso_integer,
            'bonus2_piso_integer' => $this->bonus2_piso_integer,
            'bonus2_teto_integer' => $this->bonus2_teto_integer,
            'bonus1_teto_integer' => $this->bonus1_teto_integer,

        ]);
        session()->flash('message_group', 'Dados do grupo alterados com sucesso!');
    }



    public function destroy() // DELETA GROUP
    {
        $group_padrao_aux = Group::where([['tipo', "=", 'padrao']])->where([['id', "=", $this->id_group]])->first();

        if ($group_padrao_aux) {
            $this->dispatchBrowserEvent('open-modal-group-padrao');
        }
        else{
        Group::where([['id', "=", $this->id_group]])->delete();


        session()->flash('message_delete', 'Grupo Desativado');
        }
    }



    public function render()
    {

        $where = [];

        // created_at from
        if ($this->created_at__from) {

            $this->created_at__from = str_replace("T", " ", $this->created_at__from);


            $where[] = ['created_at', '>=', $this->created_at__from];
        }

        // created_at to
        if ($this->created_at__to) {



            $this->created_at__to = str_replace("T", " ", $this->created_at__to);



            $where[] = ['created_at', '<=', $this->created_at__to];
        }

        if ($this->tipo_search) {


            $where[] = ['tipo', '=', $this->tipo_search];
        }


        if ($this->bonus1_status_search) {


            $where[] = ['bonus1_status', '=', $this->bonus1_status_search];
        }

        if ($this->bonus2_status_search) {


            $where[] = ['bonus2_status', '=', $this->bonus2_status_search];
        }


        $searchTerm = '%' . $this->searchTerm . '%';


        //dd($user_player);

        $groups = Group::where('name', 'like', $searchTerm)->where($where)->orderBy('updated_at', 'desc')->paginate(40);



        //passa classe util para view
        $objUtil = new Util();


        return view('livewire.admin.group.admin-group', [
            'groups' => $groups,
            'obj' => $objUtil,

        ]);
    }

    public function cancelEditUser() // função para fechar modal após validação
    {

        $this->resetErrorBag();


        $this->dispatchBrowserEvent('close-modal-from-cancel');
    }
}

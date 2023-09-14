<?php

namespace App\Http\Livewire\Admin\Group;

use App\Models\Group;
use Livewire\Component;

class RegisterGroup extends Component
{


    public $bonus1_status;
    public $bonus1_percentual_valor_integer;
    public $bonus1_destino;
    public $bonus2_status;
    public $bonus2_two_levels = NULL;
    public $bonus2_percentual_superior_integer;
    public $bonus2_percentual_valor_integer;
    public $bonus2_destino;
    public $name;
    public $description;
    public $tipo;
    public $bonus1_piso_integer;
    public $bonus2_piso_integer;
    public $bonus2_teto_integer;

    public $bonus1_teto_integer;



    protected $rules = [
        'name' => 'required',
        'bonus1_status' => 'required',
        'bonus1_destino' => 'required',
        'bonus2_status' => 'required',
        'bonus2_destino' => 'required',


    ];


    public function resetFilters() //reseta os campos
    {
        $this->resetFilters();

        //limpar filtros

    }

    public function register()
    {
        $this->validate();


        Group::create([
            'name' => $this->name,
            'tipo' => $this->tipo = 'nao-padrao',
            'description' => $this->description,
            'bonus1_status' => $this->bonus1_status,
            'bonus1_percentual_valor_integer' => $this->bonus1_percentual_valor_integer,
            'bonus1_destino' => $this->bonus1_destino,
            'bonus2_status' => $this->bonus2_status,
            'bonus2_two_levels' => $this->bonus2_two_levels,
            'bonus2_percentual_superior_integer' => $this->bonus2_percentual_superior_integer,
            'bonus2_percentual_valor_integer' => $this->bonus2_percentual_valor_integer,
            'bonus2_destino' => $this->bonus2_destino,
            'bonus1_piso_integer' => $this->bonus1_piso_integer,
            'bonus2_piso_integer' => $this->bonus2_piso_integer,
            'bonus2_teto_integer' => $this->bonus2_teto_integer,


        ]);
        $this->reset();
        session()->flash('message_group', 'Grupo Criado com Sucesso!');
    }

    public function cancel()
    {
        return redirect()->route('admin.admim-group');
    }

    public function render()
    {
        return view('livewire.admin.group.register-group');
    }
}

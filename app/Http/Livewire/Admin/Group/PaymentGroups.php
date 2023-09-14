<?php

namespace App\Http\Livewire\Admin\Group;

use App\Models\Account;
use App\Models\Bonus;
use App\Models\Group;
use App\Models\User;
use Livewire\Component;

class PaymentGroups extends Component
{

    //exibição
    public $group12;



    public $id_user;
    public $arr_accounts_user;
    public $name_group;
    public $userObj;
    public $bet;
    public $pagou;
    public $bonus3_valordopagamentosemanal;
    //filtros //filtros //filtros
    public $created_at__from;
    public $created_at__to;
    public $convidados;
    public $convidado_escolhido;
    public $account;
    public $account_select;
    public $group_select;
    public $gateway_pagamento;
    public $tipo_group;
    public $semana_processamento;
    public $amount = 40;





    public function mount()
    {
        $this->userObj = User::where('id', $this->id_user)->first();

        $this->convidados =  User::where('role','player')->where('active','s')->get();


        $this->arr_accounts_user = Account::where('users_id',$this->id_user)->pluck('id')->toArray();

        $this->name_group = Group::get();

    }



    public function resetFilters()
    {
        $this->reset('created_at__from','created_at__to','account_select','group_select','gateway_pagamento','tipo_group','convidado_escolhido');
    }

    public function cancel()
    {
        return redirect()->route('admin.admim-group');
    }


    public function render()
    {

        $this->account = Account::where([['users_id', '=', $this->convidado_escolhido]])->get();


        $where = [];



        if ($this->account_select) {
            $where[] = ['accounts_id','=', $this->account_select ];
        }

        if ($this->group_select) {
            $where[] = ['group_id','=', $this->group_select];
        }

        if ($this->gateway_pagamento) {

            $where[] = ['bonus12_gateway_pagamento','=', $this->gateway_pagamento];
        }

        if ($this->tipo_group) {
            $where[] = ['group_tipo','=', $this->tipo_group];
        }

        // created_at from
        if($this->created_at__from){

            $where[] = ['created_at', '>=', $this->created_at__from];
        }

        // created_at to
        if($this->created_at__to){


            $where[] = ['created_at', '<=', $this->created_at__to];
        }


        if ($this->convidado_escolhido) {

            $accounts_user = Account::where('users_id',$this->convidado_escolhido)->pluck('id')->toArray();

            //dd($accounts_user);
            $bonus12 = Bonus::whereIn('group_tipo', ['1','2'])->where($where)->whereIn('accounts_id',$accounts_user)->orderBy('id', 'desc')->take($this->amount)->get();
        }else{


        $bonus12 = Bonus::whereIn('group_tipo', ['1','2'])->where($where)->orderBy('id', 'desc')->take($this->amount)->get();
        }

        return view('livewire.admin.group.payment-groups', [
            'bonus12' => $bonus12
        ]);

    }


    public function dehydrate() //é um momento(callbacks) executado sempre depois do render(), e ele dispara um evento $this->dispatchBrowserEvent('contentChanged', 'event'); que será escutado na view e servirá para resetar o JS (recarregando-o)
    {

        $this->dispatchBrowserEvent('contentChanged', 'event');

    }
    //##################################################################################################################################################################################################################
    //##################################################################################################################################################################################################################
    //BOTÃO LOADMORE
    public function laodMore()
    {
        $this->amount += 40;
    }

}

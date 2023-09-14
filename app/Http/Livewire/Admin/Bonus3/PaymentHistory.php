<?php

namespace App\Http\Livewire\Admin\Bonus3;

use App\Models\Account;
use App\Models\Bonus;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentHistory extends Component
{
    use WithPagination;
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
    public $group3_processado;
    public $resultado_processamento;
    public $semana_processamento;
    public $amount = 40;





    public function mount()
    {
        $this->userObj = User::where('id', $this->id_user)->first();
        $this->convidados =  User::where('user_id', $this->id_user)->get();
        $this->arr_accounts_user = Account::where('users_id',$this->id_user)->pluck('id')->toArray();
    }



    public function render()
    {
        $where = [];


        if ($this->semana_processamento) {

            $where[] = ['bonus3_semanapagamento','=', $this->semana_processamento];
        }

        if ($this->resultado_processamento) {

            $where[] = ['bonus3_sinal','=', $this->resultado_processamento];
        }

        if ($this->group3_processado) {
            $where[] = ['bonus3_processado','=', $this->group3_processado];
        }

        if ($this->convidado_escolhido) {
            $where[] = ['users_id_gerador_do_bonus','=', $this->convidado_escolhido ];
        }

        // created_at from
        if($this->created_at__from){

            $where[] = ['created_at', '>=', $this->created_at__from];
        }

        // created_at to
        if($this->created_at__to){


            $where[] = ['created_at', '<=', $this->created_at__to];
        }



        $bonus3 = Bonus::where([['group_tipo', '=', '3'] ])->whereIn('accounts_id', $this->arr_accounts_user)->where($where)->orderBy('id','desc')->take($this->amount)->get();
        return view('livewire.admin.bonus3.payment-history',[
            'bonus3' => $bonus3
        ]);
    }


    //##################################################################################################################################################################################################################
    //##################################################################################################################################################################################################################
    public function dehydrate(){ //é um momento(callbacks) executado sempre depois do render(), e ele dispara um evento $this->dispatchBrowserEvent('contentChanged', 'event'); que será escutado na view e servirá para resetar o JS (recarregando-o)

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

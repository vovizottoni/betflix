<?php

namespace App\Http\Livewire\Referral;

use Livewire\Component;

//models utilizadas
use App\Models\Account;
use App\Models\Bet;
use App\Models\Bonus;
use App\Models\Game;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
//Libs utilizadas
use Livewire\WithPagination;

class ShowHeirarchy extends Component
{
    //TELA DE PESQUISA
    use WithPagination;

    //DADOS DA HIERARQUIA
    public $my_heirarchy;
    public $my_percent;
    public $group_supervisor = [];
    public $group_gerente = [];
    public $group_subgerente = [];
    public $gerente_detail;
    public $gerente_tree;
    public $subgerente_detail;
    public $subgerente_tree;
    public $arr_accounts_user;

    //FILTROS
    public $group_supervisor_select = [];
    public $group_gerente_select = [];
    public $group_subgerente_select = [];
    public $count_affiliates;

    public $amount = 50;

    public $name_group;

    public function mount()
    {




        $this->my_heirarchy = Auth::user()->bonus3_nivelhierarquico;
        $this->my_percent = Auth::user()->bonus3_percentual;

        if ($this->my_heirarchy == 'master') {

            $this->group_supervisor = User::where('bonus3_superiorhierarquico_user_id', Auth::user()->id)->where('bonus3_nivelhierarquico', 'supervisor')->get();



        } elseif ($this->my_heirarchy == 'supervisor') {

            $this->group_gerente = User::where('bonus3_superiorhierarquico_user_id', Auth::user()->id)->where('bonus3_nivelhierarquico', 'gerente')->get();

        } elseif ($this->my_heirarchy == 'gerente') {


            $this->group_subgerente = User::where('bonus3_superiorhierarquico_user_id', Auth::user()->id)->where('bonus3_nivelhierarquico', 'subgerente')->get();
        }


    }

    public function getGroupUser($group_id)
    {
        $name_group = Group::where([['id','=', $group_id]])->first()->name;
        if($name_group)
        return $name_group;
    }







    public function render()
    {



        //(ser master ou supervisor) e (supervisor estar selecionado)
        if (($this->my_heirarchy == 'master' || $this->my_heirarchy == 'supervisor') && ($this->group_supervisor_select))  {
            $this->gerente_detail = User::where('bonus3_superiorhierarquico_user_id', $this->group_supervisor_select)->where('bonus3_nivelhierarquico', 'gerente')->get();
        }


        //consulta
        if ($this->group_supervisor_select) {


            $affiliates = User::where('id', $this->group_supervisor_select)->take($this->amount)->orderBy('created_at', 'desc')->get();
        }

        if ($this->group_gerente_select) {


            $affiliates = User::where('id', $this->group_gerente_select)->take($this->amount)->orderBy('created_at', 'desc')->get();
            $this->subgerente_detail = User::where('bonus3_superiorhierarquico_user_id', $this->group_gerente_select)->where('bonus3_nivelhierarquico', 'subgerente')->get();
        }

        if ($this->group_subgerente_select) {


            $affiliates = User::where('id', $this->group_subgerente_select)->take($this->amount)->orderBy('created_at', 'desc')->get();
        }

        if ($this->subgerente_tree) {

            $this->subgerente_detail = User::where('bonus3_superiorhierarquico_user_id', $this->group_gerente_select)->where('bonus3_nivelhierarquico', 'subgerente')->get();
            $affiliates = User::where('bonus3_superiorhierarquico_user_id', $this->group_gerente_select)->take($this->amount)->orderBy('created_at', 'desc')->get();

        }


        if ($this->gerente_tree) {

            $affiliates = User::where('bonus3_superiorhierarquico_user_id', $this->group_supervisor_select)->take($this->amount)->orderBy('created_at', 'desc')->get();

            $this->subgerente_detail = User::where('bonus3_superiorhierarquico_user_id', $this->gerente_tree)->where('bonus3_nivelhierarquico', 'subgerente')->get();
            if ($this->subgerente_tree) {


                $affiliates = User::where('bonus3_superiorhierarquico_user_id', $this->gerente_tree)->take($this->amount)->orderBy('created_at', 'desc')->get();
            }

        }


        if(empty($this->group_supervisor_select) && empty($this->group_gerente_select) && empty($this->group_subgerente_select))
        {
            $cadeia = [];

            if ($this->my_heirarchy == 'master') {


                $cadeia[] = Auth::user()->id;

                $arr_supervisores__ = User::where([['bonus3_superiorhierarquico_user_id', '=',  Auth::user()->id]])->pluck('id')->toArray();



                foreach ($arr_supervisores__ as $id) {
                    $cadeia[] = $id;
                }


                $arr_gerentes__ = User::whereIn('bonus3_superiorhierarquico_user_id', $arr_supervisores__)->pluck('id')->toArray();

                foreach ($arr_gerentes__ as $id) {
                    $cadeia[] = $id;
                }

                $arr_subgerente__ = User::whereIn('bonus3_superiorhierarquico_user_id', $arr_gerentes__)->pluck('id')->toArray();

                foreach ($arr_subgerente__ as $id) {
                    $cadeia[] = $id;
                }



            }
            elseif($this->my_heirarchy == 'supervisor'){

                $cadeia[] = Auth::user()->id;


                $arr_gerentes__ = User::where([['bonus3_superiorhierarquico_user_id', '=',  Auth::user()->id]])->pluck('id')->toArray();

                foreach ($arr_gerentes__ as $id) {
                    $cadeia[] = $id;
                }



            }elseif($this->my_heirarchy == 'gerente'){

                $cadeia[] = Auth::user()->id;


            }elseif($this->my_heirarchy == 'subgerente'){

            }


            $affiliates = User::whereIn('bonus3_superiorhierarquico_user_id',$cadeia)->take($this->amount)->orderByRaw('FIELD(bonus3_nivelhierarquico,"master","supervisor","gerente","subgerente")')->get();
        }



        $this->count_affiliates = $affiliates->count();
        //dd($this->count_affiliates);
        return view('livewire.referral.show-heirarchy', [
            'affiliates' => $affiliates
        ]);
    }

    public function dehydrate()
    { //é um momento(callbacks) executado sempre depois do render(), e ele dispara um evento $this->dispatchBrowserEvent('contentChanged', 'event'); que será escutado na view e servirá para resetar o JS (recarregando-o)

        $this->dispatchBrowserEvent('contentChanged', 'event');
    }

    //BOTÃO LOADMORE
    public function laodMore()
    {
        $this->amount += 50;
    }
}

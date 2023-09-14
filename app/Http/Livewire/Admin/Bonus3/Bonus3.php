<?php

namespace App\Http\Livewire\Admin\Bonus3;

use App\Models\Bonus;
use Livewire\Component;

// models utilizadas
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
//pagination
use Livewire\WithPagination;

class Bonus3 extends Component
{


    use WithPagination;

    public $confirmingItemBan__ = false;

    //FILTROS
    public $group_name;
    public $status;
    public $searchTerm;
    public $searchTerm_email;
    public $searchTerm_nickname;
    public $created_at__from;
    public $created_at__to;
    public $from;
    public $to;
    public $group3_istrue = 's';
    public $is_true;

    //modal edição
    public $is_create = FALSE;
    public $new_group;
    public $group_master;
    public $group_master_select;
    public $group_supervisor;
    public $group_supervisor_select;
    public $group_gerente;
    public $group_gerente_select;
    public $bonus3_percentual;

    //update

    public $group3_update;
    public $group_select_update;
    public $bonus3_percentual_update;
    public $bonus3_superiorhierarquico_user_id_update;
    public $bonus3_nivelhierarquico_aux_update;

    public $email_user;
    public $id_user;


    public $name;
    public $group_id;
    public $name_group;
    public $name_group_modal;
    public $group_name_select;

    public $affiliates = 0;
    public $cpa_pendding = 0;
    public $rev_pendding = 0;




    public function mount()
    {

        $this->affiliates = $this->countAffiliates();
        $this->cpa_pendding = $this->cpaPendding();
        $this->rev_pendding = $this->revPendding();
    }


    public function cpaPendding()
    {
        $cpa_pendding = Bonus::where('group_tipo','2')
        ->where('pagou','n')
        ->select('amount')
        ->sum('amount');
        $this->cpa_pendding = $cpa_pendding;
        return $cpa_pendding;
    }

    public function revPendding()
    {
        $rev_pendding = Bonus::where('group_tipo','3')
        ->where('pagou','n')
        ->select('amount')
        ->sum('amount');
        $this->rev_pendding = $rev_pendding;
        return $rev_pendding;
    }

    public function countAffiliates()
    {
        $affiliates = User::whereNotNull('bonus3_nivelhierarquico')
        ->select('id')
        ->count('id');

        $this->affiliates = $affiliates;
        return $affiliates;
    }


    public function cancel()
    {
        $this->resetErrorBag();


        $this->dispatchBrowserEvent('close-modal-from-cancel');

        $this->reset(
            'new_group',
            'group_master',
            'group_master_select',
            'group_supervisor',
            'group_supervisor_select',
            'group_gerente',
            'group_gerente_select',
            'bonus3_percentual'
        );
    }

    public function resetFilters() //reseta os campos
    {
        $this->reset('status', 'group3_istrue', 'created_at__to', 'created_at__from', 'searchTerm_email', 'searchTerm');



        //limpar filtros

    }

    public function storeUser($id) // pegar user pelo id
    {



        $users_aux = User::where([['id', '=', $id]])->first();
        $this->name = $users_aux->name;
        $this->id_user = $id;
        $this->group_id = $users_aux->group_id;
        $this->group3_update = $users_aux->bonus3_nivelhierarquico;
        $this->bonus3_percentual_update = (int)$users_aux->bonus3_percentual;
        $this->bonus3_superiorhierarquico_user_id_update = $users_aux->bonus3_superiorhierarquico_user_id;
        $this->bonus3_nivelhierarquico_aux_update = $users_aux->bonus3_nivelhierarquico;
        //dd($this->bonus3_superiorhierarquico_user_id_update);


    }


    public function validatebonus3_create_required_fields()
    {
        //validação do preenchimento dos campos

        if ($this->new_group == 'master') {

            $input = [
                'bonus3_percentual' => $this->bonus3_percentual,
                'new_group' => $this->new_group,
            ];

            Validator::make($input, [
                'bonus3_percentual' => ['required'],
                'new_group' => ['required'],
            ])->validate();
        } elseif ($this->new_group == 'supervisor') {

            $input = [
                'bonus3_percentual' => $this->bonus3_percentual,
                'new_group' => $this->new_group,
                'group_master_select' => $this->group_master_select,
            ];
            Validator::make($input, [
                'bonus3_percentual' => ['required'],
                'new_group' => ['required'],
                'group_master_select' => ['required'],
            ])->validate();
        } elseif ($this->new_group == 'gerente') {

            $input = [
                'bonus3_percentual' => $this->bonus3_percentual,
                'new_group' => $this->new_group,
                'group_supervisor_select' => $this->group_supervisor_select,
            ];
            Validator::make($input, [
                'bonus3_percentual' => ['required'],
                'new_group' => ['required'],
                'group_supervisor_select' => ['required'],
            ])->validate();
        } elseif ($this->new_group == 'subgerente') {

            $input = [
                'bonus3_percentual' => $this->bonus3_percentual,
                'new_group' => $this->new_group,
                'group_gerente_select' => $this->group_gerente_select,
            ];
            Validator::make($input, [
                'bonus3_percentual' => ['required'],
                'new_group' => ['required'],
                'group_gerente_select' => ['required'],
            ])->validate();
        } elseif (empty($this->new_group)) {
            $input = [
                'bonus3_percentual' => $this->bonus3_percentual,
                'new_group' => $this->new_group,
            ];
            Validator::make($input, [
                'bonus3_percentual' => ['required'],
                'new_group' => ['required'],
            ])->validate();
        }
    }


    public function validatebonus3_create_percentual_value()
    {

        $bonus3_percentual_aux = (int)$this->bonus3_percentual;

        if ($this->new_group == 'master') {

            if ($bonus3_percentual_aux >= 1 && $bonus3_percentual_aux <= 100) {

                return;
            } else {

                throw ValidationException::withMessages(['bonus3_percentual' => 'O percentual deve ser entre 1% e 100%.']);
            }
        } elseif ($this->new_group == 'supervisor') {

            if ($this->group_master_select) {
                $master_aux__ = User::where([['id', '=', $this->group_master_select]])->first();
                $master_aux__->bonus3_percentual = (int)$master_aux__->bonus3_percentual;

                if ($bonus3_percentual_aux < $master_aux__->bonus3_percentual) {
                    return;
                } else {
                    throw ValidationException::withMessages(['bonus3_percentual' => 'O percentual deve ser entre 1% e ' . $master_aux__->bonus3_percentual . '%.']);
                }
            }
        } elseif ($this->new_group == 'gerente') {

            if ($this->group_supervisor_select) {
                $master_aux__ = User::where([['id', '=', $this->group_supervisor_select]])->first();
                $master_aux__->bonus3_percentual = (int)$master_aux__->bonus3_percentual;

                if ($bonus3_percentual_aux < $master_aux__->bonus3_percentual) {
                    return;
                } else {
                    throw ValidationException::withMessages(['bonus3_percentual' => 'O percentual deve ser entre 1% e ' . $master_aux__->bonus3_percentual . '%.']);
                }
            }
        } elseif ($this->new_group == 'subgerente') {

            if ($this->group_gerente_select) {
                $master_aux__ = User::where([['id', '=', $this->group_gerente_select]])->first();
                $master_aux__->bonus3_percentual = (int)$master_aux__->bonus3_percentual;

                if ($bonus3_percentual_aux < $master_aux__->bonus3_percentual) {
                    return;
                } else {
                    throw ValidationException::withMessages(['bonus3_percentual' => 'O percentual deve ser entre 1% e ' . $master_aux__->bonus3_percentual . '%.']);
                }
            }
        }
    }


    public function editGroup()
    {

        //VALIDATES FEITOS MANUALMENTE (SEM VALIDATE DO LARAVEL)
        $this->validatebonus3_create_required_fields();

        $this->validatebonus3_create_percentual_value();






        if ($this->new_group == 'master') {

            User::where([['id', '=', $this->id_user]])->update([
                'bonus3_nivelhierarquico' => 'master',
                'bonus3_percentual' => $this->bonus3_percentual,

            ]);

            $this->cancel();
            session()->flash('message_group', 'Bônus 3 adicionado com sucesso!');
        } elseif ($this->new_group == 'supervisor') {

            User::where([['id', '=', $this->id_user]])->update([
                'bonus3_nivelhierarquico' => 'supervisor',
                'bonus3_superiorhierarquico_user_id' => $this->group_master_select,
                'bonus3_percentual' => $this->bonus3_percentual,

            ]);
            $this->cancel();
            session()->flash('message_group', 'Bônus 3 adicionado com sucesso!');
        } elseif ($this->new_group == 'gerente') {

            User::where([['id', '=', $this->id_user]])->update([
                'bonus3_nivelhierarquico' => 'gerente',
                'bonus3_superiorhierarquico_user_id' => $this->group_supervisor_select,
                'bonus3_percentual' => $this->bonus3_percentual,

            ]);
            $this->cancel();
            session()->flash('message_group', 'Bônus 3 adicionado com sucesso!');
        } elseif ($this->new_group == 'subgerente') {


            User::where([['id', '=', $this->id_user]])->update([
                'bonus3_nivelhierarquico' => 'subgerente',
                'bonus3_superiorhierarquico_user_id' => $this->group_gerente_select,
                'bonus3_percentual' => $this->bonus3_percentual,
            ]);

            $this->cancel();
            session()->flash('message_group', 'Bônus 3 adicionado com sucesso!');
        }
    }
    public function validatepercentualUpdate()
    {
        //criando um array com o nome para validar
        $input = [
            'bonus3_percentual_update' => $this->bonus3_percentual_update,
        ];

        //validando o nome
        Validator::make($input, [
            'bonus3_percentual_update' => ['required'],
        ])->validate();
    }


    public function cancelUpdate()
    {
        $this->resetErrorBag();


        $this->dispatchBrowserEvent('close-modal-from-cancel-update');
    }

    public function validatebonus3_update_percentual_value()
    {


        $bonus3_percentual_update_aux = (int)$this->bonus3_percentual_update;


        if ($this->bonus3_nivelhierarquico_aux_update == 'master') {

            if ($bonus3_percentual_update_aux >= 1 && $bonus3_percentual_update_aux <= 100) {

                return;
            } else {

                throw ValidationException::withMessages(['bonus3_percentual_update' => 'O percentual deve ser entre 1% e 100%.']);
            }
        } else if ($this->bonus3_nivelhierarquico_aux_update == 'supervisor' || $this->bonus3_nivelhierarquico_aux_update == 'gerente' || $this->bonus3_nivelhierarquico_aux_update == 'subgerente') {


            $superior_hierarquico = User::where('id', '=', $this->bonus3_superiorhierarquico_user_id_update)->first();


            if ($this->bonus3_percentual_update < $superior_hierarquico->bonus3_percentual) {
                return;
            } else {
                $bonus33_percentual_int = (int)$superior_hierarquico->bonus3_percentual;
                throw ValidationException::withMessages(['bonus3_percentual_update' => 'O percentual deve ser entre 1% e ' . $bonus33_percentual_int . '%.']);
            }
        }
    }

    public function updateGroup()
    {


        $this->validatepercentualUpdate();

        $this->validatebonus3_update_percentual_value();


        User::where([['id', '=', $this->id_user]])->update([
            'bonus3_percentual' => $this->bonus3_percentual_update
        ]);
        $this->cancelUpdate();

        session()->flash('message_update_percentual_group', 'Bônus 3 alterado com sucesso!');
    }

    public function disable()
    {
        User::where([['id', '=', $this->id_user]])->update([]);
    }

    public function changeGroup3()
    {
        if ($this->group3_istrue === '') {
            $this->status = '';
        }
    }

    public function render()
    {

        $columns = new Bonus3DataTable();
        $columns = $columns->DataTableColumn();

        return view('livewire.admin.bonus3.bonus3', [
            'columns' => $columns,
        ]);
    }

    //##################################################################################################################################################################################################################
    //##################################################################################################################################################################################################################
    public function dehydrate()
    { //é um momento(callbacks) executado sempre depois do render(), e ele dispara um evento $this->dispatchBrowserEvent('contentChanged', 'event'); que será escutado na view e servirá para resetar o JS (recarregando-o)

        $this->dispatchBrowserEvent('contentChanged', 'event');
    }
    //##################################################################################################################################################################################################################
    //##################################################################################################################################################################################################################





    public function cancelEditGroupUser() // função para fechar modal após validação
    {

        $this->resetErrorBag();


        $this->dispatchBrowserEvent('cancel-edit-group');
    }

    public function cancelEditPassword() // função para fechar modal após validação
    {

        $this->resetErrorBag();


        $this->dispatchBrowserEvent('cancel-edit-password');
    }
}

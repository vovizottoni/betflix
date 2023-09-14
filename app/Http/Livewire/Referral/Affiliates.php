<?php

namespace App\Http\Livewire\Referral;

use App\Models\Account;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Affiliates extends Component
{
    use WithPagination;

    public $amount = 15;
    public $accounts_user___;
    public $transaction___;
    public $var_id_primeira_account_user_logado;
    public $affiliate_id = null;
    public $affiliate_level = null;
    public $level_above = null;
    public $groups = [];
    public $percentage = '';
    public $cpa_format = '';
    public $showModal = false;
    public $uplinePercent;
    public $searchTerm;
    protected $paginationTheme = 'custom-tailwind';

    public function mount()
    {
        $authUser = Auth::user();
        //Obter a primeira account do usuário logado
        $this->var_id_primeira_account_user_logado = $authUser->getSessionFirstAccountId();
    }

    //função apenas para enviar o form com o wire:model.defer
    public function search()
    {
        return;
    }

    public function clearFields()
    {
        $this->reset('searchTerm');
    }

    public function render()
    {

        $authUser = Auth::user();
        $user = $authUser;
        $this->affiliate_level = $user->bonus3_nivelhierarquico;
        $this->level_above = $this->getAboveLevel($this->affiliate_level);
        $this->uplinePercent = $user->bonus3_percentual;
        $this->groups = Group::allWithCache();

        if ($this->searchTerm) {
            $this->setPage(1);
            $searchTerm = '%' . $this->searchTerm . '%';
            $invites = $user->invites()
                ->where(function ($query) use ($searchTerm) {
                    $query->where('users.name', 'like', $searchTerm)
                        ->orWhere('users.email', 'like', $searchTerm);
                })
                ->orderBy('users.id', 'desc')
                ->paginate(15);
        } else {
            $invites = $user->invites()->orderBy('users.id', 'desc')->paginate(15);
        }

        return view('livewire.referral.affiliates', ['invites' => $invites]);
    }

    public function setAffiliate($id)
    {
        $authUser = Auth::user();
        $this->affiliate_id = $id;
        $user = $authUser->invites()->where('id', $id)->first();
        $this->percentage = $user->bonus3_percentual;
        $this->cpa_format = $user->group_id;
    }


    public function registerAffiliate()
    {

        $authUser = Auth::user();

        $user = $authUser->invites()->where('id', $this->affiliate_id)->first();
        if ($user) {
            $user->bonus3_superiorhierarquico_user_id = $authUser->id;
            $user->bonus3_nivelhierarquico = $this->getAboveLevel($this->affiliate_level);
            if (is_numeric($this->percentage)) {
                $user->bonus3_percentual = $this->percentage;
            }
            if ($this->cpa_format != '') {
                $user->group_id = $this->cpa_format;
            }
            $user->save();
        }
    }

    private function getAboveLevel($level)
    {
        return getAboveLevel($level);
    }

    public function laodMore()
    {
        $this->amount += 15;
    }
}

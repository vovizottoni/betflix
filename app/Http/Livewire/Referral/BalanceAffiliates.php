<?php

namespace App\Http\Livewire\Referral;

use App\Models\Account;
use App\Models\TransactionsAffiliates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BalanceAffiliates extends Component
{
    public $balanceAffiliates;
    public $transactionsAffiliates;
    public $temContratoSocial;
    public $listaBancos;
    public $exibeFormulario;
    public $valor;
    public $banco;
    public $agencia;
    public $conta;
    public $tipo_conta;


    public function mount()
    {
        $this->balanceAffiliates = Auth::user()->balanceAffiliates;
        $this->transactionsAffiliates = TransactionsAffiliates::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $this->temContratoSocial = Auth::user()->contrato_social_url ? true : false;
        $this->exibeFormulario = false;
        $this->listaBancos = config('bancos.bancos');
    }

    public function exibirFormulario()
    {
        $this->exibeFormulario = true;
    }

    public function uploadContratoSocial()
    {
        $url = 'https://BrazaBet.ams3.digitaloceanspaces.com';
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['contrato_social_url' => $url]);

            return redirect()->route('player.balance-affiliates'); 
    }

    public function uploadNotaFiscal() {

        $url = 'https://BrazaBet.ams3.digitaloceanspaces.com';

        TransactionsAffiliates::create([
            'user_id' => Auth::user()->id,
            'tipos_transacoes_id' => 1,
            'account_id' => Account::where('user_id', Auth::user()->id)->first()->id,
            'valor' => $this->valor,
            'banco' => $this->banco,
            'agencia' => $this->agencia,
            'conta' => $this->conta,
            'url_nota' => $url,
            'status' => 'Pendente',
        ]);

        return view('livewire.referral.balance_affiliates');

    }

    public function render()
    {
        return view('livewire.referral.balance_affiliates');
    }
}

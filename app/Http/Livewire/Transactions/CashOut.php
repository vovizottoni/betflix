<?php

namespace App\Http\Livewire\Transactions;

use App\Exceptions\SoftException;
use App\Rules\ValidateCpfCnpjRule;
use App\Rules\ValidatePixKeyRule;
use App\Services\TransactionService;
use Livewire\Component;


//Libs utilizadas
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

//Emails enviados
use App\Mail\CashOutPixWaitingForWithdraw;
use App\Mail\CashoutInApproval;


//Models Utilizadas
use App\Models\Account;
use App\Models\Bet;
use App\Models\FungamessGameGains;
use App\Models\TokenAccount;
use App\Models\Transaction;
use App\Models\Bonus;
use App\Models\User;

//Rules Utilizadas
use App\Rules\MinAndMaxAmountToWithdrawPixRule;
use App\Rules\HaveBalanceToWithdrawRule;

//A account_id selecionada tem saldo para sacar ?
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class CashOut extends Component
{


    //Attributes for pixWithdraw
    public $value_;
    public $document; //user.cpf: é utilizado como pixkey


    public $account_id; //account escolhida para PIXSAQUE (vem da sessao)
    public $details_account_id;
    public $msgError = '';
    public $msgRetornoSaquePIX = '';


    //All accounts of logged user
    public $accounts;

    public $cashout_in_approval = false;

    public $max_amount_for_cashout;
    public $amount_available;
    public $avaliable_for_cashout = true;
    public $account_owner;
    public $account_owner_doc;
    public $account_owner_pix;
    public $total_bets;

    public $total_deposits;
    public $cashoutActive;

    public $haveWithdrawal;
    public $showDiv = true;

    public $pendingCPA;

    //validate
    protected function rules()
    {
        return [
            'value_' => ['required', 'string', new MinAndMaxAmountToWithdrawPixRule()], //Passar o valor value_ COMO PARAMETRO para HaveBalanceToWithdrawRule
            'account_owner' => ['required', 'string'],
            'account_owner_doc' => ['required', new ValidateCpfCnpjRule()],
            'account_owner_pix' => ['required', new ValidatePixKeyRule()],
        ];
    }


    //Executa apenas uma vez, e antes do render
    public function mount()
    {
        $user = Auth::user();
        $this->cashoutActive = cashoutIsActive();
        $this->account_id = getAccountIdSession();
        $this->details_account_id = $user->accounts()->where("id", $this->account_id)->firstOrFail();

        $this->accounts = $user->accounts()->orderBy('name', 'asc')->get();
        $this->document = $user->cpf;

        $this->account_owner = $this->details_account_id->name;
        $this->account_owner_doc = $this->document;
        $this->account_owner_pix = $this->document;


        $this->total_bets = $this->details_account_id->totalBet();

        $this->haveWithdrawal = Transaction::where([['type', '=', 'cashoutPIX'], ['status', '=', 'drawee']])
            ->where('accounts_id', session()->get('account_id'))->get()->count('id');

        $this->total_deposits = Transaction::where([['type', '=', 'cashinPIX'], ['status', '=', 'paid']])
            ->where('accounts_id', session()->get('account_id'))->get()->sum('amount');


        // REGRA DE LIMITE PARA SAQUE:
        //     SALDO TOTAL DO USUÁRIO:
        //     - VALORES DEPÓSITADOS PRECISAM SER MOVIMENTADOS 2X;
        //     - CPA RECEBIDO PRECISA TER AO MENOS 7 DIAS;

        $this->pendingCPA = Bonus::where([['group_tipo', '=', '2']])
            ->whereBetween('created_at', [Carbon::today()->subDays(7), Carbon::today()])
            ->where('accounts_id', session()->get('account_id'))->get()->sum('amount');


        $this->depositOnRollover = $this->total_deposits - ($this->total_bets * 0.5);

        if ($this->depositOnRollover < 0) {
            $this->depositOnRollover = 0;
        }

        $this->max_amount_for_cashout = $this->details_account_id->balance - $this->depositOnRollover;

        //setando o valor sisponível pra saque
        if ($this->max_amount_for_cashout > $this->details_account_id->balance) {
            $this->max_amount_for_cashout = $this->details_account_id->balance;
            $this->amount_available = $this->details_account_id->balance;
        } else {
            $this->amount_available = $this->max_amount_for_cashout;
        }

        if ($this->details_account_id->balance == 0 || $user->fungamess_user_blocked == 1) {
            $this->avaliable_for_cashout = false;
        }
    }

    private function getLastWithdraw()
    {
        return Transaction::where("accounts_id", $this->account_id)->jobCashout()->orderBy("id", "desc")->first();
    }

    public function getWithdrawStatus()
    {

        $cashout = $this->getLastWithdraw();
        if (isset($cashout['id'])) {
            $extraData = $cashout->getExtraDataAsArray();
            if ($extraData['job'] === false) {
                return "processing";
            } elseif ($extraData['job'] === true && !isset($extraData['compliance'])) {
                return "paid";
            } else {
                return "compliance";
            }
        }

    }

    public function render()
    {
        return view('livewire.transactions.cash-out');
    }


    //deposito em PIX, acionando a Gateway Pagstar PIX
    public function cashoutPIX()
    {
        $this->validate();
        $amount_double = $this->convertMoneystrToMoneyfloat($this->value_);
        if ($amount_double > $this->max_amount_for_cashout) {
            $this->msgError = __('cashout.msg_erro_falha_na_requisicao');
            return;
        }
        try {
            if (!$this->cashoutActive) {
                throw new \Exception(__('cashout.msg_erro_falha_na_requisicao'));
            }
            $transactionService = new TransactionService();
            $transactionService->processWithDrawal($this->details_account_id, $this->account_owner_doc, $amount_double, false, $this->account_owner_pix, $this->account_owner);
            $this->reset(['value_']);
            $this->msgError = '';
            $this->msgRetornoSaquePIX = __('cashout.msgRetornoSaquePIX');
        } catch (\Exception $e) {
            $this->msgError = formatExceptionMessage($e);
            return;
        }

    }


    private function resetInputFields()
    { //reseta os campos

        $this->reset();

    }

    private function convertMoneystrToMoneyfloat($value___)
    {

        //trata $value___  (string) R$ 14.500,05 => (float) 14500.05
        $value___ = str_replace(['R', '$', ' ', '.'], '', $value___);
        $value___ = str_replace(',', '.', $value___);
        $value___ = (float)$value___;

        return $value___;
    }

    private function removeSpecialCharsCPF($CPF___)
    {

        $CPF___ = str_replace(['.', '-'], '', $CPF___);

        return $CPF___;
    }

    public function closeWithdrawalRules()
    {
        $this->showDiv =! $this->showDiv;
    }


}
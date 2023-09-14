<?php

namespace App\Http\Livewire\Transactions;

use App\Actions\Transactions\CreateNewCashin;
use App\Enums\TransactionType;
use App\Exceptions\SoftException;
use App\Services\TransactionService;
use Livewire\Component;


//Libs utilizadas
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

//Emails enviados
use App\Mail\CashInPixWaitingForPayment;


//Models Utilizadas
use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Group;


//Rules Utilizadas
use App\Rules\MinAndMaxAmountToDepositPixRule;
use App\Rules\MinAndMaxAmountToDepositCreditCardRule;
use Symfony\Component\Config\Definition\Exception\Exception;


class CashIn extends Component
{

    //defina aba aberta
    public $abaAtiva = '';

    //Attributes for pix
    public $value_;
    public $name;
    public $document;
    public $account_id; //account escolhida para PIX (vem da sessao)
    public $details_account_id;
    public $msgError = '';
    public $transactionId = '';

    public $qrCodePIX = '';
    public $keyPIX = '';

    public $accounts; //All accounts of logged user


    //Atributes for credit card
    public $pagstar_payment_credit_card_page = '';

    //Atributes for coinGate
    public $coingate_amount, $transaction_id, $coingate_payment_url;
    public $request_completed_coingate = FALSE;
    public $coingate_error = FALSE;


    // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    // - Rollover etapa 1 -

    public $exibe_rollover_bonus1_opcao = 'n';
    public $rollover_bonus1_opcao = ''; //checkbox inicialmente unchecked
    public $cashinActive;

    // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||


    //validate
    protected function rules()
    {
        return [
            'value_' => ['required', 'string', new MinAndMaxAmountToDepositPixRule()],
            'name' => 'required|min:6|max:40',
            // 'document' => 'required|min:14|max:14',
            // 'account_id' => 'required|numeric',
        ];
    }


    //Executa apenas uma vez, e antes do render
    public function mount()
    {
        $user = Auth::user();
        $this->cashinActive = cashinIsActive();
        $this->account_id = getAccountIdSession();
        $this->details_account_id = $user->accounts()->whereId($this->account_id)->first();
        $this->accounts = $user->accounts()->orderBy('name', 'asc')->get();
        $this->document = $user->cpf;
        $this->name = $user->name;


        // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
        // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
        // - Rollover etapa 1 -
        // se for o primeiro depósito desse user e ele está em um grupo com bonus de primeiro depósito, disponibiliza o checkbox: users.rollover_bonus1_opcao

        if ($user->hasRollOverOption()) {
            $this->exibe_rollover_bonus1_opcao = 's';
        }

    }

    public function render()
    {

        if (empty($this->abaAtiva)) {

            $this->abaAtiva = 'pix';

        }


        return view('livewire.transactions.cash-in');
    }

    //##################################################################################################################################################################################################################
    //##################################################################################################################################################################################################################
    public function dehydrate()
    { //é um momento(callbacks) executado sempre depois do render(), e ele dispara um evento $this->dispatchBrowserEvent('contentChanged', 'event'); que será escutado na view e servirá para resetar o JS (recarregando-o)

        $this->dispatchBrowserEvent('contentChanged', 'event');

    }
    //##################################################################################################################################################################################################################
    //##################################################################################################################################################################################################################


    // ================== PIX =========================
    //deposito em PIX, acionando a Gateway Pagstar PIX
    public function cashinPIX()
    {
        $this->validate();
        //Faz requisicao a PagStar Gateway para gerar o PIX
        try {
            if (!$this->cashinActive) {
                throw new \Exception(__('cashin.pix_faild'));
            }
            $name = $this->name;
            $document = $this->document;
            $newCashIn = new CreateNewCashin();
            $value = $this->convertMoneystrToMoneyfloat($this->value_);
            $rollOverStatus = ($this->exibe_rollover_bonus1_opcao == 's' && ($this->rollover_bonus1_opcao == true || $this->rollover_bonus1_opcao == 'on'));

            $transaction = $newCashIn->action($this->details_account_id, TransactionType::CashinPIX,
                $value, $name, $document, $rollOverStatus);
            $this->transactionId = $transaction->id;
            $extraData = $transaction->getExtraDataAsArray();
            $this->qrCodePIX = $extraData['pix_qr_code_url'];
            $this->keyPIX = $extraData['pix_code'];
            //limpa campos do formulario
            $this->reset(['value_', 'name']);
            $this->msgError = '';
        } catch (SoftException $e) {
            $this->msgError = formatExceptionMessage($e);
            return;
        } catch (\Exception $e) {

            $this->msgError = formatExceptionMessage($e);
            return;
        }

        return;

    }

    private function processCashIn()
    {
        //Faz requisicao a PagStar Gateway para gerar o PIX
        try {
            $name = $this->name;
            $document = $this->document;

        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->msgError = $e->getMessage();
            return;
        }

    }





    //======================= COINGATE =====================================
    //deposito em crypto moedas, utilzando gateway da coinGate

    //realiza o update no bd em caso de error nas requisições
    public function updateCaseError($id)
    {
        Transaction::where([['id', '=', $id]])->update([
            'status' => 'coingate_error',
        ]);
    }

    public function validateCoingateAmount()
    {
        $input = [
            'coingate_amount' => $this->coingate_amount,
        ];

        Validator::make($input, [
            'coingate_amount' => ['required'],
        ])->validate();
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


    public function PutValueInQuantity($value____)
    { //pix

        $this->emit('focus-in-button-quantity');
        $this->value_ = $value____;

    }

    public function PutValueInQuantityCoingate($value____)
    { //creditcard

        $this->emit('focus-in-button-quantity-coingate');
        $this->coingate_amount = $value____;

    }


    public function selectTabPIX()
    {

        $this->abaAtiva = 'pix';
        $this->pagstar_payment_credit_card_page = '';
        return;
    }

    public function selectTabCoingate()
    {

        $this->abaAtiva = 'coingate';
        return;
    }

    public function generateStrRandom($size)
    {

        $length = $size;

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;

    }

    public function depositIsPaid()
    {
        $user = Auth::user();
        return $user->transactions()->where("transactions.id", $this->transactionId)->isDeposit()->isPaid()->exists();

    }

}

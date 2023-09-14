<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Traits\HasJsonExtraData;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasJsonExtraData;

    public $table = 'transactions';
    public $timestamps = true;


    protected $guarded = [];
    protected $fillable = [
        'id', 'accounts_id', 'type', 'status', 'amount', 'external_reference',
        'transaction_code', 'balance_used',
        'cashout_approval', 'deposit_bonus_status', 'is_first_deposit', 'extra_data'
    ];

    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'accounts_id');
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(TokenAccount::class, "accounts_id", "id");
    }

    private function depositTypes()
    {
        return ['cashinPIX', 'coinGateCashin', 'cashinCC'];
    }

    private function cashoutTypes()
    {
        return [TransactionType::CashoutPIX];
    }

    public function scopeIsDeposit($query)
    {
        return $query->whereIn("type", $this->depositTypes());
    }

    public function isDeposit()
    {
        $types = $this->depositTypes();
        if (in_array($this->type, $types)) {
            return true;
        }
        return false;
    }

    public function isCashOut()
    {
        $types = $this->cashoutTypes();
        if (in_array($this->type, $types)) {
            return true;
        }
        return false;
    }

    public function scopeIsCashOut($query)
    {
        return $query->whereIn("type", $this->cashoutTypes());
    }

    public function scopeIsPendingCashout($query)
    {
        return $query->whereIn("status", [TransactionStatus::Drawee, TransactionStatus::WaitingForWithdraw, TransactionStatus::WaitingForPayment]);
    }

    public function scopeIsPaidCashout($query)
    {
        return $query->where("status", TransactionStatus::Drawee);
    }
    public function scopeIsPendingOrPaidCashout($query)
    {
        return $query->whereIn("status", [TransactionStatus::Drawee, TransactionStatus::WaitingForWithdraw, TransactionStatus::WaitingForPayment]);
    }

    public function scopeIsToday($query)
    {
        return $query->whereDate($this->table . ".created_at", Carbon::today());
    }

    public function scopeIsPaid($query)
    {
        return $query->whereIn("status", ['paid', 'coingate_paid']);
    }

    public function scopeIsNotPaid($query)
    {
        return $query->whereNotIn("status", ['paid', 'coingate_paid']);
    }

    public function scopeIncompleDeposits($query)
    {
        return $query->isDeposit()->isNotPaid();
    }

    public function scopeCompletedDeposits($query)
    {
        return $query->isDeposit()->isPaid();
    }

    public function isBrlTransaction()
    {
        $brlBalanceTypes = ['balance', 'balanceBonus'];
        if (in_array($this->balance_used, $brlBalanceTypes)) {
            return true;
        }
        return false;
    }

    public function isUsdTransaction()
    {
        $brlBalanceTypes = ['balanceUSD', 'balanceUSDBonus'];
        if (in_array($this->balance_used, $brlBalanceTypes)) {
            return true;
        }
        return false;
    }

    public function isFirstDeposit(): bool
    {
        return $this->is_first_deposit;
    }

    public function isPix()
    {
        $pixTypes = ['cashinPIX', 'cashoutPIX'];
        if (in_array($this->type, $pixTypes)) {
            return true;
        }
        return false;
    }

    public function scopeIsPixPendingCashout($query)
    {
        $status = [TransactionStatus::WaitingForPayment, TransactionStatus::WaitingForWithdraw];
        return $query->isCashout()->whereIn("status", $status);
    }


    public function isPixPendingCashout()
    {
        $status = [TransactionStatus::WaitingForPayment, TransactionStatus::WaitingForWithdraw];
        if ($this->type == TransactionType::CashoutPIX && in_array($this->status, $status)) {
            return true;
        }
        return false;
    }

    public function canBeManualPaid()
    {
        if (!$this->isPixPendingCashout()) {
            return false;
        }

        return true;
    }

    public function canBeAutoPaid()
    {
        if (!$this->isPixPendingCashout()) {
            return false;
        }
        $extraData = $this->getExtraDataAsArray();
        $requiredKeys = ['auto_pay', 'document', 'amount'];
        foreach ($requiredKeys as $requiredKey) {
            if (!isset($extraData[$requiredKey])) {
                return false;
            }
        }
        if ($extraData['auto_pay'] === true) {
            return true;
        }
        return false;
    }

    public function cancell()
    {
        $account = $this->account()->firstOrFail();
        $this->status = TransactionStatus::Canceled;
        $this->saveOrFail();
        $col = $this->balance_used;
        $code = "rlbcK-" . $this->getCode();
        $account->addBalance($col, $this->amount, $code);
    }

    public function cashoutData()
    {
        $account = $this->account()->first();
        $user = $account->user()->first();
        $extraData = $this->getExtraDataAsArray();
        if (isset($extraData['document'])) {
            $pix = decrypt($extraData['pix_key']);
            $amount = decrypt($extraData['amount']);
            $document = decrypt($extraData['document']);
        } else {
            $pix = $user['cpf'];
            $document = $user['cpf'];
            $amount = $this->amount;
        }
        return ['pix_key' => $pix, 'document' => $document, 'amount' => $amount];

    }

    public function getEmailParams()
    {
        $account = $this->account()->first();
        $user = $account->user()->first();
        $cashoutData = $this->cashoutData();
        return ['name' => $user->name, 'email' => $user->email, 'account_id_name' => $account->name, 'value_' => $cashoutData['amount'],
            'pixkey' => $cashoutData['pix_key'], 'transaction_code' => $this->transaction_code];

    }

    public function scopeComplianceCashout($query)
    {
        return $query->isCashOut()->where("status", TransactionStatus::Canceled)
            ->where('extra_data->compliance', true)->where("extra_data->compliance_time_expires", ">=", time());
    }

    public function scopeJobCashout($query)
    {
        $statuses = [TransactionStatus::WaitingForPayment, TransactionStatus::WaitingForWithdraw, TransactionStatus::Canceled];
        return $query->isCashOut()->whereIn("status", $statuses)->whereIn('extra_data->job', [true, false]);
    }

    public function getCode()
    {
        return strtolower($this->type) . '-' . $this->id;
    }
}

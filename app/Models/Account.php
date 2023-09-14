<?php

namespace App\Models;

use App\Enums\FungamesEventType;
use App\Exceptions\NotEnoughMoneyException;
use App\Exceptions\SoftException;
use App\Traits\HasEloquentCacheTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;

    use SoftDeletes;
    use HasEloquentCacheTrait;

    protected $fillable = [
        'id', 'users_id', 'created_at', 'updated_at', 'deleted_at', 'name', 'description', 'photo', 'balance',
        'balanceBonus', 'balanceUSD', 'balanceUSDBonus', 'tokenu_hypetech'
    ];

    public $table = 'accounts';
    public $timestamps = true;
    private $lastBalanceModel;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function getLastBalanceModel(): ?BalanceLog
    {
        return $this->lastBalanceModel;
    }

    private function saveBalanceLog($code, $value, $new, $old, $balance)
    {
        if (is_null($code)) {
            $code = getUniqueCode();
        }
        $balanceModel = new BalanceLog();
        $balanceModel->accounts_id = $this->id;
        $balanceModel->value = $value;
        $balanceModel->old_balance = $old;
        $balanceModel->new_balance = $new;
        $balanceModel->code = $code;
        $balanceModel->balance_col = $balance;
        $balanceModel->saveOrFail();
        $this->lastBalanceModel = $balanceModel;
    }

    public function addBalance($balanceCol, $amount, $code = null)
    {
//force update
        $account = Account::whereId($this->id)->firstOrFail();

        $amount = (string)$amount;
        $old = $account->{$balanceCol};
        $account->{$balanceCol} = safeSum($account->{$balanceCol}, $amount);
        $account->saveOrFail();
        $new = $account->{$balanceCol};

        $this->saveBalanceLog($code, $amount, $new, $old, $balanceCol);

        return $account;
    }

    public function removeBalanceAndCheckfunds($balanceCol, $amount, $code = null)
    {
//force update
        $account = Account::whereId($this->id)->firstOrFail();
        $balance = (string)$account->{$balanceCol};
        $amountStr = (string)$amount;
        $comparacao = bccomp($balance, $amountStr, 2);
        if ($comparacao === 0 || $comparacao === 1) {
            return $this->removeBalance($balanceCol, $amount, $code);
        } else {
            throw new NotEnoughMoneyException($account->{$balanceCol});
        }
    }

    public function removeBalance($balanceCol, $amount, $code = null)
    {

        $account = Account::whereId($this->id)->firstOrFail();
        $amount = (string)$amount;
        $old = $account->{$balanceCol};
        $account->{$balanceCol} = safeSub($account->{$balanceCol}, $amount);
        $account->saveOrFail();
        $new = $account->{$balanceCol};

        $this->saveBalanceLog($code, safeMul($amount, -1), $new, $old, $balanceCol);

        return $account;
    }

    public function getTokenAccountByGame($gameCode)
    {
        return $this->tokenAccounts()->
        where("game_code", $gameCode)->whereNotNull("url")->orderBy("id", "desc")->first();
    }

//tokens_accounts
    public function tokenAccounts(): HasMany
    {
        return $this->hasMany(TokenAccount::class, 'accounts_id', 'id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'accounts_id', 'id');
    }

    public function bets(): HasMany
    {
        return $this->hasMany(Bet::class, 'accounts_id', 'id');
    }

    public function bonuses(): HasMany
    {
        return $this->hasMany(Bonus::class, 'accounts_id', 'id');
    }

    public function fungamessGameGains(): HasMany
    {
        return $this->hasMany(FungamessGameGains::class, 'accounts_id', 'id');
    }

    public function bonusWithBets()
    {

        return $this->hasOneThrough(
            Bonus::class,
            Bet::class,
            'accounts_id', // Foreign key on the cars table...
            'bets_id', // Foreign key on the owners table...
            'id', // Local key on the mechanics table...
            'id' // Local key on the cars table...
        );

    }

    public function bonus3HypetechPlayerLoses($payWeek = null)
    {
        return $this->bonusWithBets()->bonus3HypetechPlayerLoses($payWeek);
    }

    public function bonus3HypetechPlayerWins($payWeek = null)
    {
        return $this->bonusWithBets()->bonus3HypetechPlayerWins($payWeek);
    }

    public function bonus3FungamesPlayersLoses($payWeek = null)
    {

        return $this->bonuses()->bonus3FungamesPlayersLoses($payWeek)->where("accounts_id", $this->id);
    }

    public function bonus3FungamesPlayersWins($payWeek = null)
    {
        return $this->bonuses()->bonus3FungamesPlayersWins($payWeek);
    }

    public function unpaidBonus3()
    {
        return $this->bonuses()->bonus3Unpaid();
    }

    public function paidBonus3()
    {
        return $this->bonuses()->bonus3Paid();
    }

    public function unpaidBonus2()
    {
        return $this->bonuses()->bonus2Unpaid();
    }

    public function paidBonus2()
    {
        return $this->bonuses()->bonus2Paid();
    }

    public function qtyCompletedCashout()
    {
        return $this->transactions()->isCashOut()->isPaidCashout()->count();
    }

    public function hasCashout()
    {
        $qty = $this->qtyCompletedCashout();
        if ($qty > 0) {
            return true;
        }
        return false;
    }

    public function getTotalDeposits()
    {
        return $this->transactions()->completedDeposits()->sum("amount");

    }

    public function totalBet()
    {
        $fungames = (float)FungamessGameGains::where("users_id", $this->users_id)->where("event_type", FungamesEventType::BetPlacing)->sum("amount");
        $hype = (float)Bet::where("accounts_id", $this->id)->whereIn("result", ['red', 'green'])->sum("amount");
        return safeSum($fungames, $hype);
    }


    public function totalWin()
    {
        $fungames = (float)FungamessGameGains::where("users_id", $this->users_id)->where("event_type", FungamesEventType::Win)->sum("amount");
        return $fungames;
    }

    public function getTotalPendingCpa()
    {
        $where = ['group_tipo' => 2, 'accounts_id' => $this->id];
        return Bonus::where($where)
            ->whereBetween("created_at", [Carbon::today()->subDays(7), Carbon::now()])->sum('amount');
    }


}


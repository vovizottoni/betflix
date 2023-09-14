<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Bonus extends Model
{
    use HasFactory;

    public $table = 'bonus';
    public $timestamps = true;


    protected $guarded = [];

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'accounts_id',
        'group_id',
        'bets_id',
        'transactions_id',
        'amount',
        'group_tipo',
        'users_id_gerador_do_bonus',
        'bonus3_processado',
        'bonus3_semanapagamento',
        'bonus3_sinal',
        'bonus12_gateway_pagamento',
        'pagou'
    ];

    public function bet(): HasOne
    {
        return $this->hasOne(Bet::class, 'id', 'bets_id');
    }

    public function scopeIsBonus3($query)
    {
        return $query->where("group_tipo", 3);
    }

    public function scopeIsBonus2($query)
    {
        return $query->where("group_tipo", 2);
    }

    public function scopeBonus3HypetechPlayers($query, $payWeek = null)
    {
        $table = $this->table;
        $where = [];
        if (!is_null($payWeek)) {
            $where["$table.bonus3_semanapagamento"] = $payWeek;
        }
        return $query->isBonus3()->where($where);
    }

    public function scopeIsFungames($query)
    {
        return $query->whereNull('bets_id');
    }

    public function scopeIsGreen($query)
    {
        $table = $this->table;
        return $query->where("$table.bonus3_sinal", "+");
    }

    public function scopeIsRed($query)
    {
        $table = $this->table;
        return $query->where("$table.bonus3_sinal", "-");
    }

    public function scopeIsPaid($query)
    {
        $table = $this->table;
        return $query->where("$table.pagou", "s");
    }

    public function scopeUnpaid($query)
    {
        $table = $this->table;
        return $query->where("$table.pagou", "n");
    }

    public function scopeBonus3HypetechPlayerLoses($query, $payWeek = null)
    {

        return $query->bonus3HypetechPlayers($payWeek)->isGreen();
    }

    public function scopeBonus3HypetechPlayerWins($query, $payWeek = null)
    {

        return $query->bonus3HypetechPlayers($payWeek)->isRed();
    }


    public function scopeBonus3FungamesPlayer($query, $payWeek = null)
    {
        $table = $this->table;
        $where = [];
        if (!is_null($payWeek)) {
            $where["$table.bonus3_semanapagamento"] = $payWeek;
        }
        return $query->isBonus3()->where($where)->isFungames();
    }

    public function scopeBonus3FungamesPlayersLoses($query, $payWeek = null)
    {

        return $query->bonus3FungamesPlayer($payWeek)->isGreen();
    }

    public function scopeBonus3FungamesPlayersWins($query, $payWeek = null)
    {

        return $query->bonus3FungamesPlayer($payWeek)->isRed();
    }

    public function scopeBonus3Unpaid($query)
    {
        return $query->isBonus3()->unpaid();
    }

    public function scopeBonus3Paid($query)
    {
        return $query->isBonus3()->isPaid();
    }


    public function scopeBonus2Unpaid($query)
    {
        return $query->isBonus2()->unpaid();
    }

    public function scopeBonus2Paid($query)
    {
        return $query->isBonus2()->isPaid();
    }

    private static function GeneratedBonusForUserCached($bonusGroup, $toAccountId, $fromUserId)
    {
        $key = "gen_b" . $bonusGroup . "_from_" . $fromUserId . '_to_' . $toAccountId;
        $instance = ['accountId' => $toAccountId, 'userId' => $fromUserId, 'bonusGroup' => $bonusGroup];
        return getCacheOrCreate($key, $instance, function ($instance) {
            $where = ['accounts_id' => $instance['accountId'], 'group_tipo' => $instance['bonusGroup'], 'users_id_gerador_do_bonus' => $instance['userId']];
            return (float)Bonus::where($where)->sum('amount');
        }, config("constants.default_cache_time"));
    }

    public static function GeneratedBonus2ForUserCached($toAccountId, $fromUserId)
    {
        return self::GeneratedBonusForUserCached(2, $toAccountId, $fromUserId);
    }

    public static function GeneratedBonus3ForUserCached($toAccountId, $fromUserId)
    {
        return self::GeneratedBonusForUserCached(3, $toAccountId, $fromUserId);
    }

    public static function withUserJsonJoin()
    {
        $select = ["bonus.*",
            'users.name',
            'users.my_invite_code'
        ];
        return Bonus::select($select)->join('users', 'bonus.users_id_gerador_do_bonus', '=', 'users.id');
    }
}

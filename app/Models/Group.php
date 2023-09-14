<?php

namespace App\Models;

use App\Traits\HasEloquentCacheTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasEloquentCacheTrait;


    public $table = 'group';
    public $timestamps = true;

    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }

    public function getBonusBrlTarget()
    {
        if ($this->bonus1_destino == 'balanceNormal') {
            return 'balance';
        } else {
            return 'balanceBonus';
        }
    }

    public function getBonusUsdTarget()
    {
        if ($this->bonus1_destino == 'balanceNormal') {
            return 'balanceUSD';
        } else {
            return 'balanceUSDBonus';
        }
    }

    public function scopeBonus2Enabled($query)
    {
        $where = [
            'bonus2_status' => 'active',
            'bonus2_two_levels' => 'active'
        ];
        return $query->where($where)->where("bonus2_percentual_valor_integer", ">", 0)->where("bonus2_percentual_superior_integer", ">", 0);
    }

    //$transaction->balance_used == 'balanceUSD' || $transaction->balance_used == 'balanceUSDBonus'
}

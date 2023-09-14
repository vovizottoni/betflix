<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bet extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bets';
    public $timestamps = true;

    protected $fillable = [
        'id', 'games_id', 'accounts_id', 'created_at', 'updated_at', 'deleted_at', 'amount', 'odd', 'result',
        'balance_used', 'bet_code', 'tokenu_hypetech'
    ];
    protected $guarded = [];

    public function bonus(): BelongsTo
    {
        return $this->belongsTo(Bonus::class, 'bets_id', "id");
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accounts_id', 'id');
    }

    public function getTransactionCode()
    {
        $result = $this->result;
        $resultSymbol = "";
        if (isset($result[0])) {
            $resultSymbol = $result[0] . '-';
        }
        return $resultSymbol . $this->bet_code . '-' . getShortUniqueCode();

    }
}

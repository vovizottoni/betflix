<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class TokenAccount extends Model
{
    use HasFactory;

    public $table = 'tokens_accounts';
    public $timestamps = true;
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'accounts_id',
        'tokenu', 'game_code', 'balance_used', 'is_fungamess',
        'url', 'used'
    ];

    protected $guarded = [];

    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'accounts_id');
    }

//
    public function getGameData()
    {
        if ($this->is_fungamess == 1) {
            return FungamessGames::where("game_code", $this->game_code)->first();
        } else {
            return Game::where("game_code", $this->game_code)->first();

        }
    }


    public function isExpired()
    {
        $validity = (int)MetaData::getValue("token_validity_min", 5);

        $expiresAt = strtotime($this->created_at) + ($validity * 60);
        $now = strtotime(date("Y-m-d H:i:s"));
        if ($expiresAt < $now) {
            return true;
        }
        return false;
    }

    public function hasSuffix()
    {
        return Str::contains($this->tokenu, fungamesSufix());
    }


}

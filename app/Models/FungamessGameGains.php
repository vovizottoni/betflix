<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FungamessGameGains extends Model
{
    use HasFactory;

    public $table = 'fungamess_game_gains';
    public $timestamps = true;

    protected $guarded = [];
    protected $fillable = [
        'id', 'token', 'users_id', 'game_id', 'extra_data', 'event_id', 'direction', 'transaction_id', 'event_type',
        'time', 'amount', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function game()
    {
        return $this->belongsTo(FungamessGames::class, 'game_id ', 'id');
    }

    public function getTokenAccount()
    {
        return TokenAccount::where("tokenu", $this->token)->firstOrFail();
    }

    public function getTransactionCode()
    {
        $result = substr($this->event_type, 0, 4);

        return $result . '-' . $this->event_id . '-' . getShortUniqueCode();

    }
}

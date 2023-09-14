<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'accounts_id', 'code', 'value', 'old_balance', 'new_balance', 'balance_col', 'created_at', 'updated_at'
    ];
}

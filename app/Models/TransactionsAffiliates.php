<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsAffiliates extends Model
{
    use HasFactory;

    protected $table = 'transactions_affiliates';

    protected $fillable = [
        'user_id',
        'tipos_transacoes_id',
        'account_id',
        'bonus3_semanapagamento',
        'status',
        'valor',
        'url_nota_fiscal',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tiposTransacoes()
    {
        return $this->belongsTo(TiposTransacoes::class, 'tipos_transacoes_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}

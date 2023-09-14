<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandBonus3Processamento__ extends Model
{
    use HasFactory;

    public $table = 'command_bonus3_processamento';
    public $timestamps = true;


    protected $guarded = [];

    public static function getPeriodEndStart()
    {
        $last_command_bonus3 = self::orderBy('id', 'desc')->first();
        if (!isset($last_command_bonus3['id'])) {
            //primeira execucao
            $bonus3_semanapagamento = 1;
            $ciclo_inicio = '06/03/2023'; //Data de lancamento do sistema em Producao
            $ciclo_fim = date('d/m/Y'); //data corrente
        } else {
            $bonus3_semanapagamento = $last_command_bonus3->bonus3_semanapagamento + 1;
            //formata $last_command_bonus3->created_at
            if ($last_command_bonus3->created_at) {
                $created_at_ciclo = explode(' ', $last_command_bonus3->created_at);
                $ciclo_inicio = implode('/', array_reverse(explode('-', $created_at_ciclo[0])));

            }
            $ciclo_fim = date('d/m/Y'); //data corrente

        }
        return ['ciclo_inicio' => $ciclo_inicio, 'ciclo_fim' => $ciclo_fim, 'bonus3_semanapagamento' => $bonus3_semanapagamento];
    }

}

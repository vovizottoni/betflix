<?php

namespace App\Util;

//models utilizadas
use App\Models\Account;
use App\Models\Game;
use App\Models\User;

use \NumberFormatter;

setlocale(LC_ALL, 'pt_BR');


class Util
{
    public $account_id;

    public function __construct()
    {
    }

    public function getBalance_FromUsedBalance()
    {

        $balanceUsed = session()->get('balanceUsed');

        //capture balance of $balanceUsed
        $accountuid = getAccountIdSession();
        $account = Account::where('id', '=',  $accountuid)->first();

        if ($balanceUsed == 'balance') {

            return $account->balance;
        } else if ($balanceUsed == 'balanceBonus') {

            return $account->balanceBonus;
        } else if ($balanceUsed == 'balanceUSD') {

            return $account->balanceUSD;
        } else if ($balanceUsed == 'balanceUSDBonus') {

            return $account->balanceUSDBonus;
        } else {

            return $account->balance;
        }
    }

    public function formata_group_bonusstatus($valor)
    {
        if ($valor == 'active') {
            return 'ativo';
        } else if ($valor == 'inactive') {
            return 'inativo';
        } else {
            return 'invalido';
        }
    }


    public function formata_group_destino($valor)
    {
        if ($valor == 'balanceNormal') {
            return 'Saldo';
        } else if ($valor == 'balanceBonus') {
            return 'Saldo Bônus';
        } else {
            return 'Ambos';
        }
    }

    //formata o status da transaction
    public function formatStatus($status)
    {
        if ($status == 'paid') {
            return __("admin_transactions_pagstar.paid");
        }
        if ($status == 'waiting_for_payment') {
            return __("admin_transactions_pagstar.waiting_for_payment");
        }
        if ($status == 'canceled') {
            return __("admin_transactions_pagstar.canceled");
        }
        if ($status == 'drawee') {
            return __("admin_transactions_pagstar.drawee");
        }
        if ($status == 'waiting_for_withdraw') {
            return __("admin_transactions_pagstar.waiting_for_withdraw");
        }
        if ($status == 'coinGate_waiting_for_confimation') {
            return __("Aguardando confirmação");
        }
        if ($status == 'coingate_new') {
            return __("Nova");
        }
        if ($status == 'coingate_pending') {
            return __("Pendente");
        }
        if ($status == 'coingate_confirming') {
            return __("confirmando");
        }
        if ($status == 'coingate_paid') {
            return __("Pago");
        }
        if ($status == 'coingate_invalid') {
            return __("Inválido");
        }
        if ($status == 'coingate_expired') {
            return __("Expirado");
        }
        if ($status == 'coingate_canceled') {
            return __("Cancelado");
        }
        if ($status == 'coingate_error') {
            return __("Falha");
        }
    }

    //formata o cashout approval
    public function formatCashoutApproval($cashout_approval)
    {
        if ($cashout_approval == 'waiting_for_approval') {
            return __("Esperando Aprovação");
        } elseif ($cashout_approval == 'approved') {
            return __("Aprovada");
        } elseif ($cashout_approval == 'denied') {
            return __("Negada");
        } else {
            return "---";
        }
    }

    public function getNickname($account_id)
    {
        $user_id = Account::where([['id', '=', $account_id]])->select('users_id')->first()->users_id;

        $nickname = User::where([['id', '=', $user_id]])->select('my_invite_code')->first()->my_invite_code;

        return $nickname;
    }

    //formata o tipo
    public function formatType($type)
    {
        if ($type == 'cashinPIX') {
            return __("Depósito Pix Pagstar");
        }
        if ($type == 'cashinCC') {
            return __("Depósito Cartão de Crédito Pagstar");
        }
        if ($type == 'cashoutPIX') {
            return __("Saque Pix Pagstar");
        }
        if ($type == 'coinGateCashin') {
            return __("Depósito CoinGate");
        }
    }

    //formata o balance
    public function formatBalance($balance)
    {
        if ($balance == 'balance') {
            return __("admin_bets.balance");
        }
        if ($balance == 'balanceBonus') {
            return __("admin_bets.balance_bonus");
        }
        if ($balance == 'balanceUSD') {
            return __("admin_bets.balance_usd");
        }
        if ($balance == 'balanceUSDBonus') {
            return __("admin_bets.balance_usd_bonus");
        }
    }

    //trata o status para a view da rota player/account/transactions
    public function statusTrated($status)
    {
        if ($status == 'coinGate_waiting_for_confimation' || $status == 'coingate_new' || $status == 'coingate_pending' || $status == 'coingate_confirming' || $status == 'waiting_for_payment') {
            return __('history.status_opcao_waiting_for_payment');
        } elseif ($status == 'coingate_invalid' || $status == 'coingate_expired' || $status == 'coingate_canceled' || $status == 'coingate_error' || $status == 'canceled') {
            return __('history.status_opcao_canceled');
        } elseif ($status == 'coingate_paid' || $status == 'paid') {
            return __('history.status_opcao_paid');
        } elseif ($status == 'waiting_for_withdraw') {
            return __('history.status_opcao_waiting_for_withdraw');
        } elseif ($status == 'drawee') {
            return __('history.status_opcao_drawee');
        } else {
            return 'Error';
        }
    }

    //pega o usuario associado ao acconut_id
    public function getUser($account_id)
    {
        $account = Account::where([['id', '=', $account_id]])->first();
        $user = User::where([['id', '=', $account->users_id]])->first();
        return $user;
    }

    //pega o game associado ao games_id
    public function getGame($game_id)
    {
        $game = Game::where([['id', '=', $game_id]])->first();
        return $game;
    }

    //pega a account associada ao account_id
    public function getAccount($account_id)
    {
        $account = Account::where([['id', '=', $account_id]])->first();
        return $account;
    }

    //pega o game associado ao game_code
    public function getGameId($game_code)
    {
        $game = Game::where([['game_code', '=', $game_code]])->first();
        return $game;
    }

    //pega o my_invite_code do user relacionado a account
    public function getMyInviteCode($account_id)
    {
        $this->account_id = $account_id;

        $my_invite_code = User::where('id', function ($query) {
            $query->select('users_id')
                ->from(with(new Account)->getTable())
                ->where('id', $this->account_id);
        })->first()->my_invite_code;

        return $my_invite_code;
    }
    public static function getJsonRequest()
    {
    }


    public function getColumns($type, $fields)
    {
        switch ($type) {
            case 'js':
                return json_encode($fields);
                break;
            case 'table':
                return $this->getColumnsTable($fields);
                break;
            default:
                return json_encode([]);
                break;
        }
    }

    public function getColumnsTable($fields)
    {
        $html = '';
        foreach ($fields as $key => $value) {
            $html .= '<th>' . $value['data'] . '</th>';
        }

        return $html;
    }

    public static function currency($val): string
    {
        // $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
        // return $formatter->formatCurrency($val, 'BRL');
        return  'R$' . number_format($val, 2, ",", ".");
    }

    /**
     * Percentage format
     *
     * @return string
     */
    public static function formatPercentage($value)
    {
        return isset($value) ? number_format($value, 2, ",", ".") . "%" : null;
    }
}

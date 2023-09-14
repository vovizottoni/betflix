<?php

namespace App\Bonus;

use App\Models\Bonus;
use App\Models\Group;
use App\Models\Transaction;
use App\Models\User;

abstract class BonusBaseAbtract
{

    public function register(Transaction $transaction, Group $group, User $user, $amount, $userIdBonusGen, $groupType = 1, $gateway)
    {
        $account = $user->accounts()->first();
        $bonus = new Bonus();
        $bonus->accounts_id = $account->id;
        $bonus->group_id = $group->id;
        $bonus->transactions_id = $transaction->id;
        $bonus->amount = $amount;
        $bonus->group_tipo = $groupType;
        $bonus->users_id_gerador_do_bonus = $userIdBonusGen;
        $bonus->bonus12_gateway_pagamento = $gateway;
        if ($groupType == 2) {
            $bonus->pagou = 's';
        }
        $bonus->saveOrFail();

    }

    //BonusRuleAbstract::create(['accounts_id' => $primeira_account->id, 'group_id' => $afiliado->group_id,
    // 'transactions_id' => $transaction->id, 'amount' => $bonusFINAL, 'group_tipo' => '2',
    // 'users_id_gerador_do_bonus' => $account->users_id, 'bonus12_gateway_pagamento' => 'coingate']);
    //BonusRuleAbstract::create(['accounts_id' => $primeira_account_SUPERIOR->id, 'group_id' => $afiliado->group_id,
    // 'transactions_id' => $transaction->id, 'amount' => $bonusFINAL_SUPERIOR, 'group_tipo' => '2',
    // 'users_id_gerador_do_bonus' => $account->users_id, 'bonus12_gateway_pagamento' => 'coingate']);

}

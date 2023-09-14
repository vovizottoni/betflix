<?php

namespace App\Bonus;

use App\Bonus\Rules\Bonus1Rules;
use App\Models\Account;
use App\Models\Bonus;
use App\Models\Group;
use App\Models\Transaction;
use App\Models\User;

class Bonus1 extends BonusBaseAbtract
{
    private Transaction $transaction;
    private Account $account;
    private User $accountOwner;
    private Group $accountOwnergroup;
    private Bonus $bonusRule;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->account = $transaction->account()->first();
        $this->accountOwner = $this->account->user()->first();
        $this->accountOwnergroup = $this->accountOwner->group()->first();
        $this->bonusRule = new Bonus1Rules($this->transaction, $this->accountOwnergroup);
    }

    private function pay()
    {
        $transaction = $this->transaction;
        $account = $this->account;
        $accountOwner = $this->accountOwner;
        $userGroup = $this->accountOwnergroup;
        //detecta grupo do user
        if (isset($userGroup['id'])) {
            $accountATUALIZADA = $account;
            $userB = $accountOwner;
            $group = $userGroup;
            if ($this->bonusRule->isActive()) {
                //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus1)
                //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus1)
                if ($this->bonusRule->hasMinTransactionAmount()) {
                    $bonusFINAL = $this->bonusRule->getTotalBonus();
                    //3) verifica Moeda e qual balance receberá o bonus
                    //3) verifica Moeda e qual balance receberá o bonus

                    $destinoB = $this->bonusRule->getBonusTargetByGroup($group);
                    //4) adiciona bonus no balance (BD)
                    //4) adiciona bonus no balance (BD)
                    $accountATUALIZADA = $accountATUALIZADA->addBalance($destinoB, $bonusFINAL);

                    // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                    // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

                    //************  */
                    // Passo 2 rollover
                    //obtem o infos do user e ve se eh rollover
                    if ($userB->rollover_bonus1_opcao == 's' && is_numeric($userB->rollover_bonus1_multiplicador)) {

                        // se for rollover ativo
                        // 1)retira  o deposito do balance, e manda p/ o balanceBonus
                        // 1)retira  o deposito do balance, e manda p/ o balanceBonus

                        //verifica qual o balance_used da $transaction->id
                        $balanceUsedName = $transaction->balance_used;
                        $amount = $transaction->amount;
                        $accountATUALIZADA = $accountATUALIZADA->removeBalance($balanceUsedName, $amount);

                        // 2) coloca $amount no balanceBonus
                        // 2) coloca $amount no balanceBonus
                        $accountATUALIZADA = $accountATUALIZADA->addBalance("balanceBonus", $amount);

                        //calcula o valor: user.rollover_bonus1_valorObjetivo:  ROLLOVER_MULTIPLICADOR * bonus de primeiro deposito
                        bcscale(2);
                        $rollover_bonus1_valorObjetivo = bcmul(env('ROLLOVER_MULTIPLICADOR'), $bonusFINAL);
                        $userB->rollover_bonus1_valorObjetivo = $rollover_bonus1_valorObjetivo;
                        $userB->saveOrFail();
                    }
                    // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                    // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

                    //5) grava esse bonus no BD (para histórico)
                    //5) grava esse bonus no BD (para histórico)
                    //public function register(Transaction $transaction, User $user, $amount, $userIdBonusGen, $groupType = 1, $gateway)
                    $this->register($transaction, $userB, $bonusFINAL, $account->users_id, 1, 'pagstar');

                }
            }

        }

    }
}

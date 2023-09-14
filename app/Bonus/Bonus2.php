<?php

namespace App\Bonus;

use App\Bonus\Rules\Bonus2Rules;
use App\Models\Account;
use App\Models\Group;
use App\Models\Transaction;
use App\Models\User;

class Bonus2 extends BonusBaseAbtract
{
    private $transaction;
    private $account;
    private $accountOwner;
    private $accountOwnergroup;
    private $bonusRule;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $account = $transaction->account()->first();
        $this->account = $account;
        $accountOwner = $account->user()->first();
        $this->accountOwner = $accountOwner;
        $accountOwnergroup = $accountOwner->group()->first();
        $this->accountOwnergroup = $accountOwnergroup;

        $this->bonusRule = new Bonus2Rules($transaction, $accountOwnergroup);
    }

    private function payLevel(User $user, Group $group, $isBonusSuperior = false, $goupCode = null)
    {
        registerLogMessage("User: " . $user->id . ' Group: ' . $group->id . " isBonus: " . $isBonusSuperior);
        $this->bonusRule = new Bonus2Rules($this->transaction, $group);
        //echo "Start pay user " . $user->id . " Group " . $group->id . "<br>";
        $this->bonusRule->isBonusSuperior = $isBonusSuperior;
        if ($this->bonusRule->isActive()) {
            //echo "Is active <br>";

            ///////////////////////////////////////////////////////////////////////////////////////
            //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
            $primeira_account = $user->accounts()->first();
            ///////////////////////////////////////////////////////////////////////////////////////
            //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus2)
            //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus2)
            if ($this->bonusRule->hasMinTransactionAmount() || $isBonusSuperior) {

                if ($this->bonusRule->hasMinTransactionAmount()) {
                    $bonusFINAL = $this->bonusRule->getTotalBonus();
                    //echo "Bonus: $bonusFINAL <br>";

                    if ($bonusFINAL > 0) {
                        //3) verifica Moeda e qual balance receberá o bonus
                        //3) verifica Moeda e qual balance receberá o bonus
                        //verifica qual MOEDA do balance_used da $transaction->id
                        $destinoB = $this->bonusRule->getBonusTargetByGroup($group);
                        //4) adiciona bonus no balance (BD)
                        //4) adiciona bonus no balance (BD)
                        //Update, ADD BONUS PARA AFILIADO
                        $primeira_account->addBalance($destinoB, $bonusFINAL, $goupCode);
                        $userBonusGen = $this->accountOwner;
                        $this->register($this->transaction, $group, $user, $bonusFINAL, $userBonusGen->id, 2, 'pagstar');
                    }

                }


            }

        } else {
            //echo "Is not active <br>";
        }

    }


    function pay()
    {
        $accountOwner = $this->accountOwner;
        //echo $accountOwner->id . " | " . $accountOwner->name . ' | ' . $accountOwner->user_id . " | " . $accountOwner->group_id . "<br>";

        $userParent = $accountOwner->parent()->first();
        //echo $userParent->id . " | " . $userParent->name . ' | ' . $userParent->user_id . " | " . $userParent->group_id . "<br>";

        //verifica se o USER dessa transaction foi indicado por algum AFILIADO (user_id)
        if (isset($userParent['id'])) {
            $userParentGroup = $userParent->group()->first();
            $groupCode = "bonus2-" . getUniqueCode();
            //consulta esse AFILIADO
            $afiliado = $userParent;
            //se esse afiliado pertence algum grupo de Bonus
            if (isset($userParentGroup['id'])) {

                //consulta esse Grupo
                $this->payLevel($userParent, $userParentGroup, false, $groupCode);
                $userSuperior = $userParent->parent()->first();
                if (isset($userSuperior['id']) && $userParentGroup->bonus2_two_levels == 'active') {
                    // echo $userSuperior->id . " | " . $userSuperior->name . ' | ' . $userSuperior->user_id . " | " . $userSuperior->group_id . "<br>";
                    $this->payLevel($userSuperior, $userParentGroup, true, $groupCode);
                }

            }


        }


    }
}

<?php

namespace App\Bonus\Rules;

use App\Models\Group;
use App\Models\Transaction;

abstract class BonusRuleAbstract
{
    private $bonusN;
    private $transaction;
    private $group;

    public function __construct(Transaction $transaction, Group $group, int $bonusN)
    {
        $this->transaction = $transaction;
        $this->group = $group;
        $this->bonusN = $bonusN;
    }

//
    public function isActive(): bool
    {
        $col = "bonus" . $this->bonusN . "_status";
        if ($this->group->{$col} == 'active') {
            return true;
        }
        return false;
    }

    public function minTransactionAmount()
    {
        $col = "bonus" . $this->bonusN . "_piso_integer";
        return $this->group->{$col};
    }

    public function hasMinTransactionAmount()
    {
        //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus1)
        //0)checka piso (se o valor for menor que o piso, nao ocorre este bonus1)
        if ($this->transaction->amount >= $this->minTransactionAmount()) {
            return true;
        }
        return false;

    }

    public function getBonusTargetByGroup(Group $group)
    {
        $transaction = $this->transaction;
        //verifica qual MOEDA do balance_used da $transaction->id
        //verifica qual MOEDA do balance_used da $transaction->id
        if ($transaction->isBrlTransaction()) {  //BRL--
            //verifica se bonus vai p/  balanceNormal ou BalanceBonus
            return $group->getBonusBrlTarget();
        } else if ($transaction->isUsdTransaction()) { //USD--
            //verifica se bonus vai p/  balanceNormal ou BalanceBonus
            return $group->getBonusUsdTarget();
        } else {
            throw new \Exception("Coin not found.");
        }

    }

    public function getLiquidTransactionAmount()
    {
        //1)checka teto
        //1)checka teto
        $col = "bonus" . $this->bonusN . "_teto_integer";
        $maxTransactionAmount = $this->group->{$col};
        $amount = $this->transaction->amount;
        if ($amount > $maxTransactionAmount) {
            return $maxTransactionAmount;
        } else {
            return $amount;
        }
    }

    public function getTotalBonus()
    {
        //2) calcula bonus: $group->bonus1_percentual_valor_integer % de  $valueB:  $percentB = ((float)$group->bonus1_percentual_valor_integer)/100.0;
        //2) calcula bonus: $group->bonus1_percentual_valor_integer % de  $valueB:  $percentB = ((float)$group->bonus1_percentual_valor_integer)/100.0;


        $amount = $this->getLiquidTransactionAmount();

        bcscale(2);
        $col = "bonus" . $this->bonusN . "_percentual_valor_integer";
        $percentB = bcdiv($this->group->{$col}, 100);
        return bcmul($percentB, $amount);
    }
}

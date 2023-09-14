<?php

namespace App\Bonus\Rules;

use App\Models\Group;
use App\Models\Transaction;

class Bonus1Rules extends BonusRuleAbstract
{

    private Transaction $transaction;
    private Group $group;
    private int $bonusN = 1;

    public function __construct(Transaction $transaction, Group $group)
    {
        $this->transaction = $transaction;
        $this->group = $group;
    }


}

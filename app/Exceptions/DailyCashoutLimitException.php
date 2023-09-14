<?php

namespace App\Exceptions;

use Exception;

class DailyCashoutLimitException extends Exception
{
    public function __construct()
    {
        $dailyLimit = (int)getMetaValue('number_of_withdraws_per_day');
        $msg = __("cashout.msg_daily_limit_cashout", ['qty' => $dailyLimit]);
        parent::__construct($msg);
    }
}

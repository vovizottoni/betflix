<?php

namespace App\Exceptions;

use Exception;

class MinMaxCashoutException extends Exception
{
    public function __construct()
    {
        $minWtd = env("MIN_AMOUNT_WITHDRAW_PIX_BRL");
        $maxWtd = env("MAX_AMOUNT_WITHDRAW_PIX_BRL");
        $msg = __("cashout.msg_limit_cashout", ['min' => $minWtd, 'max' => $maxWtd]);
        parent::__construct($msg);
    }
}

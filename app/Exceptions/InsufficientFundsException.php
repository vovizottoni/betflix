<?php

namespace App\Exceptions;

use Exception;

class InsufficientFundsException extends Exception
{
    public function __construct()
    {
        $msg = __("cashout.mgs_inssuficient_funds");
        parent::__construct($msg);
    }
}

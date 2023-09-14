<?php

namespace App\Exceptions;

use Exception;

class NotEnoughMoneyException extends Exception
{
    private $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
        parent::__construct("Insufficient funds.");
    }

    public function getBalance()
    {
        return $this->balance;
    }
}

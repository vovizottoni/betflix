<?php

namespace App\Exceptions;

use Exception;

class DuplicatedTransactionException extends Exception
{
    private $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
        parent::__construct("Duplicated transaction");
    }

    public function getBalance()
    {
        return $this->balance;
    }
}

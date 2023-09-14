<?php

namespace App\Exceptions;

use Exception;

class CantUploadDocException extends Exception
{
    public function __construct()
    {

        parent::__construct("Unable to send documents.");
    }
}

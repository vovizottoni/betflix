<?php

namespace App\Exceptions;

use Exception;

class HypetechException extends Exception
{
    private $httpCode;
    private $errorCode;
    private $storedResult;

    public function __construct($msg, $httpCode, $errorCode, $storedResult)
    {
        $this->httpCode = $httpCode;
        $this->errorCode = $errorCode;
        $this->storedResult = $storedResult;
        parent::__construct($msg);
    }


    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getStoredResult()
    {
        return $this->storedResult;
    }

    public function getResponseArr()
    {
        $arr = [
            'msg' => $this->getMessage(),
            'code' => $this->getErrorCode(),
        ];
        if (!is_null($this->getStoredResult())) {
            $arr['stored_result'] = $this->getStoredResult();
        }
        return $arr;
    }

}

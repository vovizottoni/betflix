<?php

namespace App\Traits;
trait HasJsonExtraData
{
    public function getExtraDataAsArray()
    {
        $arr = json_decode($this->extra_data, true);
        if (!is_null($this->transaction_code)) {
            $arr['transaction_code'] = $this->transaction_code;
        }
        return $arr;
    }

    public function updateExtraData($arr)
    {
        $currentValues = $this->getExtraDataAsArray();
        foreach ($arr as $k => $v) {
            $currentValues[$k] = $v;
        }

        $this->extra_data = json_encode($currentValues);
        $this->saveOrFail();
    }
}

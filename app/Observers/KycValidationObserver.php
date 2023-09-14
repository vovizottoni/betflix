<?php

namespace App\Observers;

use App\Models\KycValidation;

class KycValidationObserver
{
    /**
     * Handle the KycValidation "created" event.
     *
     * @param \App\Models\KycValidation $kycValidation
     * @return void
     */
    public function created(KycValidation $kycValidation)
    {
        $kycValidation->updateUserKycStatus();
    }

    /**
     * Handle the KycValidation "updated" event.
     *
     * @param \App\Models\KycValidation $kycValidation
     * @return void
     */
    public function updated(KycValidation $kycValidation)
    {
        $kycValidation->updateUserKycStatus();
    }

}

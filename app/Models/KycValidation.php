<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KycValidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'kyc_first_name', 'kyc_last_name',
        'kyc_phone_number', 'kyc_date_birth', 'kyc_address_1', 'kyc_address_2', 'kyc_city', 'kyc_state', 'kyc_nationality',
        'kyc_zip', 'kyc_status', 'kyc_nif', 'kyc_passport_path', 'kyc_identification_path_one', 'kyc_identification_path_two',
        'kyc_drive_path', 'kyc_selfie_doc_path', 'kyc_reason', 'kyc_date_submitted', 'kyc_date_analysed'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function updateUserKycStatus()
    {
        $user = $this->user()->first();
        $user->kyc_status = $this->kyc_status;
        $user->saveOrFail();

    }

}

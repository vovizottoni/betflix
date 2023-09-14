<?php

namespace App\Http\Livewire\Admin\Kyc;

use App\Models\KycValidation;
use Livewire\Component;

//libs
use Illuminate\Support\Facades\Mail;

//Emails enviados
use App\Mail\KycFailedVerification;
use App\Mail\KycVerified;

//models
use App\Models\User;

class KycDetails extends Component
{
    public $user_id;
    public $user;
    public $fotos;
    public $new_status;
    public $reason;
    public $reason_decline;

    protected $rules = [
        'reason' => 'required'
    ];

    //seta o motivo dfa não aprovaço do kyc
    public function setReason($reason_id)
    {
        if ($reason_id == 1) {
            $this->reason = __("admin_kyc.the_name_does_not_match");
        }
        if ($reason_id == 2) {
            $this->reason = __("admin_kyc.expired_document");
        }
        if ($reason_id == 3) {
            $this->reason = __("admin_kyc.uploaded_images_are_not_clear");
        }
        if ($reason_id == 4) {
            $this->reason = __("admin_kyc.mentioned_document_incorrect");
        }
        if ($reason_id == 5) {
            $this->reason = __("admin_kyc.documents_not_valid");
        }
        if ($reason_id == 6) {
            $this->reason = __("admin_kyc.same_document_image");
        }
        if ($reason_id == 7) {
            $this->reason = __("admin_kyc.document_underage_person");
        }
        if ($reason_id == 8) {
            $this->reason = __("admin_kyc.selfie_is_invalid");
        }

    }

    public function store_kyc_verification($id)
    {
        //pegando o user relacionado ao id recebido
        $user = User::where([['id', '=', $id]])->first();
        $kycValidation = $user->kycValidation()->firstOrFail();
        //setando os paramentros para o email
        $parametros__ = [
            'name' => $user->name,
            'kyc_date_analysed' => $kycValidation->kyc_date_analysed,
            'kyc_reason' => $this->reason,
        ];
        if ($this->new_status == 'verified') {
            $kycValidation->kyc_status = 'verified';
            $kycValidation->kyc_date_analysed = now();
            $kycValidation->saveOrFail();
            //enviar email
            Mail::to($user->email)->send(new KycVerified(env('MAIL_FROM_ADDRESS_NO_REPLY'), __('mail.subject_kyc_verified'), $parametros__));
        } else if ($this->new_status == 'failed_verification') {
            $this->validate();

            $kycValidation->kyc_date_analysed = now();
            $kycValidation->kyc_status ='failed_verification';
            $kycValidation->saveOrFail();

            //enviar email
            Mail::to($user->email)->send(new KycFailedVerification(env('MAIL_FROM_ADDRESS_NO_REPLY'), __('mail.subject_kyc_failed_verification'), $parametros__));
        }

    }

    public function setId($id)
    {
        $this->user_id = $id;
    }

    public function render()
    {
        $this->userKyc = KycValidation::with('User')->where("user_id",$this->user_id)->first();
        return view('livewire.admin.kyc.kyc-details');
    }
}

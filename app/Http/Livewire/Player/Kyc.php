<?php

namespace App\Http\Livewire\Player;

use App\Exceptions\CantUploadDocException;
use App\Http\Requests\KycStoreRequest;
use App\Models\KycValidation;
use Livewire\Component;

//Libs
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;

//Emails enviados
use App\Mail\KycSubmitted;

//Models
use App\Models\User;

class Kyc extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $phone_number;
    public $date_birth;
    public $address_1;
    public $address_2;
    public $city;
    public $state;
    public $nationality;
    public $zip;
    public $nif;
    public $passport_path;
    public $identification_path_one;
    public $identification_path_two;
    public $drive_path;
    public $selfie_doc_path;
    public $status;
    public $user;

    public $tabFileUploadAtiva = 1;


    private function resetInputFields()//reseta os campos
    {
        $this->reset();
    }

    public function store()//processamento
    {
        $rules = (new KycStoreRequest($this->tabFileUploadAtiva))->rules();
        $this->validate($rules);
        $user = Auth::user();
        if (!$user->canUploadKycDocs()) {
            throw new CantUploadDocException();
        }
        $userKyc = $user->kycValidation()->first();
        if (!isset($userKyc['id'])) {
            $userKyc = new KycValidation();
            $userKyc->user_id = $user->id;
        }

        if ($this->tabFileUploadAtiva == 1) {
            $fileNames = ['passport_path'];
        } elseif ($this->tabFileUploadAtiva == 2) {
            $fileNames = ['identification_path_one', 'identification_path_two'];
        } else {
            $fileNames = ['drive_path'];
        }

        $defaultValues = ['kyc_passport_path', 'kyc_identification_path_one',
            'kyc_identification_path_two', 'kyc_drive_path', 'kyc_selfie_doc_path'];
        foreach ($defaultValues as $df) {
            $userKyc->{$df} = null;
        }
        $fileNames = $fileNames;
        foreach ($fileNames as $file) {
            $docKey = "kyc_" . $file;
            $userKyc->{$docKey} = $this->{$file}->store('kyc');
        }
        $userKyc->kyc_selfie_doc_path = $this->selfie_doc_path->store('kyc');
        $userKyc->kyc_first_name = $this->first_name;
        $userKyc->kyc_last_name = $this->last_name;
        $userKyc->kyc_phone_number = $this->phone_number;
        $userKyc->kyc_date_birth = $this->date_birth;
        $userKyc->kyc_address_1 = $this->address_1;
        $userKyc->kyc_address_2 = $this->address_2;
        $userKyc->kyc_city = $this->city;
        $userKyc->kyc_state = $this->state;
        $userKyc->kyc_nationality = $this->nationality;
        $userKyc->kyc_zip = $this->zip;
        $userKyc->kyc_nif = $this->nif;
        $userKyc->kyc_date_submitted = date("Y-m-d H:i:s");
        $userKyc->kyc_status = 'under_verification';
        $userKyc->save();

        $this->resetInputFields();

        //enviar email
        $parametros__ = [
            'name' => $user->name,
            'kyc_date_submitted' => $userKyc->kyc_date_submitted,
        ];
        Mail::to($user->email)->send(new KycSubmitted(env('MAIL_FROM_ADDRESS_NO_REPLY'), __('mail.subject_kyc_submitted'), $parametros__));
    }

    public function changeTabFileUploadAtiva($value___)//seta qual tab q ficará aberta
    {
        $this->tabFileUploadAtiva = $value___;
    }

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $user = User::find(Auth::user()->id);
        $this->status = $user->kyc_status;

        return view('livewire.player.kyc');
    }
}

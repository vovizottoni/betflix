<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KycStoreRequest extends FormRequest
{
    private $docTab;

    public function __construct($docTab)
    {
        $this->docTab = $docTab;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:2|max:100',
            'phone_number' => 'required|string',
            'date_birth' => 'required|string|max:10',
            'address_1' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'nationality' => 'required|string',
            'zip' => 'required|string',
            'nif' => 'required|string',
        ];
        if ($this->docTab == 1) {
            $docRules = ['passport_path' => 'required|image|max:3072'];
        } elseif ($this->docTab == 2) {
            $docRules = ['identification_path_one' => 'required|image|max:3072',
                'identification_path_two' => 'required|image|max:3072'];
        } else {
            $docRules = ['drive_path' => 'required|image|max:3072'];
        }
        $docRules = $docRules + ['selfie_doc_path' => 'required|image|max:3072'];
        return $rules + $docRules;
    }
}

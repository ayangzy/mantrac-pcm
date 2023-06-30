<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadOrganisationSetupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'structure_id' => 'required|exists:organisation_structure,structure_id',
            'file' => 'required|mimes:xls,xlsx,csv'
        ];
    }

    public function messages()
    {
        return [
            'file.mimes' => "The selected file must be in csv or excel format"
        ];
    }
}

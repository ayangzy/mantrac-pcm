<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadStaffJobDescriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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

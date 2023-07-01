<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadUserRequest extends FormRequest
{

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

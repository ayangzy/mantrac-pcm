<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrganisationRequest extends FormRequest
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
            'organisation_name' => 'required|string|min:3|max:255|unique:organisations,organisation_name',
            'mission_statement' => 'required|string',
            'vision_statement' => 'required|string',
            'organisation_color' => 'required|string|min:2|max:10',
            'organisation_address' => 'required|string|min:3|max:255',
        ];
    }
}

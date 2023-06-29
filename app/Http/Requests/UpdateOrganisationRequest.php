<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganisationRequest extends FormRequest
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
            'organisation_name' => ['filled', Rule::unique('organisations')->ignore($this->id)],
            'mission_statement' => 'filled|string',
            'vision_statement' => 'filled|string',
            'organisation_color' => 'filled|string|min:2|max:10',
            'organisation_address' => 'filled|string|min:3|max:255',
        ];
    }
}

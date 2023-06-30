<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\OrganisationStructure;
use Illuminate\Foundation\Http\FormRequest;

class OrganisationDataRequest extends FormRequest
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
        $structureId = $this->input('structure_id');
        $organisationSetups = $this->input('organisation_setups');

        return [
            'structure_id' => 'required|exists:organisation_structure,structure_id',
            'organisation_setups' => 'required|array',
            'organisation_setups' => 'required|array|min:1',
            'organisation_setups.*.name' => [
                'required',
                'distinct',
                Rule::unique('organisation_setups', 'name')->where(function ($query) use ($structureId) {
                    return $query->where('structure_id', $structureId);
                }),
            ],
        ];
    }
}

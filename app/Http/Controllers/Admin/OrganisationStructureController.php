<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organisation;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveOrganisationStructureRequest;
use App\Models\OrganisationStructure;

class OrganisationStructureController extends Controller
{

    public function index()
    {
        $organisationStructures = OrganisationStructure::query()->select('id', 'name')->get();

        return $this->successResponse('Organisation structures retrieved successfully', $organisationStructures);
    }

    public function store(SaveOrganisationStructureRequest $request, $organisationId)
    {
        $organisation = Organisation::find($organisationId);

        if (!$organisation) {
            return $this->notFoundAlert('Organisation not found');
        }

        $selectedOrganisationStructures = $request->input('organisation_structures', []);

        $organisation->organisationStructures()->detach();

        $organisation->organisationStructures()->attach($selectedOrganisationStructures);

        $savedOrganisation = Organisation::with('organisationStructures:id,name')->findOrFail($organisationId);

        return $this->createdResponse('Organisation structures saved successfully', $savedOrganisation);
    }
}

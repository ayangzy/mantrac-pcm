<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrganisationSetupService;
use App\Http\Requests\OrganisationDataRequest;

class OrganisationSetupController extends Controller
{
    private $organisationSetupService;

    public function __construct(OrganisationSetupService $organisationSetupService)
    {
        $this->organisationSetupService = $organisationSetupService;
    }

    public function index()
    {
        $organisationSetups = $this->organisationSetupService->getAllOrganisationSetups();

        return $this->successResponse('Organisation setups retrieved successfully', $organisationSetups);
    }

    public function show($id)
    {
        $organisationSetup = $this->organisationSetupService->getOrganisationSetupById($id);

        return $this->successResponse('Organisation setup retrieved successfully', $organisationSetup);
    }

    public function store(OrganisationDataRequest $request)
    {
        $structureId = $request->input('structure_id');
        $organisationSetups = $request->input('organisation_setups');

        $createdSetups = $this->organisationSetupService->saveOrganisationSetup($structureId, $organisationSetups);

        return $this->createdResponse('Organisation structure setup saved successfully', $createdSetups);
    }


    public function update(Request $request, $id)
    {
        $lineManagerId = $request->input('line_manager_id');
        $name = $request->input('name');

        $organisationSetup = $this->organisationSetupService->updateOrganisationSetup($id, $lineManagerId, $name);

        return $this->successResponse('Organisation setup updated successfully', $organisationSetup);
    }

    public function destroy($id)
    {
        $this->organisationSetupService->deleteOrganisationSetup($id);

        return $this->successResponse('Organisation setup deleted successfully');
    }
}

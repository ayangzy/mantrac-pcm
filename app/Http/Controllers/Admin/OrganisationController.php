<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\OrganisationService;
use App\Http\Requests\CreateOrganisationRequest;
use App\Http\Requests\UpdateOrganisationRequest;


class OrganisationController extends Controller
{

    private $organisationService;

    public function __construct(OrganisationService $organisationService)
    {
        $this->organisationService = $organisationService;
    }

    public function index()
    {
        $organisations = $this->organisationService->getAllOrganisations();

        return $this->successResponse("Organisation retrieved successfully", $organisations);
    }


    public function store(CreateOrganisationRequest $request)
    {
        $request['user_id'] = Auth::id();

        $organisation = $this->organisationService->createOrganisation($request->all());

        return $this->createdResponse("Organisation created successfully", $organisation);
    }


    public function show($id)
    {
        $organisation = $this->organisationService->getOrganisationById($id);

        return $this->successResponse("Organisation retrieved successfully", $organisation);
    }


    public function update(UpdateOrganisationRequest $request, $id)
    {
        $organisation = $this->organisationService->updateOrganisation($id, $request->validated());

        return $this->successResponse("Organisation updated successfully", $organisation);
    }


    public function destroy($id)
    {
        $organisation = $this->organisationService->deleteOrganisation($id);

        return $this->successResponse("Organisation deleted successfully");
    }
}

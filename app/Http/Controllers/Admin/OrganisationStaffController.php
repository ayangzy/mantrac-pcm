<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organisation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\OrganisationStaffService;
use App\Http\Resources\OrganisationStaffResource;
use App\Http\Requests\CreateOrganisationStaffRequest;
use App\Http\Requests\UpdateOrganisationStaffRequest;

class OrganisationStaffController extends Controller
{

    private $organisationStaffService;

    public function __construct(OrganisationStaffService $organisationStaffService)
    {
        $this->organisationStaffService = $organisationStaffService;
    }

    public function index()
    {
        $organisationStaff = $this->organisationStaffService->getStaffMembers();

        return $this->successResponse('Organisation staff retreived successfully', $organisationStaff);
    }

    public function store(CreateOrganisationStaffRequest $request)
    {
        $organisation = Organisation::where('user_id', Auth::id())->firstOrFail();

        $userData = $this->getUserData($request);

        $staffData = [
            'organisation_id' => $organisation->id,
            'job_title' => $request->job_title
        ];

        $organisationStaff = $this->organisationStaffService->createStaffMember($userData, $staffData);

        $organisationStaffResource = new OrganisationStaffResource($organisationStaff);

        return $this->createdResponse('Organisation staff created successfully', $organisationStaffResource);
    }



    public function show($id)
    {
        $organisationStaff = $this->organisationStaffService->getStaffMember($id);

        $organisationStaffResource = new OrganisationStaffResource($organisationStaff);

        return $this->successResponse('Organisation staff retrieved successfully', $organisationStaffResource);
    }

    public function update(UpdateOrganisationStaffRequest $request, $id)
    {
        $userData = $this->getUserData($request);

        $staffData = [
            'job_title' => $request->job_title,
            'job_description' => $request->job_description
        ];

        $organisationStaff = $this->organisationStaffService->updateStaffMember($id, $userData, $staffData);

        $organisationStaffResource = new OrganisationStaffResource($organisationStaff);

        return $this->successResponse('Organisation staff updated successfully', $organisationStaffResource);
    }

    public function destroy($id)
    {
        $this->organisationStaffService->deleteStaffMember($id);

        return $this->successResponse('Organisation staff and associated user deleted successfully');
    }



    private function getUserData($request)
    {
        return [
            'full_name' => $request->full_name,
            'email' => $request->email,
        ];
    }
}

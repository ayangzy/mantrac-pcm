<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organisation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateOrganisationRequest;
use App\Http\Requests\UpdateOrganisationRequest;


class OrganisationController extends Controller
{

    public function index()
    {
        $organisations = Organisation::query()->get();

        return $this->successResponse("Organisation retrieved successfully", $organisations);
    }


    public function store(CreateOrganisationRequest $request)
    {
        $request['user_id'] = Auth::id();
        $organisation = Organisation::create($request->all());

        return $this->createdResponse("Organisation created successfully", $organisation);
    }


    public function show($id)
    {
        $organisation = Organisation::find($id);

        if (!$organisation) {
            return $this->notFoundAlert("Organisation not found");
        }

        return $this->successResponse("Organisation retrieved successfully", $organisation);
    }


    public function update(UpdateOrganisationRequest $request, $id)
    {
        $organisation = Organisation::find($id);

        if (!$organisation) {
            return $this->notFoundAlert("Organisation not found");
        }

        $organisation->update($request->validated());

        return $this->successResponse("Organisation updated successfully", $organisation);
    }


    public function destroy($id)
    {
        $organisation = Organisation::find($id);

        if (!$organisation) {
            return $this->notFoundAlert("Organisation not found");
        }

        $organisation->delete();

        return $this->successResponse("Organisation deleted successfully");
    }
}

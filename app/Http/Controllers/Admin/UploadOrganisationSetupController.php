<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\OrganisationStructureImport;
use App\Http\Requests\UploadOrganisationSetupRequest;

class UploadOrganisationSetupController extends Controller
{
    public function uploadOrganisationSetup(UploadOrganisationSetupRequest $request)
    {
        (new OrganisationStructureImport)->import($request->file);

        return $this->successResponse('Organisation setup imported successfully');
    }
}

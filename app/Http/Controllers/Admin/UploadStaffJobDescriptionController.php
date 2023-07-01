<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\StaffJobDescriptionImport;
use App\Http\Requests\UploadStaffJobDescriptionRequest;

class UploadStaffJobDescriptionController extends Controller
{
    public function uploadJobDescription(UploadStaffJobDescriptionRequest $request)
    {
        (new StaffJobDescriptionImport)->import($request->file);

        return $this->successResponse('Job description uploaded successfully');
    }
}

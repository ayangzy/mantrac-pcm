<?php

namespace App\Http\Controllers\Admin;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadUserRequest;

class BulkUploadUserController extends Controller
{
    public function uploadUser(UploadUserRequest $request)
    {
        (new UsersImport)->import($request->file);

        return $this->successResponse('Users imported successfully');
    }
}

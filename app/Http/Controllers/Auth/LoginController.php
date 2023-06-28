<?php

namespace App\Http\Controllers\Auth;

use App\Actions\LoginAction;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = (new LoginAction())->execute($request);

        return $this->successResponse('User successfully logged in', $this->generateAuthData($user));
    }
}

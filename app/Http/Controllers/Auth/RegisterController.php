<?php

namespace App\Http\Controllers\Auth;

use App\Actions\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = (new RegisterAction())->execute($request);

        return $this->createdResponse('User successfully registered', (object) $this->generateAuthData($user));
    }
}

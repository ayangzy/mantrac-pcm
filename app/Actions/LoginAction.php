<?php

namespace App\Actions;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class LoginAction
{

    public function execute(LoginRequest $request)
    {
        $user = $this->getAuthenticatedUser($request);

        return $user;
    }

    private function getAuthenticatedUser($request): ?User
    {
        $user = User::with(['permissions', 'roles'])->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw new BadRequestException('The provided credentials are incorrect.');
        }

        return $user;
    }
}

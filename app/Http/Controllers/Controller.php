<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponses;
use App\Http\Resources\UserResource;
use App\Traits\GenerateAuthAccessCredentials;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ApiResponses, GenerateAuthAccessCredentials;


    protected function generateAuthData($user)
    {
        [$accessToken, $expiresAt] = $this->generateAccessCredentialsFor($user);

        return [
            'token' => $accessToken,
            'expires_at' => $expiresAt,
            'user' => new UserResource($user),
        ];
    }
}

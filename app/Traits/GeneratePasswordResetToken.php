<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use App\Models\PasswordResetToken;

trait GeneratePasswordResetToken
{
    protected function generateToken($email)
    {
        $token = encrypt($email);
        $url = sprintf('%s', $token);

        PasswordResetToken::create([
            'email' => $email,
            'created_at' => Carbon::now(),
        ]);

        return $url;
    }
}

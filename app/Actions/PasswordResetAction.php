<?php

namespace App\Actions;

use App\Models\User;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PasswordResetAction
{
    public function execute($password, string $token): void
    {
        DB::beginTransaction();
        try {
            $email = decrypt($token);

            $passwordResetToken = PasswordResetToken::where('email', $email)->first();

            if (!$passwordResetToken) {
                throw new BadRequestException('Token is not valid or has already been used');
            }

            if ($this->checkTokenExpiration($passwordResetToken)) {
                throw new BadRequestException('Password reset token has expired');
            }

            $user = User::where('email',  $email)->first();

            if (!$user) {
                throw new BadRequestException('User not found');
            }

            DB::commit();

            $user->password = Hash::make($password);
            $user->save();

            $passwordResetToken->delete();
        } catch (DecryptException $ex) {
            DB::rollBack();
            throw new BadRequestException('Token is not valid or has already been used');
        }
    }

    private function checkTokenExpiration($passwordResetToken)
    {
        if (now()->diffInMinutes($passwordResetToken->created_at) < 10) {
            return false;
        }
        return true;
    }
}

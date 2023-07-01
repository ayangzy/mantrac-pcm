<?php

namespace App\Http\Controllers\Auth;

use App\Actions\PasswordResetAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;

class PasswordResetController extends Controller
{
    public function resetPassword(PasswordResetRequest $request, PasswordResetAction $passwordResetAction)
    {
        $passwordResetAction->execute($request->password, $request->token);

        return $this->successResponse('Password has been reset successfully');
    }
}

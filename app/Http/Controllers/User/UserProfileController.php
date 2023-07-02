<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function getUserProfile()
    {
        $user = User::with('staff')->where('id', Auth::id())->firstOrFail();

        return $user;
    }
}

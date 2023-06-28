<?php

namespace App\Actions;

use App\Models\User;
use App\Enums\RoleEnum;
use App\Http\Requests\RegisterRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    public function execute(RegisterRequest $request)
    {
        $role = Role::where('name', RoleEnum::ADMIN_PC)->firstOrFail();

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($role->name);

        return $user;
    }
}

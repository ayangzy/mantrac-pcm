<?php

namespace App\Services;

use App\Models\User;
use App\Enums\RoleEnum;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\GetUserPermissionResource;

class UserManagementService
{
    public function getUser()
    {
        $user = User::findOrFail(Auth::id());

        if ($user->hasAnyRole([
            RoleEnum::SUPER_ADMIN, RoleEnum::ADMIN_PC,
            RoleEnum::ADMIN_STRATEGY, RoleEnum::LINE_MANAGER, RoleEnum::STAFF
        ])) {
            $permissions = $user->getAllPermissions()->map(function ($permission) {
                return $permission;
            });
        } else {
            $permissions = $user->getDirectPermissions()->map(function ($permission) {
                return $permission;
            });
        }

        $responsePayload = [
            'user' => $user,
            'permission' => $permissions,
        ];

        return new GetUserPermissionResource((object) $responsePayload);
    }

    public function assignRole(User $user, Role $role)
    {
        $user->assignRole($role);
    }

    public function detachRole(User $user, Role $role)
    {
        $user->removeRole($role);
    }

    public function assignPermission(User $user, Permission $permission)
    {
        $user->givePermissionTo($permission);
    }

    public function detachPermission(User $user, Permission $permission)
    {
        $user->revokePermissionTo($permission);
    }

    public function getAllRole()
    {
        $roles = Role::select('id', 'name')->get();
        return $roles;
    }

    public function getAllPermission()
    {
        $permissions = Permission::select('id', 'name')->get();
        return $permissions;
    }
}
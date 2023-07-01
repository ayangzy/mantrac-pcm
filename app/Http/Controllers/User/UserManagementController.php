<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\UserManagementService;
use Spatie\Permission\Models\Permission;


class UserManagementController extends Controller
{
    protected $userManagementService;

    public function __construct(UserManagementService $userManagementService)
    {
        $this->userManagementService = $userManagementService;
    }

    public function getUser()
    {
        $user = $this->userManagementService->getUser();

        return $this->successResponse('User successfully retrieved', $user);
    }

    public function getAllRole()
    {
        $roles = $this->userManagementService->getAllRole();

        return $this->successResponse('Roles retrieved successfully', $roles);
    }

    public function getAllPermission()
    {
        $permissions = $this->userManagementService->getAllPermission();

        return $this->successResponse('Permissions retrieved successfully', $permissions);
    }

    public function assignRole(Request $request, $userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($roleId);

        $this->userManagementService->assignRole($user, $role);

        return $this->successResponse('Role assigned successfully');
    }

    public function detachRole(Request $request, $userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($roleId);

        $this->userManagementService->detachRole($user, $role);

        return $this->successResponse('Role detached successfully');
    }

    public function assignPermission(Request $request, $userId, $permissionId)
    {
        $user = User::findOrFail($userId);
        $permission = Permission::findOrFail($permissionId);

        $this->userManagementService->assignPermission($user, $permission);

        return $this->successResponse('Permission assigned successfully');
    }

    public function detachPermission(Request $request, $userId, $permissionId)
    {
        $user = User::findOrFail($userId);
        $permission = Permission::findOrFail($permissionId);

        $this->userManagementService->detachPermission($user, $permission);

        return $this->successResponse('Permission detached successfully');
    }
}

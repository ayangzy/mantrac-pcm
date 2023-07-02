<?php

use Illuminate\Http\Request;
use App\Enums\PermissionEnum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Admin\OrganisationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\User\UserManagementController;
use App\Http\Controllers\Admin\BulkUploadUserController;
use App\Http\Controllers\Admin\OrganisationSetupController;
use App\Http\Controllers\Admin\OrganisationStaffController;
use App\Http\Controllers\Admin\UploadOrganisationSetupController;
use App\Http\Controllers\Admin\UploadStaffJobDescriptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('register', [RegisterController::class, 'register'])->name('register');
        Route::post('login', [LoginController::class, 'login'])->name('login');
        Route::post('password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.resetPassword');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('organisations')->name('organisations.')->group(function () {
            Route::get('', [OrganisationController::class, 'index'])->name('index')->middleware(['permission:' . PermissionEnum::VIEW_ORG_INFO]);
            Route::post('', [OrganisationController::class, 'store'])->name('store')->middleware(['permission:' . PermissionEnum::ADD_ORG_INFO]);
            Route::get('/{id}', [OrganisationController::class, 'show'])->name('show')->middleware(['permission:' . PermissionEnum::VIEW_ORG_INFO]);
            Route::patch('/{id}', [OrganisationController::class, 'update'])->name('update')->middleware(['permission:' . PermissionEnum::EDIT_ORG_INFO]);
            Route::delete('/{id}', [OrganisationController::class, 'destroy'])->name('destroy')->middleware(['permission:' . PermissionEnum::DELETE_ORG_INFO]);
        });

        Route::prefix('structures')->name('structures.')->group(function () {
            Route::get('', [StructureController::class, 'index'])->name('index')->middleware(['permission:' . PermissionEnum::VIEW_ORG_STRUCTURE]);
            Route::post('', [StructureController::class, 'store'])->name('store')->middleware(['permission:' . PermissionEnum::ADD_ORG_STRUCTURE]);
        });

        Route::prefix('organisation-setups')->name('organisationSetups.')->group(function () {
            Route::get('/', [OrganisationSetupController::class, 'index'])->middleware(['permission:' . PermissionEnum::VIEW_ORG_SETUP]);
            Route::post('/', [OrganisationSetupController::class, 'store'])->middleware(['permission:' . PermissionEnum::ADD_ORG_SETUP]);
            Route::get('/{id}', [OrganisationSetupController::class, 'show'])->middleware(['permission:' . PermissionEnum::VIEW_ORG_SETUP]);
            Route::patch('/{id}', [OrganisationSetupController::class, 'update'])->middleware(['permission:' . PermissionEnum::EDIT_ORG_SETUP]);
            Route::delete('/{id}', [OrganisationSetupController::class, 'destroy'])->middleware(['permission:' . PermissionEnum::DELETE_ORG_SETUP]);
        });

        Route::post('organisation-setups/upload', [UploadOrganisationSetupController::class, 'uploadOrganisationSetup'])->middleware(['permission:' . PermissionEnum::UPLOAD_ORG_SETUP]);
        Route::post('organisation-staff/upload', [BulkUploadUserController::class, 'uploadUser'])->middleware(['permission:' . PermissionEnum::UPLOAD_ORG_STAFF]);
        Route::post('organisation-staff/job-description/upload', [UploadStaffJobDescriptionController::class, 'uploadJobDescription'])->middleware(['permission:' . PermissionEnum::UPLOAD_ORG_JOB_DESC]);

        Route::prefix('user-managements')->name('userManagement.')->group(function () {
            Route::get('/user', [UserManagementController::class, 'getUser']);
            Route::get('/permissions', [UserManagementController::class, 'getAllPermission'])->middleware(['permission:' . PermissionEnum::VIEW_PERMISSIONS]);
            Route::get('/roles', [UserManagementController::class, 'getAllRole'])->middleware(['permission:' . PermissionEnum::VIEW_ROLES]);
            Route::patch('/users/{userId}/roles/{roleId}/assign-role', [UserManagementController::class, 'assignRole'])->middleware(['permission:' . PermissionEnum::ASSIGN_ROLE]);
            Route::delete('/users/{userId}/roles/{roleId}/detach-role', [UserManagementController::class, 'detachRole'])->middleware(['permission:' . PermissionEnum::DETACH_ROLE]);
            Route::patch('/users/{userId}/permissions/{permissionId}/assign-permission', [UserManagementController::class, 'assignPermission'])->middleware(['permission:' . PermissionEnum::ASSIGN_PERMISSION]);
            Route::delete('/users/{userId}/permissions/{permissionId}/detach-permission', [UserManagementController::class, 'detachPermission'])->middleware(['permission:' . PermissionEnum::DETACH_PERMISSION]);
        });

        Route::prefix('organisation-staff')->name('organisationStaff.')->group(function () {
            Route::get('',  [OrganisationStaffController::class, 'index'])->name('index')->middleware(['permission:' . PermissionEnum::VIEW_ORG_STAFF]);
            Route::post('',  [OrganisationStaffController::class, 'store'])->name('store')->middleware(['permission:' . PermissionEnum::ADD_ORG_STAFF]);
            Route::get('/{id}',  [OrganisationStaffController::class, 'show'])->name('show')->middleware(['permission:' . PermissionEnum::VIEW_ORG_STAFF]);
            Route::patch('/{id}',  [OrganisationStaffController::class, 'update'])->name('update')->middleware(['permission:' . PermissionEnum::EDIT_ORG_STAFF]);
            Route::delete('/{id}',  [OrganisationStaffController::class, 'destroy'])->name('destroy')->middleware(['permission:' . PermissionEnum::DELETE_ORG_STAFF]);
        });

        Route::get('user-profile', [UserProfileController::class, 'getUserProfile']);
    });
});
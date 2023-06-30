<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Controllers\Admin\OrganisationController;
use App\Http\Controllers\Admin\OrganisationSetupController;
use App\Http\Controllers\Admin\OrganisationStructureController;

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
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('organisations')->name('organisations.')->group(function () {
            Route::get('', [OrganisationController::class, 'index'])->name('index');
            Route::post('', [OrganisationController::class, 'store'])->name('store');
            Route::get('/{id}', [OrganisationController::class, 'show'])->name('show');
            Route::patch('/{id}', [OrganisationController::class, 'update'])->name('update');
            Route::delete('/{id}', [OrganisationController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('structures')->name('structures.')->group(function () {
            Route::get('', [StructureController::class, 'index'])->name('index');
            Route::post('', [StructureController::class, 'store'])->name('store');
        });

        Route::prefix('organisation-setups')->name('organisationSetups.')->group(function () {
            Route::get('/', [OrganisationSetupController::class, 'index']);
            Route::post('/', [OrganisationSetupController::class, 'store']);
            Route::get('/{id}', [OrganisationSetupController::class, 'show']);
            Route::patch('/{id}', [OrganisationSetupController::class, 'update']);
            Route::delete('/{id}', [OrganisationSetupController::class, 'destroy']);
        });
    });
});

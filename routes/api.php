<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\API\AuthenticatedSessionController;
use App\Http\Controllers\Auth\API\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\API\NewPasswordController;
use App\Http\Controllers\Auth\API\PasswordResetLinkController;
use App\Http\Controllers\Auth\API\RegisteredUserController;
use App\Http\Controllers\Auth\API\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\SalaryController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\FolderController;
use App\Http\Controllers\API\NoteController;

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/public-notes', [NoteController::class, 'showPublic']);

Route::group(['middleware' => 'auth:sanctum'], function ()  {
    // Employees
    Route::apiResource('employees', EmployeeController::class);

    // Salaries
    Route::apiResource('salaries', SalaryController::class);

    // Departments
    Route::apiResource('departments', DepartmentController::class);

    // Notes
    Route::apiResource('folders/{folder}/notes', NoteController::class);

    // Folders
    Route::apiResource('folders', FolderController::class);


    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Folder\FolderController;
use App\Http\Controllers\Note\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Salary\SalaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD for employees
    Route::resource('employees', EmployeeController::class);

    // CRUD for employees
    Route::resource('departments', DepartmentController::class);

    // CRUD for salaries
    Route::resource('salaries', SalaryController::class);

    // CRUD for folders
    Route::resource('folders', FolderController::class);
    Route::get('notes', [NoteController::class, 'list'])->name('notes.list');

    // CRUD for notes
    Route::resource('folders/{folder}/notes', NoteController::class);
});

require __DIR__ . '/auth.php';

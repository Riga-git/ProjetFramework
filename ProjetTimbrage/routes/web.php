<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClockingController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
      'canLogin' => Route::has('login'),
      'canRegister' => Route::has('register'),
      'laravelVersion' => Application::VERSION,
      'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('departments', DepartmentController::class)->except(['edit']);

Route::resource('clockings', ClockingController::class)->except(['edit', 'create']);

Route::resource('projects', ProjectController::class)->except(['edit']);

Route::resource('users', UserController::class);


//Route::get('users-management-allusers', [UserManagementController::class, 'getAllUsers'])->name('allUsers');
//Route::get('users-management-without-department', [UserManagementController::class, 'getUserWithoutDepartment'])->name('usersWithoutDepartment');

// Assignments
/*
Route::get('/assignments', [AssignmentController::class, 'index']);
Route::patch('/assignments', [AssignmentController::class, 'edit']);
Route::post('/assignments', [AssignmentController::class, 'store']);
Route::delete('/assignments', [AssignmentController::class, 'destroy']);
*/

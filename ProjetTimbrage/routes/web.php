<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClockingController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;

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


Route::middleware(['auth'])->group(function () {

    Route::get('/', function() {
        return Inertia::render('HomePage');
    });

    Route::resource('departments', DepartmentController::class)->except(['edit', 'create']);
    Route::resource('clockings', ClockingController::class)->except(['edit', 'create', 'show', 'update', 'destroy']);
    Route::get('/getClockings', [ClockingController::class, 'show']);
    Route::resource('projects', ProjectController::class)->except(['edit']);
    Route::resource('users', UserController::class);
    Route::resource('assignments', AssignmentController::class);
    Route::get('assignment/daily', [AssignmentController::class, 'getAssigmentsForDate']);
});


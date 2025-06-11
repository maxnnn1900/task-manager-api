<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeRoleController;
use App\Http\Controllers\TaskAssignmentController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/employees/{employee}/assign-role', [EmployeeRoleController::class, 'assign']);
Route::post('/employees/{employee}/remove-role', [EmployeeRoleController::class, 'remove']);
Route::apiResource('employees', EmployeeController::class);

Route::get('/tasks/grouped-by-status', [TaskController::class, 'groupedByStatus']);
Route::prefix('tasks')->group(function () {
    Route::post('{task}/assign', [TaskAssignmentController::class, 'assign']);
    Route::post('{task}/unassign', [TaskAssignmentController::class, 'unassign']);
});

Route::apiResource('tasks', TaskController::class)->except(['store']);
Route::post('/tasks', [TaskController::class, 'store'])->middleware('throttle:task-creation');


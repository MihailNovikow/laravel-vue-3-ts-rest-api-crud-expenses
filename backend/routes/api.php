<?php

use App\Http\Controllers\Api\ExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\UserController;

Route::post('login',[AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('user/{id}', [UserController::class, 'singleUser']);
Route::get('users', [UserController::class, 'index']);

Route::get('/expenses',  [ExpenseController::class, 'index']);
Route::get('/expenses/{id}',  [ExpenseController::class, 'show']);
Route::post('/expenses',  [ExpenseController::class, 'store']);
Route::put('/expenses/{id}',  [ExpenseController::class, 'update']);
Route::delete('/expenses/{id}',  [ExpenseController::class, 'destroy']);
Route::delete('/expenses',  [ExpenseController::class, 'destroyAll']);



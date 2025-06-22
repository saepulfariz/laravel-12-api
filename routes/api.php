<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/todos', [TodoController::class, 'store'])->middleware(['auth:sanctum', 'can:create-todo']); // only creator can create todos

// PUT update all data, PATCH update part data.
Route::patch('/todos/{id}', [TodoController::class, 'update'])->middleware(['auth:sanctum', 'can:update-todo']); // only editor can update todos
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->middleware(['auth:sanctum', 'can:delete-todo']); // only admin can delete todos
Route::get('/todos', [TodoController::class, 'index']);
Route::get('/todos/{id}', [TodoController::class, 'show'])->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

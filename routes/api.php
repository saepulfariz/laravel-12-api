<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/todos', [TodoController::class, 'store']);

// PUT update all data, PATCH update part data.
Route::patch('/todos/{id}', [TodoController::class, 'update']);



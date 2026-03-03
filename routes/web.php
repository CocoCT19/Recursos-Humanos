<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollaboratorController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/dashboard', function () {
    return response('Dashboard', 200);
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/collaborators', [CollaboratorController::class, 'index']);
    Route::post('/collaborators', [CollaboratorController::class, 'store']);
    Route::get('/collaborators/{id}/edit', [CollaboratorController::class, 'edit']);
    Route::put('/collaborators/{id}', [CollaboratorController::class, 'update']);
    Route::delete('/collaborators/{id}', [CollaboratorController::class, 'destroy']);

});
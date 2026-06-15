<?php
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
Route::get('/insight', [TaskController::class, 'insightPage'])->name('insight');

Route::post('/tasks', [TaskController::class, 'store']);

Route::post('/sessions/start', [SessionController::class, 'start']);
Route::post('/sessions/stop', [SessionController::class, 'stop']);




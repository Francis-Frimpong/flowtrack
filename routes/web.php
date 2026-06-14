<?php
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
Route::get('/insight', [TaskController::class, 'insightPage'])->name('insight');

Route::post('/tasks', [TaskController::class, 'store']);




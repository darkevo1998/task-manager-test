<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('projects', ProjectController::class)->only(['index', 'create', 'store']);

Route::prefix('projects/{project}')->group(function () {
    Route::resource('tasks', TaskController::class)->except(['show']);
    Route::post('tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
});

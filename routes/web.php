<?php

use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    /*
        Organisation Routes  --------------------------------------------------------
    */
    Route::get('/organisations', [OrganisationController::class, 'index'])->name('organisations.index');

    /*
        Project Routes  -------------------------------------------------------------
    */
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    /*
        Task Routes  -------------------------------------------------------------
    */
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/projects/{project}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');

    /*
        Profile Routes  -------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
// Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
// Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
// Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
// Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
// Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

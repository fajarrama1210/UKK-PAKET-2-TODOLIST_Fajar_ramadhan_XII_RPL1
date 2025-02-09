<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});
Auth::routes();

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('list');
            Route::get('/add', [CategoryController::class, 'create'])->name('add');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}/update', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])->name('delete');
        });
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('list');
            Route::get('/add', [UserController::class, 'create'])->name('add');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}/update', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('delete');
            Route::get('/show/{user}', [UserController::class, 'show'])->name('show');
        });
    });

    Route::prefix('user')
    ->middleware(['auth', 'role:user'])
    ->name('user.')
    ->group(function () {
        Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');

        Route::prefix('list')->name('list.')->group(function () {
            Route::get('/', [TaskListController::class, 'index'])->name('list');
            Route::get('/add', [TaskListController::class, 'create'])->name('add');
            Route::get('/edit/{taskList}', [TaskListController::class, 'edit'])->name('edit');
            Route::put('/update/{taskList}', [TaskListController::class, 'update'])->name('update');
            Route::post('/store', [TaskListController::class, 'store'])->name('store');
            Route::delete('/delete/{taskList}', [TaskListController::class, 'destroy'])->name('delete');
        });

        Route::prefix('tasks')->name('tasks.')->group(function () {
            Route::get('/', [TaskController::class, 'index'])->name('list');
            Route::get('/list/{taskList}', [TaskController::class, 'index'])->name('list.filter');
            Route::get('/add/{listid}', [TaskController::class, 'create'])->name('add');
            Route::post('/store', [TaskController::class, 'store'])->name('store');
            Route::get('/edit/{task}', [TaskController::class, 'edit'])->name('edit');
            Route::put('/update/{task}', [TaskController::class, 'update'])->name('update');
            Route::delete('/delete/{task}/{listid}', [TaskController::class, 'destroy'])->name('delete');
            Route::get('/show/{task}', [TaskController::class, 'show'])->name('show');
        });

        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'indexUser'])->name('list');
        });
    });

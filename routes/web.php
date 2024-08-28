<?php

use App\Http\Controllers\ArticaleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::post('/permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::delete('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::delete('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');



    Route::get('/articles', [ArticaleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticaleController::class, 'create'])->name('articles.create');
    Route::post('/articles/store', [ArticaleController::class, 'store'])->name('articles.store');
    Route::post('/articles/update/{id}', [ArticaleController::class, 'update'])->name('articles.update');
    Route::get('/articles/edit/{id}', [ArticaleController::class, 'edit'])->name('articles.edit');
    Route::delete('/articles/delete/{id}', [ArticaleController::class, 'destroy'])->name('articles.destroy');

});


require __DIR__.'/auth.php';

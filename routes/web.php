<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'loadAllUsers'])->name('users.list');

Route::get('/add/user', [UserController::class, 'loadAddUserForm'])->name('users.add.form');
Route::post('/add/user', [UserController::class, 'AddUser'])->name('users.add.submit');

Route::get('/edit/{id}', [UserController::class, 'loadEditForm'])->name('users.edit.form');
Route::post('/edit/user', [UserController::class, 'EditUser'])->name('users.edit.submit');

Route::get('/delete/{id}', [UserController::class, 'deleteUser'])->name('users.delete');


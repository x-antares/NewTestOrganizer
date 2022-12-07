<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::model('user', User::class);
Route::get('/user/{user}/', [UserController::class, 'edit'])->name('edit.user');
Route::post('/user/{user}/update/', [UserController::class, 'update'])->name('update.user');
Route::get('/user/{user}/password/change/', [UserController::class, 'changePassword'])->name('password.change');
Route::post('/user/{user}/password/update/', [UserController::class, 'changePasswordSave'])->name('password.confirm');

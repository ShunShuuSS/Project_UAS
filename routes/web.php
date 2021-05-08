<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'index']);

Route::get('login', [LoginController::class, 'view_login']);
Route::get('register', [LoginController::class, 'view_register']);
Route::post('submit_login', [LoginController::class, 'login']);
Route::post('submit_register', [LoginController::class, 'register']);

// ADMIN

Route::get('admin/home', [AdminController::class, 'home']);
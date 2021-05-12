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

Route::get('admin/users', [AdminController::class, 'user_list']);
Route::get('admin/users/add_view', [AdminController::class, 'user_add_view']);
Route::post('admin/users/add', [AdminController::class, 'user_add']);
Route::get('admin/users/edit_view/{id}', [AdminController::class, 'user_edit_view']);
Route::post('admin/users/edit/{id}', [AdminController::class, 'user_edit']);
Route::get('admin/users/delete/{id}', [AdminController::class, 'user_delete']);

Route::get('admin/hotels/home', [AdminController::class, 'hotel_list']);
Route::get('admin/hotels/add_view', [AdminController::class, 'hotel_add_view']);
Route::post('admin/hotels/add', [AdminController::class, 'hotel_add']);
Route::get('admin/hotels/{id}', [AdminController::class, 'hotel_edit_view']);
Route::post('admin/hotels/edit/{id}', [AdminController::class, 'hotel_edit']);
Route::get('admin/hotels/delete/{id}', [AdminController::class, 'hotel_delete']);

Route::get('admin/hotels/facility/{id}', [AdminController::class, 'facility_view']);
Route::get('admin/hotels/facility/add_view/{id}', [AdminController::class, 'facility_add_view']);
Route::post('admin/hotels/facility/add/{id}', [AdminController::class, 'facility_add']);
Route::delete('admin/hotels/facility/delete/{id}', [AdminController::class, 'hotel_facility_view']);

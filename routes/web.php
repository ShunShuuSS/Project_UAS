<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
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

// Login
Route::get('login', [LoginController::class, 'view_login']);
Route::get('register', [LoginController::class, 'view_register']);
Route::get('logout', [LoginController::class, 'logout']);
Route::post('submit_login', [LoginController::class, 'login']);
Route::post('submit_register', [LoginController::class, 'register']);

// Admin

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
Route::get('admin/hotels/facility/delete/{idh}/{idf}', [AdminController::class, 'facility_delete']);

// User

Route::get('home', [HomeController::class, 'index']);
Route::get('hotel/{id}', [HomeController::class, 'detail_view']);
Route::get('profile', [HomeController::class, 'profile_view']);
Route::post('profile/edit', [HomeController::class, 'profile_edit']);

Route::get('booking/{id}', [BookingController::class, 'booking_view']);
Route::post('booking', [BookingController::class, 'booking']);

Route::get('booking_list', [BookingController::class, 'booking_list']);
Route::get('booking_detail/{id}', [BookingController::class, 'booking_detail']);

// Filter
Route::get('home/filter', [HomeController::class, 'filterByStar']);
Route::get('home/filterlokasi/{id}', [HomeController::class, 'filterByLocation']);

// About Us
Route::get('aboutus', [HomeController::class, 'aboutus']);
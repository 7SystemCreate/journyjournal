<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;

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

// Route::get('/', function () {
//    return view('welcome');
// });

Route::get('/', [DisplayController::class, 'index']);
Route::get('/post/{post}/detail', [DisplayController::class, 'postDetail'])->name('post.detail');
Route::get('/post/{post}/booking', [RegistrationController::class, 'booking'])->name('booking');
Route::post('/post/{post}/booking/confirm', [RegistrationController::class, 'bookingConf'])->name('booking.conf');
Route::post('/booking/complete', [RegistrationController::class, 'bookingComp'])->name('booking.comp');
Route::get('/booking/complete', function () { return view('booking_comp');})->name('booking.complete');

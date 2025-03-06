<?php

use App\Http\Controllers\GeneralDisplayController;
use App\Http\Controllers\GeneralPostController;
use App\Http\Controllers\GeneralReportController;
use App\Http\Controllers\GeneralBookingController;
use App\Http\Controllers\InnDisplayController;
use App\Http\Controllers\InnPostController;

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

Auth::routes();

//一般ユーザ(登録なくても利用可)
Route::get('/', [GeneralDisplayController::class, 'index'])->name('home');
Route::get('/post/{post}/detail', [GeneralPostController::class, 'postDetail'])->name('post.detail');

Route::group(['middleware' => 'auth'], function() {

    //通報
    Route::get('/post/{post}/report', [GeneralReportController::class, 'postReport'])->name('post.report');
    Route::post('/post/{post}/report/confirm', [GeneralReportController::class, 'reportConf'])->name('report.conf');
    Route::post('/report/complete', [GeneralReportController::class, 'reportComp'])->name('report.comp');
    //一般ユーザ予約
    Route::get('/post/{post}/booking', [GeneralBookingController::class, 'booking'])->name('booking');
    Route::post('/post/{post}/booking/confirm', [GeneralBookingController::class, 'bookingConf'])->name('booking.conf');
    Route::post('/booking/complete', [GeneralBookingController::class, 'bookingComp'])->name('booking.comp');
    //一般ユーザマイページ


    //旅館運営ユーザ
    Route::get('/inn_main', [InnDisplayController::class, 'index'])->name('inn.home');
    Route::get('/post/{post}/mypost_detail', [InnPostController::class, 'mypostDetail'])->name('mypost.detail');
    Route::POST('/post/{post}/delete', [InnPostController::class, 'delete'])->name('post.delete');
    //新規投稿
    Route::get('/post/create', [InnPostController::class, 'createPost'])->name('create.post');
    Route::post('/post/create/confirm', [InnPostController::class, 'createConf'])->name('createpost.conf');
    Route::post('/post/create/complete', [InnPostController::class, 'createComp'])->name('createpost.comp');


    //投稿内容編集
    Route::get('/post/{post}/edit_post', [InnPostController::class, 'editPost'])->name('edit.post');
    Route::post('/post/{post}/edit_post/confirm', [InnPostController::class, 'editConf'])->name('editpost.conf');
    Route::post('/post/{post}/edit_post/update', [InnPostController::class, 'update'])->name('post.update');
});


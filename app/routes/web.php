<?php

use App\Http\Controllers\GeneralDisplayController;
use App\Http\Controllers\GeneralPostController;
use App\Http\Controllers\GeneralReportController;
use App\Http\Controllers\GeneralBookingController;
use App\Http\Controllers\InnDisplayController;
use App\Http\Controllers\InnPostController;
use App\Http\Controllers\AdminDisplayController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LikeController;


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

Auth::routes(['verify' => true]);

//一般ユーザ(登録なくても利用可)
Route::get('/', [GeneralDisplayController::class, 'index'])->name('home');
Route::post('/', [GeneralDisplayController::class, 'search']);
Route::get('/post/{post}/detail', [GeneralPostController::class, 'postDetail'])->name('post.detail');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::post('/account/edit/confirm', [AccountController::class, 'editConfirm'])->name('account.edit.conf');
    Route::post('/account/update', [AccountController::class, 'updateAccount'])->name('account.update');
    Route::get('/account/delete', [AccountController::class, 'deleteAccountConf'])->name('account.delete');
    Route::post('/account/delete/{user}', [AccountController::class, 'accountDelete'])->name('myaccount.delete');
});

Route::group(['middleware' => ['auth', 'can:general']], function() {
    //通報
    Route::get('/post/{post}/report', [GeneralReportController::class, 'postReport'])->name('post.report');
    Route::post('/post/{post}/report/confirm', [GeneralReportController::class, 'reportConf'])->name('report.conf');
    Route::post('/report/complete', [GeneralReportController::class, 'reportComp'])->name('report.comp');
    //一般ユーザ予約
    Route::get('/post/{post}/booking', [GeneralBookingController::class, 'booking'])->name('booking');
    Route::post('/post/{post}/booking/confirm', [GeneralBookingController::class, 'bookingConf'])->name('booking.conf');
    Route::post('/booking/complete', [GeneralBookingController::class, 'bookingComp'])->name('booking.comp');
    //一般ユーザマイページ
    Route::get('/general/mypage', [GeneralDisplayController::class, 'showMypage'])->name('general.mypage');
    Route::get('/general/mybooking', [GeneralDisplayController::class, 'showMybooking'])->name('general.mybooking');
    Route::get('/booking/{booking}/detail', [GeneralDisplayController::class, 'showDetail'])->name('booking.detail');
    Route::post('/booking/{booking}/delete', [GeneralDisplayController::class, 'deleteBooking'])->name('booking.delete.confirm');
    Route::get('/general/likelist', [GeneralDisplayController::class, 'showMylike'])->name('general.likelist');
    //いいね
    Route::post('/post/{post}/like', [LikeController::class, 'like'])->name('post.like');
    Route::post('/post/{post}/unlike', [LikeController::class, 'unlike'])->name('post.unlike');
});
Route::group(['middleware' => ['auth', 'can:inn']], function() {
    //旅館運営ユーザ
    Route::get('/inn_main', [InnDisplayController::class, 'index'])->name('inn.home');
    Route::get('/post/{post}/mypost_detail', [InnPostController::class, 'mypostDetail'])->name('mypost.detail');
    Route::POST('/post/{post}/delete', [InnPostController::class, 'delete'])->name('post.delete');
    //新規投稿
    Route::get('/post/create', [InnPostController::class, 'createPost'])->name('create.post');
    Route::post('/post/create/confirm', [InnPostController::class, 'createConf'])->name('createpost.conf');
    Route::post('/post/create/complete', [InnPostController::class, 'createComp'])->name('createpost.comp');

    //旅館運営ユーザマイページ
    Route::get('/inn/mypage', [InnDisplayController::class, 'showMypage'])->name('inn.mypage');
    Route::get('/inn/bookinglist', [InnDisplayController::class, 'showBooking'])->name('booking.list');
    Route::get('/inn/booking/{booking}/detail', [InnDisplayController::class, 'showDetail'])->name('inn.booking.detail');

    //投稿内容編集
    Route::get('/post/{post}/edit_post', [InnPostController::class, 'editPost'])->name('edit.post');
    Route::post('/post/{post}/edit_post/confirm', [InnPostController::class, 'editConf'])->name('editpost.conf');
    Route::post('/post/{post}/edit_post/update', [InnPostController::class, 'update'])->name('post.update');
    
});
Route::group(['middleware' => ['auth', 'can:admin']], function() {
    //管理者ユーザマイページ
    Route::get('/admin/mypage', [AdminDisplayController::class, 'showMypage'])->name('admin.mypage');
    //投稿一覧ページ
    Route::get('/admin/postlist', [AdminDisplayController::class, 'postList'])->name('post.list');
    //投稿削除ページ
    Route::get('/post/{post}/post_delete', [AdminDisplayController::class, 'postDetail'])->name('delete.detail');
    Route::POST('/admin/postdelete/{post}', [AdminDisplayController::class, 'postDelete'])->name('post.delete');
    //ユーザ一覧ページ
    Route::get('/admin/userlist', [AdminDisplayController::class, 'userList'])->name('user.list');
    //ユーザ削除ページ
    Route::get('/user/{user}/user_delete', [AdminDisplayController::class, 'userDetail'])->name('delete.userdetail');
    Route::POST('/admin/userdelete/{user}', [AdminDisplayController::class, 'userDelete'])->name('user.delete');
});

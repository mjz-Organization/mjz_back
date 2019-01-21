<?php

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

Route::any('unAuth', function () {
    return responseToJson(1,'未认证或认证失败');
})->name('unAuth');

Route::prefix('admin')->namespace('Admin')->group(function() {
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@login');
    Route::middleware('auth:admin','update:admin', 'loginCheck')->group(function() {
        include 'admin.php';
    });
});

Route::prefix('customer')->namespace('Customer')->group(function() {
    Route::post('register', 'RegisterController@register');
    Route::post('login', ' @login');
//    Route::middleware('auth:customer','update:customer', 'loginCheck')->group(function() {
    include 'customer.php';
//    });
});

Route::prefix('student')->namespace('Student')->group(function() {
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@login');
//    Route::middleware('auth:student','update:student', 'loginCheck')->group(function() {
    include 'student.php';
//    });
});
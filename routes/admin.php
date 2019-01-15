<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/14
 * Time: 14:49
 */

Route::post('logout', 'LoginController@logout');

Route::get('user', function (){
    return response()->json([
        'data' => Auth::guard('admin')->user()->toArray()
    ]);
});
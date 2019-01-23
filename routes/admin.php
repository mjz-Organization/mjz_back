<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/14
 * Time: 14:49
 */

Route::post('logout', 'LoginController@logout');

Route::get('getMenu', 'MenuController@getMenu');
/**
 * 启动页路由
 */
Route::group(['prefix' => 'startPage'], function () {
    //添加
    Route::post('addAd', 'StartPageController@createAd');
    //查询
    Route::get('getAd','StartPageController@selectAd');
    //更新
    Route::post('updateAd','StartPageController@alterAd');
});


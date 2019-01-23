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
 * 角色权限
 */
Route::group(['prefix' => 'roleAuth'], function () {
    Route::post('createRole', 'RoleAuthController@createOrUpdate');
    Route::post('updateRole', 'RoleAuthController@createOrUpdate');
});

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
    //删除
    Route::post('deleteAd','StartPageController@dropAd');

});

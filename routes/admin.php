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
    Route::get('getRoles', 'RoleAuthController@getRoles');
    Route::get('getRoleAndAuth', 'RoleAuthController@getRoleAndAuth');

    Route::post('createRole', 'RoleAuthController@createOrUpdate');
    Route::post('updateRole', 'RoleAuthController@createOrUpdate');
    Route::post('deleteRole', 'RoleAuthController@deleteRole');
});

/**
 * 启动页路由
 */
Route::group(['prefix' => 'startPage'], function () {
    //添加
    Route::post('createAd', 'StartPageController@createStartPageAd');
    //查询
    Route::get('selectAd','StartPageController@selectStartPageAd');
    //更新
    Route::post('updateAd','StartPageController@updateStartPageAd');
    //删除
    Route::post('deleteAd','StartPageController@deleteStartPageAd');

});
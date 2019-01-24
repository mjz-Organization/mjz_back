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
 * 用户管理
 */
Route::group(['prefix' => 'userManage'], function () {

    Route::middleware('userType:admin')->group(function() {
        Route::get('getAdmins', 'UserController@getUsers');
        Route::post('deleteAdmin', 'UserController@deleteUsers');
        Route::post('createAdmin', 'UserController@createOrUpdateUser');
        Route::post('updateAdmin', 'UserController@createOrUpdateUser');
    });

    Route::middleware('userType:student')->group(function() {
        Route::get('getStudents', 'UserController@getUsers');
        Route::post('deleteStudent', 'UserController@deleteUsers');
        Route::post('createStudent', 'UserController@createOrUpdateUser');
        Route::post('updateStudent', 'UserController@createOrUpdateUser');
    });

    Route::middleware('userType:customer')->group(function() {
        Route::get('getCustomers', 'UserController@getUsers');
        Route::post('deleteCustomer', 'UserController@deleteUsers');
        Route::post('createCustomer', 'UserController@createOrUpdateUser');
        Route::post('updateCustomer', 'UserController@createOrUpdateUser');
    });
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
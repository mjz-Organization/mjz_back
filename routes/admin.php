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
        Route::get('getAdmin', 'UserController@getUser');
        Route::get('getAdmins', 'UserController@getUsers');
        Route::post('deleteAdmin', 'UserController@deleteUsers');
        Route::post('createAdmin', 'UserController@createOrUpdateUser');
        Route::post('updateAdmin', 'UserController@createOrUpdateUser');
    });

    Route::middleware('userType:student')->group(function() {
        Route::get('getStudent', 'UserController@getUser');
        Route::get('getStudents', 'UserController@getUsers');
        Route::post('deleteStudent', 'UserController@deleteUsers');
        Route::post('createStudent', 'UserController@createOrUpdateUser');
        Route::post('updateStudent', 'UserController@createOrUpdateUser');
    });

    Route::middleware('userType:customer')->group(function() {
        Route::get('getCustomer', 'UserController@getUser');
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
    //修改顺序
    Route::post('changeOrderAd','StartPageController@updateOrderAd');
});

/**
 * 首页管理
 */
Route::group(['prefix' => 'indexPage'], function () {
    //添加首页广告
    Route::post('createIndex', 'IndexController@createIndexPageAd');

    //更新首页广告
    Route::post('updateIndex', 'IndexController@updateIndexPageAd');

    //查询首页广告
    Route::get('selectIndex','IndexController@selectIndexPageAd');

    //删除首页广告
    Route::get('deleteIndex','IndexController@deleteIndexPageAd');
});
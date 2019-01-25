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
    //修改顺序
    Route::post('changeOrderAd','StartPageController@updateOrderAd');
});

/**
 * 首页管理
 */
Route::group(['prefix' => 'indexPage'], function () {
    //添加首页广告
    Route::post('createIndexAd', 'IndexController@createIndexPageAd');
    //更新首页广告
    Route::post('updateIndexAd', 'IndexController@updateIndexPageAd');
    //查询首页广告
    Route::get('selectIndexAd','IndexController@selectIndexPageAd');
    //删除首页广告
    Route::post('deleteIndexAd','IndexController@deleteIndexPageAd');
    //修改首页广告顺序
    Route::post('changeOrderIndexAd','IndexController@updateOrderIndexPageAd');

    //添加新手导读
    Route::post('createNovice', 'IndexController@createNoviceArticle');
    //更新新手导读
    Route::post('updateNovice', 'IndexController@updateNoviceArticle');
    //查询新手导读
    Route::get('selectNovice','IndexController@selectNoviceArticle');
    //删除新手导读
    Route::post('deleteNovice','IndexController@deleteNoviceArticle');

});
<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/14
 * Time: 14:49
 */

Route::post('logout', 'LoginController@logout');

Route::get('getMenu', 'MenuController@getMenu');

//角色权限管理
Route::post('createRole', 'RoleAuthController@createOrUpdate');
Route::post('updateRole', 'RoleAuthController@createOrUpdate');
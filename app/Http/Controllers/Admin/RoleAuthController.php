<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/22
 * Time: 14:04
 */

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleAuthRequest;

class RoleAuthController
{
    /**
     * 创建或更新角色
     *
     * @param RoleAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrUpdate(RoleAuthRequest $request) {
        $roleId   = $request->input('roleId');
        $authArr  = $request->input('authArr');
        $roleName = $request->input('roleName');

        if (Role::createOrUpdate($roleName, $authArr, $roleId)) {
            return responseToJson(0, 'success');
        }
        return responseToJson(2,'修改角色权限失败');
    }

    /**
     * 删除角色及其权限
     *
     * @param RoleAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRole(RoleAuthRequest $request) {
        if (Role::deleteRole($request->input('idArr'))) {
            return responseToJson(0, 'success');
        }
        return responseToJson(2, '删除角色失败');
    }

    /**
     * 获得所有角色
     *
     * @param RoleAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoles(RoleAuthRequest $request) {
        return responseToJson(0, 'success', Role::paginate($request->input('pageSize')));
    }

    /**
     * 获得单个角色与其权限id
     *
     * @param RoleAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoleAndAuth(RoleAuthRequest $request) {
        return responseToJson(0, 'success', Role::getRoleAndAuth($request->input('roleId')));
    }
}
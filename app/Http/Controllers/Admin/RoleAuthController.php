<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/22
 * Time: 14:04
 */

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Http\Requests\RoleAuth\GetRoleRequest;
use App\Http\Requests\RoleAuth\RoleAuthRequest;
use App\Http\Requests\RoleAuth\DeleteRoleRequest;
use Illuminate\Http\Request;

class RoleAuthController
{
    /**
     * 创建或更新角色
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
     * @param DeleteRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRole(DeleteRoleRequest $request) {
        if (Role::deleteRole($request->input('idArr'))) {
            return responseToJson(0, 'success');
        }
        return responseToJson(2, '删除角色失败');
    }

    /**
     * 获得所有角色
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoles(Request $request) {
        return responseToJson(0, 'success', Role::paginate($request->input('pageSize')));
    }

    /**
     * 获得单个角色与其权限id
     * @param GetRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoleAndAuth(GetRoleRequest $request) {
        return responseToJson(0, 'success', Role::getRoleAndAuth($request->input('roleId')));
    }
}
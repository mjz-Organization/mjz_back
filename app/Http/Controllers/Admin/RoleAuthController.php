<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/22
 * Time: 14:04
 */

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Http\Requests\RoleAuthRequest;

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
}
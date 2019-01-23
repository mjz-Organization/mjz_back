<?php

namespace App\Model;

class RoleMenu extends BaseModel
{
    protected $table = 'role_menu';

    /**
     * 更新角色权限
     * @param $roleId : 角色id
     * @param $authArr : 数组|角色能操作菜单的id
     */
    public static function updateRoleAuto($roleId, $authArr) {
        $data = [];
        $time = time();
        foreach ($authArr as $auth) {
            $data[] = [
                'role_id' => $roleId,
                'menu_id' => $auth,
                'created_at' => $time,
                'updated_at' => $time
            ];
        }
        self::where('role_id',$roleId)->forceDelete();
        self::insert($data);
    }

    /**
     * 删除多个角色的权限
     * @param $idArr :数组|角色id
     */
    public static function deleteRoleAuth($idArr) {
        self::whereIn('role_id', $idArr)->delete();
    }
}
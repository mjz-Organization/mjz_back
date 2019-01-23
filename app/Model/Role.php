<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class Role extends BaseModel
{
    protected $table = 'role';

    /**
     * 创建或更新角色
     * @param $roleName : 角色名称
     * @param $authArr : 角色权限数组
     * @param null $roleId  : 角色id：如果有则更新，没有则插入
     * @return bool
     */
    public static function createOrUpdate($roleName, $authArr, $roleId = null) {
        $role = empty($roleId) ? new Role() : Role::find($roleId);
        $role->role_name = $roleName;

        DB::beginTransaction();
        try {
            $role->save();
            RoleMenu::updateRoleAuto($role->id, $authArr);
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }
}

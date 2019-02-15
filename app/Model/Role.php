<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class Role extends BaseModel
{
    protected $table = 'role';

    public static $dbTable = 'role';

    /**
     * 创建或更新角色
     * @param $roleName : 角色名称
     * @param $authArr : 角色权限数组
     * @param null $roleId  : 角色id：如果有则更新，没有则插入
     * @return bool
     */
    public static function createOrUpdate($roleName, $authArr, $roleId = null) {
        $role = empty($roleId) ? new static() : self::findOrFail($roleId);
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

    /**
     * 删除角色及其权限
     * @param $idArr
     * @return bool
     */
    public static function deleteRole($idArr) {
        DB::beginTransaction();
        try {
            self::whereIn('id', $idArr)->delete();
            RoleMenu::deleteRoleAuth($idArr);
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }

    /**
     * 获得角色及其权限id
     * @param $roleId
     * @return mixed
     */
    public static function getRoleAndAuth($roleId) {
        $data['role'] = self::find($roleId);
        $resust = RoleMenu::select('menu_id')
            ->where('role_id',$roleId)
            ->get();
        foreach ($resust as $roleMenu) {
            $data['roleAuth'][] = $roleMenu['menu_id'];
        }
        return $data;
    }
}
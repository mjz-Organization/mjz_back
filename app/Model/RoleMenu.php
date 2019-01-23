<?php

namespace App\Model;

class RoleMenu extends BaseModel
{
    protected $table = 'role_menu';

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
        RoleMenu::where('role_id',$roleId)->delete();
        RoleMenu::insert($data);
    }
}
<?php

namespace App\Model;


class Admin extends BaseUser
{
    protected $table = 'user_admin';
    public static $dbTable = 'user_student';

    protected $fillable = [
        'name', 'phone', 'role_id'
    ];

    public static function getUsers($data) {
        $pageSize   = array_get($data, 'pageSize', 10);
        $name = array_get($data, 'name', null);
        return empty($name) ? self::paginate($pageSize) :
            self::where('name', 'like', '%'.$name.'%')->paginate($pageSize);
    }
}
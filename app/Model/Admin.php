<?php

namespace App\Model;

class Admin extends BaseUser
{
    protected $table = 'user_admin';

    /**
     * DB构造器使用的table
     * @var string
     */
    public static $dbTable = 'user_admin';

    /**
     * 模型数据自动填充字段
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'role_id', 'password'
    ];

    /**
     * 获得管理员用户
     * @param $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public static function getUsers($data) {
        $name       = array_get($data, 'name', null);
        $pageSize   = array_get($data, 'pageSize', 10);

        $query = self::when($name, function ($query) use ($name) {
            return $query->where('name', 'like', '%'.$name.'%');
        });

        $query = $query->leftJoin(Role::$dbTable, self::$dbTable.'.role_id', '=' , Role::$dbTable.'.id');

        return $query->select(
            self::$dbTable.'.id',
            self::$dbTable.'.name',
            self::$dbTable.'.phone',
            self::$dbTable.'.status',
            self::$dbTable.'.role_id',
            Role::$dbTable.'.role_name',
            self::$dbTable.'.created_at',
            self::$dbTable.'.updated_at'
        )->paginate($pageSize);
    }
}
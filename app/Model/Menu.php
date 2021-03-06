<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class Menu extends BaseModel
{
    protected $table = 'menu';
    public static $dbTable = 'menu';

    /**
     * 获取菜单
     * @return \Illuminate\Support\Collection
     */
    public static function getMenus() {
        return DB::table(self::$dbTable)->select('id', 'name', 'pid', 'depth', 'path', 'icon')
            ->where('status', 0)->orderBy('code')->get();
    }
}
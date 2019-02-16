<?php

namespace App\Model;


class ComplainType extends BaseModel
{
    protected $table = 'complaint_type';

    public static $dbTable = 'complaint_type';

    protected $guarded = [];

    /**
     * 添加
     * @param array $data
     * @return bool
     */
    public static function createType(array $data){
        if (self::create($data)) return true;
        return false;
    }

    /**
     * 修改
     * @param array $data
     * @return bool
     */
    public static function updateType(array $data){
        if(self::updateOrCreate(['id'=>$data['type_id']],array_slice($data,1))) return true;
        return false;
    }

    /**
     * 查询
     * @param int $per_page
     * @return mixed
     */
    public static function selectType($per_page = 10){
        return self::paginate($per_page);
    }

    /**
     * 删除
     * @param array $data
     * @return bool
     */
    public static function deleteType(array $data){
        if (self::whereIn('id', $data)->delete()) return true;
        return false;
    }

}

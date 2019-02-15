<?php

namespace App\Model;


class ComplainType extends BaseModel
{
    protected $table = 'complaint_type';

    public static $dbTable = 'complaint_type';

    protected $guarded = [];

    public static function createType(array $data){
        if (self::create($data)) return true;
        return false;
    }

}

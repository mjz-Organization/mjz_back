<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class StartPageRecord extends BaseModel
{
    protected $table = 'start_page_record';
    private static $dbTable = 'start_page_record';

    public static function getStartPageList($per_page = 5){
        $pageList = DB::table(self::$dbTable)->paginate($per_page);
        return $pageList;
    }

}

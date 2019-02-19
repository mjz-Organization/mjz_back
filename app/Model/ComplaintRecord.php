<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class ComplaintRecord extends BaseModel
{

    protected $table = 'complaint_record';

    public static $dbTable = 'complaint_record';

    protected $guarded = [];

    public static function createRecord(array $data){
        DB::beginTransaction();
        try{
            $img = ImagesList::createImg($data,'complaints');
            $data = array_diff_key($data,['image'=>'']);
            $data['images_id'] = $img->id;
            self::create($data);
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
        }
        return false;
    }

    public static function selectRecord(){

    }

    public static function updateRecord(){

    }

    public static function deleteRecord(){

    }
}

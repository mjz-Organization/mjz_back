<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class CommentList extends BaseModel
{
    protected $table = 'comment_list';

    public static $dbTable = 'comment_list';

    protected $guarded = [];

    public static function createRecord(array $data){
        DB::beginTransaction();
        try{
            $img = ImagesList::createImg($data);
            self::create([
                'record_type'=>$data['record_type'],
                'name'=>$data['name'],
                'images_id'=>$img->id,
                'img_order'=>$img->id,
            ]);
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

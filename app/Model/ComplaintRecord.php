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

    public static function selectRecord($per_page = 10, $select_data = null){
        $pageList = self::join(ComplainType::$dbTable,ComplainType::$dbTable.'.id','=',self::$dbTable.'.complaint_type')
            ->join(ImagesList::$dbTable,ImagesList::$dbTable.'.id','=',self::$dbTable.'.images_id')
            ->select([self::$dbTable.'.id','defendant','plaintiff','complaint_reason','paths','name',self::$dbTable.'.created_at',self::$dbTable.'.updated_at']);
        if ($select_data == null) return $pageList->paginate($per_page);
        return $pageList->where(function ($query) use($select_data) {
            $query->orWhere('name', 'like', '%'.$select_data.'%')->orWhere('content', 'like', '%'.$select_data.'%');
        })->paginate($per_page);
    }

    public static function updateRecord(){

    }

    public static function deleteRecord(){

    }
}

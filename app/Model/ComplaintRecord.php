<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class ComplaintRecord extends BaseModel
{

    protected $table = 'complaint_record';

    public static $dbTable = 'complaint_record';

    protected $guarded = [];

    /**
     * 添加记录
     * @param array $data
     * @return bool
     */
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

    /**
     * 查询记录
     * @param int $per_page
     * @param null $select_data
     * @return mixed
     */
    public static function selectRecord($per_page = 10, $select_data = null){
        $pageList = self::join(ComplainType::$dbTable,ComplainType::$dbTable.'.id','=',self::$dbTable.'.complaint_type')
            ->join(ImagesList::$dbTable,ImagesList::$dbTable.'.id','=',self::$dbTable.'.images_id')
            ->select(DB::raw(self::$dbTable.".id, (case when direction=0 then (select name from ".Customer::$dbTable." where id = defendant) else (select name from ".Student::$dbTable." where id = defendant) end) defendant, (case when direction=0 then (select name from ".Student::$dbTable." where id = plaintiff) else (select name from ".Customer::$dbTable." where id = plaintiff) end) plaintiff, ".self::$dbTable.".complaint_reason, ".ImagesList::$dbTable.".paths, ".ComplainType::$dbTable.".name, ".ComplaintRecord::$dbTable.".created_at, ".ComplaintRecord::$dbTable.".updated_at"));
        if ($select_data == null) return $pageList->paginate($per_page);
        return $pageList->where(function ($query) use($select_data) {
            $query->orWhere('defendant', 'like', '%'.$select_data.'%')->orWhere('plaintiff', 'like', '%'.$select_data.'%');
        })->paginate($per_page);
    }

    /**
     * 批量删除记录
     * @param array $data
     * @return bool
     */
    public static function deleteRecord(array $data){
        $data = transposition($data);
        DB::beginTransaction();
        try{
            self::whereIn('id', $data['record_id'])->delete();
            ImagesList::deleteImg($data['images_id']);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
        }
        return false;
    }

    public static function exportRecord(array $data){

    }
}

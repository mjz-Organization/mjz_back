<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class StartPageRecord extends BaseModel
{
    protected $table = 'start_page_record';

    private static $dpTable = 'start_page_record';
    private static $ilTable = 'images_list';

    public static function getAd($per_page = 5){
        $pageList = DB::table(self::$dpTable)->paginate($per_page);
        return $pageList;
    }

    public static function createAd(array $data){
        $imgName = uploadImg($data['ad_img']);
        if ($imgName == null) return false;
        $urlImg = '/storage/app/images/'.$imgName;
        DB::beginTransaction();
        try{
            $time = time();
            $imgId = DB::table(self::$ilTable)->insertGetId([
                'path'=>$urlImg,
                'content'=>$data['ad_introduce'],
                'created_at' =>$time,
                'updated_at' =>$time
            ]);
            if ($imgId == 0) return false;
            $bool = DB::table(self::$dpTable)->insert([
                'record_type'=>(int)$data['record_type'],
                'ad_name'=>$data['ad_name'],
                'images_id'=>$imgId,
                'img_order'=>$imgId,
                'created_at' =>$time,
                'updated_at' =>$time
            ]);
            if ($bool) DB::commit();
            return $bool;
        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
        return false;
    }

    public static function updateAd(array $date){

    }

    public static function deleteAd(array $date){

    }

}

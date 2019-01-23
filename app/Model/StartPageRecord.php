<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class StartPageRecord extends BaseModel
{
    protected $table = 'start_page_record';

    public static $dpTable = 'start_page_record';

    public static function ModelDB(){
        return DB::table(self::$dpTable);
    }

    /**
     * 分页展示启动页广告
     * @param int $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function selectAd($per_page = 5,$record_type = 0){
        $pageList = ImagesList::ModelDB()
            ->rightJoin(self::$dpTable,ImagesList::$dpTable.'.id','=',self::$dpTable.'.images_id')
            ->where('record_type','=',$record_type)->paginate($per_page);
        return $pageList;
    }

    /**
     * 添加启动页广告
     * @param array $data
     * @param null $time
     * @return bool
     */
    public static function createAd(array $data, $time = null){
        DB::beginTransaction();
        try{
            $imgId = ImagesList::createImgGetId($data,$time);
            if ($imgId == null) return false;
            StartPageRecord::ModelDB()->insert(atTimeSave([
                'record_type'=>$data['record_type'],
                'name'=>$data['name'],
                'images_id'=>$imgId,
                'img_order'=>$imgId,
            ],'create',$time));
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
        }
        return false;
    }

    /**
     * 修改启动页广告
     * @param array $data
     * @param $time
     * @return bool
     */
    public static function updateAd(array $data, $time = null){
        DB::beginTransaction();
        try{
            $updateArr = [
                'id' => [
                    $data['ad_id']
                ],
                'data' => atTimeSave([
                    'record_type' => $data['record_type'],
                    'name'=>$data['name']
                ],'update',$time)
            ];
            ImagesList::updateOnlyImg($data,$time);
            DB::table(self::$dpTable)->whereIn('id',$updateArr['id'])->update($updateArr['data']);
            if ($data['image'] == null || deleteImg($data['path'])){
                DB::commit();
                return true;
            }
        }catch (\Exception $e) {
            DB::rollBack();
        }
        return false;
    }

    public static function deleteAd(array $date, $time = null){

    }

}

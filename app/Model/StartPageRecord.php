<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class StartPageRecord extends BaseModel
{
    protected $table = 'start_page_record';

    private static $dpTable = 'start_page_record';
    private static $ilTable = 'images_list';

    /**
     * 分页展示启动页广告
     * @param int $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function selectAd($per_page = 5,$record_type = 0){
        $pageList = DB::table(self::$ilTable)
            ->rightJoin(self::$dpTable,self::$ilTable.'.id','=',self::$dpTable.'.images_id')
            ->where('record_type','=',$record_type)->paginate($per_page);
        return $pageList;
    }

    /**
     * 添加启动页广告
     * @param array $data
     * @return bool
     */
    public static function createAd(array $data){
        $imgName = uploadImg($data['ad_img']);
        if ($imgName == null) return false;
        DB::beginTransaction();
        try{
            $time = time();
            $imgId = DB::table(self::$ilTable)->insertGetId(atTimeSave([
                'path'=>'/storage/images/'.$imgName,
                'content'=>$data['ad_introduce'],
            ],'create',$time));
            if ($imgId == 0) return false;
            $bool = DB::table(self::$dpTable)->insert(atTimeSave([
                'record_type'=>$data['record_type'],
                'ad_name'=>$data['ad_name'],
                'images_id'=>$imgId,
                'img_order'=>$imgId,
            ],'create',$time));
            if ($bool) DB::commit();
            return $bool;
        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * 修改启动页广告
     * @param array $data
     * @return bool
     */
    public static function updateAd(array $data){
        $imgName = uploadImg($data['ad_img']);
        DB::beginTransaction();
        $time = time();
        try{
            $updateStart = ['update_id' => [
                    $data['ad_id']
                ], 'update_data' => atTimeSave([
                    'record_type' => $data['record_type'],
                    'ad_name'=>$data['ad_name']
                ],'update',$time)];
            $updateImg = ($imgName == null)?['update_id' => [
                        $data['images_id']
                    ], 'update_data' => atTimeSave([
                        'content'=>$data['ad_introduce']
                    ],'update',$time)] : ['update_id' => [
                        $data['images_id']
                    ], 'update_data' => atTimeSave([
                        'path' => '/storage/images/'.$imgName,
                        'content'=>$data['ad_introduce']
                    ],'update',$time)];
            $Ibool = DB::table(self::$ilTable)->whereIn('id',$updateImg['update_id'])->update($updateImg['update_data']);
            $Sbool = DB::table(self::$dpTable)->whereIn('id',$updateStart['update_id'])->update($updateStart['update_data']);
            if ($Ibool&&$Sbool)
                if ($imgName == null){
                    DB::commit();
                    return true;
                }else
                    if(deleteImg($data['path'])){
                        DB::commit();
                        return true;
                    } else return false;
            return false;
        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public static function deleteAd(array $date){

    }

}

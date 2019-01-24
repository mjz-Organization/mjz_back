<?php

namespace App\Model;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class StartPageRecord extends BaseModel
{
    use SoftDeletes;

    protected $table = 'start_page_record';

    public static $dpTable = 'start_page_record';

    protected $guarded = [];

    protected $dates = ['delete_at'];

    /**
     * 分页展示启动页广告
     * @param int $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function selectAd($per_page = 5,$record_type = 0){
        $pageList = ImagesList::rightJoin(self::$dpTable,ImagesList::$dpTable.'.id','=',self::$dpTable.'.images_id')
            ->where('record_type','=',$record_type)->paginate($per_page);
        return $pageList;
    }

    /**
     * 添加启动页广告
     * @param array $data
     * @return bool
     */
    public static function createAd(array $data){
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

    /**
     * 修改启动页广告
     * @param array $data
     * @return bool
     */
    public static function updateAd(array $data){
        DB::beginTransaction();
        try{
            ImagesList::updateOnlyImg($data);
            self::where('id',$data['ad_id'])->update([
                'record_type' => $data['record_type'],
                'name'=>$data['name']
            ]);
            if ($data['image'] == null || deleteImg($data['path'])){
                DB::commit();
                return true;
            }
        }catch (\Exception $e) {
            DB::rollBack();
        }
        return false;
    }

    /**
     * 批量删除
     * @param array $data
     * @return bool
     */
    public static function deleteAd(array $data){
        $data = self::deleteArr($data);
        DB::beginTransaction();
        try{
            self::whereIn('id', $data['ad_id'])->delete();
            ImagesList::deleteImg($data['images_id']);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
        }
        return false;
    }

    /**
     * 构建必要数组
     * @param array $data
     * @return array
     */
    private static function deleteArr(array $data){
        $adId = [];
        $imagesId = [];
        $path = [];
        foreach ($data as $val){
            $adId[] = $val['ad_id'];
            $imagesId[] = $val['images_id'];
            $path[] = $val['path'];
        }
        return[
            'ad_id'=>$adId,
            'images_id'=>$imagesId,
            'path'=>$path
        ];
    }
}

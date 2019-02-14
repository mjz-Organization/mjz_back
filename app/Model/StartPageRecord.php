<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class StartPageRecord extends BaseModel
{

    protected $table = 'start_page_record';

    public static $dbTable = 'start_page_record';

    protected $guarded = [];

    protected $dates = ['delete_at'];

    /**
     * 分页展示启动页广告
     * @param int $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function selectAd($per_page = 10,$record_type = 0,$select_data = null){
        $pageList = ImagesList::rightJoin(self::$dbTable,ImagesList::$dbTable.'.id','=',self::$dbTable.'.images_id')
            ->where('record_type','=',$record_type);
        if ($select_data == null) return $pageList->paginate($per_page);
        return $pageList->where(function ($query) use($select_data) {
            $query->orWhere('name', 'like', '%'.$select_data.'%')->orWhere('content', 'like', '%'.$select_data.'%');
        })->paginate($per_page);
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
     * 改变启动页顺序
     * @param array $data
     * @return bool
     */
    public static function updateOrderAd(array $data){
        DB::beginTransaction();
        try{
            $oldAd = self::find($data['from_id']);
            $newAd = self::find($data['to_id']);
            self::where('id',$oldAd->id)->update(['img_order' => $newAd->img_order]);
            self::where('id',$newAd->id)->update(['img_order' => $oldAd->img_order]);
            DB::commit();
            return true;
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
        $arr = ['ad_id'=>[],'images_id'=>[],'path'=>[]];
        foreach ($data as $val)
            foreach ($arr as $key=>$item)
                $arr[$key][] = $val[$key];
        return $arr;
    }
}

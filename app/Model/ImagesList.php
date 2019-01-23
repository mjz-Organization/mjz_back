<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class ImagesList extends BaseModel
{
    protected $table = 'images_list';

    public static $dpTable = 'images_list';

    public static function ModelDB(){
        return DB::table(self::$dpTable);
    }

    /**
     * 添加图片并返回Id
     * @param array $data
     * @param null $time
     * @return int|null
     */
    public static function createImgGetId(array $data,$time = null){
        $imgName = uploadImg($data['image']);
        if ($imgName) return ImagesList::ModelDB()
            ->insertGetId(atTimeSave([
                'path'=>'/storage/images/'.$imgName,
                'content'=>$data['content'],
                ],'create',$time));
        return null;
    }

    /**
     * 更新单个图片
     * @param array $data
     * @param null $time
     * @return int
     */
    public static function updateOnlyImg(array $data,$time = null){
        $imgName = uploadImg($data['image']);
        $updateArr = ($imgName == null)?[
            'id' => [
                $data['images_id']
            ],
            'data' => atTimeSave([
                'content'=>$data['content']
            ],'update',$time)
        ] : [
            'id' => [
                $data['images_id']
            ],
            'data' => atTimeSave([
                'path' => '/storage/images/'.$imgName,
                'content'=>$data['content']
            ],'update',$time)
        ];
        return ImagesList::ModelDB()->whereIn('id',$updateArr['id'])->update($updateArr['data']);
    }
}

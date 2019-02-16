<?php

namespace App\Model;


class ImagesList extends BaseModel
{

    protected $table = 'images_list';

    public static $dbTable = 'images_list';

    protected $guarded = [];

    /**
     * 添加图片并返回Id
     * @param array $data
     * @return int|null
     */
    public static function createImg(array $data){
        $paths = uploadImg($data['image']);
        if (!empty($paths)) return self::create([
                'paths'=>json_encode($paths),
                'content'=>$data['content'],
                ]);
        return false;
    }

    /**
     * 更新图片
     * @param array $data
     * @return bool
     */
    public static function updateImg(array $data){
        $paths = uploadImg($data['image']);
        $updateArr = (empty($paths))? [
                'content'=>$data['content']
            ] : [
                'paths' => json_encode($paths),
                'content'=>$data['content']
            ];
        if ((self::where('id',$data['images_id'])->update($updateArr)) > 0) return true;
        return false;
    }

    /**
     * 软删除图片
     * @param array $data
     * @return bool
     */
    public static function deleteImg(array $data){
         if((self::whereIn('id', $data)->delete()) > 0) return true;
         return false;
    }
}

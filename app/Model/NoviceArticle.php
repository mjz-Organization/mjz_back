<?php

namespace App\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class NoviceArticle extends BaseModel
{

    use SoftDeletes;

    protected $table = 'novice_article';

    public static $dbTable = 'novice_article';

    protected $guarded = [];

    protected $dates = ['delete_at'];

    /**
     * 插入新手导读内容
     * @param array $data
     * @return bool
     */
    public static function createNovice(array $data){
        if(self::create($data)) return true;
        return false;
    }

    /**
     * 查询新手导读内容
     * @param int $per_page
     * @param int $novice_type
     * @param null $select_data
     * @return mixed
     */
    public static function selectNovice($per_page = 10,$novice_type = 0,$select_data = null){
        $pageList = self::where('novice_type','=',$novice_type);
        if ($select_data == null) return $pageList->paginate($per_page);
        return $pageList->where(function ($query) use($select_data) {
            $query->orWhere('name', 'like', '%'.$select_data.'%')->orWhere('content', 'like', '%'.$select_data.'%');
        })->paginate($per_page);
    }
}

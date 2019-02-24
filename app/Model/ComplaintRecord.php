<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Excel;

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
     * 查询投诉记录数据原型
     * @return mixed
     */
    public static function selectData(){
        return self::join(ComplainType::$dbTable,ComplainType::$dbTable.'.id','=',self::$dbTable.'.complaint_type')
            ->join(ImagesList::$dbTable,ImagesList::$dbTable.'.id','=',self::$dbTable.'.images_id')
            ->select(DB::raw(self::$dbTable.".id, (case when direction=0 then (select name from ".Customer::$dbTable." where id = defendant) else (select name from ".Student::$dbTable." where id = defendant) end) defendant, (case when direction=0 then (select name from ".Student::$dbTable." where id = plaintiff) else (select name from ".Customer::$dbTable." where id = plaintiff) end) plaintiff, ".ComplainType::$dbTable.".name, ".self::$dbTable.".complaint_reason, ".ImagesList::$dbTable.".paths, ".ComplaintRecord::$dbTable.".created_at, ".ComplaintRecord::$dbTable.".updated_at"));
    }

    /**
     * 查询记录
     * @param int $per_page
     * @param null $select_data
     * @return mixed
     */
    public static function selectRecord($per_page = 10, $select_data = null){
        $pageList = self::selectData();
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

    /**
     * 导出投诉记录
     * @param array $data
     */
    public static function exportRecord(array $data){
        $metaData = self::selectData();
        if (isset($data['start_time'])) $metaData->where(self::$dbTable.'.created_at','>=',strtotime($data['start_time']));
        if (isset($data['end_time'])) $metaData->where(self::$dbTable.'.created_at','<',strtotime($data['end_time']));
        if (!empty($metaData)){
            foreach (($metaData->get()->toArray()) as $key=>$val) {
                array_unshift($val,$key+1);
                unset($val['id']);
                unset($val['paths']);
                unset($val['updated_at']);
                $listData[] = $val;
            };
            self::exportExecl($listData,$data);
        }
        return responseToJson(2,'failure');

    }

    /**
     * 组织投诉记录表
     * @param array $data
     */
    public static function exportExecl(array $data,array $time){
        $execlData = array_merge([
            ['投诉记录表'],
            ['编号','投诉者', '被投诉者','投诉类型','投诉原因','投诉时间'],
        ],$data);
        $fileName = '投诉记录表';
        Excel::create(iconv('UTF-8', 'GBK', $fileName.$time['end_time'].'至'.$time['start_time']),
            function($excel) use ($fileName,$execlData){
                $excel->sheet($fileName, function($sheet) use ($execlData){
                    $sheet->setWidth(['A' => 12, 'B' => 16, 'C' => 16, 'D' => 16, 'E' => 25, 'F' => 20])
                        ->setFontFamily('等线')->setFontSize(10)->setHeight(1, 33);
                    $sheet->mergeCells('A1:F1');
                    $sheet->cells('A1', function($cells) {
                        $cells->setAlignment('center');
                        $cells->setFontSize(22);
                    })->cells('A1:F2', function($cells) {
                        $cells->setFontWeight('bold');
                    })->fromArray($execlData,null,'A1',true,false);
                });
            })->export('xlsx');
    }
}

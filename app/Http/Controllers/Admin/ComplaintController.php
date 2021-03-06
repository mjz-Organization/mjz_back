<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ComplainRequest;
use App\Http\Controllers\Controller;
use App\Model\ComplaintRecord;
use App\Model\ComplainType;

class ComplaintController extends Controller
{

    /**
     * 添加投诉类型
     * @param ComplainRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createComplaintType(ComplainRequest $request){
        return ComplainType::createType($request->all())?responseToJson(0,'添加成功'):responseToJson(2,'添加失败');
    }

    /**
     * 修改投诉类型
     * @param ComplainRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateComplaintType(ComplainRequest $request){
        return ComplainType::updateType($request->all())?responseToJson(0,'修改成功'):responseToJson(2,'修改失败');
    }

    /**
     * 查询投诉类型
     * @param ComplainRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectComplaintType(ComplainRequest $request){
        $results = ComplainType::selectType($request->per_page);
        return empty($results->data)?responseToJson(0,'success',$results):responseToJson(2,'failure');
    }

    /**
     * 删除投诉类型
     * @param ComplainRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteComplaintType(ComplainRequest $request){
        $data = $request->all();
        return ComplainType::deleteType($data['ct'])?responseToJson(0,'删除成功'):responseToJson(2,'删除失败');
    }

    /**
     * 添加投诉记录
     * @param ComplainRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createComplaintRecord(ComplainRequest $request){
        return ComplaintRecord::createRecord($request->all())?responseToJson(0,'添加成功'):responseToJson(2,'添加失败');
    }

    /**
     * 查询投诉记录
     * @param ComplainRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectComplaintRecord(ComplainRequest $request){
        $results = ComplaintRecord::selectRecord($request->per_page,$request->select_data);
        return empty($results->data)?responseToJson(0,'success',$results):responseToJson(2,'failure');
    }

    /**
     * 删除投诉记录
     * @param ComplainRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteComplaintRecord(ComplainRequest $request){
        $data = $request->all();
        return ComplaintRecord::deleteRecord($data['cr'])?responseToJson(0,'删除成功'):responseToJson(2,'删除失败');
    }

    /**
     * 导出投诉记录
     * @param ComplainRequest $request
     */
    public function exportComplaintRecord(ComplainRequest $request){
        ComplaintRecord::exportRecord($request->all());
    }

}

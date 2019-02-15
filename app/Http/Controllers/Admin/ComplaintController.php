<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ComplainRequest;
use App\Http\Controllers\Controller;
use App\Model\ComplainType;

class ComplaintController extends Controller
{


    public function createComplaintType(ComplainRequest $request){
        return ComplainType::createType($request->all())?responseToJson(0,'添加成功'):responseToJson(2,'添加失败');
    }

    public function updateComplaintType(ComplainRequest $request){
        return ComplainType::updateType($request->all())?responseToJson(0,'修改成功'):responseToJson(2,'修改失败');
    }

    public function selectComplaintType(ComplainRequest $request){
        $results = ComplainType::selectType($request->per_page);
        return empty($results->data)?responseToJson(0,'success',$results):responseToJson(2,'failure');
    }

    public function deleteComplaintType(ComplainRequest $request){
        $data = $request->all();
        return ComplainType::deleteType($data['ct'])?responseToJson(0,'删除成功'):responseToJson(2,'删除失败');
    }

}

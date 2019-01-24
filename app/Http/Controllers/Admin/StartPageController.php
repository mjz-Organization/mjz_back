<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StartPageRequest;
use App\Model\StartPageRecord;
use App\Http\Controllers\Controller;

class StartPageController extends Controller
{

    /**
     * get 获取启动页广告列表
     * @param StartPageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectStartPageAd(StartPageRequest $request){
        $results = StartPageRecord::selectAd($request->per_page,$request->record_type);
        if (empty($results->data)){
            return responseToJson(0,'success',$results);
        }
        return responseToJson(2,'failure');
    }

    /**
     * post 新增启动页广告
     * @param StartPageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createStartPageAd(StartPageRequest $request){
        $data = $request->all();
        if(StartPageRecord::createAd($data)){
            return responseToJson(0,'添加成功');
        }else{
            return responseToJson(2,'添加失败');
        }
    }

    /**
     * post 修改启动页广告
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateStartPageAd(StartPageRequest $request){
        $data = $request->all();
        if (StartPageRecord::updateAd($data)){
            return responseToJson(0,'修改成功');
        }else{
            return responseToJson(2,'修改失败');
        }
    }

    /**
     * post 删除启动页广告
     * @param StartPageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function deleteStartPageAd(StartPageRequest $request){
        $data = $request->all();
        if (StartPageRecord::deleteAd($data['ad'])){
            return responseToJson(0,'删除成功');
        }else{
            return responseToJson(2,'删除失败');
        }
    }

}
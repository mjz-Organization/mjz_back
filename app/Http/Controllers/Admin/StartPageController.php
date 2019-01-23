<?php

namespace App\Http\Controllers\Admin;

use App\Model\StartPageRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StartPageController extends Controller
{

    /**
     * get 获取启动页广告列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectAd(Request $request){
        $results = StartPageRecord::selectAd($request->per_page,$request->record_type);
        if (empty($results->data)){
            return responseToJson(0,'success',$results);
        }
        return responseToJson(1,'failure');
    }

    /**
     * post 新增启动页广告
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAd(Request $request){
        $data = $request->all();
        if ($this->validator($data)) return responseToJson(1,'数据格式错误');
        if(StartPageRecord::createAd($data)){
            return responseToJson(0,'添加成功');
        }else{
            return responseToJson(1,'添加失败');
        }
    }

    /**
     * post 修改启动页广告
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function alterAd(Request $request){
        $data = $request->all();
        if ($this->validator($data,'update')) return responseToJson(1,'数据格式错误');
        if (StartPageRecord::updateAd($data)){
            return responseToJson(0,'修改成功');
        }else{
            return responseToJson(1,'修改失败');
        }
    }

    private function validator(array $data,$action='create'){
        switch ($action){
            case 'create':
                $rules = [
                    'record_type' => 'required',
                    'ad_name' => 'required|max:50',
                    'ad_img' => 'required|file|image',
                    'ad_introduce' => 'required'
                ];
                break;
            case 'update':
                $rules = [
                    'ad_id' => 'required',
                    'images_id' => 'required',
                    'path' => 'required',
                    'record_type' => 'required',
                    'ad_name' => 'required|max:50',
                    'ad_introduce' => 'required'
                ];
                break;
            case 'delete':
                $rules = [
                    'ad_id' => 'required'
                ];
                break;
        }
        $validator = \Validator::make($data,$rules);
        if($validator->fails()){
            return true;
        }
        return false;
    }

}
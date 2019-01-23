<?php

namespace App\Http\Controllers\Admin;

use App\Model\StartPageRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StartPageController extends Controller
{

    public function getAd(){

    }

    /**
     * post 新增启动页广告
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAd(Request $request){
        $data = $request->all();
        $rules = [
            'record_type' => ['required'],
            'ad_name' => ['required','max:50'],
            'ad_img' => [ 'file','image' ],
            'ad_introduce' => ['required']
        ];
        $validator = \Validator::make($data,$rules);
        if($validator->fails()){
            return responseToJson(1,'数据格式错误');
        }
        if(StartPageRecord::createAd($data)){
            return responseToJson(0,'添加成功');
        }else{
            return responseToJson(1,'添加失败');
        }

    }

}
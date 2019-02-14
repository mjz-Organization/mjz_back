<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Model\CarouselRecord;
use App\Model\NoviceArticle;

class IndexController extends Controller
{

    /**
     * get 获取首页广告列表
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectIndexPageAd(IndexRequest $request){
        $results = CarouselRecord::selectCarouselAd($request->per_page,$request->record_type,$request->select_data);
        if (empty($results->data)){
            return responseToJson(0,'success',$results);
        }
        return responseToJson(2,'failure');
    }

    /**
     * post 新增首页广告
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function createIndexPageAd(IndexRequest $request){
        $data = $request->all();
        if (CarouselRecord::createCarouselAd($data)){
            return responseToJson(0,'添加成功');
        }else{
            return responseToJson(2,'添加失败');
        }
    }

    /**
     * post 修改首页广告
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateIndexPageAd(IndexRequest $request){
        $data = $request->all();
        if (CarouselRecord::updateCarouselAd($data)){
            return responseToJson(0,'修改成功');
        }else{
            return responseToJson(2,'修改失败');
        }
    }

    /**
     * post 修改首页广告顺序
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateOrderIndexPageAd(IndexRequest $request){
        $data = $request->all();
        if (CarouselRecord::updateCarouselOrderAd($data)){
            return responseToJson(0,'修改成功');
        }else{
            return responseToJson(2,'修改失败');
        }
    }

    /**
     * post 删除首页广告
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function deleteIndexPageAd(IndexRequest $request){
        $data = $request->all();
        if (CarouselRecord::deleteCarouselAd($data['ad'])){
            return responseToJson(0,'删除成功');
        }else{
            return responseToJson(2,'删除失败');
        }
    }

    /**
     * post 添加新手导读界面
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNoviceArticle(IndexRequest $request){
        $data = $request->all();
        if (NoviceArticle::createNovice($data)){
            return responseToJson(0,'添加成功');
        }else{
            return responseToJson(2,'添加失败');
        }
    }

    public function updateNoviceArticle(IndexRequest $request){

    }

    /**
     * get 获取新手导读页列表
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectNoviceArticle(IndexRequest $request){
        $results = NoviceArticle::selectNovice($request->per_page,$request->novice_type,$request->select_data);
        if (empty($results->data)){
            return responseToJson(0,'success',$results);
        }
        return responseToJson(2,'failure');
    }

    public function deleteNoviceArticle(IndexRequest $request){

    }

}

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
        return empty($results->data)?responseToJson(0,'success',$results):responseToJson(2,'failure');
    }

    /**
     * post 新增首页广告
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function createIndexPageAd(IndexRequest $request){
        return CarouselRecord::createCarouselAd($request->all())?responseToJson(0,'添加成功'):responseToJson(2,'添加失败');
    }

    /**
     * post 修改首页广告
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateIndexPageAd(IndexRequest $request){
        return CarouselRecord::updateCarouselAd($request->all())?responseToJson(0,'修改成功'):responseToJson(2,'修改失败');
    }

    /**
     * post 修改首页广告顺序
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateOrderIndexPageAd(IndexRequest $request){
        return CarouselRecord::updateCarouselOrderAd($request->all())?responseToJson(0,'修改成功'):responseToJson(2,'修改失败');
    }

    /**
     * post 删除首页广告
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function deleteIndexPageAd(IndexRequest $request){
        $data = $request->all();
        return CarouselRecord::deleteCarouselAd($data['ad'])?responseToJson(0,'删除成功'):responseToJson(2,'删除失败');
    }

    /**
     * post 添加新手导读界面
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNoviceArticle(IndexRequest $request){
        return NoviceArticle::createNovice($request->all())?responseToJson(0,'添加成功'):responseToJson(2,'添加失败');
    }

    /**
     * post 更新新手导读页
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateNoviceArticle(IndexRequest $request){
        return NoviceArticle::updateNovice($request->all())?responseToJson(0,'修改成功'):responseToJson(2,'修改失败');
    }

    /**
     * get 获取新手导读页列表
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectNoviceArticle(IndexRequest $request){
        $results = NoviceArticle::selectNovice($request->per_page,$request->novice_type,$request->select_data);
        return empty($results->data)?responseToJson(0,'success',$results):responseToJson(2,'failure');
    }

    /**
     * post 删除新手导读文章
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteNoviceArticle(IndexRequest $request){
        $data = $request->all();
        return NoviceArticle::deleteNovice($data['na'])?responseToJson(0,'删除成功'):responseToJson(2,'删除失败');
    }

}

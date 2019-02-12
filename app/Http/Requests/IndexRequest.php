<?php

namespace App\Http\Requests;


class IndexRequest extends BaseRequest
{

    protected $rules = [
        'createIndexAd' => [
            'record_type' => 'required|integer',
            'name' => 'required|string|max:50',
            'image' => 'required|file|image',
            'content' => 'required|string'
        ],
        'updateIndexAd' => [
            'ad_id' => 'required|integer',
            'images_id' => 'required|integer',
            'path' => 'required|string',
            'record_type' => 'required|integer',
            'name' => 'required|string|max:50',
            'content' => 'required|string'
        ],
        'selectIndexAd' => [
            'page' => 'required|integer',
            'per_page' => 'required|integer',
            'record_type' => 'required|integer'
        ],
        'deleteIndexAd' => [
            'ad' => 'required|array',
        ],
        'changeOrderIndexAd' => [
            'from_id' => 'required|integer',
            'to_id' => 'required|integer'
        ],
        'createNovice' => [
            'title' => 'required|string|max:45',
            'content' => 'required|string',
            'novice_type' => 'required|integer'
        ],
        'updateNovice' => [

        ],
        'selectNovice' => [

        ],
        'deleteNovice' => [

        ]
    ];

}

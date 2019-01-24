<?php

namespace App\Http\Requests;

class StartPageRequest extends BaseRequest
{
    protected $rules = [
        'selectAd' =>[
            'page' => 'required|integer',
            'per_page' => 'required|integer',
            'record_type' => 'required|integer'
        ],
        'createAd' =>[
            'record_type' => 'required|integer',
            'name' => 'required|string|max:50',
            'image' => 'required|file|image',
            'content' => 'required|string'
        ],
        'updateAd' =>[
            'ad_id' => 'required|integer',
            'images_id' => 'required|integer',
            'path' => 'required|string',
            'record_type' => 'required|integer',
            'name' => 'required|string|max:50',
            'content' => 'required|string'
        ],
        'deleteAd' =>[
            'ad_id' => 'required'
        ]
    ];
}

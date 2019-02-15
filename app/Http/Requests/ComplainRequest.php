<?php

namespace App\Http\Requests;

class ComplainRequest extends BaseRequest
{

    protected $rules = [
        'createType' => [
            'name' => 'required|string|max:50',
            'explain' => 'required|string'
        ],
        'updateType' => [
            'type_id' => 'required|numeric',
            'name' => 'required|string|max:50',
            'explain' => 'required|string'
        ],
        'selectType' => [
            'page' => 'required|integer',
            'per_page' => 'required|integer',
        ],
        'deleteType' => [
            'ct' => 'required|array'
        ]
    ];

}

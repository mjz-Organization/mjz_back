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
        ],
        'createRecord' => [
            'defendant' => 'required|numeric',
            'plaintiff' => 'required|numeric',
            'direction' => 'required|string|max:1',
            'complaint_type' => 'required|numeric',
            'complaint_reason' => 'required|string',
            'images' => 'file|image|array'
        ],
        'selectRecord' => [
            'page' => 'required|integer',
            'per_page' => 'required|integer'
        ],
        'deleteRecord' => [
            'cr' => 'required|array'
        ]
    ];

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartPageRequest extends FormRequest
{

    private $rules = [
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

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $action = explode('/',trim(FormRequest::getPathInfo()));
        $action = $action[count($action)-1];
        foreach ($this->rules as $key => $val){
            if ($action == $key) $rules = $val;
        }
        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * 某一模块中定义的规则二维数组：[事件 => 规则]
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return array_get($this->rules, $this->getAction(), []);
    }

    /**
     * 获取事件
     *
     * @return mixed
     */
    private function getAction() {
        return array_last(explode('/',trim(FormRequest::getPathInfo())));
    }
}

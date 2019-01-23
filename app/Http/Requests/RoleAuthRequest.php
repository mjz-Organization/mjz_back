<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleAuthRequest extends FormRequest
{
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
        return [
            'roleName' => 'required|string|max:20',
            'authArr'  => 'required|array'
        ];
    }
}
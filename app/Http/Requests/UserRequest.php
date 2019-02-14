<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/24
 * Time: 12:18
 */

namespace App\Http\Requests;


class UserRequest extends BaseRequest
{
    protected $rules = [
        'getAdmin' => [
            'userId' => 'required|numeric'
        ],
        'getStudent' => [
            'userId' => 'required|numeric',
        ],
        'getCustomer' => [
            'userId' => 'required|numeric',
        ],
        'getAdmins' => [
            'pageSize' => 'required|numeric'
        ],
        'getStudents' => [
            'pageSize' => 'required|numeric',
            'sex' => 'sometimes|numeric|size:1',
            'auth' => 'sometimes|numeric|size:1',
            'startTime' => 'sometimes|numeric|size:10',
            'endTime' => 'sometimes|numeric|size:10',
        ],
        'getCustomers' => [
            'pageSize' => 'required|numeric',
            'sex' => 'sometimes|numeric|size:1',
            'auth' => 'sometimes|numeric|size:1',
            'startTime' => 'sometimes|numeric|size:10',
            'endTime' => 'sometimes|numeric|size:10',
        ],
        'deleteAdmin' => [
            'idArr' => 'required|array'
        ],
        'deleteStudent' => [
            'idArr' => 'required|array'
        ],
        'deleteCustomer' => [
            'idArr' => 'required|array'
        ],
        'createAdmin' => [
            'name' => 'required|string|max:20',
            'phone' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\\d{8}$/'
            ],
            'password' => 'required|string',
        ],
        'createStudent' => [

        ],
        'createCustomer' => [

        ],
        'updateAdmin' => [
            'userId' => 'required|numeric',
            'name' => 'required|string|max:20',
            'phone' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\\d{8}$/'
            ],
        ],
        'updateStudent' => [

        ],
        'updateCustomer' => [

        ],
    ];
}
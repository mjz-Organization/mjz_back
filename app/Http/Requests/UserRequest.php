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
        'getAdmins' => [
            'pageSize' => 'required|numeric'
        ],
        'getStudents' => [
            'pageSize' => 'required|numeric'
        ],
        'getCustomers' => [
            'pageSize' => 'required|numeric'
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
            'user' => 'required|string|max:20',
            'phone' => [
                'required',
                'regex:/^([1-9]|1[0-2])$/'
            ],
            'password' => 'required|string',
        ],
        'createStudent' => [

        ],
        'createCustomer' => [

        ],
        'updateAdmin' => [

        ],
        'updateStudent' => [

        ],
        'updateCustomer' => [

        ],
    ];
}
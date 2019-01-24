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

        ],
        'getStudents' => [

        ],
        'getCustomers' => [

        ],
        'deleteAdmin' => [

        ],
        'deleteStudent' => [

        ],
        'deleteCustomer' => [

        ],
        'createAdmin' => [

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
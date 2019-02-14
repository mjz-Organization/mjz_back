<?php

namespace App\Http\Requests;

class RoleAuthRequest extends BaseRequest
{
    protected $rules = [
        'getRoles' => [
            'pageSize' => 'required|numeric'
        ],
        'getRoleAndAuth' => [
            'roleId' => 'required|numeric'
        ],
        'createRole' => [
            'roleName' => 'required|string|max:20',
            'authArr'  => 'required|array'
        ],
        'updateRole' => [
            'roleId'   => 'required|numeric|max:20',
            'roleName' => 'required|string|max:20',
            'authArr'  => 'required|array'
        ],
        'deleteRole' => [
            'idArr' => 'required|array'
        ]
    ];
}
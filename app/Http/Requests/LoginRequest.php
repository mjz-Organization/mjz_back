<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
{
    protected $rules = [
        'user' => 'required|string|max:20',
        'password' => 'required|string',
    ];
}

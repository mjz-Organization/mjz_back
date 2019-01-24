<?php

namespace App\Model;

class Student extends BaseUser
{
    protected $table = 'user_student';

    protected $fillable = [
        'name', 'phone', 'head_img', 'birthday', 'height', 'sex', 'address',
        'school', 'major', 'introduce', 'creadit_value', 'promo_code', 'status'
    ];
}

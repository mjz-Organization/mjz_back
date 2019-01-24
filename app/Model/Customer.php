<?php

namespace App\Model;

class Customer extends BaseUser
{
    protected $table = 'user_customer';

    protected $fillable = [
        'account', 'name', 'phone', 'head_img', 'credit_value', 'promo_code', 'status'
    ];
}

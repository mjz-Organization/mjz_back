<?php

namespace App\Model;

class Customer extends BaseUser
{
    protected $table = 'user_customer';
    public static $dbTable = 'user_customer';

    protected $fillable = [
        'account', 'name', 'phone', 'head_img', 'credit_value', 'promo_code', 'status'
    ];


    public static function setSelect($query) {
        return $query->select(
            'id','name','phone','head_id','birthday','height','sex','address', 'school','major',
            'introduce','creadit_value','is_auth','promo_code','status','created_at','updated_at'
        );
    }
}

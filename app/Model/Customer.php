<?php

namespace App\Model;

class Customer extends BaseUser
{
    protected $table = 'user_customer';
    public static $dbTable = 'user_customer';

    protected $fillable = [
        'name', 'address', 'phone', 'head_img', 'password', 'credit_value', 'promo_code', 'status'
    ];

    /**
     * 一对一的关系，一个商家有一个认证信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userAuth() {
        return $this->hasOne('App\Model\EnterpriseAuth', 'customer_id');
    }

    public static function setSelect($query) {
        return $query->select(
            'id','name','sex','phone','head_id','credit_value','is_auth','promo_code','status','created_at','updated_at'
        );
    }
}

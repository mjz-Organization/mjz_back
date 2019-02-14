<?php

namespace App\Model;

class Student extends BaseUser
{
    protected $table = 'user_student';
    public static $dbTable = 'user_student';

    protected $fillable = [
        'name', 'phone', 'password' ,'head_img', 'birthday', 'height', 'sex', 'address',
        'school', 'major', 'introduce', 'creadit_value', 'promo_code', 'status'
    ];

    /**
     * 一对一的关系，一个用户有一个授权信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userAuth() {
        return $this->hasOne('App\Model\UserAuth', 'user_id');
    }

    /**
     * 该方法用于设置查询的字段
     * @param $query
     * @return mixed
     */
    public static function setSelect($query) {
        return $query->select(
            'id','name','phone','head_id','birthday','height','sex','address', 'school','major',
            'introduce','creadit_value','is_auth','promo_code','status','created_at','updated_at'
        );
    }

    public static function getInfoAndAuth($id) {
        $user = self::findOrFail($id);
        $user->userAuth;
        return $user;
    }
}

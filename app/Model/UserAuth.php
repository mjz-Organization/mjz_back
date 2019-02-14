<?php

namespace App\Model;


class UserAuth extends BaseModel
{
    protected $table = 'user_auth';

    /**
     * 模型数据自动填充字段
     * @var array
     */
    protected $fillable = [
        'user_id', 'identity', 'real_name', 'authimg_front', 'authimg_back', 'authimg_hand'
    ];

    /**
     * 创建或者更新用户授权信息
     * @param $data
     */
    public static function createOrUpdateAuth($data) {
        //TODO::获取登录用户的id
//        $data['user_id'] = getUserId();
        $data['user_id'] = 1;
        $studentAuth = array_has($data, 'authId') ? self::findOrFail($data['authId'])->fill($data) : new static($data);
        $studentAuth->save();
    }
}

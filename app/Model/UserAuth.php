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
     * @return UserAuth
     */
    public static function createOrUpdateAuth($data) {
        return array_has($data, 'authId') ? self::updateAuth($data) : self::createAuth($data);
    }

    /**
     * 更新
     * @param $data
     * @return mixed
     */
    private static function updateAuth($data) {
        return self::findOrFail($data['authId'])->fill($data)->save();
    }

    /**
     * 创建
     * @param $data
     * @return bool|static
     */
    private static function createAuth($data) {
        return array_has($data, 'user_id') ? self::create($data)->save() : false;
    }
}
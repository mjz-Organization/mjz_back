<?php

namespace App\Model;


class EnterpriseAuth extends BaseModel
{
    protected $table = 'enterprise_auth';

    /**
     * 模型数据自动填充字段
     * @var array
     */
    protected $fillable = [
        'customer_id', 'real_name', 'identity', 'name', 'number', 'nature_id', 'sum', 'address',
        'describe', 'authimg_front', 'authimg_back', 'authimg_hand', 'authimg_licence'
    ];

    /**
     * 创建或者更新用户授权信息
     * @param $data
     * @return EnterpriseAuth|bool|mixed
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
        return array_has($data, 'customer_id') ? self::create($data)->save() : false;
    }
}

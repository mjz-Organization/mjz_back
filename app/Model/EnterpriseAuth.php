<?php

namespace App\Model;


class EnterpriseAuth extends BaseModel
{
    protected $table = 'enterprise_auth';

    /**
     * 创建或者更新用户授权信息
     * @param $data
     */
    public static function createOrUpdateAuth($data) {
        $enterpriseAuth = array_has($data, 'authId') ? self::findOrFail($data['authId'])->fill($data) : new static($data);
        $enterpriseAuth->save();
    }
}

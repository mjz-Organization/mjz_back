<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseUser extends Authenticatable
{
    use Notifiable,SoftDeletes;

    protected static $dbTable;


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'updated_token_at',
    ];

    /**
     * 获取当前时间
     *
     * @return int
     */
    public function freshTimestamp() {
        return time();
    }

    /**
     * 避免转换时间戳为时间字符串
     *
     * @param DateTime|int $value
     * @return DateTime|int
     */
    public function fromDateTime($value) {
        return $value;
    }

    /**
     * 更新token
     * @return mixed|string
     */
    public function generateToken() {
        $this->api_token = str_random(128);
        $this->updated_token_at = millisecond();
        $this->save();

        return $this->api_token;
    }

    /**
     * 获取用户集合，sex：0-1，auth:0-1，startTime-endTime：创建区间
     * @param $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getUsers($data) {
        $pageSize = array_get($data, 'pageSize', 10);
        $sex    = array_get($data, 'sex');
        $auth   = array_get($data, 'auth');
        $name   = array_get($data, 'name');
        $start  = array_get($data, 'startTime');
        $end    = array_get($data, 'endTime');

        $query = self::when($name, function ($query) use ($name) {
                return $query->where('name', 'like', '%'.$name.'%');
            })->when($sex, function ($query) use ($sex) {
                return $query->where('sex', $sex);
            })->when($auth, function ($query) use ($auth) {
                return $query->where('is_auth', $auth);
            });

        //empty($start)为假 且empty($end)为假（start和end同时存在），则执行whereBetween
        (empty($start) || empty($end)) || ($query = $query->whereBetween('created_at', [$start, $end]));

        return static::setSelect($query)->paginate($pageSize);
    }

    /**
     * 删除用户
     * @param $idArr
     */
    public static function deleteUser($idArr) {
        self::whereIn('id', $idArr)->delete();
    }

    /**
     * 创建或者更新用户
     * @param $data
     */
    public static function createOrUpdateUser($data) {
        $data = self::hashPassword($data);
        $admin = null;
        if (array_has($data, 'userId')) {
            $admin = self::findOrFail($data['userId'])->fill($data);
        } else {
            $data['promo_code'] = self::getPromoCode();
            $admin = new static($data);
        }
        $admin->save();
    }

    /**
     * 如果有密码给密码加密
     * @param $data
     * @return mixed
     */
    private static function hashPassword($data) {
        if (array_has($data, 'password')) {
            $data['password'] = bcrypt($data['password']);
        }
        return $data;
    }

    /**
     * 获取邀请码
     * @return string
     */
    private static function getPromoCode() {
        return bcrypt(time().str_random(5));
    }
}
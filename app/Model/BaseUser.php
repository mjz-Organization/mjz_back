<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseUser extends Authenticatable
{
    use Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user','password', 'phone', 'status'
    ];

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
        $admin = array_has($data, 'userId') ? self::find($data['userId'])->fill($data) : new self($data);
        $admin->save();
    }

    private static function hashPassword($data) {
        if (array_has($data, 'password')) {
            $data['password'] = bcrypt($data['password']);
        }
        return $data;
    }
}
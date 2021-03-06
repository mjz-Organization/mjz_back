<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/15
 * Time: 8:43
 */

/**
 * 固定的返回格式
 * @param int $code 0:请求成功; 1:认证失败; 其他：其他
 * @param string $msg
 * @param null $result
 * @return \Illuminate\Http\JsonResponse
 */
function responseToJson($code = 0, $msg = '', $result = null) {
    $res["code"] = $code;
    $res["msg"] = $msg;
    if (!empty($result)) {
        $res["result"] = $result;
    }
    return response()->json($res);
}

/**
 * 获得毫秒级的时间戳
 * @return float
 */
function millisecond() {
    return ceil(microtime(true) * 1000);
}

/**
 * 给定时间与时间间隔，计算当前时间与给定时间的时间差是否大于给定的时间间隔
 * @param $time :给定的时间 毫秒级
 * @param $interval :给定的时间间隔（分钟）默认10分钟
 * @return bool 大于：true；小于：false
 */
function isTimeGreater($time, $interval = 10) {
    $int = millisecond() - $time;
    $interval = $interval * 60 * 1000;
    return $int > $interval ? true : false;
}

/**
 * 上传图片
 * @param $image
 * @param string $drive
 * @return string|null
 */

function uploadImg($files, $drive='images') {
    $imgs = [];
    foreach (changeToArray($files) as $file){
        if (!empty($file)) {
            $imgName = date('YmdHis') . uniqid() . '.' . $file->getClientOriginalExtension();
            $bool= Storage::disk($drive)->put($imgName,file_get_contents($file->getRealPath()));
            if ($bool) $imgs[]= '/storage/'.$drive.'/'.$imgName;
        }
    }
    return $imgs;
}

/**
 * 删除图片
 * @param $path
 * @param string $drive
 * @return mixed
 */
function deleteImg($paths, $drive='images') {
    foreach (changeToArray($paths) as $path){
        if(!(Storage::disk($drive)->delete(array_last(explode('/',trim($path)))))) return false;
    }
    return true;
}

/** updated_at/created_at 自动维护
 * @param array $data
 * @param string $action
 * @param null $time
 * @return array
 */
function atTimeSave(array $data, $action = 'create', $time = null){
    if ($time == null) $time = time();
    switch ($action) {
        case 'create':
            $atTime = [
                'updated_at' => $time,
                'created_at' => $time
            ];
            break;
        case 'update':
            $atTime = [
                'updated_at' => $time
            ];
            break;
    }
    if (count($data) == count($data,1)) {
        return array_merge($data,$atTime);
    }
    foreach ($data as $key => $value) {
        $data[$key] = array_merge($value,$atTime);
    }
    return $data;
}

/**
 * RSA 解密算法
 * @param $ciphertext
 * @return string
 */
function decryptRSA($ciphertext)
{
    $private_key = file_get_contents(base_path('keys/rsa_private_key.pem'));
    $pi_key = openssl_pkey_get_private($private_key);
    $decrypted = "";
    openssl_private_decrypt(base64_decode($ciphertext), $decrypted, $pi_key);
    return $decrypted;
}
/**
 * 获得当前登录用户的id
 * @return bool|string
 */
function getUserId() {
    $user = session('user');
    return empty($user) ? 0 : $user->toArray()['id'];
}

/**
 * php二维数组转置
 * @param array $data
 * @return array
 */
function transposition(array $data) {
    $arr = [];
    array_filter($data, function($val) use (&$arr){
        foreach($val as $k=>$v) $arr[$k][] = $v;
    });
    return $arr;
}

/**
 * 返回数组
 * @param $value
 * @return array
 */
function changeToArray($value){
    if(!is_array($value)) {
        $arr = [];
        $arr[] = $value;
        return $arr;
    }
    return $value;
}
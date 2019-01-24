<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/24
 * Time: 11:47
 */

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use App\Model\Student;
use App\Model\Customer;
use App\Http\Requests\UserRequest;

class UserController {

    public function getUsers(UserRequest $request) {
        $pageSize = $request->input('pageSize');
        switch ($request->input('userType')) {
            case 'admin' :
                return responseToJson(0, 'success', Admin::paginate($pageSize));
            case 'student' :
                return responseToJson(0, 'success', Student::paginate($pageSize));
            case 'customer' :
                return responseToJson(0, 'success', Customer::paginate($pageSize));
            default :
                return responseToJson(2, '请求用户类型错误');
        }
    }

    public function deleteUsers(UserRequest $request) {
        $idArr = $request->input('idArr');
        switch ($request->input('userType')) {
            case 'admin' :
                return responseToJson(0, 'success', Admin::deleteUser($idArr));
            case 'student' :
                return responseToJson(0, 'success', Student::deleteUser($idArr));
            case 'customer' :
                return responseToJson(0, 'success', Customer::deleteUser($idArr));
            default :
                return responseToJson(2, '请求用户类型错误');
        }
    }

    public function createOrUpdateUser(UserRequest $request) {
        $data = $request->all();
        switch ($request->input('userType')) {
            case 'admin' :
                return responseToJson(0, 'success', Admin::createOrUpdateUser($data));
            case 'student' :
                return responseToJson(0, 'success', Student::createOrUpdateUser($data));
            case 'customer' :
                return responseToJson(0, 'success', Customer::createOrUpdateUser($data));
            default :
                return responseToJson(2, '请求用户类型错误');
        }
    }
}
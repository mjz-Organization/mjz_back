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

    public function getUser(UserRequest $request) {
        switch ($request->input('userType')) {
            case 'admin' :
                return responseToJson(0, 'success', Admin::find($request->input('id')));
            case 'student' :
                return responseToJson(0, 'success', Student::find($request->input('id')));
            case 'customer' :
                return responseToJson(0, 'success', Customer::find($request->input('id')));
            default :
                return responseToJson(2, '请求用户类型错误');
        }
    }

    public function getUsers(UserRequest $request) {
        switch ($request->input('userType')) {
            case 'admin' :
                return responseToJson(0, 'success', Admin::getUsers($request->all()));
            case 'student' :
                return responseToJson(0, 'success', Student::getUsers($request->all()));
            case 'customer' :
                return responseToJson(0, 'success', Customer::getUsers($request->all()));
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
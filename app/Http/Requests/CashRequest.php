<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/2/12
 * Time: 15:05
 */

namespace App\Http\Requests;


class CashRequest extends BaseRequest {
    protected $rules = [
        'getCashRecords' => [
            'cashType' => 'required|numeric'
        ],
    ];
}
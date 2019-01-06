<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/24
 * Time: 23:05
 */

namespace app\api\validate;


class SignNew extends BaseValidate
{
    protected $rule=[
        'name' => 'require|isNotEmpty',
        'sex' => 'require|isNotEmpty',
        'age' => 'require|isNotEmpty',
        'status' => 'require|isNotEmpty',
        'race' => 'require|isNotEmpty',
        'marriage' => 'require|isNotEmpty',
        'mobile' => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city' => 'require|isNotEmpty',
        'country' => 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty',
        'summary' => 'require|isNotEmpty',
        'main_img_url'=>'require|isNotEmpty',
    ];
}
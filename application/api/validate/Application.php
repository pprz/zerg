<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/16
 * Time: 23:36
 */

namespace app\api\validate;


class Application extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile' => 'require|isMobile',
        'section' => 'require|isNotEmpty',
        'reason' => 'require|isNotEmpty',
        'delete_time' => 'require|isNotEmpty',
        'update_time' => 'require|isNotEmpty',
        'days' => 'require|isNotEmpty'
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/17
 * Time: 1:01
 */

namespace app\api\validate;


class AsignVocation extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];
}
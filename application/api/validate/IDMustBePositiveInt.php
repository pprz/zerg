<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/27
 * Time: 10:04
 */

namespace app\api\validate;


class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];

//    protected function isPositiveInteger($value, $rule='', $data='', $field='')
//    {
//        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
//            echo $value;
//            return true;
//        }
//        return $field . '必须是正整数';
//    }
}
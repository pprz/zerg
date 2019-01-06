<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/10
 * Time: 0:00
 */

namespace app\lib\exception;


class WechatException extends BaseException
{
    public $code = 400;
    public $msg = 'wechat unknown error';
    public $errorCode = 999;
}
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/10
 * Time: 10:49
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code=401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;
}
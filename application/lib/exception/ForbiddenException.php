<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/16
 * Time: 20:56
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}
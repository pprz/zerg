<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/15
 * Time: 18:35
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code=404;
    public $msg='用户不存在';
    public $errorCode=60000;
}
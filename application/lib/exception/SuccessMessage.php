<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/15
 * Time: 19:33
 */

namespace app\lib\exception;


class SuccessMessage extends BaseException
{
    public $code = 201;
    public $msg = 'ok';
    public $errorCode = 0;
}
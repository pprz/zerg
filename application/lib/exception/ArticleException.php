<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/8
 * Time: 13:50
 */

namespace app\lib\exception;


class ArticleException extends BaseException
{
    public $code = 404;
    public $msg = '指定的文章不存在，请检查参数';
    public $errorCode = 20000;
}
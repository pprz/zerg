<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/26
 * Time: 9:35
 */

namespace app\lib\exception;


class ImageException extends BaseException
{
    public $code = 404;
    public $msg = '照片不合格，请上传小于2M的jpg png格式图片';
    public $errorCode = 90000;
}
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/5
 * Time: 11:51
 */

namespace app\api\model;


use think\Model;

class Image extends BaseModel
{
    protected $hidden = ['delete_time', 'id', 'from','update_time'];

    //TP5读取器 get+需要读取的字段的名字+Attr $value是读取字段的值 $data当前模型的所有字段
    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}
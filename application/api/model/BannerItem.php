<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/4
 * Time: 11:24
 */

namespace app\api\model;


use think\Model;

class BannerItem extends BaseModel
{
    protected $hidden = ['id', 'img_id', 'banner_id', 'delete_time'];
    //一对一 有外键的一方用belongto
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }
}
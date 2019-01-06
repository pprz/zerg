<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/28
 * Time: 10:11
 */

namespace app\api\model;


use think\Db;
use think\Model;

class Banner extends BaseModel
{
   //指定表
    // protected $table='';

    //关联模型 在banner里调用bannerItem模型 一对多
    // 多对对需要第三章表 参见theme product
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }
    public static function getBannerByID($id){
        $banner=self::with(['items','items.img'])->find($id);
        return $banner;
    }
}
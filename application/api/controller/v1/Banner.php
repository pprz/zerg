<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/26
 * Time: 23:28
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\MissException;

class Banner
{
    /**
     * 获取指定id的banner信息
     *
     * @url /banner/:id
     * @id banner的id号
     * @throws MissException
     */
    public function getBanner($id){
//        echo $id;
        $validate=new IDMustBePositiveInt();
        $validate->goCheck();
        $banner=BannerModel::getBannerByID($id);
        if(!$banner){
            throw new MissException([
                'msg'=>'请求banner不存在',
                'errorCode'=>40000
            ]);
        }
        return $banner;

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/26
 * Time: 23:28
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;

class Banner
{
    /**
     * 获取指定id的banner信息
     *
     * @url /banner/:id
     * @id banner的id号
     */
    public function getBanner($id){
//        echo $id;
        $validate=new IDMustBePositiveInt();
        $validate->goCheck();
    }
}
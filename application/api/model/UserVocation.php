<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/16
 * Time: 23:49
 */

namespace app\api\model;




class UserVocation extends BaseModel
{
//    protected $hidden =[ 'user_id'];

    public static function getSingalVocation($id){
        $vocation= self::find($id);
        return $vocation;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/8
 * Time: 19:33
 */

namespace app\api\model;


class User extends BaseModel
{
    protected $autoWriteTimestamp = true;

    public function vocation(){
        return $this->hasMany('UserVocation','user_id','id');
    }

    public function address()
    {
        //在没有外键的一方定义一对一关系 用hasOne
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public function sign(){
        return $this->hasOne('UserSign','user_id','id');
    }


    /**
     * 用户是否存在
     * 存在返回uid，不存在返回0
     */
 public static function getByOpenID($openid){
     $user=self::where('openid','=',$openid)->find();
     return $user;
 }
    //插入一条user记录

    public static function insertUser($openid){
     $user=self::create([
         'openid'=>$openid
     ]);

     return $user->id;
 }




}
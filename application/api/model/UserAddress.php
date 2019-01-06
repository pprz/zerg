<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/15
 * Time: 20:02
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden =['id', 'delete_time', 'user_id'];
}
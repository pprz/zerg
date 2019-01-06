<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/24
 * Time: 23:55
 */

namespace app\api\model;


class UserSign extends BaseModel
{
    protected $hidden =['id', 'delete_time', 'user_id'];
}
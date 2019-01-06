<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/14
 * Time: 10:04
 */

namespace app\api\model;


class ArticleProperty extends BaseModel
{
    protected $hidden=['article_id', 'delete_time', 'id'];
}
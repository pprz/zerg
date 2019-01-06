<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/14
 * Time: 0:30
 */

namespace app\api\model;


class ArticleImage extends BaseModel
{
    protected $hidden = ['img_id', 'delete_time', 'article_id','update_time'];
    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}
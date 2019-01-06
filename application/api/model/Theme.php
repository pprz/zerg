<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/6
 * Time: 23:33
 */

namespace app\api\model;


class Theme extends BaseModel
{
    // 多对多需要第三章表 参见theme product
    //theme与主题img之间是一对一关系
    protected $hidden = ['delete_time','update_time', 'topic_img_id', 'head_img_id'];
    public function topicImg(){
        //外键在当前表用belongsTo 否则用hasOne
        return $this->belongsTo('Image','topic_img_id','id');
    }

    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }

    //多对多 belongsToMany('Product','theme_product','product_id')
    public function articles(){
        return $this->belongsToMany('Article','theme_article','article_id','theme_id');
    }

    public static function getThemeWithArticles($id){
        $theme=self::with('articles,topicImg,headImg')->find($id);
        return $theme;
    }

}
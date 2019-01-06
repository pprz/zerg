<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/8
 * Time: 10:34
 */

namespace app\api\model;


class Article extends BaseModel
{
    protected $autoWriteTimestamp = 'datetime';
    //pivot多对多关系中间表
    protected $hidden = [
        'delete_time', 'main_img_id', 'pivot', 'from', 'category_id',
        'create_time', 'update_time'];

    /**
     * 图片属性
     */
    public function imgs()
    {
        return $this->hasMany('ArticleImage', 'article_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany('ArticleProperty', 'article_id', 'id');
    }

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    //指定数量 排序
    public static function getMostRecent($count){
        $articles=self::limit($count)->order('create_time desc')->select();
        return $articles;
    }

    public static function getArticlesByCategoryID($categoryID){
        $article=self::where('category_id','=',$categoryID)->select();
        return $article;
    }

    public static function getArticleDetail($id){
        //按照imgUrl模型order字段排序
//        $article=self::with(['imgs.imgUrl'])
        $article=self::with([
            'imgs'=>function($query){
                $query->with(['imgUrl'])
                ->order('order','asc');
            }
        ])
        ->with(['properties'])
        ->find($id);
        return $article;
    }

}
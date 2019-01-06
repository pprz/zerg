<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/8
 * Time: 13:15
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Article as ArticleModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ArticleException;

class Article
{
    public function getRecent($count=14){
//        return $count;
        (new Count())->goCheck();
        $articles=ArticleModel::getMostRecent($count);
        if($articles->isEmpty()){
            throw new ArticleException();
        }
        //数据集 在database.php中修改查询返回类型为collection
//        $collection=collection($articles);
        $articles=$articles->hidden(['summary']);
        return $articles;
    }

    public function getAllInCategory($id){
        (new IDMustBePositiveInt())->goCheck();
        $articles=ArticleModel::getArticlesByCategoryID($id);
        if($articles->isEmpty()){
            throw new ArticleException();
        }
        $articles=$articles->hidden(['summary']);
        return $articles;
    }

    public function getOne($id){
        (new IDMustBePositiveInt())->goCheck();
        $article=ArticleModel::getArticleDetail($id);
        if(!$article){
            throw new ArticleException();

        }
        return $article;
    }

}
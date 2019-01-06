<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/8
 * Time: 16:04
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllCategories(){
        $categories=CategoryModel::with('img')->select();
        if($categories->isEmpty()){
            throw new CategoryException();
        }
        return $categories;
    }
}
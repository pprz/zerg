<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//Banner
Route::rule('api/v1/banner/:id','api/v1.Banner/getBanner');

//Theme
Route::get('api/v1/theme','api/v1.Theme/getSimpleList');
Route::get('api/v1/theme/:id','api/v1.Theme/getComplexOne');

//Article 路由分组
Route::group('api/v1/article',function (){
Route::get('/recent','api/v1.Article/getRecent');
Route::get('/by_category','api/v1.Article/getAllInCategory');
Route::get('/:id','api/v1.Article/getOne',[],['id'=>'\d+']);
});
//Category
Route::get('api/v1/category/all','api/v1.Category/getAllCategories');

//Token
Route::post('api/v1/token/user', 'api/v1.Token/getToken');
Route::post('api/v1/token/manager', 'api/v1.Token/getManagerToken');
Route::post('api/v1/token/staff', 'api/v1.Token/getStaffToken');
Route::post('api/v1/token/verify','api/v1.Token/verifyToken');
Route::get('api/v1/token/isStaffToken','api/v1.Vocation/isAboveStaff');
Route::get('api/v1/token/getCurrentRole','api/v1.Token/getCurrentRole');
//Address
Route::post('api/v1/address', 'api/v1.Address/createOrUpdateAddress');

//Sign
Route::post('api/v1/sign', 'api/v1.Signin/createOrUpdateSign');

Route::post('api/v1/sign/imgUpdate', 'api/v1.Signin/imgUpdate');

//vocation
Route::post('api/v1/apply_for_vocation', 'api/v1.Vocation/applicationForVocation');
Route::get('api/v1/vocation/:id', 'api/v1.Vocation/assignVocation');
Route::get('api/v1/cannel_vocation/:id', 'api/v1.Vocation/cannelVocation');
Route::get('api/v1/vocation/getAllVocation', 'api/v1.Vocation/getAllVocation');
Route::get('api/v1/vocation/getMyVocation', 'api/v1.Vocation/getMyVocation');
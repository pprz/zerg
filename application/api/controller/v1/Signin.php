<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/24
 * Time: 20:38
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\validate\SignNew;
use app\api\service\Token as TokenService;
use app\lib\exception\ImageException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class signin extends BaseController
{
    public function createOrUpdateSign(){
        $validate=new SignNew();
        $validate->goCheck();

        $uid=TokenService::getCurrentUid();
        $user=UserModel::get($uid);
        if(!$user){
            throw new UserException([
                'code' => 404,
                'msg' => '用户收获地址不存在',
                'errorCode' => 60001
            ]);
        }
        $userSign=$user->sign;
        $data=$validate->getDataByRule(input('post.'));

        if(!$userSign){
            $user->sign()->save($data);
        }else{
            $user->sign->save($data);
        }
        return json(new SuccessMessage(),201);

    }

    public function imgUpdate(){

        $file=request()->file('image');
        $info=$file->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->rule('uniqid')->move(UPLOAD_PATH );

        if(!$info){
        return new ImageException();
        }
        return $info->getFilename();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/16
 * Time: 23:28
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\UserVocation as vocationModel;
use app\api\model\UserVocation;
use app\api\validate\Application;
use app\api\service\Token as TokenService;
use app\api\model\User;
use app\api\validate\AsignVocation;
use app\api\validate\IDMustBePositiveInt;
use app\lib\enum\ScopeEnum;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Db;

class Vocation extends BaseController
{
    protected $beforeActionList = [
        'checkStaffScope' => ['only' => 'applicationForVocation'],
        'checkManagerScope'=>['only'=>'assignVocation,getAllVocation']
    ];

    public function getMyVocation(){
        $uid=TokenService::getCurrentUid();
        if(!$uid){
            throw new UserException([
                'code' => 404,
                'msg' => '不存在该条请假记录',
                'errorCode' => 60001
            ]);
        }

        $vocation=Db::table('user_vocation')->
                    where('user_id',$uid)->
                    where('delete_flag',null)->
                    select();

        return $vocation;

    }
    public function getAllVocation(){
        $vocations=Db::table('user_vocation')->select();
        if(empty($vocations)){
            throw new UserException([
                'msg'=>'没有请假记录'
            ]);
        }
        return $vocations;
    }

    public function isAboveStaff(){
        $scope=TokenService::getCurrentTokenVar('scope');
        if($scope<ScopeEnum::staff){
            return false;
        }
        return true;

    }

    public function cannelVocation($id){
        (new IDMustBePositiveInt())->goCheck();
        $uid=TokenService::getCurrentUid();
        $user=User::get($uid);
        if(!$user){
            throw new UserException([
                'code' => 404,
                'msg' => '该用户不存在',
                'errorCode' => 60001
            ]);
        }
        Db::table('user_vocation')->
        where('id',$id)->
        update(['delete_flag'=>'1']);
        return new SuccessMessage();
    }

    public function assignVocation($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $vocation=Db::table('user_vocation')->
                    where('id',$id)->
                    where('delete_flag',null)->where('asignee',null)->find();

        $scope=TokenService::getCurrentTokenVar('scope');
        if($scope<ScopeEnum::manager){
            throw new UserException([
                'code' => 404,
                'msg' => '用户权限不够批准请假',
                'errorCode' => 60001
            ]);
        }
        if(!$vocation){
            throw new UserException([
                'msg'=>'没有找到该条请假记录'
            ]);
        }else{
            Db::table('user_vocation')->
            where('id',$id)->
            update(['asignee'=>'批准']);
            return new SuccessMessage();
        }

    }

    public function applicationForVocation(){
        $validate=new Application();
        $validate->goCheck();

        $uid=TokenService::getCurrentUid();
        $user=User::get($uid);
        if(!$user){
            throw new UserException([
                'code'=>404,
                'msg'=>'获取用户信息错误',
                'errorCode'=>70001
            ]);
        }
        $userVocation=new vocationModel();
        $data=$validate->getDataByRule(input('post.'));
       $data['user_id']=$uid;
//        if(!$userVocation){
//            $user->vocation()->save($data);
//        }  else
//        {
//            $user->vocation->save($data);
//        }
        $userVocation->save($data);
        return new SuccessMessage();

    }
}
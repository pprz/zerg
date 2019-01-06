<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/8
 * Time: 19:25
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;
use app\lib\exception\ParameterException;
use app\api\service\Token as TokenService;
class Token
{
    public function getToken($code=''){
        (new TokenGet())->goCheck();
        $ut=new UserToken($code);
        $token=$ut->get();
        return [
            'token'=>$token
        ];
    }

    public function getCurrentRole(){
        $role=TokenService::getCurrentTokenVar('scope');
        return $role;
    }

    public function getManagerToken($code=''){
    (new TokenGet())->goCheck();
    $manager=new UserToken($code);
    $token=$manager->getManagerToken();
    return[
        'token'=>$token
    ];
}

    public function getStaffToken($code=''){
        (new TokenGet())->goCheck();
        $staff=new UserToken($code);
        $token=$staff->getStaffToken();
        return[
            'token'=>$token
        ];
    }

    public function verifyToken($token=''){
        if(!$token){
            throw new ParameterException([
                'token不允许为空'
            ]);
        }
        $valid=TokenService::verifyToken($token);
        return [
            'isValid'=>$valid
        ];
    }
}
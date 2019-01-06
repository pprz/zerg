<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/8
 * Time: 19:34
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WechatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code=$code;
        $this->wxAppID=config('wx.app_id');
        $this->wxAppSecret=config('wx.app_secret');
        $this->wxLoginUrl=sprintf(config('wx.login_url'),
                $this->wxAppID,$this->wxAppSecret,$this->code);
    }
    //在common.php中定义的方法为全局方法 可以在任何地方调用
    public function get(){
        $result=curl_get($this->wxLoginUrl);
        //将微信服务器生成的openid session等信息封装成json格式
        $wxResult=json_decode($result,true);
        if(empty($wxResult)){
            throw new Exception('获取session_key及openid时异常，微信内部错误！');
        }else{
            $loginFail=array_key_exists('errcode',$wxResult);
            if($loginFail){
                $this->processLoginError($wxResult);
            }else{
                return $this->grantToken($wxResult,ScopeEnum::User);
            }
        }
    }

    //生成managerToken
    public function getManagerToken(){
    $result=curl_get($this->wxLoginUrl);
    $wxResult=json_decode($result,true);
    if(empty($wxResult)){
        throw new Exception('获取managertoken的session_key及openid时异常，微信内部错误！');
    }else{
        $loginFail=array_key_exists('errorCode',$wxResult);
        if($loginFail){
            $this->processLoginError($wxResult);
        }else{
            return $this->grantToken($wxResult,ScopeEnum::manager);
        }
    }
}

    public function getStaffToken(){
        $result=curl_get($this->wxLoginUrl);
        $wxResult=json_decode($result,true);
        if(empty($wxResult)){
            throw new Exception('获取managertoken的session_key及openid时异常，微信内部错误！');
        }else{
            $loginFail=array_key_exists('errorCode',$wxResult);
            if($loginFail){
                $this->processLoginError($wxResult);
            }else{
                return $this->grantToken($wxResult,ScopeEnum::staff);
            }
        }
    }

    /**
     * 颁发令牌
     * 拿到openid
     *查询数据库，当前openid是否存在 如存在不处理 不存在新增一条用户记录
     * 生成令牌，准备缓存数据。写入缓存
     * 把令牌返回到客户端去
     * key:token value:$wxResult,uid,scope(权限级别)
     */
    private function grantToken($wxResult,$scope){
        $openid=$wxResult['openid'];
        $user=UserModel::getByOpenID($openid);
        if($user){
            $uid=$user->id;
        }else{
            $uid=UserModel::insertUser($openid);
        }
        $cachedValue=$this->prepareCachedValue($wxResult,$uid,$scope);
        $token=$this->saveToCache($cachedValue);
        return $token;
    }

    /**
     * @param $cachedValue
     * @return string
     * @throws TokenException
     * 生成令牌，并存入缓存
     */
    private function saveToCache($cachedValue){
        $key=self::generateToken();
        $value=json_encode($cachedValue);
        $expore_in=config('setting.token_expore_in');
        $request=cache($key,$value,$expore_in);
        if(!$request){
            throw new TokenException([
                'msg'=>'服务器缓存异常',
                'errorCode'=>10005
            ]);
        }
        return $key;
    }

    /**
     * 准备缓存数据
     */
    private function prepareCachedValue($wxResult,$uid,$scope){
        $cacheVaule=$wxResult;
        $cacheVaule['uid']=$uid;
        $cacheVaule['scope']=$scope;
        return $cacheVaule;
    }


    private function processLoginError($wxResult){
        throw new WechatException([
            'msg'=>$wxResult['errmsg'],
            'errorCode'=>$wxResult['errcode']
        ]);
    }
}
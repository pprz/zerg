<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/16
 * Time: 20:51
 */

namespace app\api\controller;


use app\api\service\Token;
use think\Controller;

class BaseController extends Controller
{
    //用户专有权限
    protected function checkExclusiveScope(){
        Token::needExclusiveScope();
    }

    //初级权限
    protected function checkPrimaryScope(){
        Token::needPrimaryScope();
    }

    protected function checkStaffScope(){
        Token::needStaffScope();
    }


    protected function checkSuperScope()
    {
        Token::needSuperScope();
    }

    protected function checkManagerScope()
    {
        Token::needManagerScope();
    }


}
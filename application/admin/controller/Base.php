<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;

class Base extends Controller
{
    public function _initialize()//初始化检测session,没有session则自动跳到登录页面
    {
        $uname = Session::get('uname');
        if($uname == ""){
            $this->redirect('Login/index');
        }
    }
}

<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;

class Login extends Controller
{
    public function index(){
    	return $this->fetch();
    }
    public function login(Request $request){
    	$request = Request::instance();
    	$username = $request->param('username');
    	$password = $request->param('password');
    	$verify = $request->param('verify');
    	if($username == "admin" && $password == "admin"){
    		Session::set('uname',$username);
    		$this->success('登录成功','Index/index');
    	}else{
    		$msg = "账号密码不匹配";
    		$this->error($msg);
    	}
    }
}

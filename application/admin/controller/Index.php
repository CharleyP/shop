<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;

class Index extends Base
{
    public function hello($name = 'thinkphp')
    {   
        return $this->fetch();
    }
    public function index(){
        $uname = Session::get('uname');
    	return $this->fetch();
    }
    public function welcome(){
    	return $this->fetch();
    }
}

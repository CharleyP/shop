<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;
use think\Db;
use app\admin\model\Priv;


class Index extends Base
{
    public function hello($name = 'thinkphp')
    {   
        return $this->fetch();
    }
    public function index(){
        /*$priv = new Priv();
        $list = $priv->where('priv_id','1')->find()->nodes;*/
        /*foreach ($list as $key => $value) {
            $list[$key]['']
        }*/
        //dump($list);
        $list = Db::table('priv_node')
                    ->alias('a')
                    ->join('node b','a.node_id=b.node_id','LEFT')
                    ->where('level',1)
                    ->select();
        foreach ($list as $key => $value) {
            $id = $list[$key]['node_id'];
            $list1 = Db::table('priv_node')
                    ->alias('a')
                    ->join('node b','a.node_id=b.node_id','LEFT')
                    ->where('parent',$id)
                    ->select();
            $list[$key]['son'] = $list1;
        }
       
        //$list = genTree($list);
        dump($list);
        $this->assign('list',$list);
        $uname = Session::get('uname');
    	return $this->fetch();
    }
    public function welcome(){
    	return $this->fetch();
    }
}

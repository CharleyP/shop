<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Admin;
use app\admin\model\Priv;
use app\admin\model\Node;
use think\Db;

class Administrator extends Base{
	public function priv_list(){
		$priv = new Priv;
		$list = $priv->getPrivList();
		$this->assign('list',$list);
		return $this->fetch();
	}
	public function priv_add()
	{
		$node = new Node;
		$list = $node->getNodeAll();
		$list = Tree($list);
		$this->assign('list',$list);
		return $this->fetch();
	}
	public function doPrivAdd(Request $request)
	{
		$request = Request::instance();
		$privList = $request->post();
		$privName = $request->param('roleName');
		$remark = $request->post('remark');
		if(!isset($privList) || !isset($privName)){
			return json('信息填写不完整');
			exit;
		}
		$priv = new Priv;
		$data = $priv->privNodeAdd($privList);
		if($data){
			return json('ok');
		}else{
			return json('error');
		}
	}
	public function priv_edit(Request $request){
		$request = Request::instance();
    	$id = $request->param('id');//获取参数id
    	$priv = new Priv;
		$allow = $priv->getNodes($id);
		$privMsg = $priv->getPrivOne($id);
    	/*$allow = Db::table('priv_node')
    				->join('node','priv_node.node_id = node.node_id','LEFT')
    				->where('priv_id',$id)
    				->field('priv_id,priv_node.node_id,priv_node.active,name,path,parent,level')
    				->select();*/
    	$list = Tree($allow);
    	$this->assign('privMsg',$privMsg);
    	$this->assign('id',$id);
    	$this->assign('list',$list);
		return $this->fetch();
	}
	public function doPrivEdit(Request $request){
		$request = Request::instance();
		$privId = $request->param('privId');//当前编辑的权限ID
		$privList = $request->post();
		$privName = $request->param('roleName');
		$remark = $request->post('remark');
		if(!isset($privId) || !isset($privList) || !isset($privName)){
			return json('信息填写不完整');
			exit;
		}
		$priv = new Priv;
		$data = $priv->privNodeUpdate($privList);
		if($data){
			return json('ok');
		}else{
			return json('error');
		}
	}
	public function node_list($value='')
	{	
		$node = new Node();
		$list = $node->getNodeAll();
		$list = Tree($list);
		$this->assign('list',$list);
		return $this->fetch();
	}
	public function node_edit(Request $request)
	{
		$request = Request::instance();
    	$id = $request->param('id');//获取参数id
    	$node = new Node();
    	$nodeMsg = $node->getNodeOne($id);
    	$nodeParent = $node->getNodeParent();
    	$this->assign('nodeMsg',$nodeMsg);
    	$this->assign('nodeParent',$nodeParent);
    	$this->assign('id',$id);
		return $this->fetch();
	}
	public function doNodeEdit(Request $request)
	{
		$request = Request::instance();
		$privId = $request->param('nodeId');//当前编辑的权限ID
	}
}
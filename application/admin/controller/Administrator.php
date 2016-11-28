<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Admin;
use app\admin\model\Priv;
use think\Db;

class Administrator extends Base{
	public function priv_list(){
		$priv = new Priv;
		$list = $priv->getPrivList();
		$this->assign('list',$list);
		return $this->fetch();
	}
	public function priv_add(){
		return $this->fetch();
	}
	public function priv_edit(Request $request){
		$request = Request::instance();
    	$id = $request->param('id');//获取参数id
    	$priv = new Priv;
		$allow = $priv->getNodes($id);
    	/*$allow = Db::table('priv_node')
    				->join('node','priv_node.node_id = node.node_id','LEFT')
    				->where('priv_id',$id)
    				->field('priv_id,priv_node.node_id,priv_node.active,name,path,parent,level')
    				->select();*/
    	$list = Tree($allow);
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
		$privUpdata = array(
				'priv_id'	=>	$privId,
				'priv_name'	=>	$privName,
				'remark'	=>	$remark,
			);
		unset($privList['privId']);
		unset($privList['roleName']);
		unset($privList['remark']);
		foreach ($privList as $key => $value) {
			$addData[] = array(
					'priv_id'	=>	intval($privId),
					'node_id'	=>	intval($key),
					'active'	=>	intval($value),
				);
		}
		//dump($privUpdata);

		// 启动事务
		Db::startTrans();
		try{
			Db::table('priv')->update($privUpdata);
		    Db::table('priv_node')->where('priv_id',$privId)->delete();
		    Db::table('priv_node')->insertAll($addData);
		    // 提交事务
		    Db::commit();    
		    return json('ok');
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return json('error');
		}
	}
}
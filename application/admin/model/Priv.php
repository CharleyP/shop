<?php 
namespace app\admin\model;
use think\Model;
use think\Db;

class Priv extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'priv';

    public function nodes()
    {
        return $this->belongsToMany('Node','priv_node','node_id','priv_id');
    }
    public function getPrivList($value='')
    {
    	return $this->all();
    }
    public function getPrivOne($id='')
    {
    	return $this->find($id);
    }
    public function getNodes($id='')
    {
    	return $this->get($id)->nodes;
    }
    public function addPrivOne($data='')
    {
    	return $this->save($data);
    }
    public function privNodeAdd($privList='')
    {
    	$privName = $privList['roleName'];
    	$remark = $privList['remark'];
    	$addPrivData = array(
    			'priv_name'	=>	$privName,
    			'create_time'	=>	time(),
    			'active'	=>	1,
    			'remark'	=>	$remark,
    		);
    	$resultAdd = Db::table('priv')->insertGetId($addPrivData);
    	if($resultAdd){
    		$privId = $resultAdd;
    	}else{
    		return false;
    		exit;
    	}
    	$privUpdata = array(
				'priv_id'	=>	$privId,
				'priv_name'	=>	$privName,
				'remark'	=>	$remark,
			);
		unset($privList['roleName']);
		unset($privList['remark']);
		foreach ($privList as $key => $value) {
			$addData[] = array(
					'priv_id'	=>	$privId,
					'node_id'	=>	$key,
					'active'	=>	$value,
				);
		}
		// 启动事务
		Db::startTrans();
		try{
		    Db::table('priv_node')->where('priv_id',$privId)->delete();
		    Db::table('priv_node')->insertAll($addData);
		    // 提交事务
		    Db::commit();    
		    return true;
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return false;
		}
    }
    public function privNodeUpdate($privList='')
    {
    	/*$privId = $privList['privId'];
    	$privName = $privList['roleName'];
    	$remark = $privList['remark'];
    	unset($privList['privId']);
		unset($privList['roleName']);
		unset($privList['remark']);
		foreach ($privList as $key => $value) {
			$nodeActives[] = array(
					'active'	=>	$value,
				);
		}
		$nodeIds = array_keys($privList);
		$this->get($privId)->nodes()->detach($nodeIds);
		$this->get($privId)->nodes()->saveAll($nodeIds,$nodeActives);*/
		$privId = $privList['privId'];
    	$privName = $privList['roleName'];
    	$remark = $privList['remark'];
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
					//'priv_id'	=>	intval($privId),
					//'node_id'	=>	intval($key),
					//'active'	=>	intval($value),
					'priv_id'	=>	$privId,
					'node_id'	=>	$key,
					'active'	=>	$value,
				);
		}
		// 启动事务
		Db::startTrans();
		try{
			Db::table('priv')->update($privUpdata);
		    Db::table('priv_node')->where('priv_id',$privId)->delete();
		    Db::table('priv_node')->insertAll($addData);
		    // 提交事务
		    Db::commit();    
		    return true;
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return false;
		}
    }
    /*public function privUpdate($id='',$arr)
    {	
    	$id = 2;
    	return $this->get($id)->nodes()->attach(1,['remark'=>'test']);
    }*/
}

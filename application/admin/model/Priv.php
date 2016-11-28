<?php 
namespace app\admin\model;
use think\Model;

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
    /*public function privUpdate($id='',$arr)
    {	
    	$id = 2;
    	return $this->get($id)->nodes()->attach(1,['remark'=>'test']);
    }*/
}

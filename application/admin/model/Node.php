<?php 
namespace app\admin\model;
use think\Model;

class Node extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'node';

    public function getNodeAll($value='')
    {
    	return $this->all();
    }
    public function getNodeOne($value='')
    {
    	return $this->get($value);
    }
    public function getNodeParent($value='')
    {
    	return $this->where('level','1')->select();
    }
}

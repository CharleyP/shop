<?php 
namespace app\admin\model;
use think\Model;

class Admin extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'admin';

    public function privs()
    {
        return $this->belongsToMany('Priv','admin_priv','priv_id','admin_id');
    }
}

<?php
/**
 * 递归获取树形结构算法
 */
function tree($items,$pid = 0){
	$return = array();
	foreach ($items as $item) {
		if ($item['parent'] == $pid) {
			$item['child'] = tree($items,$item['node_id']);
			$return[] = $item;
		}
	}
	return $return;
}
function ajax_return($data,$status,$msg){
	$r = array(
		'data'   =>$data,
		'status' =>$status,
		'msg'	 =>$msg
		);
	header('Content-Type:application/json;charset=utf-8');
	exit(json_encode($r));
}
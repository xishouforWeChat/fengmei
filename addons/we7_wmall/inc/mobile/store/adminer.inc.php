<?php 

defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
if($_W['ispost']){
	//供应商信息
	$gaver_id=trim($_GPC['gaver_id']);
	//var_dump($gaver_id);exit;
	$price = $_GPC['price'];
	$num=trim($_GPC['num']);
	$gid=trim($_GPC['goods_id']);
	$createtime=time();
	$time=date("Y-m-d",$createTime);
	if($num==''&&$gid==''&&$gid==''){
		$goods_id=pdo_get('tiny_wmall_gaver',array('id'=>$gaver_id),array('goods_id'));
		$goods_id=explode(",",$goods_id['goods_id']);
		$goods=array();
		foreach($goods_id as $k=>$v){
			$goods[]=pdo_get('tiny_wmall_gaver_goods',array('id'=>$v),array('goods','id'));
		}
		message(array('data'=>$goods), '', 'ajax');
	}
	$res=pdo_insert('tiny_wmall_adminer',array('goods_id'=>$gid,'price'=>$price,'num'=>$num,'createTime'=>$createtime,'time'=>$time));
	if($res==''){
		message(error(-1, '失败'), '', 'ajax');
		return false;
	}
	message(error(0, '成功'), '', 'ajax');
	return false;
	
}



	$gavername=pdo_fetchall('SELECT gavername,id FROM ' . tablename('tiny_wmall_gaver'));
	include $this->template('adminer');


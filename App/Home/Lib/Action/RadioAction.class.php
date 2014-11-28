<?php
/**
 * 电台查询
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-24 下午2:18:33
 * @version 1.0
 */
class RadioAction extends Action{
	function _initialize(){
		$this->assign('flag','shenghuo');
		$this->assign('headInfo',setHead());
		$this->assign('footerFlag',1);
	}
	public function index(){
// 		header("Content-Type:text/html;charset=utf-8");
// 		if($id <= 1155){
// 			if($time <= 7){
// 				$url = "http://www.radio366.com/jiemu.asp?bh={$id}";
// 				$result = getByNetFun($url);
// 				$result = iconv("gb2312","utf-8//IGNORE",$result);
// 				$matchAll = array();
// 				$reg = '/<p id=\"c(.*?)\">(.*?)<\/p>.*?<div class=\"reference\">(.*?)<\/div>/is';
// 				preg_match_all($reg, $result, $matchAll,PREG_SET_ORDER);
// 				$insertInfo = array();
// 				foreach($matchAll as $key => $value){
// 					$insertInfo[$key]['type'] = $type;
// 					$insertInfo[$key]['name'] = $value[3];
// 					$insertInfo[$key]['content'] = $value[2];
// 				}
// 				$foodValue = M('famous_type');
// 				$foodValue -> addAll($insertInfo);
// 				echo "<script>";
// 				echo 'window.location.href="'.__URL__.'/index/type/'.($type).'/page/'.($page+1).'/"';
// 				echo "</script>";
// 			}
// 			echo "<script>";
// 			echo 'window.location.href="'.__URL__.'/index/type/'.($type+1).'/page/1/"';
// 			echo "</script>";
// 		}
// 		$num = date('W');
// 		$Cache = Cache::getInstance('File',array('expire'=>'60'));
// 		$value = $Cache->get('num');
// 		if(empty($value)){
// 			$Cache->set('num',$num);
// 		}else{
// 			if($num>$value){
// 				$Cache->set('num',$num);
// 			}
// 		}
		$radio_type		= 	M('radio_type');
		$radioType		=	$radio_type->select();	
		$radio 			= 	M('radio');
		$result 		= 	$radio->select();
		$this->assign('resultInfo',$radioType);
		$this->assign('result',$result);
 		$this->display();
	}
}
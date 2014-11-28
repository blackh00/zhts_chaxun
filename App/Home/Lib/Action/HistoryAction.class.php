<?php
/**
 * 历史上的今天对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-7 上午9:23:11
 * @version 1.0
 */
class HistoryAction extends Action{
	function _initialize(){
		$this->assign('flag','shenghuo');
		$this->assign('footerFlag',1);
		$this->assign('headerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		set_time_limit(0);
		date_default_timezone_set("PRC");
		$y = $_GET['year'];
		$m = $_GET['month'];
		$d = $_GET['day'];
		if(empty($_GET['year'])){
			$y          = date("Y");
		}
		if(empty($_GET['month'])){
			$m          = date("m");
		}
		if(empty($_GET['day'])){
			$d          = date("d");
		}
		$time           = $m.'-'.$d;
		$today			= $m.'月'.$d.'日';
		require ROOT_PATH . '/App/Home/Conf/lunardate.php';
		$lunar	= 	new Lunar();
		$ldate	=	$lunar->convertSolarToLunar($y, $m, $d);
		$ndate	=	$ldate[1].$ldate[2];
		$sedate =   $lunar->getLunarYearName($y);
		require ROOT_PATH . '/App/Home/Conf/timeType.php';
		$type           = $timeType[$time];
		$history        = M("history");
		$resultInfo     = $history->where("type=".$type)->select();
		$image = $history->where("type=".$type." and image !=''")->field("id,image,title")->limit(0,3)->select();
		foreach($image as $key =>$val){
			$imgarray=explode('/',$val['image']);
			$image[$key]['image']=$imgarray[count($imgarray)-1];
		}
		/*
		$rs = $history->select();
		foreach($rs as $key =>$val){
			$img=$val['image'];
			$imgarray=explode('/',$img);
			$imgelem[$key]['image']=$imgarray[count($imgarray)-1];	
		}
		*/
		/*
		$rs = $history->limit(0,30)->select();
		foreach($rs as $key =>$val){
			$con=$val['content'];
			$matchAll = array();
			$reg = '/src=\"(.*?)\"/is';
			preg_match_all($reg, $con, $matchAll,PREG_SET_ORDER);
			dump($matchAll);
			$conarray=explode('/',$con);
			$conelem[$key]['image']=$conarray[count($conarray)-1];			
		}
		*/
		$this->assign('image',$image);
		$this->assign('resultInfo',$resultInfo);
		$this->assign('today',$today);
		$this->assign('ndate',$ndate);
		$this->assign('sedate',$sedate);
		$this->display();
	}
	public function hlist(){
		date_default_timezone_set("PRC");
		$y              = date("Y");
		$m              = date("m");
		$d              = date("d");
		$time           = $m.'-'.$d;
		$today			= $m.'月'.$d.'日';
		require ROOT_PATH . '/App/Home/Conf/lunardate.php';
		$lunar	= 	new Lunar();
		$ldate	=	$lunar->convertSolarToLunar($y, $m, $d);
		$ndate	=	$ldate[1].$ldate[2];
		$sedate =   $lunar->getLunarYearName($y);
		require ROOT_PATH . '/App/Home/Conf/timeType.php';
		$type           = $timeType[$time];
		$id             = $_GET['cid'];
		$history        = M("history");
		$image			= $history->where("type = ".$type." and category = ".$id." and image !=''")->field("id,image,title")->limit(0,3)->select();
		foreach($image as $key =>$val){
			$imgarray=explode('/',$val['image']);
			$image[$key]['image']=$imgarray[count($imgarray)-1];
		}
		$resultInfo     = $history->where("type = ".$type." and category = ".$id)->select();
		$desc			= array();
		foreach($resultInfo as $key =>$val){
			$desc[$key]=strip_tags($resultInfo[$key]['content']);
			$desc[$key]=mb_substr($desc[$key],0,150,'utf-8');
		}
		$this->assign('image',$image);
		$this->assign('resultInfo',$resultInfo);
		$this->assign('today',$today);
		$this->assign('desc',$desc);
		$this->assign('category',$id);
		$this->assign('ndate',$ndate);
		$this->assign('sedate',$sedate);
		$this->display();
	}
	public function content(){
		$id             = $_GET['id'];
		$history        = M("history");
		$resultInfo     = $history->where("id = ".$id)->select();
		$this->assign('resultInfo',$resultInfo);
		$this->display();
	}
}
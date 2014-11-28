<?php
/**
 * 黄道吉日
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @UpdateDate: 2013-7-11 下午4:04:10
 * @version 1.0
 */
class AuspiciousAction extends Action{
	// 控制器初始化方法。
	public function _initialize(){
		$footerFlag=1;
		$this->assign('footerFlag',$footerFlag);
		$flag="zonghe";
		$this->assign('flag',$flag);
		$this->assign("headInfo", setHead());	
	}
	// 黄道吉日首页显示。
	public function index(){
		if(isset($_POST) && $_POST['checkform']=='submit'){
			$hdjr=M('hdjr');
			$data[$_POST['lmanacType']]=array('like','%'.$_POST['lmanacCond'].'%');
			$data1['time']=array('like','%'.$_POST['s_year'].'-'.$_POST['s_month'].'-'.$_POST['s_day'].'%');
			$start=$hdjr->where($data1)->getField('id');
			$data2['time']=array('like','%'.$_POST['e_year'].'-'.$_POST['e_month'].'-'.$_POST['e_day'].'%');
			$end=$hdjr->where($data2)->getField('id');
			if($start > $end){
				$data3['id']=array('between',array($end,$start));
				$data3[$_POST['lmanacType']]=array('like','%'.$_POST['lmanacCond'].'%');
				$record=$hdjr->where($data3)->order('id asc')->select();
				$num=$hdjr->where($data3)->order('id asc')->count();
				if($_POST['lmanacType']=='yi'){
					$rad='宜';
				}else{
					$rad='忌';
				}
				$this->assign('s_year',$_POST['s_year']);
				$this->assign('s_month',$_POST['s_month']);
				$this->assign('s_day',$_POST['s_day']);
				
				$this->assign('e_year',$_POST['e_year']);
				$this->assign('e_month',$_POST['e_month']);
				$this->assign('e_day',$_POST['e_day']);
				
				$this->assign('num',$num);
				$this->assign('rad',$rad);
				$this->assign('condi',$_POST['lmanacCond']);
				$this->assign('record',$record);
			}else if($start < $end){
				$data3['id']=array('between',array($start,$end));
				$data3[$_POST['lmanacType']]=array('like','%'.$_POST['lmanacCond'].'%');
				$record=$hdjr->where($data3)->order('id asc')->select();
				$num=$hdjr->where($data3)->count();
				if($_POST['lmanacType']=='yi'){
					$rad='宜';
				}else{
					$rad='忌';
				}
				$this->assign('s_year',$_POST['s_year']);
				$this->assign('s_month',$_POST['s_month']);
				$this->assign('s_day',$_POST['s_day']);
				
				$this->assign('e_year',$_POST['e_year']);
				$this->assign('e_month',$_POST['e_month']);
				$this->assign('e_day',$_POST['e_day']);
				
				$this->assign('num',$num);
				$this->assign('rad',$rad);
				$this->assign('condi',$_POST['lmanacCond']);
				$this->assign('record',$record);
			}else if($start == $end){
				$data3['id']=$start;
				$data3[$_POST['lmanacType']]=array('like','%'.$_POST['lmanacCond'].'%');
				$record=$hdjr->where($data3)->order('id asc')->select();
				$num=$hdjr->where($data3)->count();
				if($_POST['lmanacType']=='yi'){
					$rad='宜';
				}else{
					$rad='忌';
				}
				$this->assign('s_year',$_POST['s_year']);
				$this->assign('s_month',$_POST['s_month']);
				$this->assign('s_day',$_POST['s_day']);
				
				$this->assign('e_year',$_POST['e_year']);
				$this->assign('e_month',$_POST['e_month']);
				$this->assign('e_day',$_POST['e_day']);
				
				$this->assign('num',$num);
				$this->assign('rad',$rad);
				$this->assign('condi',$_POST['lmanacCond']);
				$this->assign('num',$num);
				$this->assign('record',$record);
			}	
		}else{						
			if(isset($_REQUEST['k1']) && $_REQUEST['k1']==1){
				$Cache = Cache::getInstance('file');
				$record = $Cache->get('record');  // 获取缓存的record数据
				if(!isset($record) || $record=='' || $record==null){
					$hdjr=M('hdjr');
					$data1['time']=array('like','%2013-1-1%');
					$start=$hdjr->where($data1)->getField('id');
					$data2['time']=array('like','%2013-12-31%');
					$end=$hdjr->where($data2)->getField('id');
					$data3['id']=array('between',array($start,$end));
					$data3['yi']=array('like','%'.'嫁娶'.'%');
					$record=$hdjr->where($data3)->order('id asc')->select();
					$num=$hdjr->where($data3)->order('id asc')->count();
					
					$Cache->set('record',$record,'3600*24*100');  // 缓存record数据
					$this->assign('s_year',2013);
					$this->assign('s_month',1);
					$this->assign('s_day',1);
					
					$this->assign('e_year',2013);
					$this->assign('e_month',12);
					$this->assign('e_day',31);
					
					$this->assign('rad','宜');
					$this->assign('condi','嫁娶');
					$this->assign('num',$num);
					$this->assign('record',$record);
				}else{
					$this->assign('s_year',2013);
					$this->assign('s_month',1);
					$this->assign('s_day',1);
					
					$this->assign('e_year',2013);
					$this->assign('e_month',12);
					$this->assign('e_day',31);
					
					$this->assign('rad','宜');
					$this->assign('condi','嫁娶');
					$this->assign('num','257');
					$this->assign('record',$record);
				}	
			}elseif(isset($_REQUEST['k2']) && $_REQUEST['k2']==2){
				$Cache = Cache::getInstance('file');
				$record = $Cache->get('record2');  // 获取缓存的record数据
				if(!isset($record) || $record=='' || $record==null){
					$hdjr=M('hdjr');
					$data1['time']=array('like','%2013-1-1%');
					$start=$hdjr->where($data1)->getField('id');
					$data2['time']=array('like','%2013-12-31%');
					$end=$hdjr->where($data2)->getField('id');
					$data3['id']=array('between',array($start,$end));
					$data3['yi']=array('like','%'.'求嗣'.'%');
					$record=$hdjr->where($data3)->order('id asc')->select();
					$num=$hdjr->where($data3)->order('id asc')->count();
						
					$Cache->set('record2',$record,'3600*24*100');  // 缓存record数据
					$this->assign('s_year',2013);
					$this->assign('s_month',1);
					$this->assign('s_day',1);
					
					$this->assign('e_year',2013);
					$this->assign('e_month',12);
					$this->assign('e_day',31);
					
					$this->assign('rad','宜');
					$this->assign('condi','求嗣');
					$this->assign('num',$num);
					$this->assign('record',$record);
				}else{
					$this->assign('s_year',2013);
					$this->assign('s_month',1);
					$this->assign('s_day',1);
					
					$this->assign('e_year',2013);
					$this->assign('e_month',12);
					$this->assign('e_day',31);
					
					$this->assign('rad','宜');
					$this->assign('condi','求嗣');
					$this->assign('num','273');
					$this->assign('record',$record);
				}
			}elseif(isset($_REQUEST['k3']) && $_REQUEST['k3']==3){
				$Cache = Cache::getInstance('file');
				$record = $Cache->get('record3');  // 获取缓存的record数据
				if(!isset($record) || $record=='' || $record==null){
					$hdjr=M('hdjr');
					$data1['time']=array('like','%2013-1-1%');
					$start=$hdjr->where($data1)->getField('id');
					$data2['time']=array('like','%2013-12-31%');
					$end=$hdjr->where($data2)->getField('id');
					$data3['id']=array('between',array($start,$end));
					$data3['yi']=array('like','%'.'开市'.'%');
					$record=$hdjr->where($data3)->order('id asc')->select();
					$num=$hdjr->where($data3)->order('id asc')->count();
				
					$Cache->set('record3',$record,'3600*24*100');  // 缓存record数据
					$this->assign('s_year',2013);
					$this->assign('s_month',1);
					$this->assign('s_day',1);
					
					$this->assign('e_year',2013);
					$this->assign('e_month',12);
					$this->assign('e_day',31);
				
					$this->assign('rad','宜');
					$this->assign('condi','开市');
					$this->assign('num',$num);
					$this->assign('record',$record);
				}else{
					$this->assign('s_year',2013);
					$this->assign('s_month',1);
					$this->assign('s_day',1);
					
					$this->assign('e_year',2013);
					$this->assign('e_month',12);
					$this->assign('e_day',31);
					
					$this->assign('rad','宜');
					$this->assign('condi','开市');
					$this->assign('num','145');
					$this->assign('record',$record);
				}			
			}elseif(isset($_REQUEST['k4']) && $_REQUEST['k4']==4){
				$Cache = Cache::getInstance('file');
				$record = $Cache->get('record4');  // 获取缓存的record数据
				if(!isset($record) || $record=='' || $record==null){
					$hdjr=M('hdjr');
					$data1['time']=array('like','%2013-1-1%');
					$start=$hdjr->where($data1)->getField('id');
					$data2['time']=array('like','%2013-12-31%');
					$end=$hdjr->where($data2)->getField('id');
					$data3['id']=array('between',array($start,$end));
					$data3['yi']=array('like','%'.'移徙'.'%');
					$record=$hdjr->where($data3)->order('id asc')->select();
					$num=$hdjr->where($data3)->order('id asc')->count();
				
					$Cache->set('record4',$record,'3600*24*100');  // 缓存record数据	
					$this->assign('s_year',2013);
					$this->assign('s_month',1);
					$this->assign('s_day',1);
					
					$this->assign('e_year',2013);
					$this->assign('e_month',12);
					$this->assign('e_day',31);
				
					$this->assign('rad','宜');
					$this->assign('condi','移徙');
					$this->assign('num',$num);
					$this->assign('record',$record);
				}else{
					$this->assign('s_year',2013);
					$this->assign('s_month',1);
					$this->assign('s_day',1);
					
					$this->assign('e_year',2013);
					$this->assign('e_month',12);
					$this->assign('e_day',31);
					
					$this->assign('rad','宜');
					$this->assign('condi','移徙');
					$this->assign('num','139');
					$this->assign('record',$record);
				}
			}else{
				$hdjr=M('hdjr');
				$record=array();
				for($i = 0 ; $i <= 31 ; $i++){
					$data['time']=array('like','%'.date('Y-n-j',(time()+$i*24*3600)).'%');
					$record[$i]=$hdjr->where($data)->find();
				}
				$arr1=explode('-', date('Y-n-j',time()));
				$arr2=explode('-', date('Y-n-j',time()+31*24*3600));
				
				$this->assign('s_year',$arr1[0]);
				$this->assign('s_month',$arr1[1]);
				$this->assign('s_day',$arr1[2]);
				
				$this->assign('e_year',$arr2[0]);
				$this->assign('e_month',$arr2[1]);
				$this->assign('e_day',$arr2[2]);
				
				$this->assign('rad','宜');
				$this->assign('m','no');
				$this->assign('record',$record);
			}
		}
		$this->display();
	}
}
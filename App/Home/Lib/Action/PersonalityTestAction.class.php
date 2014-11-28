<?php
/**
 * 性格色彩测试
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-9-22 下午3:18:26
 * @version 1.0
 */
class PersonalityTestAction extends Action{
	function _initialize(){
		$this->assign('flag','yule');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		
		$this->display();
	}
	public function result(){
		$mkey = array();
		$pa	= 0;
		$pb	= 0;
		$pc	= 0;
		$pd	= 0;
		$na	= 0;
		$nb	= 0;
		$nc	= 0;
		$nd	= 0;
		$totel=array();
		$totel['red']=0;
		$totel['blue']=0;
		$totel['yellow']=0;
		$totel['green']=0;
		for($i=1;$i<=30;$i++){
			$mkey[$i]=$_POST[$i];
		}
 		dump($mkey);
		for($j=1;$j<=15;$j++){
			switch($mkey[$j]){
				case 'A':
					$pa++;
					break;
				case 'B':
					$pb++;
					break;
				case 'C':
					$pc++;
					break;
				case 'D':
					$pd++;
					break;
			}
		}
		for($j=16;$j<=30;$j++){
			switch($mkey[$j]){
				case 'A':
					$na++;
					break;
				case 'B':
					$nb++;
					break;
				case 'C':
					$nc++;
					break;
				case 'D':
					$nd++;
					break;
			}
		}
		dump($pa.'+'.$pb.'+'.$pc.'+'.$pd.'+'.$na.'+'.$nb.'+'.$nc.'+'.$nd);
		$totel['red']=$pa+$nd;
		$totel['blue']=$pb+$nc;
		$totel['yellow']=$pc+$nb;
		$totel['green']=$pd+$na;
		dump($totel['red'].'+'.$totel['blue'].'+'.$totel['yellow'].'+'.$totel['green']);
		$max = max($totel);
		if($totel['red']==$max){
			$color = 'red';
		}else if($totel['blue']==$max){
			$color = 'blue';
		}else if($totel['yellow']==$max){
			$color = 'yellow';
		}else{
			$color = 'green';
		}
		dump($color);
		$this->assign('color',$color);
		$this->display();
	}
}

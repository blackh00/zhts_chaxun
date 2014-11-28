<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-7 上午11:25:04
 * @version 1.0
 */
class MobileNumAction extends Action{
	// 控制器初始化方法。
	function _initialize(){
		$this->assign('flag','zonghe');
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	// 手机号测吉凶首页。
	public function index(){
		$this->display();
	}
	// 手机号测吉凶结果。
	public function mobilenumSearch(){
		if(isset($_REQUEST['mobile']) && $_REQUEST['mobile'] != '' && strlen($_REQUEST['mobile']) ==11 ){
			$arr=array('130','131','132','133','134','135','136','137','138','139','150','151','153','155','156','157','158','159','180','181','182','183','184','185','186','187','188','189');
			$chknum=substr($_REQUEST['mobile'],0,3);
			if(!in_array($chknum,$arr)){
				$this->error("请输入正确的手机号。");
				return false;
			}							
			$num=substr($_REQUEST['mobile'],3,8);
			$num=$num%80;
			if(!$num){
				$num=81;
			}
			$data=array();
			$Mobile=M('shouji');
			$record=$Mobile->where("num=".$num)->find();
			$data['number']=$_REQUEST['mobile'];
			$arr1=explode('』',$record['ji_xiong']);
			$data['jx']=str_replace('『', '', $arr1[0]);
			$data['fenxi']=$arr1[1];			
			$arr2=explode(']，', $record['xing_ge']);
			$data['gexing']=str_replace('[', '', $arr2[0]);
			$arr2[1]=preg_replace('/其具体表现为：/', '', $arr2[1]);
			$data['biaoxian']=$arr2[1];
			$this->assign('jx',$data['jx']);
			$this->assign('data',$data);
			$this->display();
		} else {
			$this->redirect('/mobilenum/');
			return false;
		}
	}	
}
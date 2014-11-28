<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-13 下午8:04:30
 * @version 1.0
 */
class YanYuAction extends Action{
	
	// 控制器初始化方法。
	function _initialize(){
	
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	// 艳遇测试首页显示。
	public function index(){
		$this->assign("footerFlag",'1');
		$titleKey='艳遇测试查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="yule";
		$this->assign('flag',$flag);
		$this->display();
	}
	
	// 艳遇test。。。
	public function yanyu2(){
		$this->assign("headerFlag",'1');
		$this->assign("footerFlag",'1');
		$titleKey='艳遇测试查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="yule";
		$this->assign('flag',$flag);
		$this->display();
	}
}
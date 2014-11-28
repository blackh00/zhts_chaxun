<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-16 下午2:24:50
 * @version 1.0
 */
class ZhuFangGongJiAction extends Action{
	
	// 控制器初始化方法。
	public function _initialize(){
		
		$flag="jinrong";
		$this->assign('flag',$flag);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	//住房公积金查询首页显示。
	public function index(){
		
		$this->assign('headerFlag',1);
		$this->display();
	}
}
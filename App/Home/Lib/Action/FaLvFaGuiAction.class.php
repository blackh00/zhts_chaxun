<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-16 下午3:42:20
 * @version 1.0
 */
class FaLvFaGuiAction extends Action{
	
	// 控制器类初始化。
	public function _initialize(){
		$flag="jiaoyu";
		$this->assign('flag',$flag);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	// 法律法规首页显示。
	public function index(){
		$this->display();
	}
}
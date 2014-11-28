<?php
/**
 * qq强制聊天对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-16 上午10:03:13
 * @version 1.0
 */
class QqltAction extends Action{
	public function index(){
		$this->assign("flag","yule");
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display();
	}
}
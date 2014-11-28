<?php
/**
 * 常用号码对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-22 上午10:55:51
 * @version 1.0
 */
class CommonTelphoneAction extends Action{
	public function index(){
		$this->assign("flag","shenghuo");
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display();
	}
}
<?php
/**
 * 银行大全对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-13 下午5:55:47
 * @version 1.0
 */
class BankAction extends Action{
	public function _initialize(){
		$this->assign("flag","jinrong");
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	public function index(){
		$this->display();
	}
	public function detail(){		
		$this->display();
	}
}
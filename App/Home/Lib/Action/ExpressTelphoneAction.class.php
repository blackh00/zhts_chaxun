<?php
/**
 * 快递电话查询
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-8-30 下午1:43:34
 * @version 1.0
 */
class ExpressTelphoneAction extends Action{
	function _initialize(){
		$this->assign('flag','shenghuo');
		$this->assign('footerFlag',1);
		$this->assign('headerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	} 
}
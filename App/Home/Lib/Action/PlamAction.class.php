<?php
/**
 * 手相自测
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-9-23 下午4:19:17
 * @version 1.0
 */
class PlamAction extends Action{
	function _initialize(){
		$this->assign('flag','shenghuo');
		$this->assign('headerFlag',1);
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
	public function index2(){
		$this->display();
	}
	public function index3(){
		$this->display();
	}
}

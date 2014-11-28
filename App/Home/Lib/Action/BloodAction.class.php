<?php
/**
 * 血型性格测试
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-4 下午4:41:46
 * @version 1.0
 */
class BloodAction extends Action{
	function _initialize(){
		$this->assign('flag','zonghe');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
}
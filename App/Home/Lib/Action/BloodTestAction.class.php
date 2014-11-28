<?php
/**
 * 血型自测
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-9-23 下午3:25:21
 * @version 1.0
 */
class BloodTestAction extends Action{
	function _initialize(){
		$this->assign('flag','shenghuo');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		
		$this->display();
	}
}

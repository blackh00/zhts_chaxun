<?php
/**
 * 心理年龄测试
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-30 上午8:44:07
 * @version 1.0
 */
class MentalAgeTestAction extends Action{
	function _initialize(){
		$this->assign('flag','yule');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
}
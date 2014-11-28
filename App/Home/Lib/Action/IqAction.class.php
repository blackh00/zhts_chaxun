<?php
class IqAction extends Action{
	function _initialize(){
		$this->assign('flag','yule');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	/**
	 * 智力测试
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-6-27 上午11:21:02
	 */
	public function index(){
		$this->display();
	}
}
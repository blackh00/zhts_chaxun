<?php
/**
 * 标注女性三围
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-4 下午6:11:19
 * @version 1.0
 */
class MeasurementsAction extends Action{
	function _initialize(){
		$this->assign('flag','zonghe');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
}
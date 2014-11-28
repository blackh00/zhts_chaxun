<?php
/**
 * 计量单位换算器对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-9 下午5:33:19
 * @version 1.0
 */
class ConverterAction extends Action {
	function _initialize() {
		$this->assign ( 'flag', 'jiaoyu' );
		$this->assign ( 'headerFlag', 1 );
		$this->assign ( 'footerFlag', 1 );
		$this->assign ( 'headInfo', setHead () );
	}
	public function index() {
		$this->display ();
	}
}
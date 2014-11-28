<?php
/**
 * 科学计算器对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-9 上午9:52:10
 * @version 1.0
 */
class CalculatorAction extends Action{
	/**
	 * 使用计算器
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-9 上午9:52:35
	 */
	public function index(){
		$this->assign('footerFlag',1);
		$this->assign('headerFlag',1);
		$this->assign('headInfo',setHead());
		$this->assign('flag','jinrong');
		$this->display();
	}
}
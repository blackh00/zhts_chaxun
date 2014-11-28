<?php
/**
 * 房贷计算器对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-13 下午5:57:09
 * @version 1.0
 */
class BuyHouseAction extends Action{
	/**
	 * 购房贷款计算器
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-13 下午5:57:53
	 */
	public function index(){
		$this->display();
	}
	/**
	 * 提前还款计算器
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-13 下午5:58:46
	 */
	public function hk(){
		$this->display();
	}
	/**
	 * 购房税费计算器
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-13 下午5:58:50
	 */
	public function sf(){
		$this->display();
	}
}
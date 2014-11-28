<?php 
/**
 * 女性安全期计算器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-25 下午2:20:29
 * @version 1.0
 */
class SafePeriodAction extends Action{
	public function index(){
		$this->assign('flag','zonghe');
		$this->assign('headerFlag',1);
		$this->assign('footerFlag',1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display();
	}
}
?>
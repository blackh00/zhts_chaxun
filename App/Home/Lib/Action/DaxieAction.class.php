<?php
/**
 * 金额大写转换对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-16 下午2:04:18
 * @version 1.0
 */
class DaxieAction extends Action{
	public function index(){
		$this->assign("flag","jinrong");
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display();
	}
}
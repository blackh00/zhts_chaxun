<?php
/**
 * 人品计算器对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-13 下午6:49:09
 * @version 1.0
 */
class CharacterAction extends Action{
	public function index(){
		$this->assign("flag","yule");
		$this->assign("footerFlag",1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display();
	}
}
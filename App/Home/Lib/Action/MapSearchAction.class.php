<?php
/**
 * 
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Yumao <815227173@qq.com>
 * @CreateDate: 2013-5-8 上午11:04:17
 * @version 1.0
 */
class MapSearchAction extends Action{
	
	/*
	 * 所有action默认调用的方法
	 */
	function _initialize(){
		$this->assign("flag","jiaotong");
		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	/*
	 * 地图查询首页对应方法
	 * 
	 */
	public function index(){
	
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->display();
	} 
}
<?php
/**
 * 
 * 黄金价格对应控制器
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Yumao <815227173@qq.com>
 * @CreateDate: 2013-5-14 下午2:13:49
 * @version 1.0
 */
class GoldPriceAction extends Action{
	/**
	 * 初始值
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-5 下午7:44:37
	 */
	function _initialize(){
		$this->assign("flag","jinrong");
		$this->assign("headerFlag",1);
		$this->assign("footerFlag",1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	/**
	 * 
	 * 首页对应方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-14 下午2:14:35
	 */
	public function index(){
		$this->display();
	}
}
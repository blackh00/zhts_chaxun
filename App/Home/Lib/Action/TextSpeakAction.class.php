<?php 
/**
 * 火星文
 * 
 * @copyright (C)2012 ZHTS Inc.
 * @project KEFU
 * @author Vonwey <vonwey@qq.com>
 * @CreateDate: 2013-6-17 下午4:43:45
 * @version 1.0
 *
 * @ModificationHistory  
 * Who          When                What 
 * --------     ----------          ------------------------------------------------ 
 * Linmaogan   2013-6-17 下午4:43:45      todo
 */
class TextSpeakAction extends Action{
	/**
	 * 初始值
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-8 上午8:50:42
	 */
	function _initialize(){
		$this->assign("flag","yule");
		$this->assign("footerFlag",1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	/**
	 * 火星文
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-17 下午7:19:33
	 */
	public function index(){
		$this->display();
	}
}

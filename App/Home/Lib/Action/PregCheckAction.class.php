<?php 
/**
 * 怀孕计算器对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-7 下午2:34:08
 * @version 1.0
 */
class PregCheckAction extends Action{
	/**
	 * _initialize
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-5-31 上午9:52:35
	 */
	function _initialize(){
		$this->assign("flag","zonghe");
		$this->assign("footerFlag",1);
		$this->assign("headerFlag",1);
	}
	/**
	 * 根据输入信息做出判断
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-7 下午2:34:40
	 */
	public function index(){
		header("Content-Type:text/html;charset=utf-8");
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display();
	}
}
?>
<?php 
/**
 * 标准体重对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-7 下午2:34:08
 * @version 1.0
 */
class WeightTestAction extends Action{
	/**
	 * 根据输入信息做出判断
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-7 下午2:34:40
	 */
	public function index(){
		$this->assign("flag","zonghe");
		$this->assign("footerFlag",1); // 用来标志是否在模版页面尾部要包含另外的js ,1表示包含
		$this->assign("headerFlag",1); // 用来标志是否在模版页面头部要包含另外的css ,1表示包含
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display();
	}
}
?>
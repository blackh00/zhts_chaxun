<?php
/**
 * 历史朝代公元对照表对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-10 上午9:32:01
 * @version 1.0
 */
class DynastyAction extends Action{
	/**
	 * 查看历史朝代公元对照表
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-10 上午9:33:08
	 */
	public function index(){
		$this->assign("flag","jiaoyu");
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display();
	}
}
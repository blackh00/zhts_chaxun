<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-14 上午10:31:56
 * @version 1.0
 */
class RiddlesAction extends Action{
	
	//首页显示。
	public function index(){
		import("ORG.Util.Page");
		$ridd=M('riddles');
		$count = $ridd->count();
		$page = new Page($count,30);
		$nowPage = isset($_GET['p']) ? $_GET['p']:1;
		$list = $ridd->order('id')->page($nowPage.",".$page->listRows)->select();
		$show = $page->show();
		
		$this->assign('list',$list);
		$this->assign('show',$show);
		$titleKey='脑经急转弯查询-快查';
		$this->assign('titleKey',$titleKey);
		$this->display();
	}
}
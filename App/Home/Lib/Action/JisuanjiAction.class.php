<?php
class JisuanjiAction extends Action{
	function _initialize(){
		$this->assign("flag","jinrong");
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
}
?>
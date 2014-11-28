<?php 
/*
 *功能：邮编信息的搜素查询
*作者：yumao
*联系方式:QQ:916564404
*创建时间:2013/3/28
* */
class PostcodeSearchAction  extends	 Action{
	
	// 显示首页和查询结果页的相关方法
	public function index(){
	
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->assign("flag","shenghuo");
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->display();
	}
	
}
?>
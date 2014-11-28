<?php
/**
 *功能：生肖搜素所对应的控制器
 *作者：yumao
 *联系方式:QQ:916564404
 *创建日期:2013/4/15
 */
class ShengxiaoSearchAction extends  Action{
	/**
	 * 初始数据
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-5 上午9:53:40
	 */
	function _initialize(){
		$this->assign("flag","shenghuo");
		$this->assign("footerFlag",1);
		$this->assign("headerFlag",1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	/*
	 * 首页或者查询后结果页所对应的方法
	 */
	public function index(){
		
		// 定义生肖所对应的数组
		$shengXiao = array('猴','鸡','狗','猪','鼠','牛','虎','兔','龙','蛇','马','羊');
		$linklist = array('monkey','chook','dog','pig','mouse','ox','tiger','rabbit','dragon','snake','horse','sheep');
	
		// 得到提交过来的年份数据
		if($_POST['sub_btn']){
			//dump($_POST);	
			if($_POST['year'] || $_POST['year']==='0'){
				$year = ltrim(ltrim($_POST['year']),"0");
				$place = $year%12;
				$sub_post = 1;
				$this->assign("animal",$shengXiao[$place]);
				$this->assign("link",$linklist[$place]);
			} else {
				//echo "请输入年份";
			}
		}else {
			$sub_post = 0;
		}
		$this->assign("linklist",$linklist);
		$this->assign("sub_post",$sub_post);
		$this->display();
	}
	
	public function show(){
		$shengxiao = array(
				"0"  => array('鼠','mouse'),
				"1"  => array('牛','ox'),
				"2"  => array('虎','tiger'),
				"3"  => array('兔','rabbit'),
				"4"  => array('龙','dragon'),
				"5"  => array('蛇','snake'),
				"6"  => array('马','horse'),
				"7"  => array('羊','sheep'),
				"8"  => array('猴','monkey'),
				"9"  => array('鸡','chook'),
				"10" => array('狗','dog'),
				"11" => array('猪','pig')
		);
		$animal = $_GET['animal'];
		$this->assign("animal",$animal);
		$this->assign("shengxiao",$shengxiao);
		$this->display();
	}
}
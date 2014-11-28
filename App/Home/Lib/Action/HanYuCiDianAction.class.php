<?php
class HanYuCiDianAction extends Action{
	
	// 初始化函数。
	function _initialize(){
		$this->assign("flag","jiaoyu");
		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	// 汉语词典首页方法。
	public function index(){
		$this->display();
	}
	
	// 汉语词典搜索页方法。
	public function search(){
		import("ORG.Util.Page");
		$manerge=M('hanyucidian');
		if(isset($_GET['cihui']) && !empty($_GET['cihui'])){
			$data['cihui']=array('like','%'.$_GET['cihui'].'%');
		}else{
			echo "<script>alert('对不起，没有查到这个词语。');</script>";
			$this->display("hanyucidian:index");
			return false;
		}
		$count=$manerge->where($data)->count();	
		//echo $count;exit;
		if(!$count){
			echo "<script>alert('对不起，没有查到这个词语。');</script>";
			$this->display("hanyucidian:index");
			return false;	
		}	
		$page=new Page($count,10);
		$show=$page->show();
		$list=$manerge->where($data)->order("id desc")->limit($page->firstRow.",".$page->listRows)->select();
		$this->assign("show",$show);
		$this->assign("list",$list);
		//var_dump($list);exit;
		var_dump($show);exit;
		$this->display();
	}
	
	// 汉语词典搜索页方法。
	public function hanYuShow(){
		$this->display();
	}
}
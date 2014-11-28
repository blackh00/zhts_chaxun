<?php
/**
 * 电话区号查询控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-6 下午5:52:34
 * @version 1.0
 */
class ZoneAction extends Action{
	function _initialize(){
		$this->assign("flag","shenghuo");
		$this->assign("footerFlag",1); // 用来标志是否在模版页面尾部要包含另外的js ,1表示包含
	}
	/**
	 * 操作数据库在数据库中根据id查询相应的信息
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-6 下午5:55:45
	 * @return array
	 */
	public function index(){
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display();
	}
	/**
	 * ajax返回通过区号搜索请求数据
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-22 下午5:55:39
	 */
	public function num(){
		$callback = $_REQUEST['callback'];
		$keyword = $_GET['keyword'];
		$zone   = M('zone');
		$result = $zone->where('num = '.$keyword)->select();
		$info = json_encode($result);
		echo $callback."($info)";
	}
	/**
	 * ajax返回通过地名模糊查询请求的数据
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-23 上午8:48:46
	 */
	public function word(){
		$callback = $_REQUEST['callback'];
		$keyword = $_GET['keyword'];
		$zone   = M('zone');
		$result = $zone->where('address like"%'.$keyword.'%"')->order('id')->select();
		$info = json_encode($result);
		echo $callback."($info)";
	}
	/**
	 * 客服系统 区号查询 API
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-19 下午5:47:29
	 */
	public function tele(){
		$keyword = $_GET['arg'];
		$zone   = M('zone');
		$result = $zone->where('num = '.$keyword)->select();
		$info = json_encode($result[0]);
		echo $info;
	}
	/**
	 * 客服系统 查询 链接查询
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-22 上午11:38:12
	 */
	public function kefu(){
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		
		$keyword = $_GET['keyword'];
		$keyword = explode("-",$keyword);
		$keyword = substr($keyword[0],0,4);
		$zone   = M('zone');
		$result = $zone->where('num = '.$keyword)->select();
		
		$kefu  = "<div id=\"jieguo\" class=\"quhao_c\">";
		$kefu .= "<h4>查询结果：</h4>";
		foreach($result as $value){
			$kefu .= "<p><a href=".C('SITE_DYNAMIC_URL')."/ditu/?city=".$value['address']."\">查看地图&gt;&gt;</a>".$value['province'].$value['address']." 邮编：".$value['code']." 区号：".$value['num']."</p>";
		}
		$kefu .= "</div>";
		$this->assign("kefu",$kefu);
		$this->display("index");
	}
}
?>
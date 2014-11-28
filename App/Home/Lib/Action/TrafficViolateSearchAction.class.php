<?php
/*
 *功能：交通违规信息的搜素查询
*作者：yumao
*联系方式:QQ:916564404
*创建时间:2013/4/3
* */
class TrafficViolateSearchAction extends Action{
	
	/*
	 * 所有action默认调用的方法
	*/
	function _initialize(){
		$this->assign("flag","jiaotong");
		// 分配Ip查询页面的title关键字
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	/*
	 * 交通违规查询结果的显示与搜素
	 */
	public function index(){
		header("Content-Type:text/html;charset=utf-8");
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示包含
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		/*暂时没有用到
		// 处理数据
		$citycode = $_POST['citycode'];
		$fdjh = $_POST['fdjh'];
		$cardnumber = $_POST['cardnumber'];
		$cardqz = $_POST['$cardqz'];
		
		// 调用网络接口获取数据
		if($_POST['sub']){
			$url = C('TRAFFIC_VIOLATE_API_URL')."?key=".C('MOBILE_GET_BY_NET_KEY')."&citycode=".$citycode."&fdjh=".$fdjh."&cardnumber=".$cardnumber."&cardqz=".$cardqz;
			
			// 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
			$result = getByNetFun($url);
			$trafficViolateInfo = json_decode($result);
			dump($trafficViolateInfo);
		}*/
		$this->display();
	}
}
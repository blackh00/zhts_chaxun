<?php 
/*
 *功能：火车票信息的搜素查询
*作者：yumao
*联系方式:QQ:916564404
*创建时间:2013/3/29
* */
class TrainTicketSearchAction extends Action{
	
	/*
	 * 火车票查询结果的显示与搜素
	 */
	public function index(){
		$date = date("Y-m-d");
		$this->assign("date",$date);
		// 判断是否是点击提交按钮链接到页面
		if($_POST['sub']){
			$startCity = $_POST['startCity'];
			$aimCity = $_POST['aimCity'];
			$trainName = $_POST['trainName'];
			if($startCity && $aimCity){
				
				$url = 'http://apis.juhe.cn/train/s2s?start='.$startCity.'&end='.$aimCity.'&key='.C('MOBILE_GET_BY_NET_KEY');
				$return = file_get_contents($url);
				echo $return;					
			} elseif($trainName){
				$url = 'http://apis.juhe.cn/train/s?name='.$trainName.'&key='.C('MOBILE_GET_BY_NET_KEY');
				$return = file_get_contents($url);
				echo $return;
			} else {
				$returnInfo = "信息填写不完整";
			}
			// 过滤掉不合理的数据
		}
		$this->display();
	} 
}
?>
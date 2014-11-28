<?php 
/*
 *功能：邮编信息的搜素查询
 *作者：yumao
 *联系方式:QQ:916564404
 *创建时间:2013/3/28
 */
class AirTicketSearchAction extends Action{

	/*
	 * 所有action默认调用的方法
	 */
	function _initialize(){
		$this->assign("flag","jiaotong");
		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	// 飞机票查询及结果的显示
	public function index(){
	
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示包含
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->display();
	}
	
	// 用来处理ajax请求特价机票对应的方法
	public function specialTicket(){
		header("Content-Type:text/html;charset=utf-8");
		
		// 获取回调函数名
		$callback = $_REQUEST['callback'];
		
		// 初始化缓存对象
		$cacheSpecialTicket = Cache::getInstance('file');
		
		// 保存特价机票信息
		$specialTicketInfo = array();
		
		// 先到缓存中得到
		$specialTicketInfo = $cacheSpecialTicket->get('specialTicketInfo');
		
		// 如果缓存中不存在则到远程采集
		if(!$specialTicketInfo){
			
			// 定义数据采集网址
			$collectUrl = C('KUXUN_JIPIAO_API');
			
			// 遍历采集数据
			foreach($collectUrl as $key=>$val){
			
				// 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
				$result = getByNetFun($val);
				
				// 正则匹配数据
				$re = '/<li><a\s*class="_date"\s*date=".*?"\s*price="\d*?"\s*href="(.*?)">.*?<span\s*class="TabContDate">(.*?)<\/span>.*?<span\s*class="TabContPlace">(.*?)<\/span>.*?<span\s*class="TabContPrice">&yen;<span>(\d+)<\/span><\/span>.*?<span\s*class="TabContSale">(.*?)折<\/span><\/span><\/a><\/li>/is';
				
				preg_match_all($re,$result,$matchAll,PREG_SET_ORDER);
				
				foreach($matchAll as $key2=>$val2){
					$specialTicketInfo[$key][$key2]['url'] = 'http://jipiao.kuxun.cn/'.$val2[1];
					$specialTicketInfo[$key][$key2]['time'] = $val2[2];
					$specialTicketInfo[$key][$key2]['path'] = $val2[3];
					$specialTicketInfo[$key][$key2]['price'] = $val2[4];
					$specialTicketInfo[$key][$key2]['discount'] = $val2[5];
				}
		
			}
			// 保存到缓存文件一小时
			$cacheSpecialTicket->set('specialTicketInfo',$specialTicketInfo,3600);
			
			
		}
		$specialTicketInfo = json_encode($specialTicketInfo);
		echo $callback."($specialTicketInfo)";
	}
	
	// 请求酒店数据的方法
	public function hotelData(){
		// 获取回调函数名
		$callback = $_REQUEST['callback'];
		
		// 初始化缓存对象
		$cacheHotel = Cache::getInstance('file');
		
		// 定义保存酒店信息的数组
		$hotelArr = array();
		$hotelArr = $cacheHotel ->  get('hotelInfo');
		if(!$hotelArr){
			// 定义采集数据的url地址
			$url = C('KUXUN_HOTEL_URL');
			
			// 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
			$result = getByNetFun($url);
			
			// 定义正则匹配规则
			$re = '/<li>\s*?<div\s+class=".*?"><a target="_blank"\s+title=""\s+href="(.*?)"><img src="(.*?)"\s+width="\d+"\s* height="\d+"><\/a><\/div>\s*<div\s+class=".*?">\s*<h3><a\s*target="_blank"\s*title=""\s*href=".*?">(.*?)<\/a><\/h3>\s*<p\s*class=".*?"><span\s*class=".*?"><span\s*class=".*?">¥<\/span><span\s*class=".*?">(\d*)<\/span>.*?<\/span>(.*?)<\/p>\s*<p\s*class=""><a\s*target="_blank"\s*title=""\s*href=".*?"\s*class=".*?">查看详情<\/a>位置：(.*?)<\/p>\s*<\/div>\s*<\/li>/is';
			
			// 定义匹配后数据保存的数组
			$matchArr = array();
			
			// 匹配获取数据
			preg_match_all($re,$result,$matchArr,PREG_SET_ORDER);
			//dump($matchArr);
			
			// 遍历数组存储数据
			foreach($matchArr as $key => $val){
				$hotelArr[$key]['detailsUrl'] = $val[1];
				$hotelArr[$key]['pic'] = $val[2];
				$hotelArr[$key]['name'] = $val[3];
				$hotelArr[$key]['price'] = $val[4];
				$hotelArr[$key]['star'] = $val[5];
				$hotelArr[$key]['address'] = $val[6];
			}
			// 缓存到文件一小时
			$cacheHotel -> set('hotelInfo',$hotelArr,3600);
		}
		
		// 把数据转换为json格式
		$hotelArr = json_encode($hotelArr);
		echo $callback."($hotelArr)";
		//dump($hotelArr);
	}
	// 飞机票查询及结果的显示
	public function indexbak(){
		
		// 获取航班号
		if($_POST['airticketNum']){
			$airticketNum = trim($_POST['airticketNum']);
		}
		
		//	获取航班时间
		if($_POST['startDate']){
			$startDate = trim($_POST['startDate']);
		}
		if($_POST['sub']){
			
			// 处理提交过来的数据
			if(!$airticketNum){
				$returnInfo = "请输入航班号";
				$this->assign("returnInfo",$returnInfo);
			} elseif(!$startDate){
				$returnInfo = "请输入航班日期";
				$this->assign("returnInfo",$returnInfo);
			} elseif(!preg_match('/\d{4}-\d{2}-\d{2}/',$startDate)) {
				
				// 所传入的日期格式不对
				$returnInfo = "请输入正确的如期格式如:2013-04-03";
				$this->assign("returnInfo",$returnInfo);		
			} else {
				
				// 到聚合的接口上查找数据
				$url = C('AIRTICKET_API_URL').$airticketNum."&date=".$startDate."&key=".C('MOBILE_GET_BY_NET_KEY');
				$result = getByNetFun($url);
				$result = trim($result);
				
				// 判断如果返回信息中含有BOM则去除BOM
				if(substr($result,0,3)==pack("CCC",0xef,0xbb,0xbf)){
					$result = substr($result,3);
				}
				var_dump(json_decode($result));
				$this->assign("startDate",$startDate);
			}
		}
		
		// 获取当前时间格式化
		$nowTime = date("Y-m-d");
		$this->assign('nowTime',$nowTime);
		$this->display();
	}
	
	// 航线搜索对应的方法
	public function laneSearch(){
	
		// 处理数据先略
		if($_POST['startCity']){
			$startCity = $_POST['startCity'];
		}
		if($_POST['aimCity']){
			$aimCity = $_POST['aimCity'];
		}
		if($_POST['startDate']){
			$startDate = $_POST['startDate'];
		}
		if($_POST['sub']){
		
			// 调用网络接口得到数据
			$url = C('AIRTICKET_API_URL2').$startCity."&end=".$aimCity."&date=".$startDate."&key=".C('MOBILE_GET_BY_NET_KEY');
			
			// 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
			$result= getByNetFun($url);
			$result = trim($result);
		
			// 判断如果返回信息中含有BOM则去除BOM
			if(substr($result,0,3)==pack("CCC",0xef,0xbb,0xbf)){
				$result = substr($result,6);
			}
			file_put_contents("bb.txt",$result);
			$airInfo = json_decode($result);
			dump($airInfo);
		}
	}
}
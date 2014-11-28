<?php
/**
 * 
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Yumao <815227173@qq.com>
 * @CreateDate: 2013-5-13 下午5:27:07
 * @version 1.0
 */
class ExchangeRateAction extends Action{
	/**
	 * 初始化
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-3 下午2:07:14
	 */
	function _initialize(){
		$this->assign("flag","jinrong");
		$this->assign("headerFlag",1);
	}
	
	/**
	 * 
	 *
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-13 下午5:27:40
	 */
	public function index(){
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		
		$this->gethl();
		$this->assign("froms", "CNY");
		$this->assign("tos", "USD");
		$this->display();
	}
	
	/**
	 * 
	 * 搜寻结果对应的方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-13 下午5:57:36
	 */
	public function search(){
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$country = array("CNY"=>"人民币","HKD"=>"港币","MOP"=>"澳门元","TWD"=>"台币","USD"=>"美元","GBP"=>"英镑","EUR"=>"欧元","KRW"=>"韩元","JPY"=>"日元","CAD"=>"加拿大元","AUD"=>"澳大利亚元","CHF"=>"瑞士法郎","SGD"=>"新加坡元","SEK"=>"瑞典克朗","DKK"=>"丹麦克朗","NOK"=>"挪威克朗","PHP"=>"菲律宾比索","THB"=>"泰国铢","NZD"=>"新西兰元");
		
		if($this->isPost()){
		
		// 获取数据
		// 需要转化的货币品种
		$from = $_POST['from'];
		
		// 转换后的货币品种
		$to = $_POST['to'];
		
		// 需要转换的数目
		$total = $_POST['total'];
		
		$yahooApi = C('YAHOO_HUILV_API');
		$url = $yahooApi['UC_API'].$from.$to."=X&f=sl1d1t1ba&e=.html";
		$result = getByNetFun($url);
		$result = explode(",",$result);
		$result['resultNum'] = $total*$result[1];
		$result['now'] = date("Y-m-d");
		$result[4] = $total * $result[4];
		$result[5] = $total * $result[5];
		//dump($result);
		$this->assign("froms", $from);
		$this->assign("tos", $to);
		$this->assign("from", $country["$from"]);
		$this->assign("to", $country["$to"]);
		$this->assign("total", $total);
		$this->assign("result", $result);
		$this->assign("sub_post", "1");
		}else {
			$this->assign("sub_post", "0");
		}
		$this->gethl();
		$this->assign("country",$country);
		$this->display("index");
	}
	/**
	 * 获取汇率数据
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-3 下午5:27:54
	 */
	function gethl(){
		$country = array("CNY"=>"人民币","HKD"=>"港币","MOP"=>"澳门元","TWD"=>"台币","USD"=>"美元","GBP"=>"英镑","EUR"=>"欧元","KRW"=>"韩国元","JPY"=>"日元","CAD"=>"加拿大元","AUD"=>"澳大利亚元","CHF"=>"瑞士法郎","SGD"=>"新加坡元","SEK"=>"瑞典克朗","DKK"=>"丹麦克朗","NOK"=>"挪威克朗","PHP"=>"菲律宾比索","THB"=>"泰国铢","NZD"=>"新西兰元");
		$juheApi = C('JUHE_HUILV_API');
		$result = getByNetFun($juheApi);
		$json = json_decode($result, true);
		$result = $json["result"]["0"];
		foreach($result as $key=>$value){
			$symbol = array_keys($country,$value["name"]);
			$result[$key]["symbol"] = $symbol[0];
			foreach ($value as $k=>$v){
				if($v <= 0 && $k != "name") $result[$key][$k]="";
			}
		}
		$this->assign("data", $result);
	}
}
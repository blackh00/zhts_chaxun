<?php
/* 
 *功能：身份证号码的查询
 *作者：yumao
 *联系方式:QQ:916564404
 *创建时间:2013/4/22
 */
class IdentitySearchAction extends Action{

	/*
	 * 所有action默认调用的方法
	 */
	function _initialize(){
		// 获取当前客户端ip
		$ip = get_client_ip();
		$this->assign("ip",$ip);
		$this->assign("flag","shenghuo");
		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	/*
	 *显示首页和查询结果页的相关方法
	 */
	public function index(){
	
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		if($_POST['identityNum']){
			$identityNum = trim($_POST['identityNum']);
		}
		// 定义匹配规则
		$reg = '/^(\d{15})|(\d{17}([0-9]|X))$/is';
		// 如果点击提交先进行数据处理
		if($identityNum){
			if(preg_match($reg,$identityNum)){
				$data=array();
				// 先到本地数据库中查询数据
				$identity = M('identityNum');
				$identityInfo = $this->searchDataFromLocalhost($identityNum,$data,$identity);
				
				// 如果没有在本地数据库中找到信息则到网上接口查找
				if(!$identityInfo){
				
					// 通过有道接口获取
					$identityInfo = $this->getDataFromNet($identityNum); 
					//dump($identityInfo);
					// 如果查询的数据不存在则输出错误信息
					if(!$identityInfo){
					
						// 如果本地数据库和接口都找不到数据则提示错误信息 
						$this->assign("errorInfo","您所查的身份证号码有误或不存在请仔细检查");
					} else {
						// 往本地数据库中插入数据
						// 处理数据
						$this->dealData($data,$identityInfo);
						
						//往数据库中插入数据
						$identity->add($data);
						// 用json格式返回数据
						if($data['sex'] == 1){
							$data['sex'] = "男";
						} else {
							$data['sex'] = "女";
						}
						$data['birthday'] = substr($data['birthday'],0,4)."年".substr($data['birthday'],4,2)."月".substr($data['birthday'],6,2);
						$this -> assign("identityInfo",$data);
					}	
				} else {
					if($identityInfo['sex'] == 1){
						$identityInfo['sex'] = "男";
					} else {
						$identityInfo['sex'] = "女";
					}
					
					// 数据组合成年月日格式
					$identityInfo['birthday'] = substr($identityInfo['birthday'],0,4)."年".substr($identityInfo['birthday'],4,2)."月".substr($identityInfo['birthday'],6,2);
					
					// 分配数据到前台
					$this -> assign("identityInfo",$identityInfo);
				}
			} else {
				$this -> assign("errorInfo","您所查的身份证号码有误或不存在请仔细检查");
			}
		}
		$this->display();	
	}
	
	
	/*
	 *手机号码信息的搜素
	 */
	public function search(){
		// 获取身份证号码
		if($_REQUEST['identityNum']){
			$identityNum = trim($_REQUEST['identityNum']);
		}
		
		// 获取回调函数名
		$callback = $_REQUEST['callback'];
		// 定义匹配规则
		$reg = '/^(\d{15})|(\d{17}([0-9]|X))$/is';
		
		// 判断身份证号码是否匹配
		if(preg_match($reg,$identityNum)){
		
			$data=array();
				// 先到本地数据库中查询数据
			$identity = M('identityNum');
			$identityInfo = $this->searchDataFromLocalhost($identityNum,$data,$identity);
			
			// 如果没有在本地数据库中找到信息则到网上接口查找
			if(!$identityInfo){
			
				// 通过有道接口获取
				$identityInfo = $this->getDataFromNet($identityNum); 
					
				//dump($identityInfo);
				// 如果查询的数据不存在则输出错误信息
				if(!$identityInfo){
					$errorInfo = array("errorNum"=>"2"); // 表示查找的身份证号码不存在
					$identityInfo = json_encode($errorInfo);
					echo $callback."($identityInfo)";  	
				} else {
				
					// 往本地数据库中插入数据
					// 处理数据
					$this->dealData($data,$identityInfo);
						
					// 往数据库中插入数据
					$identity->add($data);
					
					// 用json格式返回数据
					if($data['sex'] == 1){
						$data['sex'] = "男";
					} else {
						$data['sex'] = "女";
					}
					$identityInfo = json_encode($data);
					echo $callback."($identityInfo)";  
				}
			} else {
				// 如果从数据库中查到数据则直接处理数据
				if($identityInfo['sex'] == 1){
					$identityInfo['sex'] = "男";
				} else {
					$identityInfo['sex'] = "女";
				}
				$identityInfo = json_encode($identityInfo);
				echo $callback."($identityInfo)";  
			}
		} else {
			$errorInfo = array("errorNum"=>"1"); // 表示输入身份证号码结构不匹配
			$identityInfo = json_encode($errorInfo);
			echo $callback."($identityInfo)";  	
		}
	}
	
	/*
	 *从本地数据库中搜索数据
	 */
	private function searchDataFromLocalhost($identityNum,&$data,$identity){
				
			// 组装查询条件信息
			$data['identity_num'] = $identityNum;
			$identityInfo = $identity->where($data)->find();
			return $identityInfo;
	}
	
	/*
	 *从有道接口获取数据
	 */
	 private function getDataFromNet($identityNum){
		$youdaoApi = C('YOUDAO_SHRNFEN_API');
		$url = $youdaoApi['UC_API'].$identityNum;
		$identityInfo = getByNetFun($url);
		$identityInfo = iconv("gb2312","utf-8//IGNORE",$identityInfo);
		$identityInfo = str_replace("gbk", "UTF-8", $identityInfo);
		
		// 字符串数据转化为XML数据
		$identityInfo = simplexml_load_string($identityInfo);
		return $identityInfo;
	 }
	 
	 /*
	  * XML数据处理
	  */
	  private function dealData(&$data,$identityInfo){
	  	$data['address'] = (string)($identityInfo->product->location); // 这里一定要强制类型转换
		$data['birthday'] = (string)($identityInfo->product->birthday);
		foreach($data['birthday'] as $key=>$val){
			$data['birthday'] = $val[1][0];							
		}
		if($identityInfo->product->gender=="m"){
			$data['sex']	= 1;
		}else{
			$data['sex']	= 0;
		}
	  }
}
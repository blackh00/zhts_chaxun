<?php
/**
*功能：ip搜素所对应的控制器
*作者：yumao
*联系方式:QQ:916564404
*创建日期:2013/3/25
*/
class IpSearchAction extends Action{
	
	/*
	 * 所有action默认调用的方法
	 */
	function _initialize(){
	
		// 获取当前客户端ip
		//$ip = get_client_ip();	
		//$this->assign("ip",$ip);
		$this->assign("flag","shenghuo");
		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	/*
	首页或者查询后结果页所对应的方法
	*/
	public function index(){
		header("Content-Type:text/html;charset=utf-8");
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示包含
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		if($_REQUEST['ip']){
			$res = '/((25[0-5]|2[0-4]\d|1?\d?\d)\.){3}(25[0-5]|2[0-4]\d|1?\d?\d)/';
			
			// 判断ip地址是否合法
			if(preg_match($res,$_REQUEST['ip'])){
				$ip = $_REQUEST['ip'];
			} else {
				$returnInfo = "ip地址格式不正确";
			
				// 分配结果到模版
				$this->assign('returnInfo',$returnInfo);
			}
			
			// 状态标志代表是否是分类页面提交查询信息跳转到ip查询结果也还是用户直接访问结果也
			$this->assign("submitFlag","1");
		}  else {
			// 获取本地ip地址
			$ip = get_client_ip();	
			$this->assign("submitFlag","0");
		}
		
		// 如果你得到合法ip则进行查找
		if($ip){
			
			//	通过ip查询查询相应的地址
			$returnInfo = $this->ipToAddress($ip);
			// 分配结果到模版
			$this->assign('returnInfo',$returnInfo);
			
		}
		//$this->display("index.bak");
		$this->display();
	}
	
	// 首页输入信息ajax返回数据
	public function search(){
		header("Content-Type:text/html;charset=utf-8");
	
		// 获取回调函数名
		$callback = $_REQUEST['callback'];
		if($_REQUEST['ip']){
			$res = '/((25[0-5]|2[0-4]\d|1?\d?\d)\.){3}(25[0-5]|2[0-4]\d|1?\d?\d)/';
			$res2 = '/([a-z0-9][a-z0-9\-]*?\.(?:com|cn|net|org|gov|info|la|cc|co)(?:\.(?:cn|jp))?)$/is'; //代表域名
			// 判断ip地址是否合法
			if(preg_match($res,$_REQUEST['ip'])){
				$ip = $_REQUEST['ip'];
			} elseif(preg_match($res2,$_REQUEST['ip'])){
				$ip = gethostbyname($_REQUEST['ip']);
			} else {
				$errorInfo = array("errorNum" => "1"); // 代表ip地址格式不对
				$ipInfo = json_encode($errorInfo);
				echo $callback."($ipInfo)";
				exit;
			}
		} elseif (!$_REQUEST['ip']){
		
			// 获取本地ip地址
			$ip = get_client_ip();
			
			// 得到本地ip保存到客户端cookie一天时间
			setcookie("localhostIp",$ip,time()+3600*24,'/');
		}
		
		// 如果你得到合法ip则进行查找
		if($ip){
		
			//	通过ip查询查询相应的地址
			$returnInfo = $this->ipToAddress($ip);
			if(!$_REQUEST['ip']){
			
			// 如果是客户端直接访问本地地址则保存把ip类型直接保存到用户cookies中
			setcookie("localhostIpType",$returnInfo['area'],time()+3600*24,'/');
			
			// 如果是客户端直接访问本地地址则保存客户端ip地址到用户cookies中
			setcookie("localhostIpAddress",$returnInfo['country'],time()+3600*24,'/');
			}
			
			// 返回json数据
			$ipInfo = json_encode($returnInfo);
			echo $callback."($ipInfo)";
			exit;
		}
		
	}
	
		
	/****根据域名搜素ip和城市****/
	public function domain(){
		if(!$_REQUEST['domain'] && $_REQUEST['sub']){
			$returnInfo = "输入的域名不能为空";
		} elseif ($_REQUEST['domain']){
			$domain = trim(str_replace("http://",'',$_REQUEST['domain']));
		}
		
		if(!preg_match('/([a-z0-9][a-z0-9\-]*?\.(?:com|cn|net|org|gov|info|la|cc|co)(?:\.(?:cn|jp))?)$/',$domain) && !$returnInfo){
			$returnInfo = "您输入的域名不合法";
		}
		
		if(!$returnInfo){
			$ip = gethostbyname($domain);
			
			// 如果返回的值和原来输入的域名值是一样说明通过域名没有找到ip
			if($ip == $domain){
				$returnInfo = "您输入的域名不合法";
			}else{
			
				//	通过ip查询查询相应的地址
				$returnInfo = $this->ipToAddress($ip);
			}
		}
		$this->assign("ip",$ip);
		$this->assign('returnInfo',$returnInfo);
		$this->display("index");	
	}
	
	/*****通过ip查询相应的地址*****/
	private function ipToAddress($ip){
	
		// 第一步在thinkphp自带的UTFWry.dat中查找
		import('ORG.Net.IpLocation'); // 导入IpLocation类
		$Ip = new IpLocation(); // 实例化类
		$location = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
		//$returnInfo = $location['country']." ".$location['area'];
		$returnInfo = $location;
		// 转换为utf-8编码
		//$resultInfo = iconv("gb2312","utf-8//IGNORE",$resultInfo);
		
		
		// 如果没有查询到则到本地数据库查询
		if(!$returnInfo){
			$ipToAdd = M('ipToAddress');
			
			// 查询单条数据
			$condition = $this->ipToArr($ip);
			$ipToAddInfo = $ipToAdd->where($condition)->find();
			$returnInfo = $ipToAddInfo['address'];
		}
		
		// 如果还是没有查询到则到新浪上去采集
		if(!$returnInfo){
			$obj = $this->getBySina($ip);
			
			// 组装$returnInfo
			$returnInfo = $obj->country." ".$obj->province." ".$obj->city;
			if($returnInfo){
				
				// 往本地数据库中添加此条信息
				$condition['address'] = $returnInfo;
				$ipToAdd->add($condition);
			}
		}
	
		// 如果还是没有找到数据则
		if(!$returnInfo){
			$returnInfo = "抱歉没有找到ip的相关信息";
		}
		return $returnInfo;
		
	}
	/***从新浪上获取数据函数*/
	private function getBySina($ip){
		$url = C('SINA_PORT').$ip;
		
		// 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
		$result = getByNetFun($url);
		
		// 匹配获取自己需要格式的数据
		preg_match('/var remote_ip_info = (.*?);/',$result,$matchInfo);
		$matchjson = json_decode($matchInfo[1]);
		return $matchjson;
	}

	/******拆分ip并且组装成数组的方法******/
	private function ipToArr($ip){
	
		//拆分传递过来的ip
		$ipArr = explode('.',$ip);
				
		//组装查询条件
		$condition['ip1'] = $ipArr[0];
		$condition['ip2'] = $ipArr[1];
		$condition['ip3'] = $ipArr[2];
		$condition['ip4'] = $ipArr[3];
		return $condition;
	}
	
	/*** ip接口别人访问时通过ip得到本地地址****/
	public function ipPort(){
		
		$ip = $_COOKIE['localhostIp'];
		if(!$ip){
		// 获取本地ip地址
		$ip = get_client_ip();
			
		// 得到本地ip保存到客户端cookie一天时间
		setcookie("localhostIp",$ip,time()+3600*24);
		
		}
		//	通过ip查询查询相应的地址
		$returnInfo = $this->ipToAddress($ip);
		echo json_encode($returnInfo);
	}
	
	/*** 外网访问ip地址对应接口****/
	public function outerIpPort(){
		// 获取回调函数名
		$callback = $_REQUEST['getIp'];
		$ip = $_COOKIE['localhostIp'];
		if(!$ip){
		// 获取本地ip地址
		$ip = get_client_ip();
			
		// 得到本地ip保存到客户端cookie一天时间
		setcookie("localhostIp",$ip,time()+3600*24);
		
		}
		//	通过ip查询查询相应的地址
		$returnInfo = $this->ipToAddress($ip);
		$returnInfo = json_encode($returnInfo);
		$callback."($returnInfo)";
	}
	
}
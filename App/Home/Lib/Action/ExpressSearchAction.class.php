<?php
/* 
 *功能：快递信息的搜素查询
 *作者：yumao
 *联系方式:QQ:916564404
 *创建时间:2013/3/26
 */
class ExpressSearchAction extends Action{

	/*
	 * 所有action默认调用的方法
	 */
	function _initialize(){
		// 获取当前客户端ip
		$ip = get_client_ip();	
		$this->assign("ip",$ip);
		$this->assign("flag","express");
		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	// 显示首页和查询结果页的相关方法
	public function index(){
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		// 定义各个快递公司所对应账单号的规则
		// $expressRule = C('EXPRESS_API_RULE');
		
		// 在配置文件中获取接口url相关信息
		//$urlInfo = C("EXPRESS_API_URL");
		// 获取相关基础信息
		$expressNameCode = C('EXPRESS_COMPANY_NAME');
		$key = $_REQUEST['key'];
		$expressNum = trim($_REQUEST['expressNum']);
		$expressMatch = $expressInfo[$key]['matchRule'];
		$this->sortByCode($expressNameCode);
		
		// 截取前面十二项最常用的
		$expressNameCode = array_slice($expressNameCode,0,12);
		$this->assign('expressNameCode',$expressNameCode);
		
		// 快递默认显示的是第一个快递公司相关的信息
		$code = $expressNameCode[0];
		$this->assign("codeDefault",$code);
		// 从配置文件中读取快递信息
		$expressInfo = C('EXPRESS_COMPANY_NAME');
		$expressMatch = $expressInfo[$key]['matchRule'];
		// 如果匹配所对应公司的订单规则才进行处理
		if(!$expressMatch || preg_match($expressMatch,$expressNum)){
			$expressType = $expressInfo[$key]['code'];
			$express_api = C('EXPRESS_API');
			$url = $express_api['UC_API'].$expressType."&nu=".$expressNum."&id=".$express_api['UC_KEY'];
			// 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
			$result = getByNetFun($url);
			$this->dealInfo($result);
		}
		$this->display();
	}
	
	/*
	 *快递公司按字母排序
	 *
	 */
	private function sortByCode($expressNameCode){
		// 以字母为下标组装快递公司
		$expressNameByCode = array();
		foreach($expressNameCode as $key=>$val){
			switch($val['charSort']){
				case 'A':$expressNameByCode['A'][] = $val;
				break;
				case 'B':$expressNameByCode['B'][] = $val;
				break;
				case 'C':$expressNameByCode['C'][] = $val;
				break;
				case 'D':$expressNameByCode['D'][] = $val;
				break;
				case 'E':$expressNameByCode['E'][] = $val;
				break;
				case 'F':$expressNameByCode['F'][] = $val;
				break;
				case 'G':$expressNameByCode['G'][] = $val;
				break;
				case 'H':$expressNameByCode['H'][] = $val;
				break;
				case 'I':$expressNameByCode['I'][] = $val;
				break;
				case 'J':$expressNameByCode['J'][] = $val;
				break;
				case 'K':$expressNameByCode['K'][] = $val;
				break;
				case 'L':$expressNameByCode['L'][] = $val;
				break;
				case 'M':$expressNameByCode['M'][] = $val;
				break;
				case 'N':$expressNameByCode['N'][] = $val;
				break;
				case 'O':$expressNameByCode['O'][] = $val;
				break;
				case 'P':$expressNameByCode['P'][] = $val;
				break;
				case 'Q':$expressNameByCode['Q'][] = $val;
				break;
				case 'R':$expressNameByCode['R'][] = $val;
				break;
				case 'S':$expressNameByCode['S'][] = $val;
				break;
				case 'T':$expressNameByCode['T'][] = $val;
				break;
				case 'U':$expressNameByCode['U'][] = $val;
				break;
				case 'V':$expressNameByCode['V'][] = $val;
				break;
				case 'W':$expressNameByCode['W'][] = $val;
				break;
				case 'X':$expressNameByCode['X'][] = $val;
				break;
				case 'Y':$expressNameByCode['Y'][] = $val;
				break;
				case 'Z':$expressNameByCode['Z'][] = $val;
				break;
			}
		}
		
		// 按照下标排序
		ksort($expressNameByCode);
		$this->assign("expressNameByCode",$expressNameByCode);
	}

	/*
	 *搜索数据
	 *
	 */
	public function search(){
		
		// 获取回调函数名
		$callback = $_REQUEST['callback'];
		// 获取快递的公司的下标key值和快递单
			$key = $_REQUEST['key'];
		
		// 获取快递单号
		if($_REQUEST['expressNum']){
			$expressNum = $_REQUEST['expressNum'];
		}

		// 从配置文件中读取快递信息
		$expressInfo = C('EXPRESS_COMPANY_NAME');
		$expressMatch = $expressInfo[$key]['matchRule'];
		// 实例化memcache类对象
		$Cache = Cache::getInstance('Memcache');
		
		// 先从memcache 中取数据
		$result = $Cache->get($expressMatch.$expressNum);
		if($result){
			echo $callback."($result)";
			
			exit;
		}
		if(!$expressMatch || preg_match($expressMatch,$expressNum)){
			$expressType = $expressInfo[$key]['code'];
			$express_api = C('EXPRESS_API');
			$url = $express_api['UC_API'].$expressType."&nu=".$expressNum."&id=".$express_api['UC_KEY'];
			
			// 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
			$result = getByNetFun($url);
			$result = iconv("gb2312","utf-8//IGNORE",$result);
			
			// 把数据缓存到memcache中
			$Cache->set($expressMatch.$expressNum,$result,3600);
			echo $callback."($result)";
			exit;
		}else{
			$errorInfo = array("errorNum"=>"1"); // 代表数据匹配不上
			$errorInfo = json_encode($errorInfo);
			echo $callback."($errorInfo)";
			exit;
		}
	}
	/*
	 * 返回数据的处理函数
	 */
	private function dealInfo($result){
		$result = iconv("gb2312","utf-8//IGNORE",$result);
		
		$returnJson = json_decode($result);
		
		// 分配到前台模版中显示数据
		if($returnJson->data){
			$this->assign("expressInfoLength",count($returnJson->data));
			$this->assign("expressInfo",array_reverse($returnJson->data));
		} else {
			// 分配到前台模版中显示数据
			$this->assign("expressInfoError","<font color='red'>您所输入的账单号不存在</font>");
		}
	}

}
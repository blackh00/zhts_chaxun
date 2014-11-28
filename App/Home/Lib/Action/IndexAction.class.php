<?php
/**
*功能：网站首页控制器
*作者：yumao
*联系方式:QQ:916564404
*创建日期:2013/4/16
*/
class IndexAction extends Action{
	
	/*
	 * 所有action默认调用的方法
	 */
	function _initialize(){
		
		// 分配模版名到前端
		//$this->ass
		// 获取当前客户端ip
		$ip = get_client_ip();	
		$this->assign("ip",$ip);
		
		// 分配查询首页title关键字
		$this->assign("titleKey","快查首页");
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		
	}
	
	/*
	 * 首页或者查询后结果页所对应的方法
	 */
	public function index(){
		
		
		
		
		
		// 首页导航信息和其他的页面不同分配特殊标志
		$this->assign("flagIndex",1); // 代表有滑动效果
		// 获取快递公司相关信息
		
		$expressNameCode = $this -> expressInfo();
		
		// 获取前面24项
		$expressNameCode = array_slice($expressNameCode,0,24);
		$this -> assign('expressNameCode',$expressNameCode);
		
		// 快递默认显示的是第一个快递公司相关的信息
		$code = $expressNameCode[0];
		$this->assign("codeDefault",$code);
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("footerFlag",1); // 1表示要包含
		

		
		$this->assign("headInfo", setHead()); // 设置页面头部信息

		
		$this -> display();
	}
	
	/*
	 * 交通出行频道首页
	 */
	public function jiaotong(){
	
		// 分配查询交通出行频道页title关键字
		$this->assign("titleKey","交通出行-快查");
		
		// 分配标志代表是交通出行频道页
		$this->assign("flag","jiaotong");
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示要包含
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		
		$this->display();
	 
	}
	
	/*
	 * 教育学习频道首页
	 */
	 public function jiaoyu(){
		
		// 分配查询站教育学习频道页title关键字
		$this->assign("titleKey","教育学习-快查");
		
		// 分配标志 代表是教育学习频道首页
		$this->assign("flag","jiaoyu");
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示要包含
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		
		$this->display();
	 }
	 
	 /*
	  * 教育学习频道首页
	  */
	public function shenghuo(){
		
		// 分配生活频道页面title关键字
		$this->assign("titleKey","生活助手-快查");
		
		// 分配标志 代表是生活频道首页
		$this->assign("flag","shenghuo");
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示要包含
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->display();
	}
	
	/*
	 * 娱乐频道首页
	 */
	public function yule(){
	
		// 分配娱乐频道页面title关键子
		$this->assign("titleKey","休闲娱乐-快查");
		
		// 分配标志 代表是娱乐频道首页
		$this->assign("flag","yule");
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示要包含
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->display();
	}
	
	/*
	 * 金融频道首页
	 */ 
	public function jinrong(){
		
		// 获得彩票数据。
		$contents1 = @file_get_contents("http://kaijiang.500.com/ssq.shtml");
		$contents1 = iconv('GB2312', 'UTF-8//IGNORE', $contents1);
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents1, $shuangSe3);
		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
		$shuangSe03[]=strip_tags($shuangSe3[0][5]);
		$data['shuangSe03']=$shuangSe03;
		//print_r($shuangSe03);exit;
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents1, $shuangSe4);
		$shuangSe04=strip_tags($shuangSe4[0][0]);
		$data['shuangSe04']=$shuangSe04;
		//print_r($shuangSe04);exit;
		
		$data['1']=$shuangSe03[0];
		$data['2']=$shuangSe03[1];
		$data['3']=$shuangSe03[2];
		$data['4']=$shuangSe03[3];
		$data['5']=$shuangSe03[4];
		$data['6']=$shuangSe03[5];
		$data['7']=$shuangSe04;
		$this->assign('data',$data);
	
		// 金融频道首页title关键字
		$this->assign("titleKey","金融理财-快查");
		
		// 分配标志 代表是金融频道首页
		$this->assign("flag","jinrong");
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示要包含
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->display();
	}
	
	/*
	 * 综合频道首页
	 */ 
	public function zonghe(){
		
		// 综合频道首页title关键字
		$this->assign("titleKey","综合查询-快查");
		
		// 分配标志 代表是综合频道页面首页
		$this->assign("flag","zonghe");
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示要包含
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->display();		
	}
	
	/*
	 * 获取快递相关信息
	 *
	 */ 
	private function expressInfo(){
		$expressNameCode = C('EXPRESS_COMPANY_NAME');
		return $expressNameCode;
	}
	
	/*
	 * 静态页面用ajax获取本机ip
	 */
	 public function searchIp(){
	 
		// 获取当前客户端ip
		$ip = get_client_ip();
		
		// 定义ipInfo数组
		$ipInfo['ip'] = $ip;
		// 得到本地ip保存到客户端cookie一天时间
		setcookie("localhostIp",$ip,time()+3600*24);
		// 获取回调函数
		$callback = $_REQUEST['callback'];
		$ipInfo = json_encode($ipInfo);
		
		echo $callback."($ipInfo)";
	 }	
	 
	 /*
	  * 搜索结果页面相关
	  */
	  public function search(){
		
		// 搜索首页title关键字
		$this->assign("titleKey","查询结果-首页");
		
			// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示要包含
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		// 分配标志 代表是综合频道页面首页
		$this->assign("flag","search");
		$this->display();
	  }
	  
	  public function caiPiao(){
	  	
	  	// 获得选中彩票的开奖数。
	  	$callback=$_REQUEST['callback'];   // 解决ajax跨域问题。
	  	
	  	$contents1 = @file_get_contents("http://kaijiang.500.com/ssq.shtml");
	  	$contents1 = iconv('GB2312', 'UTF-8//IGNORE', $contents1);
	  	if(isset($_REQUEST['cate']) && $_REQUEST['cate']=='1'){
	  		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents1, $shuangSe3);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][5]);
	  		$data['shuangSe03']=$shuangSe03;
	  		//print_r($shuangSe03);exit;
	  		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents1, $shuangSe4);
	  		$shuangSe04=strip_tags($shuangSe4[0][0]);
	  		$data['shuangSe04']=$shuangSe04;
	  		//print_r($shuangSe04);exit;	  		
	  		
		  	$data['1']=$shuangSe03[0];
		  	$data['2']=$shuangSe03[1];
		  	$data['3']=$shuangSe03[2];
		  	$data['4']=$shuangSe03[3];
		  	$data['5']=$shuangSe03[4];
		  	$data['6']=$shuangSe03[5];
		  	$data['7']=$shuangSe04;
		  	$data['8']='555';
		  	$data['status']='shuangseqiu';
		  	$data['info']='获取数据成功。';
		  	
		  	
		  	$data = json_encode($data);
		  	echo $callback."($data)";
		  	
		  	
		  	//$this->ajaxReturn($data,'JSON');
		  	// $this->display();
	  	} elseif (isset($_REQUEST['cate']) && $_REQUEST['cate']=='2'){
	  		$contents = @file_get_contents("http://kaijiang.500.com/sd.shtml");
	  		$contents = iconv('GB2312', 'UTF-8//IGNORE', $contents);
	  		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents, $shuangSe3);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][2]);	  		
	  		//print_r($shuangSe03);exit;
	  		
	  		$data['1']=$shuangSe03[0];
	  		$data['2']=$shuangSe03[1];
	  		$data['3']=$shuangSe03[2];
	  		$data['status']='sandi';
	  		$data['info']='获取数据成功。';
	  		
	  		$data = json_encode($data);
	  		echo $callback."($data)";
	  		// $this->ajaxReturn($data,'JSON');
	  		
	  	} elseif (isset($_REQUEST['cate']) && $_REQUEST['cate']=='3'){
	  		$contents2 = @file_get_contents("http://kaijiang.500.com/qlc.shtml");
	  		$contents2 = iconv('GB2312', 'UTF-8//IGNORE', $contents2);
	  		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents2, $shuangSe3);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][5]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][6]);
	  		$data['shuangSe03']=$shuangSe03;
	  		//print_r($shuangSe03);exit;
	  		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents2, $shuangSe4);
	  		$shuangSe04=strip_tags($shuangSe4[0][0]);
	  		$data['shuangSe04']=$shuangSe04;
	  		//print_r($shuangSe04);exit;
	  		
	  		$data['1']=$shuangSe03[0];
	  		$data['2']=$shuangSe03[1];
	  		$data['3']=$shuangSe03[2];
	  		$data['4']=$shuangSe03[3];
	  		$data['5']=$shuangSe03[4];
	  		$data['6']=$shuangSe03[5];
	  		$data['7']=$shuangSe03[6];
	  		$data['8']=$shuangSe04;
	  		$data['status']='qicaile';
	  		$data['info']='获取数据成功。';
	  		
	  		$data = json_encode($data);
	  		echo $callback."($data)";
	  		// $this->ajaxReturn($data,'JSON');
	  		
	  	} elseif (isset($_REQUEST['cate']) && $_REQUEST['cate']=='4'){
	  		
	  		$contents3 = @file_get_contents("http://kaijiang.500.com/eexw.shtml");
	  		$contents3 = iconv('GB2312', 'UTF-8//IGNORE', $contents3);
	  		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents3, $shuangSe3);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
	  		$data['shuangSe03']=$shuangSe03;
	  		//print_r($shuangSe03);exit;
	  		
	  		$data['1']=$shuangSe03[0];
	  		$data['2']=$shuangSe03[1];
	  		$data['3']=$shuangSe03[2];
	  		$data['4']=$shuangSe03[3];
	  		$data['5']=$shuangSe03[4];
	  		$data['status']='erer';
	  		$data['info']='获取数据成功。';
	  		
	  		$data = json_encode($data);
	  		echo $callback."($data)";
	  		// $this->ajaxReturn($data,'JSON');
	  		
	  	} elseif (isset($_REQUEST['cate']) && $_REQUEST['cate']=='5'){
	  		
	  		$contents = @file_get_contents("http://kaijiang.500.com/pls.shtml");
	  		$contents = iconv('GB2312', 'UTF-8//IGNORE', $contents);
	  		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents, $shuangSe3);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
	  		$data['shuangSe03']=$shuangSe03;
	  		//print_r($shuangSe03);exit;
	  		
	  		$data['1']=$shuangSe03[0];
	  		$data['2']=$shuangSe03[1];
	  		$data['3']=$shuangSe03[2];
	  		$data['status']='paile';
	  		$data['info']='获取数据成功。';
	  		
	  		$data = json_encode($data);
	  		echo $callback."($data)";
	  		//  $this->ajaxReturn($data,'JSON');
	  		
	  	} elseif (isset($_REQUEST['cate']) && $_REQUEST['cate']=='6'){
	  		
	  		$contents3 = @file_get_contents("http://kaijiang.500.com/qxc.shtml");
	  		$contents3 = iconv('GB2312', 'UTF-8//IGNORE', $contents3);
	  		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents3, $shuangSe3);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][5]);
	  		$shuangSe03[]=strip_tags($shuangSe3[0][6]);
	  		$data['shuangSe03']=$shuangSe03;
	  		//print_r($shuangSe03);exit;
	  		
	  		$data['1']=$shuangSe03[0];
	  		$data['2']=$shuangSe03[1];
	  		$data['3']=$shuangSe03[2];
	  		$data['4']=$shuangSe03[3];
	  		$data['5']=$shuangSe03[4];
	  		$data['6']=$shuangSe03[5];
	  		$data['7']=$shuangSe03[6];
	  		$data['status']='qixingcai';
	  		$data['info']='获取数据成功。';
	  		
	  		$data = json_encode($data);
	  		echo $callback."($data)";
	  		// $this->ajaxReturn($data,'JSON');
	  		
	  	} elseif (isset($_REQUEST['cate']) && $_REQUEST['cate']=='7'){
	  		
	  		$contents3 = @file_get_contents("http://kaijiang.500.com/dlt.shtml");
	  		$contents3 = iconv('GB2312', 'UTF-8//IGNORE', $contents3);

	  		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents3, $shuangSe3);
			$shuangSe03[]=strip_tags($shuangSe3[0][0]);
			$shuangSe03[]=strip_tags($shuangSe3[0][1]);
			$shuangSe03[]=strip_tags($shuangSe3[0][2]);
			$shuangSe03[]=strip_tags($shuangSe3[0][3]);
			$shuangSe03[]=strip_tags($shuangSe3[0][4]);
			$data['shuangSe03']=$shuangSe03;
			//print_r($shuangSe03);exit;
			preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents3, $shuangSe4);
			$shuangSe04[]=strip_tags($shuangSe4[0][0]);
			$shuangSe04[]=strip_tags($shuangSe4[0][1]);
			$data['shuangSe04']=$shuangSe04;
			//print_r($shuangSe04);exit;
	  		
	  		$data['1']=$shuangSe03[0];
	  		$data['2']=$shuangSe03[1];
	  		$data['3']=$shuangSe03[2];
	  		$data['4']=$shuangSe03[3];
	  		$data['5']=$shuangSe03[4];
	  		$data['6']=$shuangSe04[0];
	  		$data['7']=$shuangSe04[1];
	  		$data['status']='daletou';
	  		$data['info']='获取数据成功。';
	  		
	  		$data = json_encode($data);
	  		echo $callback."($data)";
	  		//  $this->ajaxReturn($data,'JSON');
	  	} 
	  	
	  }
}
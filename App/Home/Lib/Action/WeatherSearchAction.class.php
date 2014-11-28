<?php
// 数据查询体验
class WeatherSearchAction extends Action{
	function _initialize() {
		// 为了方便使用，先在初始化方法里统一编码
		header("Content-Type:text/html; charset=utf-8");
		$this->assign("flag","shenghuo");
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	public function index(){
	
		// 如果是ajax请求但文件没过期就什么都不要执行 
		// 得到当前时间的年月日
		$nowTime  = date("Y-m-d",time());
		
		// 得到天气首页最后一次修改的年月日时间
		$tianqiFileEditTime = date("Y-m-d",filemtime(ROOT_PATH."/Www/Html/".C("WeatherSearch")."/index.html"));
		if($_GET['isajax'] && ($nowTime == $tianqiFileEditTime )){
			exit;
		}else{
		
			// 用来标志是否在模版页面尾部要包含另外的js
			$this->assign("footerFlag",1); // 1表示包含
			$weatherInfoRecently = array();
			$weatherInfoAll = $this->dealData($weatherInfoRecently); // 获取相关数据
			
			// 刷选处理要用到的数据组装当天和第二天的天气数据数组
		
			
			$weatherInfoRecently['today']['day'] = date("m月d日",time()); // 保存当前时间
			$weatherInfoRecently['tomorrow']['day'] = date("m月d日",time()+3600*24); // 保存第二天的时间
			$weatherInfoRecently['today']['week'] = $this->timeToWeek(date("w"));
			$weatherInfoRecently['tomorrow']['week'] = $this->timeToWeek(date("w",time()+3600*24));
			
			// 今天的天气信息
			$weatherInfoRecently['today']['daytimeWeather'] = $weatherInfoAll->weatherinfo->img_title1;
			$weatherInfoRecently['today']['nightWeather'] = $weatherInfoAll->weatherinfo->img_title2;
			
			// 如果今天有雨则分配温馨提示信息
			if(stristr($weatherInfoRecently['today']['daytimeWeather'],'雨') || stristr($weatherInfoRecently['today']['nightWeather'],'雨')){
				$this -> assign('suggest','今天可能要下雨，出门记得带伞哦~');
			}
			// 第二天天气信息
			$weatherInfoRecently['tomorrow']['daytimeWeather'] = $weatherInfoAll->weatherinfo->img_title3;
			$weatherInfoRecently['tomorrow']['nightWeather'] = $weatherInfoAll->weatherinfo->img_title4;
			
			// 今天的温度信息
			$weatherInfoRecently['today']['temperature'] = $weatherInfoAll->weatherinfo->temp1;
			
			// 第二天温度信息
			$weatherInfoRecently['tomorrow']['temperature'] = $weatherInfoAll->weatherinfo->temp2;
			
			// 今天的天气对应图片
			$weatherInfoRecently['today']['daytimePic'] = $weatherInfoAll->weatherinfo->img1.".png";
			$weatherInfoRecently['today']['nightPic'] = $weatherInfoAll->weatherinfo->img2.".png";
			
			// 如果返回图片信息是99说明晚上白天天气信息相同
			if($weatherInfoRecently['today']['nightPic'] == "99.png"){
				$weatherInfoRecently['today']['nightPic'] = $weatherInfoRecently['today']['daytimePic'];
			}
			
			// 明天的天气对应图片
			$weatherInfoRecently['tomorrow']['daytimePic'] = $weatherInfoAll->weatherinfo->img3.".png";
			$weatherInfoRecently['tomorrow']['nightPic'] = $weatherInfoAll->weatherinfo->img4.".png";
			
			// 如果返回图片信息是99说明晚上白天天气信息相同
			if($weatherInfoRecently['tomorrow']['nightPic'] == "99.png"){
				$weatherInfoRecently['tomorrow']['nightPic'] = $weatherInfoRecently['tomorrow']['daytimePic'];
			}
			
			// 获取今天的风向信息
			$weatherInfoRecently['today']['wind'] = $weatherInfoAll->weatherinfo->wind1;
			
			// 获取第二天风向信息
			$weatherInfoRecently['tomorrow']['wind'] = $weatherInfoAll->weatherinfo->wind2;
			
			// 获取今天风级数
			$weatherInfoRecently['today']['stages'] = $weatherInfoAll->weatherinfo->fl1;
			
			// 获取第二天风级数
			$weatherInfoRecently['tomorrow']['stages'] = $weatherInfoAll->weatherinfo->fl2;
			
			//dump($weatherInfoAll);
			// 保存当天的其他信息
			$todayAnotherInfo = array();
			$todayAnotherInfo['index'] = $weatherInfoAll->weatherinfo->index; // 穿衣指数
			$todayAnotherInfo['index_uv'] = $weatherInfoAll->weatherinfo->index_uv; // 紫外线指数
			$todayAnotherInfo['index_xc'] = $weatherInfoAll->weatherinfo->index_xc; // 洗车指数
			$todayAnotherInfo['index_tr'] = $weatherInfoAll->weatherinfo->index_tr; // 旅游指数
			$todayAnotherInfo['index_cl'] = $weatherInfoAll->weatherinfo->index_cl; // 晨练指数
			$todayAnotherInfo['index_ls'] = $weatherInfoAll->weatherinfo->index_ls; // 晾晒指数
			$todayAnotherInfo['index_ag'] = $weatherInfoAll->weatherinfo->index_ag; // 过敏气象指数
			$this->assign('todayAnotherInfo',$todayAnotherInfo);
			// 遍历获取最近四天的天气相关信息
			$weatherAnotherDayInfo = array(); // 用来保存其他四天的天气信息
			for($i=3;$i<=6;$i++){
				$weatherAnotherDayInfo[$i]['day'] = date("m月d日",time()+3600*24*($i-1)); 
				$weatherAnotherDayInfo[$i]['week'] = $this->timeToWeek(date("w",time()+3600*24*($i-1)));
				
				// 获取天气其他相关信息返回数组格式数据
				$weatherAnotherDayInfo[$i]['weatherAnotherInfo'] =  $this->getWeatherInfoPic($i,$weatherInfoAll);
			}
		
			
			// 分配今明两天的信息到前端模版
			$this->assign('weatherInfoRecently',$weatherInfoRecently);
			
			// 分配其他天的信息到前端模版
			$this->assign('weatherAnotherDayInfo',$weatherAnotherDayInfo);
			$this->assign('cityid',$number);
			$this->assign('weatherInfoAll',$weatherInfoAll);
			
			// 如果是ajax请求则生成静态页面 不是就直接展现页面
			if($_GET['isajax'] && ($nowTime != $tianqiFileEditTime)){
			
				// 定义页面内容保存变量
				$content = $this->fetch();
				
				// 往天气首页写入内容
				file_put_contents(ROOT_PATH."/Www/Html/".C("WeatherSearch")."/index.html",$content);
				
			} else {
				$this->display();
			}
			
		}
    }
	
	public function weatherApi(){
		
		 // 获取客户端提交过来的城市编号
		 if(!$_GET['city']){
			exit;
		 }
		 
		 // 从接口获取数据
		 $data = getweatherinfo($_GET['city']);
		 // 定义变量保存返回的数据	
		$weatherInfoRecently = array();
		/*
		$weatherInfoRecently['today']['daytimeWeather'] = $data->weatherinfo->img_title1;
		echo $weatherInfoRecently['today']['daytimeWeather'];
		echo $data;*/
		//echo json_encode($data);
		$data = json_decode($data);
		// 城市名称
		$weatherInfoRecently['city'] = $data->weatherinfo->city;
		//echo $weatherInfoRecently['city'];
		
		// 当天日期
		$weatherInfoRecently['date'] = date("Y-m-d",time());
		
		// 当天气温
		$weatherInfoRecently['temp'] = $data->weatherinfo->temp1;
		
		// 当天天气
		$weatherInfoRecently['weather'] = $data->weatherinfo->weather1;
		
		// 当天湿度
		$weatherInfoRecently['humidity'] = ""; // 接口没有提供数据
		
		// 当天风向
		$weatherInfoRecently['wind'] = $data->weatherinfo->wind1.$data->weatherinfo->fl1;	
		
		// 今天是周几
		$weatherInfoRecently['week'] = $this->timeToWeek(date("w",time()));
		
		// 今天的农历
		$weatherInfoRecently['lunar_calendar'] = "";
		$weatherInfoRecently['pm'] = "";
		
		// 紫外线
		$weatherInfoRecently['rays'] = $data->weatherinfo->index_uv;
		
		// 其他天的情况
		$weatherInfoRecently['more'] = array();
		for($i=1;$i<=6;$i++){
			if($i==1){
				$weatherInfoRecently['more'][$i-1]['tag'] = "今天"; 
			}else{
				$weatherInfoRecently['more'][$i-1]['tag'] = $this->timeToWeek(date("w",time()+($i-1)*24*3600));
			}
			$weather = "weather".$i;
			$img =  "img".$i;
			$temp = "temp".$i;
			$weatherInfoRecently['more'][$i-1]['date'] = date("m.d",time()+($i-1)*24*3600);
			
			$weatherInfoRecently['more'][$i-1]['img'] = (int)($data->weatherinfo->$img);
			
			$temperatureArr = explode("~",$data->weatherinfo->$temp);
			
			$weatherInfoRecently['more'][$i-1]['max'] = $temperatureArr[0];
			$weatherInfoRecently['more'][$i-1]['min'] = $temperatureArr[1];
			$weatherInfoRecently['more'][$i-1]['weather'] = $data->weatherinfo->$weather;
			
		
			//dump($data->weatherinfo->weather1);
			//dump($data->weatherinfo->$weather);
			
		
		}
		if($weatherInfoRecently['more']){
			
			// 说明数据有获取
			$weatherInfoRecently['state']=0;
			$weatherInfoRecently['error_info'] = "OK";
		}else{
		
			// 说明接口数据获取有误
			$weatherInfoRecently['state']=-1;
			$weatherInfoRecently['error_info'] = "接口数据获取有误";
		}
		if($_GET['flag']){
			dump($weatherInfoRecently);
		}else{
			echo json_encode($weatherInfoRecently);
		}
	}
	public function cityweather(){
		$number = getcityid($_POST['country']);			//获取县级名
		if(!$number){$number = getcityid($_POST['city']);}				//如果县级名没找到，则找市级名
		if(!$number){$number = "101010100";}			//如果市级名也未找到，这默认为北京
		$datas = getweatherinfo($number);			//接口获取天气信息	
		echo $datas;
	}
	// 定义数据处理函数
	private function dealData(&$weatherInfoRecently){
		
		// 去除通过url get中提交过来的参数后面的省市区
		$province = $_GET['province'];
		$city = rtrim($_GET['city'],'省市县区');
		$county = rtrim($_GET['county'],'省市县区');
		
		// 分配选择地址到视图中
		$this->assign('county',$_GET['county']);
		
		// 过滤掉重复数据
		$addressFlip = array('朝阳','通州','金山','松江','天池','东港','清水河','河南','河口','东乡','南溪','玉山','东兴');
		
		// 前面加上省防止重复的数出现例如辽宁有朝阳北京也有朝阳
		if(in_array($county,$addressFlip)){
			$number = getcityid($province.$county);
		} else {
			$number = getcityid($county);
		}
		if(!$number){
			if(in_array($city,$addressFlip)){
				$number = getcityid($province.$city);
				
			} else {
				$number = getcityid($city);
			}
		}
		if(!$number){
				$number = getcityid($province);
		}
		if(!$province){
			
			// 说明用户是通过直接今日天气页面必须获取用户当前地址
			$addressInfo = getByNetFun(C('SITE_DYNAMIC_URL')."/ip/ipPort");
			
			$addressInfo = json_decode($addressInfo);
			
			// 正则匹配
			$re = '/(?:.*?省)?(.*?)(?:市|区|县)/is';
			
			if(preg_match($re,$addressInfo->country,$matchWeathInfo)){
				$addressWeath = $matchWeathInfo[1];
				$number = getcityid($addressWeath);
				$weatherInfoRecently['address'] = $addressWeath;
				$this->assign('county',$addressWeath);
			} else {
				$number = getcityid('深圳');
				$weatherInfoRecently['address'] = '深圳';
				$this->assign('county','深圳');
			}
		}
		$data = getweatherinfo($number);			//接口获取天气信息
		// $array中保存天气信息
		$weatherInfoAll = json_decode($data);		//json信息转化为数据信息
		return $weatherInfoAll;
	}
	// 把获取到的星期中的第几天的数据转化为周一，周二这种格式的数据
	private function timeToWeek($weekday){
		switch ($weekday){
			case 0:
				$weekdate = "周日";
				break;
			case 1:
				$weekdate = "周一";
				break;
			case 2:
				$weekdate = "周二";
				break;
			case 3:
				$weekdate = "周三";
				break;
			case 4:
				$weekdate = "周四";
				break;
			case 5:
				$weekdate = "周五";
				break;
			case 6:
				$weekdate = "周六";
				break;
		}
		return $weekdate;
	}
	
	// 获取天气其他相关信息函数
	private function getWeatherInfoPic($i,$weatherInfoAll){
		switch (2*$i-1){
			case 5:
				$weatherAnotherInfo['pic'] = $weatherInfoAll->weatherinfo->img5.".png";
				$weatherAnotherInfo['weather'] = $weatherInfoAll->weatherinfo->weather3;
				$weatherAnotherInfo['wind'] = $weatherInfoAll->weatherinfo->wind3;
				$weatherAnotherInfo['stages'] = $weatherInfoAll->weatherinfo->fl3;
				$weatherAnotherInfo['temperature'] = $weatherInfoAll->weatherinfo->temp3;
				break;
			case 7:
				$weatherAnotherInfo['pic'] = $weatherInfoAll->weatherinfo->img7.".png";
				$weatherAnotherInfo['weather'] = $weatherInfoAll->weatherinfo->weather4;
				$weatherAnotherInfo['wind'] = $weatherInfoAll->weatherinfo->wind4;
				$weatherAnotherInfo['stages'] = $weatherInfoAll->weatherinfo->fl4;
				$weatherAnotherInfo['temperature'] = $weatherInfoAll->weatherinfo->temp4;
				break;
			case 9:
				$weatherAnotherInfo['pic'] = $weatherInfoAll->weatherinfo->img9.".png";
				$weatherAnotherInfo['weather'] = $weatherInfoAll->weatherinfo->weather5;
				$weatherAnotherInfo['wind'] = $weatherInfoAll->weatherinfo->wind5;
				$weatherAnotherInfo['stages'] = $weatherInfoAll->weatherinfo->fl5;
				$weatherAnotherInfo['temperature'] = $weatherInfoAll->weatherinfo->temp5;
				break;
			case 11:
				$weatherAnotherInfo['pic'] = $weatherInfoAll->weatherinfo->img11.".png";
				$weatherAnotherInfo['weather'] = $weatherInfoAll->weatherinfo->weather6;
				$weatherAnotherInfo['wind'] = $weatherInfoAll->weatherinfo->wind6;
				$weatherAnotherInfo['stages'] = $weatherInfoAll->weatherinfo->fl6;
				$weatherAnotherInfo['temperature'] = $weatherInfoAll->weatherinfo->temp6;
				break;
		}
		return $weatherAnotherInfo;
	}
	
	// 天气页面提供的对外接口
	public function weatherPort(){
		
		// 获取回调函数
		$callback = $_REQUEST['callback'];
		$weatherInfoRecently = array();
		$weatherInfoAll = $this->dealData($weatherInfoRecently); // 获取相关数据
		
		
		
		
		
		// 今天的温度天气风向信息
		$weatherInfoRecently['today']['temperature'] = $weatherInfoAll->weatherinfo->temp1;
		$weatherInfoRecently['today']['weather'] = $weatherInfoAll->weatherinfo->weather1;
		$weatherInfoRecently['today']['wind'] = $weatherInfoAll->weatherinfo->wind1;
		
		// 第二天温度天气风向信息
		$weatherInfoRecently['tomorrow']['temperature'] = $weatherInfoAll->weatherinfo->temp2;
		$weatherInfoRecently['tomorrow']['weather'] = $weatherInfoAll->weatherinfo->weather2;
		$weatherInfoRecently['tomorrow']['wind'] = $weatherInfoAll->weatherinfo->wind2;
		
		// 第三天温度天气风向信息
		$weatherInfoRecently['hou']['temperature'] = $weatherInfoAll->weatherinfo->temp3;
		$weatherInfoRecently['hou']['weather'] = $weatherInfoAll->weatherinfo->weather3;
		$weatherInfoRecently['hou']['wind'] = $weatherInfoAll->weatherinfo->wind3;
		
		$weatherInfoRecently = json_encode($weatherInfoRecently);
		//dump();
		echo $callback."($weatherInfoRecently)";
	
	}
	


}//类定义 end
?>


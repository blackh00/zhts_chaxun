<?php
/*
 *api相关的配置
 *作者：yumao
 *联系方式:QQ:916564404
 */
return array(

	/*爱查网快递API**/
	'EXPRESS_API'			=> array('UC_API'=>'http://api.ickd.cn/?com=',"UC_KEY"=>'846BD038F4DEDEB162361376C3D2181E'),// 申请爱查快递API所得到的id 和 快递查询接口网址;快递公司及其相应的代码数据来自http://www.ickd.cn/api/doc.html爱查快递
	
	/**有道身份证号码查询**/
	'YOUDAO_SHRNFEN_API' 	=> array('UC_API'=>'http://www.youdao.com/smartresult-xml/search.s?type=id&q='),// 有道身份证信息查询接口url 参考信息来自http://www.hujuntao.com/archives/youdao-idcard-api.html
	
	/***聚合手机api****/
	'JUHE_SHOUJI_API'		=> array('UC_API'=>'http://apis.juhe.cn/mobile/get?m=',"UC_KEY"=>'b4b88a8ffc09e2fd3f24251ee19fa168'),// 聚合手机信息查询接口url与密钥
	
	/***雅虎汇率转换接口**/
	'YAHOO_HUILV_API'		=> array('UC_API'=>'http://download.finance.yahoo.com/d/quotes.html?s='),// 雅虎汇率转换接口url
	/***新浪Ip api接口*****/
	
	// 定义酷讯网上特价机票采集网址
	'KUXUN_JIPIAO_API'		=> array('beijing'=>'http://jipiao.kuxun.cn/ajax_index_tejia_v4.php?v=2&cate=PEK','shanghai'=>'http://jipiao.kuxun.cn/ajax_index_tejia_v4.php?v=2&cate=SHA','guangzhou'=>'http://jipiao.kuxun.cn/ajax_index_tejia_v4.php?v=2&cate=CAN','shenzhen'=>'http://jipiao.kuxun.cn/ajax_index_tejia_v4.php?v=2&cate=SZX','chongqin'=>'http://jipiao.kuxun.cn/ajax_index_tejia_v4.php?v=2&cate=CKG'),
	
	// 定义酷讯网上采集酒店数据的网址
	'KUXUN_HOTEL_URL' => 'http://hotel.kuxun.cn/',
	
	/***根据需求变化ip 搜索的api由新浪换成百度****/
	//'BAI_IP_API' 			=> array('UC_API'=>'http://api.map.baidu.com/location/ip?',"UC_KEY"=>'16b4d168a7f690a08977a8867f003f99'),// 百度ip搜索api 参考信息来自http://developer.baidu.com/map/ip-location-api.htm
	
	'SINA_PORT'		=> "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=", // sina获取ip地址接口
	'MOBILE_GET_BY_NET_URL'	=> "http://apis.juhe.cn/mobile/get?m=",	// 获取手机相关信息的url
	'MOBILE_GET_BY_NET_KEY' => "b4b88a8ffc09e2fd3f24251ee19fa168", // 获取手机相关信息的密钥 火车票查询同样适应，飞机票查询也同样适应，身份证号码查询也同样适应
	'POSTCODE_API_URL'	=> "http://www.youdao.com/smartresult-xml/search.s?type=zip&q=",//	邮编查询api接口
	'AIRTICKET_API_URL' => "http://apis.juhe.cn/plan/s?name=", // 航班查询api接口url地址
	'AIRTICKET_API_URL2' => "http://apis.juhe.cn/plan/s2s?start=", // 航线查询api接口url地址
	'TRAFFIC_VIOLATE_API_URL' => 'http://v.juhe.cn/wz/index', // 交通违规查询api接口url地址
	'CALENDAR_URL' => 'http://www.chachaba.com/news/tools/rili/wannianli.html',
	'WEATHER_API'=>'http://m.weather.com.cn/data/', // 天气api接口地址
	'JUHE_HUILV_API' => "http://web.juhe.cn:8080/finance/exchange/rmbquot?key=24f01b1dcc88a1401ad7996c391069b2&dtype=json", // 聚合 获取汇率转换数据
		
);
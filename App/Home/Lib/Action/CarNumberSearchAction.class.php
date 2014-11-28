<?php
/**
 *功能：车牌号码搜素所对应的控制器
 *作者：yumao
 *联系方式:QQ:916564404
 *创建日期:2013/4/9
 */
class CarNumberSearchAction extends Action{
	/*** 
	*车牌号码搜索对应的首页与结果页
	*/
	public function index(){
		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->assign("flag","jiaotong");
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		$this->display();
	}
	/*
	 *车牌号码
	 *数据采集所对应的方法
	 */
	public function collect(){
		sleep(1);
		if(!$_GET['page']){
			$page = 1;
		}else{
			$page = $_GET['page'];
		}
		if($page <= 31){
			$url = "http://bm12345.net/chepai/data/{$page}.html" ;
			
			// 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
			$result = getByNetFun($url);
			$result = iconv("gb2312","utf-8//IGNORE",$result);
			$matchAll = array();
			
			// 定义匹配规则
			$reg = '/<tr>\s*?<td><strong>(.*?)<\/strong><\/td>\s*?<td>(.*?)<\/td>\s*?<td>(.*?)<\/td>\s*?<td>(.*?)<\/td>\s*?<\/tr>/is';
			preg_match_all($reg, $result, $matchAll,PREG_SET_ORDER);
			$insertInfo = array();
			foreach($matchAll as $key => $value){
				$insertInfo[$key]['address'] = $value[1];
				$insertInfo[$key]['areacode'] = $value[2];
				$insertInfo[$key]['postcode'] = $value[3];
				$insertInfo[$key]['carNumber'] = $value[4];
			}
			
			// 往数据库中插入数据
			$carNumber = M('carNumber');
			$carNumber -> addAll($insertInfo);
			
			// 页面跳转
			echo "<script>";
			echo 'window.location.href="'.__URL__.'/collect/page/'.($page+1).'"';
			echo "</script>";
		}
		//echo $result;
	}
}
<?php
/**
 * 
 * 日历功能模块相关
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Yumao <815227173@qq.com>
 * @CreateDate: 2013-5-16 上午9:35:47
 * @version 1.0
 */
class RiliSearchAction extends Action{
	
	/**
	 * 
	 * 本模块所有功能都执行的方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-16 上午9:37:10
	 */
	function _initialize(){
		// 获取当前客户端ip
		$ip = get_client_ip();
		$this->assign("ip",$ip);
		$this->assign("flag","shenghuo");		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	/**
	 * 
	 * 日历模块首页对应方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-16 上午9:39:05
	 */
	public function index(){
		
		// 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示包含
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		
		$this->display();
	}
	
	/**
	 * 
	 * 日历模块获取黄道吉日的数据
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-6-7 下午15:30:05
	 */
	public function diesFaustusSearch(){
		// 获取客户端当天的时间
		$yearMonthDateSer = date("Y-n-j",time());
		// 得到年月日
		$yearMonthDate = $_REQUEST['yearMonthDate'];
		$callback = $_REQUEST['callback'];
		if($yearMonthDateSer != $yearMonthDate){
		
			// 创建连接数据库对象
			$hdjr = M('hdjr');
			
			// 组装查询条件
			$condition["time"] = $yearMonthDate;
			$dayInfo = $hdjr->field("yi,ji")->where($condition)->find();
		}else{
			
			// 初始化缓存对象	
			$cacheDateInfo = Cache::getInstance('file');
			// 如果有则直接取缓存中的东西
			$dateInfo = $cacheDateInfo -> get('dateInfo');
			
			if($dateInfo && $dateInfo['time']==(date("Y-n-j",time()))){
					$dayInfo = $dateInfo;
			}else{

				// 创建连接数据库对象
				$hdjr = M('hdjr');
				// 组装查询条件
				$condition["time"] = $yearMonthDate;
				$dayInfo = $hdjr->field("yi,ji")->where($condition)->find();
				$dayInfo['time'] = $yearMonthDateSer;
				// 缓存到文件
				$cacheDateInfo -> set('dateInfo',$dayInfo,3600*24);
			}	
		}
		
		// 转换为json格式
		$dayInfo = json_encode($dayInfo);
	
		echo $callback."($dayInfo)";
		
	}
}
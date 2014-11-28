<?php
/**
 * 北京时间对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-22 上午9:12:02
 * @version 1.0
 */
class BjTimeAction extends Action{
	function _initialize(){
		$this->assign("flag","shenghuo");
		$this->assign("footerFlag",1); // 用来标志是否在模版页面尾部要包含另外的js ,1表示包含
	}
	public function index(){
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->display(); 
	}
	public function reback(){
	
		// 初始化缓存对象
		$cacheBjTime = Cache::getInstance('file');
		$cacheBjTimeInfo = $cacheBjTime->get('cacheBjtime');
		
		if(!$cacheBjTimeInfo){
		// 先到缓存中获取时间的相关信息 若没有相关信息则到时间服务器上获取，然后缓存
		
			$data = '';
			$i=1;
			while(!$data && $i<5){
				$url =  'http://www.time.ac.cn/timeflash.asp?user=flash';
				$ch=curl_init();
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
				$data=curl_exec($ch);
				curl_close($ch);
				$data = simplexml_load_string($data);
				$data = object_to_array($data);
				$i++;
			}
			$time = $data['time']['year']."-".$data['time']['month']."-".$data['time']['day']." ".$data['time']['hour'].":".$data['time']['minite'].":".$data['time']['second'];
			$bjtime = strtotime($time);
			
			// 把北京时间和当前服务器的时间戳组成字符串缓存到文件中一个小时
			$cacheBjTime -> set('cacheBjtime',$bjtime."-".time(),3600);
 			
			
		}else{
		
		
			
			// 如果有缓存时间则从缓存中取出北京时间并加上现在的时间戳减去保存的时间戳
			$timeInfo =  explode("-",$cacheBjTimeInfo);
			
			// 得到时间服务器上缓存的时间戳
			$bjtime = $timeInfo[0];
			
			// 间隔时间
			$intervalTime = time()-$timeInfo[1];
			
			// 计算出现在的北京时间戳
			$bjtime = $bjtime+$intervalTime;
			
		}
		
		$bjtime =$bjtime."000";
		$callback = $_REQUEST['callback'];   
		$info['bjtime'] = $bjtime;
		$info = json_encode($info); 
		echo $callback."($info)";
	}
} 
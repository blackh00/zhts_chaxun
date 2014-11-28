<?php
/**
 * 
 * 汽车标志大全相关控制器
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Yumao <815227173@qq.com>
 * @CreateDate: 2013-5-20 上午11:14:43
 * @version 1.0
 */
class CarSignSearchAction extends Action{
	
	/**
	 * 所有action默认调用的方法
	 */
	function _initialize(){
		// 获取当前客户端ip
		
		$this->assign("flag","shenghuo");
	
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	/**
	 * 
	 * 首页对应的方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-20 下午6:59:31
	 */
	public function index(){
		
		// 定义数据库对象
		$carSign = M("carSign");
		
		// 查询除了id列的所有信息
		$carSignInfo = $carSign -> field("details",true) -> select();
		
		// 保存处理之后的数据
		$chebiaoInfo = array();
		
		// 遍历处理数据
		foreach($carSignInfo as $key => $val){
			$chebiaoInfo[$val['kind']][$key]['name'] = $val['name']; 
			$chebiaoInfo[$val['kind']][$key]['pic'] = $val['pic'];
			$chebiaoInfo[$val['kind']][$key]['id'] = $val['id'];
		}
		$this->assign('chebiaoInfo',$chebiaoInfo);
		
		$this->display();
	}
	
	/**
	 * 
	 * 点击首页上具体车标后进入到的详细页面对应的方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-21 上午10:56:32
	 */
	public function details(){
		
		header("Content-Type:text/html; charset=utf-8");
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		
		$id = $_GET['id'];
		
		// 定义数据库对象
		$carSign = M("carSign");
		
		$carDetails = $carSign->find($id);
		$carDetails['simpleDetails'] = mb_substr($carDetails['details'],0,130,'utf-8');
		$this->assign("carDetails",$carDetails);
		$this->display();
	} 
	
	/**
	 * 
	 * 用户搜索指定品牌车名对应的方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-21 下午1:51:25
	 * @param unknown_type $key
	 */
	public function search(){
		
		header("Content-Type:text/html; charset=utf-8");
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
					
		// 获取从其他页面中提交过来的搜索关键字
		$searchKey = $_POST['searchKey'];
		
		// 定义数据库对象
		$carSign = M("carSign");
		
		// 搜索数据库中内容
		// 组合查询条件
		$data['name'] = array('like',"%{$searchKey}%");
		
		// 查询数据库
		$resultInfo = $carSign -> where($data) -> select();		
		foreach($resultInfo as $key=>$val){
			$resultInfo[$key]['simpleDetails'] =  mb_substr($val['details'],0,130,'utf-8');
		}
		$this->assign('resultInfo',$resultInfo);
		$this->display();
	}
	
	/**
	 * 
	 * 采集数据相关函数
	 * 此方法可能只会用一次
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-20 上午11:18:19
	 */
	public function collectData(){
		
		// 关闭服务器超时时间
		ini_set("max_execution_time","0");
		
		// 远程获取数据的网址url
		$url = "http://car.carschina.com/";
		
		// 获取远程数据
		$content = file_get_contents($url);
		
		// 把字符集改为utf8编码
		$content = iconv("gb2312","utf-8//IGNORE",$content);
		// 定义匹配规则
		$reg = '/<a\s+title=".*?"\s+href="(car\/brand_\d+?.html)"><img\s+alt=".*?"\s+src="(.*?)"><p>(.*?)<\/p><\/a>/is';
		
		// 定义保存匹配到的数据的数组
		$matchesAll = array();
		
		// 正则匹配
		preg_match_all($reg,$content, $matchesAll,PREG_SET_ORDER);
		
		// 采集http://news.bitauto.com/pinpai/网中的详细
		$url2 = "http://news.bitauto.com/pinpai/";
		$content2 = file_get_contents($url2);
		
		// 把字符集改为utf8编码
		$content2 = iconv("gb2312","utf-8//IGNORE",$content2);
		
		// 定义匹配规则
		$reg2 = '/<li><a\s+href="(.*?)"\s+title=".*?"\s+target="_blank"><img\s+width=".*?"\s+height=".*?"\s+src=".*?"\s+\/><\/a><a\s+href=".*?"\s+target="_blank">(.*?)<\/a><\/li>/is';
		
		// 定义保存匹配到的数据的数组
		$matchesAll2 = array();
		
		// 正则匹配
		preg_match_all($reg2,$content2, $matchesAll2,PREG_SET_ORDER);
		
		/**
		 * 
		 *  根据名字相同第一个页面中得到的车辆到第二个页面中采集详细信息
		 * 1处理$matchesAll2 组装成新的格式 $dataContent 一个一维数组 包含从$matchesAll2得到的汽车品牌名称
		 * 2遍历$matchesAll 看看每一个汽车是否可以在$dataContent中找到 如果可以则在http://news.bitauto.com/pinpai/得到详细信息 不可以则在http://car.carschina.com/
		 * 3根据不同的匹配规则到不同的页面把详细信息匹配保存到数组并且把图片保存下来
		 */
		$dataComplete = array(); // 保存处理好的数据
		
		// 第一步
		foreach($matchesAll2 as $key=>$val){
				$dataContent[$key] = $val[2];
		}
		$dataContentFlip = array_flip($dataContent); // 保存键值反转后的函数

		// 第二步
		foreach($matchesAll as $key=>$val){
			if(in_array($val[3],$dataContent)){
				
				// 获取当前$dataContent的键值
				$nowKey = $dataContentFlip[$val[3]];
			
				// 根据$nowKey到$matchesAll2 得到拥有详细信息页面的地址保存到$dataComplete
				$dataComplete[$key]['contentUrl'] =  $matchesAll2[$nowKey][1];
			} elseif(in_array($val[3]."汽车",$dataContent)){
				
				// 获取当前$dataContent的键值
				$nowKey = $dataContentFlip[$val[3]."汽车"];
				// 根据$nowKey到$matchesAll2 得到拥有详细信息页面的地址保存到$dataComplete
				$dataComplete[$key]['contentUrl'] =  $matchesAll2[$nowKey][1];
				
			} else {
	
				// 从$matchesAll中得到详细信息的地址
				$dataComplete[$key]['contentUrl'] = "http://car.carschina.com/".$val[1];
				
			}
			
			// 获取当前品牌名称
			$dataComplete[$key]['pinpai'] = $val[3];
			
			// 获取图片的地址
			$dataComplete[$key]['pic'] = "http://car.carschina.com/".$val[2];
		}

		
		// 定义匹配规则
		// http://car.bitauto.com页面上的匹配规则是
		$pattern1 = '/<div\s+id="aa"\s+style="display: none"\s+class="carintropop">(.*?)<\/div>/is'; 

		// http://car.carschina.com/页面的匹配规则是
		$pattern2 = '/<div\s+class="cars_p2"\s*>[^<]*?<p>(.*?)<span><a href=".*?">\[详细\]<\/a><\/span><\/p>[^<]*?<\/div>/is';
		
		// 定义数据库对象
		$carSign = M("carSign");
		//dump($dataComplete);
		// 遍历$dataComplete匹配详细信息数据
		foreach($dataComplete as $key=>$val){
			if(stristr($val["contentUrl"],"http://car.bitauto.com")){
				$pattern = $pattern1;
				$zhuan = 0; // 判断是否要转编码 1表示转0表示不转
			} else {
				$pattern = $pattern2;
				$zhuan = 1; // 0表示不转
			}
			
			// 定义$carSignData用来保存插入到数据库中的数据
			$carSignData = array();
			
			$carSignData['name'] = $val["pinpai"];
			
			// 获取详细页面信息
			$contentDetails = file_get_contents($val['contentUrl']);
			
			if($zhuan){
				// 把字符集改为utf8编码
				$contentDetails = iconv("gb2312","utf-8//IGNORE",$contentDetails);
			}
			$matchContent = array(); // 保存匹配后的信息
			preg_match($pattern,$contentDetails,$matchContent);	// 正则匹配把匹配到的数据保存到$matchContent中
			
			$carSignData['details'] = $matchContent[1];
			if($key > 102){
				
				// 代表是国产
				$carSignData['kind'] = 3;
				
			}elseif($key > 66){
				
				// 代表合资品牌
				$carSignData['kind'] = 2;
			} else {
				
				// 代表进口
				$carSignData['kind'] = 1;
			}
			
			// 获取图片
			$carSignData['pic'] = $this->grabImage($val['pic']);
			
			$carSign->add($carSignData);
			
			echo $carSignData['name']."采集完毕<br/>";
			echo str_pad(" ", 256);
			ob_flush();
			flush();
			sleep(0.5);
		}
		
	}
	
	
	
	/**
	 * 抓取远程图片
	 *
	 * @param string $url 远程图片路径
	 *
	 */
	private function grabImage($url) {
		
		if($url == '') {
			return false; //如果 $url 为空则返回 false;
		}
		
		//开始捕获
		ob_start();
		readfile($url);
		$img_data = ob_get_contents();
		ob_end_clean();
		$size = strlen($img_data);
		
		// 获取远程文件名
		$picPathInfo = pathinfo($url);
		
		$filename = ROOT_PATH."/Www/upload/carSign/".$picPathInfo['basename'];
		$local_file = fopen($filename , 'a+');
		fwrite($local_file, $img_data);
		fclose($local_file);
		$filename = $picPathInfo['basename'];
		return $filename;
	}
} 
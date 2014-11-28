<?php
/**
 *功能：常用交通标志搜素所对应的控制器
 *作者：yumao
 *联系方式:QQ:916564404
 *创建日期:2013/4/8
 */
class TrafficSignSearchAction extends Action{
	public function index(){
		header("Content-Type:text/html;charset=utf-8");
		echo "图片和数据已经采集到本地，前台显示待定";
	}
	/***交通标志内容的修改***/
	public function show(){

		// 操作数据库在数据库中根据id查询相应的信息
		$trafficSign = M('trafficSign');
		$result = $trafficSign->select();
		$this->assign("resultInfo",$result);
		$this->display();
	}
	
	/***确认修改******/
	public function doUpdate(){
		
		if($_GET['id']){
			$data['id'] = $_GET['id'];
		}
		if($_GET['mean']){
			$data['mean'] = $_GET['mean'];
		}
		
		// 修改数据
		$trafficSign = M('trafficSign');
		$resultItem = $trafficSign -> save($data);
		if($resultItem!=0){
			echo $data['mean'];
		}
	}
	/**
	 * 抓取远程图片
	 *
	 * @param string $url 远程图片路径
	 * @param string $filename 本地存储文件名
	 */
	private function grabImage($url, $filename = '') {
		if($url == '') {
			return false; //如果 $url 为空则返回 false;
		}
		$ext_name = strrchr($url, '.'); //获取图片的扩展名
		if($ext_name != '.gif' && $ext_name != '.jpg' && $ext_name != '.bmp' && $ext_name != '.png') {
			return false; //格式不在允许的范围
		}
		if($filename == '') {
			$filename = time().$ext_name; //以时间戳另起名
		}
		//开始捕获
		ob_start();
		readfile($url);
		$img_data = ob_get_contents();
		ob_end_clean();
		$size = strlen($img_data);
		$local_file = fopen($filename , 'a+');
		fwrite($local_file, $img_data);
		fclose($local_file);
		return $filename;
	}
} 
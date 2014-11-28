<?php
/**
 * 生日密码
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-3 下午5:27:47
 * @version 1.0
 */
class BirthdayAction extends Action{
	function _initialize(){
		$this->assign('flag','zonghe');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		ini_set("max_execution_time","0");
		$htmlPath = ROOT_PATH."/Www/Html";
		// 生成js文件夹
		if((!file_exists($htmlPath."/birthday/js")) || (!is_dir($htmlPath."/birthday/js"))){
			mkdir($htmlPath."/birthday/js");
		}
		// 读取js文件夹下文件的个数
		$dir = $htmlPath."/birthday/js";
		$handle = opendir($dir);
		$i = 0;
		while(false !== $file=(readdir($handle))){
			if($file !== '.' || $file != '..'){
				$i++ ;
			}
		}
		closedir($handle);
		// 生成生日密码js文件
		if($i<368){
			$birthday 		= M('birthday');
			$birthdayList 	= $birthday->field('date,data')->select();
			foreach($birthdayList as $key => $value){
				$data		= $value['data'];
				$date  		= $value['date'];
				file_put_contents(ROOT_PATH."/Www/Html/birthday/js/".$date.".js",$data);
			}
		}
		$this->display();
	}
}
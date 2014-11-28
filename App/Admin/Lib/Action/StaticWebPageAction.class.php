<?php
/**
 * 
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Yumao <815227173@qq.com>
 * @CreateDate: 2013-5-9 下午3:01:09
 * @version 1.0
 * 
 */
class StaticWebPageAction extends CommonAction{
	
	
	public function index(){
		ini_set("max_execution_time","0");
	
		$htmlPath = ROOT_PATH."/Www/Html";
		//echo ROOT_PATH.'/App/Home/Conf/site.php';exit;
		// 包含前台项目动态配置文件
		$webUrl = require ROOT_PATH.'/App/Home/Conf/site.php';
		
		// 生成网站首页
		// 如果web目录下面html目录不存在则创建html文件夹
		if((!file_exists($htmlPath)) || (!is_dir($htmlPath))){
			mkdir($htmlPath);
		}
		// 获取网站首页内容
		$content = file_get_contents($webUrl['SITE_DYNAMIC_URL']);
		
		// 生成静态首页
		file_put_contents($htmlPath."/index.html", $content);
		echo "首页生成完毕<br/>";
		// 读取module.php配置文件生成各个分类页和功能首页
		$moduleList = require ROOT_PATH.'/App/Home/Conf/module.php';
		
		// 遍历生成各个功能或分类页面的首页
		foreach($moduleList as $key => $value){
			
			// 如果当前模块文件夹不存在则创建
			if((!file_exists($htmlPath."/".$value)) || (!is_dir($htmlPath."/".$value))){
				mkdir($htmlPath."/".$value);
			}
			
			// 读取功能模块内容
			$content = file_get_contents($webUrl['SITE_DYNAMIC_URL']."/".$value."/");
			
			
			// 生成静态文件
			file_put_contents($htmlPath."/".$value."/index.html", $content);
			echo $value."页面生成完毕<br/>";
			echo str_pad(" ", 256);
			ob_flush();
			flush();
			sleep(0.5);
			
		}
		echo "静态页面生成完毕";
	}	
} 
?>
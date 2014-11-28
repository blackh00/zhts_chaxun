<?php
/**
 * 24节气
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-5 上午11:06:21
 * @version 1.0
 */
class SolarAction extends Action{
	function _initialize(){
		$this->assign('flag','shenghuo');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$htmlPath = ROOT_PATH."/Www/Html";
		// 生成js文件夹
		if((!file_exists($htmlPath."/solar/js")) || (!is_dir($htmlPath."/solar/js"))){
			mkdir($htmlPath."/solar/js");
		}
		// 读取js文件夹下文件的个数
		$dir = $htmlPath."/solar/js";
		$handle = opendir($dir);
		$i = 0;
		while(false !== $file=(readdir($handle))){
			if($file !== '.' || $file != '..'){
				$i++ ;
			}
		}
		closedir($handle);
		// 生成24节气js文件
		if($i<26){
			$solar 	= M('solar');
			$solarList 		 = $solar->field('id,jieqi')->select();
			foreach($solarList as $key=>$val){
				switch($val['id']){
					case 1:
						$jieqi = 'lichun';
						break;
					case 2:
						$jieqi = 'yushui';
						break;
					case 3:
						$jieqi = 'jingzhe';
						break;
					case 4:
						$jieqi = 'chunfen';
						break;
					case 5:
						$jieqi = 'qingming';
						break;
					case 6:
						$jieqi = 'guyu';
						break;
					case 7:
						$jieqi = 'lixia';
						break;
					case 8:
						$jieqi = 'xiaoman';
						break;
					case 9:
						$jieqi = 'mangzhong';
						break;
					case 10:
						$jieqi = 'xiazhi';
						break;
					case 11:
						$jieqi = 'xiaoshu';
						break;
					case 12:
						$jieqi = 'dashu';
						break;
					case 13:
						$jieqi = 'liqiu';
						break;
					case 14:
						$jieqi = 'chushu';
						break;
					case 15:
						$jieqi = 'bailu';
						break;
					case 16:
						$jieqi = 'qiufen';
						break;
					case 17:
						$jieqi = 'hanlu';
						break;
					case 18:
						$jieqi = 'shuangjiang';
						break;
					case 19:
						$jieqi = 'lidong';
						break;
					case 20:
						$jieqi = 'xiaoxue';
						break;
					case 21:
						$jieqi = 'daxue';
						break;
					case 22:
						$jieqi = 'dongzhi';
						break;
					case 23:
						$jieqi = 'xiaohan';
						break;
					case 24:
						$jieqi = 'dahan';
						break;
					default:
						break;
				}
				$solarString  = $val['jieqi'];
				file_put_contents(ROOT_PATH."/Www/Html/solar/js/".$jieqi.".js",$solarString);
			}
		}
		$this->display();
	}
}
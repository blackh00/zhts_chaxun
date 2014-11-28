<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-15 上午9:01:27
 * @version 1.0
 */
class HanZiToPinYinAction extends Action{
	
	// 首页显示汉字转拼音
	public function index(){
		
		// 导入汉字转拼音php文件。
		include ROOT_PATH . '/App/Vendor/PingYin/HanZiToPinYin/pinyin.php';
		if(isset($_POST['form_check']) && $_POST['form_check'] == 'submit'){
			if(isset($_POST['text_ch']) && $_POST['text_ch'] != ''){
				$pin=new Pinyin();
				$pinyin=$pin->convert($_POST['text_ch'],"utf8");
			}
		}
		if(!isset($pinyin) || $pinyin == ''){
			$pinyin="";
		}
		if(isset($_POST['text_ch']) && $_POST['text_ch'] != ''){
			$chinese = $_POST['text_ch'];
		} else {
			$chinese='';
		}
		
		$this->assign('chinese',$chinese);
		$this->assign('pinyin',$pinyin);
		$titleKey='汉字转拼音查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="jiaoyu";
		$this->assign('flag',$flag);
		$this->display();
	}
}
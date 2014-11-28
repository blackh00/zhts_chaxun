<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-6 下午5:38:17
 * @version 1.0
 */
class TranslationAction extends Action{
	public function _initialize(){
		$this->assign('flag','jiaoyu');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	// 教育学习的在线翻译页面。
	public function index(){
		$this->display();
	}
	// 在线翻译提交后显示翻译结果页面。
	public function fanyiSearch(){
		if(isset($_POST['language']) && $_POST['language'] != ''){
			$language=$_POST['language'];
			$lang=explode(",", $language);
			$from=$lang[0];
			$target=$lang[1];
		}else{
			$from="zh-cn";
			$target="en";
		}
		if(isset($_POST['content']) && isset($_POST['content']) != ''){
			$text=$_POST['content'];
		}else{
			$text='';
		}
		$transUrl='http://www.google.com/translate_t?langpair='.urlencode($from.'|'.$target).'&text='.urlencode($text);
		redirect($transUrl);
	}
}
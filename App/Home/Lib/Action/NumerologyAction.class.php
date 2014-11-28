<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-7 上午9:05:28
 * @version 1.0
 */
class NumerologyAction extends Action{
	
	// 风水命理首页显示。
	public function index(){
		$this->display();
	}
	
	// 风水命理查询结果。
	public function fengshuiSearch(){
		
	// 判断查询条件是否为空。	
	if(@$_POST['sex'] != '' && @$_POST['year'] != '' && @$_POST['yue'] != '' && @$_POST['ri'] != ''){		
	$cookiefile = tempnam('./temp', 'cookie');	
	$url = 'http://www.buyiju.com/fssm/fssm.asp';		
	$post_data = "sex=".$_POST['sex']."&year=".$_POST['year']."&yue=".$_POST['yue']."&ri=".$_POST['ri'];	
	$ch = curl_init();	
	curl_setopt($ch, CURLOPT_URL, $url);	
	curl_setopt($ch, CURLOPT_HEADER, 0);	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
	
	// 我们在POST数据哦！
	curl_setopt($ch, CURLOPT_POST, 1);
	
	// 把post的变量加上
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	
	// 保存cookie文件
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
	$output = curl_exec($ch);
	$output=@iconv("gb2312", "utf-8", $output);
	$output=str_replace('by www.buyiju.com/fssm/ 卜易居算命网', '', $output);
	
	// 调试使用	
	if ($output === FALSE) {	
		echo "cURL Error: " . curl_error($ch);
	} 
	curl_close($ch); 
	// echo $output; 
	preg_match_all('/<B>.*<BR>/i', $output, $arr_re);
	print_r($arr_re);
    // $str=trim($arr_re);
    // $str1= strip_tags($str);
    // $com_constellation=mb_substr($str1,4,7,"utf8");
	return true;
}
		
	}
}
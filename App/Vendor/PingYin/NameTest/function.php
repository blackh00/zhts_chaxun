<?php
require_once 'utf8_chinese.php'; 
require_once 'pinyinInit.php';

//require_once 'connection.php';
/**
 * Function: Set Variable which pass by URL and return the URL
 */

//中文简体‘繁体转换为拼音。
function transformToPinYin($str){
	$pinyin=new pinyinInit();
	$str_pinyin=$pinyin->pinyin($str);
	return $str_pinyin;
}

//utf8简体、繁体转换。
function GbToBig($str){
	$chinese = new utf8_chinese;
	$str_big5 = $chinese->gb2312_big5($str);
	return $str_big5;
}

//获得笔画数。
function getnum($txt){
	$bihua=M('name_test_bihua');
	$bihua_num=$bihua->where("hanzi like '%".$txt."%'")->getField('num');
	return $bihua_num;
}

// 得到一个汉字字意五行
function getzywh($str){
	$hzwh=M('name_test_hzwh');
	$record=$hzwh->where("hz like '%".$str."%'")->find();
	return $record['wh'];
}


//获得三才中的一才。
function getsancai($sc){
	$sc = $sc % 10; 
	switch ($sc){
		case 1: $sctxt="木";break;
		case 2: $sctxt="木";break;
		case 3: $sctxt="火";break;
		case 4: $sctxt="火";break;
		case 5: $sctxt="土";break;
		case 6: $sctxt="土";break;
		case 7: $sctxt="金";break;
		case 8: $sctxt="金";break;
		case 9: $sctxt="水";break;
		case 10: $sctxt="水";break;
		case 0: $sctxt="水";break;
		default:break;
	}
	return $sctxt;
}


//判断吉凶...
function getpf($sc){
	switch ($sc){
		case "大吉": $szpf=12;break;
		case "吉": $szpf=8;break;
		case "半吉": $szpf=5;break;
		case "大凶": $szpf=0;break;
		case "凶": $szpf=1;break;
		case "半凶": $szpf=2;break;
		case "平": $szpf=4;break;
		default:break;
	}
	return $szpf;
}
// <%function getpf(sc)
// select case sc
// case "大吉"
// szpf=12
// case "吉"
// szpf=8
// case "半吉"
// szpf=5
// case "大凶"
// szpf=0
// case "凶"
// szpf=1
// case "半凶"
// szpf=2
// case "平"
// szpf=4
// end select
// getpf=szpf
// end function%>






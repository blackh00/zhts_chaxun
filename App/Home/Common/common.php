<?php
/**
 * 设置页面头部属性：title、Keywords、Description
 *
 * @author Linmaogan <linmaogan@163.com>
 * @CreateDate: 2013-5-28 下午3:48:47
 * @param string $title
 * @param string $keywords
 * @param string $description
 * @return array
 */
function setHead($title = '', $keywords = '', $description = '') {
	include ROOT_PATH . '/App/Home/Conf/head.php';
	
	// 如果未设置属性则用默认值代替
	$headIndex = $headInfo['Index'];
	if (!$head = $headInfo[MODULE_NAME]) {
		$head = $headIndex;
	}
	$title 			= $title ? $title : $head['title'];
	$keywords 		= $keywords ? $keywords : $head['keywords'];
	$description 	= $description ? $description : $head['description'];
	
	// 标题连接上网站名称
	$data['title'] 			= $title && MODULE_NAME != 'Index' ? $title . '_' . $headIndex['title'] : $headIndex['title'];
	$data['keywords'] 		= $keywords;
	$data['description'] 	= $description;
	
	return $data;	
}

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
	if(function_exists("mb_substr")){
		if ($suffix && strlen($str)>$length)
			return mb_substr($str, $start, $length, $charset)."...";
		else
			return mb_substr($str, $start, $length, $charset);
	}
	elseif(function_exists('iconv_substr')) {
		if ($suffix && strlen($str)>$length)
			return iconv_substr($str,$start,$length,$charset)."...";
		else
			return iconv_substr($str,$start,$length,$charset);
	}
	$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("",array_slice($match[0], $start, $length));
	if($suffix) return $slice."…";
	return $slice;
}
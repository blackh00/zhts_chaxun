<?php
header("Content-type: text/html; charset=utf-8");
require_once 'common.php';
// 包含配置文件
$webUrl = require ROOT_PATH.'/App/Home/Conf/site.php';

// 获取网站动态域名地址
$siteUrl = $webUrl['SITE_URL'];
$staticUrl = $webUrl['STATIC_URL'];

// 获取网站名字
$siteName = $webUrl['SITE_NAME'];
$Shortcut = "[InternetShortcut]
URL=".$siteUrl."?from=desktop
IDList=
IconFile=C:\WINDOWS\system32\SHELL32.dll
IconIndex=171
HotKey=1626
[{000214A0-0000-0000-C000-000000000046}]
Prop3=19,2";
Header("Content-type: application/octet-stream");

//header("Content-Disposition: attachment; filename=".utf8_encode("你好").".url;");


$ua = $_SERVER["HTTP_USER_AGENT"];
$encoded_filename = urlencode($siteName);
$encoded_filename = str_replace("+", "%20", $encoded_filename);
if (preg_match("/MSIE/", $ua)) {
	header('Content-Disposition: attachment; filename="' . $encoded_filename . '.url"');
} else if (preg_match("/Firefox/", $ua)) {
	header('Content-Disposition: attachment; filename*="utf8\'\'' . $siteName . '.url"');
} else {
	header('Content-Disposition: attachment; filename="' . $siteName . '.url"');
}

//header("Content-Disposition: attachment; filename=".$siteName.".url");

echo $Shortcut;
?>

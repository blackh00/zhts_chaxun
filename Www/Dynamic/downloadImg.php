<?php
//下载图片到桌面
$downloadname   = $_GET['downloadname'];
$src      		= $_GET['src'];
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=$downloadname");//$downloadname是下载后的文件名
readfile($src);//$src是你要下载的图片的路径
?>
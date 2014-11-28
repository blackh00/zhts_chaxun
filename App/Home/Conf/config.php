<?php
if (!defined('THINK_PATH'))
	exit();
$config			=	require ROOT_PATH . '/Conf/db.global.php';
$commonConfig   =   require ROOT_PATH . '/Conf/common.global.php';
$yuming 		=   require 'site.php';
$routeConfig 	=   require 'route.php';
$moduleConfig	=	require 'module.php';
$expressConfig	=	require 'express.php';
$apiConfig		=	require 'api.php';
$cacheConfig	=	require 'cache.php';

$array=array(	
	// '配置项' => '配置值'
	'TRAFFIC_SIGN_IMAGES' => './public/images', // 交通标志图片所存的路径
	'TMPL_PARSE_STRING' => $yuming,
	'DATA_CACHE_TYPE' => 'file',
	'DATA_CACHE_TIME' => '604800',
);
return array_merge($config, $commonConfig, $array,$yuming,$routeConfig,$moduleConfig,
		$expressConfig,$apiConfig,$cacheConfig);
?>
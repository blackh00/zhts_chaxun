<?php
/*
 *前端有关缓存配置
 *
 */
return array(
	'DATA_CACHE_TYPE' => 'Memcache',                //默认是file方式进行缓存的，修改为memcache   
	'MEMCACHE_HOST'   =>  'tcp://127.0.0.1:11211',  //memcache服务器地址和端口，这里为本机。   
	'DATA_CACHE_TIME' => '3600'    //过期的秒数。 
);	
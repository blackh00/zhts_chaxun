<?php
/**
 * 网站公共配置文件，所有项目都默认调用
 */

return array(	
	'SITE_URL'   			=> 'http://' . $_SERVER['SERVER_NAME'], 		// 网站地址
	
	// 指定广告的省份
	'APPOINT_AD_PROVINCE'  	=> array(
			array('id' => 0, 'parent_id' => 0, 'name' => '默认'),
			array('id' => 1, 'parent_id' => 0, 'name' => '北京'),
			array('id' => 2, 'parent_id' => 0, 'name' => '上海'),
			array('id' => 161, 'parent_id' => 7, 'name' => '广州'),
			array('id' => 178, 'parent_id' => 7, 'name' => '深圳'),
			array('id' => 540, 'parent_id' => 34, 'name' => '杭州'),	),
	'SHOW_PAGE_TRACE' 		=> APP_DEBUG,   // 设置是否显示页面Trace信息	APP_DEBUG
	'TMPL_TRACE_FILE'		=> ROOT_PATH . '/ThinkPHP/Tpl/diy_trace.tpl',
	'TRACE_PAGE_TABS'   	=> array('BASE'=>'基本','EXT'=>'扩展','CONFIG'=>'配置','FILE'=>'文件','INFO'=>'流程','ERR|NOTIC'=>'错误','SQL'=>'SQL','DEBUG'=>'调试'), // 页面Trace可定制的选项卡
	'SHOW_RUN_TIME'         => false,	    // 运行时间显示
	'SHOW_ADV_TIME'         => false,		// 显示详细的运行时间
	'SHOW_DB_TIMES'         => false,		// 显示数据库查询和写入次数
	'SHOW_CACHE_TIMES'      => false,		// 显示缓存操作次数
	'SHOW_USE_MEM'          => false,		// 显示内存开销
	'SHOW_LOAD_FILE'   		=> false, 		// 显示加载文件数
	'SHOW_FUN_TIMES'   		=> false, 		// 显示函数调用次数
	'AD_ADD_NO_VERIFY_ROLE' => array(1), // 添加广告默认不用审核的角色ID
		
);

?>
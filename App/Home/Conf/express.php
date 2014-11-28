<?php
/*
 *快递相关的配置
 *
 */
return array(	
	'EXPRESS_COMPANY_NAME' => array(
		array('name' => '申通','code' => 'shentong','charSort' => "S", 'phone' => '400-889-5543','testExample' => '668031148649','matchRule' => '/^\d{12}$/', 'sort'=>0),
		array('name' => 'EMS','code' => 'ems','charSort' => "E", 'phone' => '11183','testExample' => '1053200115600','matchRule' => '/^\d{13}$/', 'sort'=>1),
		array('name' => '顺丰','code' => 'shunfeng','charSort' => "S", 'phone' => '400-811-1111','testExample' => '028376220863','matchRule' => '/^\d{12}$/', 'sort'=>2),
		array('name' => '圆通','code' => 'yuantong','charSort' => "Y", 'phone' => '021-69777888','testExample' => '2728435536','matchRule' => '/^\d{10}$/', 'sort'=>3),
		array('name' => '中通','code' => 'zhongtong','charSort' => "Z", 'phone' => '021-39777777','testExample' => '778044381976','matchRule' => '/^\d{12}$/', 'sort'=>4),
		array('name' => '如风达','code' => 'rufeng','charSort' => "F", 'phone' => '400-010-6660','testExample' => '11302280002916','matchRule' => '/^\d{14}$/', 'sort'=>5),
		array('name' => '韵达','code' => 'yunda','charSort' => "Y", 'phone' => '400-821-6789','testExample' => '1200722815552','matchRule' => '/^\d{13}$/', 'sort'=>6),
		array('name' => '天天','code' => 'tiantian','charSort' => "T", 'phone' => '400-820-8198','testExample' => '160036452341','matchRule' => '/^\d{12}$/', 'sort'=>7),
		array('name' => '汇通','code' => 'huitong','charSort' => "H", 'phone' => '021-62963636','testExample' => '210139426256','matchRule' => '/^\d{12}$/', 'sort'=>8),
		array('name' => '全峰','code' => 'quanfeng','charSort' => "Q", 'phone' => '400-100-0001','testExample' => '200014034338','matchRule' => '/^\d{12}$/', 'sort'=>9),
		array('name' => '德邦','code' => 'debang','charSort' => "D", 'phone' => '400-830-5555','testExample' => '99925724','matchRule' => '/^\d{8}$/', 'sort'=>10),
		array('name' => '宅急送','code' => 'zhaijisong','charSort' => "Z", 'phone' => '400-6789-000','testExample' => '1328530125','matchRule' => '/^\d{10}$/', 'sort'=>11),
		array('name' => '联昊通','code' => 'lianhaotong','charSort' => "L", 'phone' => '0769-88620000','testExample' => '579001837514','matchRule' => '/^\d{12}$/', 'sort'=>12),
		array('name' => '中铁','code' => 'zhongtie','charSort' => "L", 'phone' => '95572','testExample' => 'K2100600242230','matchRule' => '/^[KkBb][\d\w]{13}$/', 'sort'=>13),
		array('name' => '中国邮政平邮','code' => 'pingyou','charSort' => "Z", 'phone' => '11183','testExample' => 'AA30613720999','matchRule' => '', 'sort'=>14),
		array('name' => '新邦','code' => 'xinbang','charSort' => "X", 'phone' => '4008-000-222','testExample' => '12591243','matchRule' => '', 'sort'=>15),
		array('name' => '能达','code' => 'nengda','charSort' => "G", 'phone' => '400-620-1111','testExample' => '880033532102','matchRule' => '/^88(\d{12}|\d{14})$/', 'sort'=>16),
		array('name' => '全日通','code' => 'quanritong','charSort' => "Q", 'phone' => '020-86298999','testExample' => '87028004238','matchRule' => '/^\d{11}$/', 'sort'=>17),
		array('name' => '全一','code' => 'quanyi','charSort' => "Q", 'phone' => '400-663-1111','testExample' => '111331710335','matchRule' => '/^\d{12}$/', 'sort'=>18),
		array('name' => '优速','code' => 'yousu','charSort' => "Y", 'phone' => '400-1111-119','testExample' => '668043062523','matchRule' => '', 'sort'=>19),
		array('name' => '龙邦','code' => 'longbang','charSort' => "L", 'phone' => '021-39283333','testExample' => '686000322262','matchRule' => '', 'sort'=>20),
		array('name' => '速尔','code' => 'sure','charSort' => "S", 'phone' => '4008822168','testExample' => '800617117882','matchRule' => '/^\d{12}$/', 'sort'=>21),
		array('name' => '佳怡','code' => 'jiayi','charSort' => "J", 'phone' => '400-660-5656','testExample' => '24553962','matchRule' => '/^\d{8}$/', 'sort'=>22),
		array('name' => 'Fedex','code' => 'fedex','charSort' => "F", 'phone' => '400-886-1888','testExample' => '802418695520','matchRule' => '', 'sort'=>23),
		array('name' => '安信达快递','code' => 'anxinda','charSort' => "A", 'phone' => '021-54224681','testExample' => '201180152054','matchRule' => '/^(\d{10}|\d{12})$/', 'sort'=>24),
		array('name' => 'CCES快递','code' => 'cces','charSort' => "C", 'phone' => '400-677-3777','testExample' => '2275945318','matchRule' => '', 'sort'=>25),
		array('name' => 'DHL快递','code' => 'dhl','charSort' => "D", 'phone' => '800-810-8000','testExample' => '9699846015','matchRule' => '', 'sort'=>26),
		array('name' => '大田物流','code' => 'datian','charSort' => "D", 'phone' => '400-626-1166','testExample' => '6108241734','matchRule' => '', 'sort'=>27),
		array('name' => '飞康达快递','code' => 'fkd','charSort' => "F", 'phone' => '010-84223376,84223378','testExample' => '87029583186','matchRule' => '', 'sort'=>28),
		array('name' => '国际Fedex','code' => 'fedex','charSort' => "F", 'phone' => '400-886-1888','testExample' => '802418695520','matchRule' => '', 'sort'=>29),
		array('name' => '天地华宇物流','code' => 'huayu','charSort' => "T", 'phone' => '400-808-6666','testExample' => '81338854','matchRule' => '/^\d{8}$/', 'sort'=>30),
		array('name' => '佳吉快运','code' => 'jiaji','charSort' => "H", 'phone' => '400-820-5566','testExample' => '028963471','matchRule' => '', 'sort'=>31),
		array('name' => '快捷快递','code' => 'kuaijie','charSort' => "K", 'phone' => '400-830-4888','testExample' => '7691102534956','matchRule' => '/^\d{13}$/', 'sort'=>32),
		array('name' => 'TNT快递','code' => 'tnt','charSort' => "T", 'phone' => '800-820-9868','testExample' => '868739247','matchRule' => '', 'sort'=>33),
		array('name' => 'UPS','code' => 'ups','charSort' => "U", 'phone' => '400-820-8388','testExample' => '1Z3119500478086955','matchRule' => '', 'sort'=>34),
		array('name' => '中邮物流','code' => 'zhongyou','charSort' => "Z", 'phone' => '11183','testExample' => 'AA30613720999','matchRule' => '', 'sort'=>35),
		
	), // 快递公司及其相应的代码数据来自http://www.ickd.cn/api/doc.html爱查快递

);
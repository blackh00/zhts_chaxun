<?php
/**
 * 省份广告模型
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project KEFU
 * @author Linmaogan <linmaogan@163.com>
 * @CreateDate: 2013-2-5 上午10:43:13
 * @version 1.0
 *
 * @ModificationHistory  
 * Who          When                What 
 * --------     ----------          ------------------------------------------------ 
 * Linmaogan   2013-2-5 上午10:43:13      todo
 */
class ProvinceAdvModel extends CommonModel
{
	public $_validate = array(
		array('name','require','{%NAME_REQUIRE}'),
	);

	protected $_auto = array( 
		//array('status','1'),  // 新增的时候把status字段设置为1
	);
}
?>
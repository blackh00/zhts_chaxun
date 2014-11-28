<?php
/**
 * 广告位模型
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project KEFU
 * @author Linmaogan <linmaogan@163.com>
 * @CreateDate: 2013-2-5 下午3:14:27
 * @version 1.0
 *
 * @ModificationHistory  
 * Who          When                What 
 * --------     ----------          ------------------------------------------------ 
 * Linmaogan   2013-2-5 下午3:14:27      todo
 */
class ProvinceAdvPositionModel extends CommonModel
{
	public $_validate = array(
		array('name','require','{%NAME_REQUIRE}'),
	);

	protected $_auto = array( 
		//array('status','1'),  // 新增的时候把status字段设置为1
	);
}
?>
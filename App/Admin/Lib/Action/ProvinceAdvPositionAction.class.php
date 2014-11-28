<?php
/**
 *  广告位
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project KEFU
 * @author Linmaogan <linmaogan@163.com>
 * @CreateDate: 2013-2-5 下午3:14:58
 * @version 1.0
 *
 * @ModificationHistory  
 * Who          When                What 
 * --------     ----------          ------------------------------------------------ 
 * Linmaogan   2013-2-5 下午3:14:58      todo
 */
class ProvinceAdvPositionAction extends CommonAction
{
	public function add()
	{
		$adflashdir = FANWE_ROOT."public/adflash/";
		$adflashlist = new Dir($adflashdir);
		$adflashs = array();
		foreach($adflashlist as $adflash)
		{
			if($adflash['ext'] == "swf")
				$adflashs[] = str_replace(".swf", "", $adflash['filename']);
		}
		$this->assign('adflashs',$adflashs);
		parent::add();
	}
	
	public function insert()
	{
		if(!isset($_POST['is_flash']))
		{
			$_POST['is_flash'] = 0;
			$_POST['flash_style'] = '';
		}
		
		$_POST['width'] = intval($_POST['width']);
		$_POST['height'] = intval($_POST['height']);	
		$_POST['status'] = getAdVerifyStatus(); // 默认广告未通过审核
		
		parent::insert();
	}
	
	public function edit()
	{
		$adflashdir = FANWE_ROOT."public/adflash/";
		$adflashlist = new Dir($adflashdir);
		$adflashs = array();
		foreach($adflashlist as $adflash)
		{
			if($adflash['ext'] == "swf")
				$adflashs[] = str_replace(".swf", "", $adflash['filename']);
		}
		$this->assign('adflashs',$adflashs);		
		
		$name = $this->getActionName();
		$model = D($name);
		
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById($id);
		
		// 如果是编辑后待审状态
		if ($vo['status'] == 3) {
			$vo['name'] = $vo['code'];
		} else {
			$vo['name'] = $vo['name'];
		}
		
		$this->assign ( 'vo', $vo );
		$this->display ();
	}
	
	public function update()
	{
		if(!isset($_POST['is_flash']))
		{
			$_POST['is_flash'] = 0;
			$_POST['flash_style'] = '';
		}
		$_POST['width'] = intval($_POST['width']);
		$_POST['height'] = intval($_POST['height']);
		
		// 管理员默认通过审核
		if ($status = getAdVerifyStatus()) {
			$_POST['name'] = $_POST['name']; // 直接更新广告内容
		} else {
			$_POST['code'] = $_POST['name']; // 存放到待审核字段中
			$status = 3; // 编辑未通过审核状态
		}
		
		$_POST['status'] = $status; // 默认广告未通过审核
		
		parent::update();
	}
		
	public function toggleStatus()
	{
		$id = intval($_REQUEST['id']);
		if($id == 0)
			exit;
	
		$val = intval($_REQUEST['val']);
			
		$field = trim($_REQUEST['field']);
		if(empty($field))
			exit;
	
		// 如果是编辑未审核，则通过审核，将新编辑的内容替换掉旧的内容
		$name=$this->getActionName();
		$model = D($name);
		$pk = $model->getPk();
		$vo = $model->getById($id);
		if ($vo['status'] == 3) {
			$model->where($pk.' = '.$id)->setField('name',array('exp','`code`'));
			$_REQUEST['val'] = 0; // 恢复status为标准值
		}		
		parent::toggleStatus();		
	}
}

function getDelLink($is_fix,$id)
{
	if($is_fix == 0)
	{
		return '<a href="javascript:;" onclick="removeData(this,\''.$id.'\',\'id\')">'.L('REMOVE').'</a>';
	}
}
?>
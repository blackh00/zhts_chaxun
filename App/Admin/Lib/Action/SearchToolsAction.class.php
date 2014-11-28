<?php

/**
 * 
 * 查询工具对应控制器
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Yumao <815227173@qq.com>
 * @CreateDate: 2013-5-28 上午8:57:54
 * @version 1.0
 */
class SearchToolsAction extends CommonAction{

	/**
	 * add方法
	 * (non-PHPdoc)
	 * @see CommonAction::add()
	 */
	public function add(){
		$searchToolsSort = $this->getToolsSort();
		$this->assign('searchToolsSort',$searchToolsSort);
		parent::add();
	}
	/**
	 * 往数据库中添加数据
	 * (non-PHPdoc)
	 * @see CommonAction::insert()
	 */
	public function insert(){
		
		$info = $this->uploadPic();

		if($info){
			
			// 往数据库中添加数据
			$_POST['pic'] = $info[0]['savename'];
			
			// 调用父类insert方法往数据库中插入数据
			parent::insert();
		}

		
	} 
	
	/**
	 * 
	 * 根据数据库中的数据生成js数组文件
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-31 下午4:07:50
	 */
	 public function edit(){
	 
		$webUrl = require ROOT_PATH.'/App/Home/Conf/site.php';
		$searchToolsSort = $this->getToolsSort();
		$this->assign('searchToolsSort',$searchToolsSort);
		// 把图片上传的路径分配到模版中
		
		$this->assign('picPath',$webUrl['ATTACHMENT_URL']."/searchToolsPic/");
		parent::edit();
	 }
	 
	 /**
	  * 查询工具更新相关的方法
	  * (non-PHPdoc)
	  * @see CommonAction::update()
	  */
	 public function update(){
		
		// 把上传图片添加到指定文件夹中
		
		if($_FILES['photo']['name']){
			$info = $this->uploadPic();
		
		}
		// 判断是否有上传图片如果有删除原来图片
		if($info){
			
			$_POST['pic'] = $info[0]['savename'];
		//	echo ROOT_PATH.'/Www/upload/searchToolsPic/'.$_REQUEST['oldPic'];
			if(file_exists(ROOT_PATH.'/Www/upload/searchToolsPic/'.$_REQUEST['oldPic'])){
			//echo "111111111";
				// 删除原来文件夹中存在的文件
				unlink(ROOT_PATH.'/Www/upload/searchToolsPic/'.$_REQUEST['oldPic']);
			}
		}
		unset($_REQUEST['oldPic']);
		// 调用父类的update方法
		parent::update();
	 }
	/**
	 * 
	 * 根据数据库中的数据生成js数组文件
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-28 下午2:17:50
	 */
	public function createJsConfig(){		
		// 包含前台项目动态配置文件
		$webUrl = require ROOT_PATH.'/App/Home/Conf/site.php';		
		// 创建数据库对象
		$searchTools = M('searchTools');
		// 查询数据库
		$searchToolsList = $searchTools->select();
		// 遍历$searchToolsList把图片路径保存为完整路径
		foreach($searchToolsList as $key=>$val){
			// 组装图片路径
			$searchToolsList[$key]['pic'] = $webUrl['ATTACHMENT_URL'].'/searchToolsPic/'.$searchToolsList[$key]['pic']; 
		}
		// 组装字符转
		$searchToolsString = 'var searchTools = '.json_encode($searchToolsList);
		// 把字符串写入前端js文件
		file_put_contents(ROOT_PATH."/Www/Html/searchTools.js",$searchToolsString);

		echo "静态js生成完毕";
	}
	/**
	 * (non-PHPdoc)
	 * @see CommonAction::remove()
	 */
	public function remove(){
		
		// 删除图片
		$searchTools = M('searchTools');
		
		// 根据id获取数据
		$itemInfo = $searchTools->find($_REQUEST['id']);
		
		// 判断图片是否存在如果存在则删除
		if(file_exists(ROOT_PATH.'/Www/upload/searchToolsPic/'.$itemInfo['pic'])){
			unlink(ROOT_PATH.'/Www/upload/searchToolsPic/'.$itemInfo['pic']);	
		}
		
		// 调用父类方法删除数据
		parent::remove();
	}
	/*
	 *图片上传相关的方法
	 */
	 private function uploadPic(){
	 
		// 导入分页类
		import("ORG.Net.UploadFile");
		
		// 实例化上传类
		$upload = new UploadFile();
		
		// 定义文件最大上传大小为100kb
		$upload->maxSize = 100000; 
		
		$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg','pjpeg','bmp');// 讴置附件上传类型
		
		
		// 设置图片上传路径
		$upload->savePath = ROOT_PATH.'/Www/upload/searchToolsPic/';
		
		
		// 上传图片
		if(!$upload->upload()){
			$this->error($upload->getErrorMsg());
		}else{
			$info = $upload->getUploadFileInfo();
		}
		return $info;
	 
	 }
	
	/*
	 * 获取所有分类
	 */	
	private function getToolsSort(){
	
		$searchToolsSort = M('searchToolsSort');
		$searchToolsSort = $searchToolsSort->field('id,name')->select();
		return $searchToolsSort;
	}
}
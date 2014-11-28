<?php
/**
 * 
 * 邮编搜索对应控制器
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Yumao <815227173@qq.com>
 * @CreateDate: 2013-5-22 下午5:31:46
 * @version 1.0
 */
class PostCodeAction extends Action{
	
	/**
	 * 
	 * 邮编搜索首页对应方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-22 下午5:33:01
	 */
	public function index(){
	
		// 分配分类标志
		$this->assign("flag","shenghuo");
		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
		
		$this->display();
	}
	
	/**
	 * 
	 * 邮编搜索对应方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-23 上午9:33:01
	 */
	public function search(){
		header("Content-Type:text/html;charset=utf-8");
		
		// 获取回调函数
		$callback = $_REQUEST['callback'];
		
		// 获取用户提交过来的数据
		$searchInfo = $_REQUEST['inputPostCode'];
		
		// 定义数据库对象
		$postCode = M("postcode");
		
		// 导入分页类
		import("ORG.Util.Page");
		
		// 判断用户是输入邮编搜素地址还是输入地址搜索邮编
		// 定义正则匹配规则
		
		$reg = '/^\s*\d+\s*$/is';
		if(preg_match($reg,$searchInfo)){
			
			// 代表输入的是邮编
			// 组装查询条件
			$data['postcodeNum'] = $searchInfo;
			
			
			
			// 查询满足条件的总数
			$count = $postCode->where($data)->count();
			
			// 定义分页类类
			$Page = new Page($count,7);
			
			// 修改分页条样式
			$Page->setConfig('theme',"%nowPage%/%totalPage% 
页%upPage%%first%%linkPage%%downPage%%end%");
			// 分页输出显示
			$show = $Page->ajaxShow('searchCode'); // 传递ajax分页所要调用的js方法
			// 查询前面七条数据
			$resultInfo = $postCode->field("address")->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
			
			// 如果$resultInfo有值则返回相关值，没有则返回报错信息
			if($resultInfo){
				// 保存分页条
				$resultInfo['page'] = $show;
				$resultInfo = json_encode($resultInfo);
				echo $callback."($resultInfo)";	
				exit;
			}else{
				
				$resultInfo['page']="";
				// 定义未查询到结果的错误信息
				$resultInfo = array("errorInfo"=>"不好意思，未找到您要搜索的信息");
				$resultInfo = json_encode($resultInfo);
				echo $callback."($resultInfo)";
				exit;
			}	
			
		} else {
		
			 // 用户是根据地址查邮编
			 // 组装查询条件
			$data['address'] = array('like',"%{$searchInfo}%");
			
			// 查询满足条件的总数
			$count = $postCode->where($data)->count();
			
			// 定义分页类类
			$Page = new Page($count,7);
			
			// 修改分页条样式
			$Page->setConfig('theme',"%nowPage%/%totalPage% 
页%upPage%%first%%linkPage%%downPage%%end%");
			// 分页输出显示
			$show = $Page->ajaxShow('searchCode'); // 传递ajax分页所要调用的js方法
			
			// 查询前面七条数据
			$resultInfo = $postCode->field("postcodeNum,address")->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
			
			
			// 如果$resultInfo有值则返回相关值，没有则返回报错信息
			if($resultInfo){
				// 保存分页条
				$resultInfo['page'] = $show;
				
				$resultInfo = json_encode($resultInfo);
				echo $callback."($resultInfo)";	
				exit;
			}else{
			
				$resultInfo['page']="";
				// 定义未查询到结果的错误信息
				$resultInfo = array("errorInfo"=>"不好意思，未找到您要搜索的信息");
				$resultInfo = json_encode($resultInfo);
				echo $callback."($resultInfo)";
				exit;
			}
		}
	}
	
	/**
	 * 
	 * 邮编搜索后对应返回信息处理方法
	 * @author Yumao <815227173@qq.com>
	 * @CreateDate: 2013-5-23 上午11:18:01
	 */
	 
	/* private function dealInfo($resultInfo){
	
		// 如果$resultInfo有值则返回相关值，没有则返回报错信息
		if($resultInfo){
			$resultInfo = json_encode($resultInfo);
			echo $callback."($resultInfo)";	
			exit;
		}else{
			
			// 定义未查询到结果的错误信息
			$resultInfo = array("errorInfo"=>"不好意思，未找到您要搜索的信息");
			$resultInfo = json_encode($resultInfo);
			echo $callback."($resultInfo)";
			exit;
		}	 
	 }*/
}
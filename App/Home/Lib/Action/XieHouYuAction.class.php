<?php
/**
 * 歇后语对应的控制器
 * 
 * @copyright (C)2012 ZHTS Inc.
 * @project KEFU
 * @author Vonwey <vonwey@qq.com>
 * @CreateDate: 2013-5-30 下午3:13:35
 * @version 1.0
 *
 * @ModificationHistory  
 * Who          When                What 
 * --------     ----------          ------------------------------------------------ 
 * Linmaogan   2013-5-30 下午3:13:35      todo
 */
class XieHouYuAction extends Action{
	/**
	 * 初始化函数
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-5-30 下午3:13:13
	 */
	function _initialize(){
		$this->assign("flag","jiaoyu");
		$this->assign("headerFlag",1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	/**
	 * 默认方法
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-5-30 下午3:14:30
	 */
	public function index(){
		header("Content-Type:text/html;charset=utf-8");
		$this->display();
	}
	/**
	 * 查询结果显示
	 * @see Action::show()
	 */
	public function show(){
		$data['letter'] = $_GET['letter'];
		$phrase = M("xiehouyu");
		$phrase         	= M('xiehouyu');
		import('ORG.Util.Page');
		$num            	= date('W');
		$Cache          	= Cache::getInstance('File',array('expire'=>'60'));
		$value          	= $Cache->get('num');  // 获取缓存的数据
		if(empty($value)){
			$Cache->set('num',$num);  // 缓存数据
		}else{
			if($num > $value){
				$Cache->set('num',$num);  // 缓存数据
				$data['count'] = 0;
				$phrase->where(1)->save($data);
			}
		}
		$count          	= $phrase->where($data)->count();
		$Page           	= new Page($count,10);
		$nowPage        	= isset($_GET['p'])?$_GET['p']:1;
		$startItem 			= ($nowPage-1)*10;
		$result         	= $phrase->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$Page -> setConfig("first","首页");
		$Page -> setConfig("last", "尾页");
		$Page -> setConfig("theme","%first%%upPage%%linkPage%%downPage%%end%");
		
		$show           	= $Page->show();
		$show = str_replace("XieHouYu","xiehouyu",$show);
		$preg 				= '/<span\s+class=\'current\'>(\d+)<\/span>/is';
		preg_match($preg,$show,$match);
		$arr 				= preg_split($preg,$show);
		if($count < 11){
			$show 			= "";
		}else{
			$show 			= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		$this->assign('page',$show);
		$this->assign('search',$_GET['letter']);
		$this->assign('count',$count);
		$this->assign('result',$result);
		
		$this->display("search");
	}
	/**
	 * 搜索结果显示
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-5-30 下午4:58:43
	 */
	
	public function search(){
		$keyword        		= $_GET['search'];
		$keyword        	 	= str_replace(' ','',$keyword);
		$phrase         	= M('xiehouyu');
		import('ORG.Util.Page');
		$num            	= date('W');
		$Cache          	= Cache::getInstance('File',array('expire'=>'60'));
		$value          	= $Cache->get('num');  // 获取缓存的数据
		if(empty($value)){
			$Cache->set('num',$num);  // 缓存数据
		}else{
			if($num > $value){
				$Cache->set('num',$num);  // 缓存数据
				$data['count'] = 0;
				$phrase->where(1)->save($data);
			}
		}
		$count          	= $phrase->where("question like '%$keyword%' or answer like '%$keyword%'")->count();
		$Page           	= new Page($count,10);
		$nowPage        	= isset($_GET['p'])?$_GET['p']:1;
		$startItem 			= ($nowPage-1)*10;
		$result         	= $phrase->where("question like '%$keyword%' or answer like '%$keyword%'")->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$Page -> setConfig("first","首页");
		$Page -> setConfig("last", "尾页");
		$Page -> setConfig("theme","%first%%upPage%%linkPage%%downPage%%end% 共%totalPage%页");
	
		$show           	= $Page->show();
		$show = str_replace("XieHouYu","xiehouyu",$show);
		$preg 				= '/<span\s+class=\'current\'>(\d+)<\/span>/is';
		preg_match($preg,$show,$match);
		$arr 				= preg_split($preg,$show);
		if($count < 11){
			$show 			= "";
		}else{
			$show 			= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		$this->assign('page',$show);
		$this->assign('search',$keyword);
		$this->assign('count',$count);
		$this->assign('result',$result);
		$this->display();
	}
}
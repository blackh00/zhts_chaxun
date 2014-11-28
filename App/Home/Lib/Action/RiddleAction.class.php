<?php
/**
 * 谜语大全对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-14 下午6:25:19
 * @version 1.0
 */
class RiddleAction extends Action{
	function _initialize(){
		$this->assign('flag','yule');
		$this->assign('footerFlag',1);
		$this->assign('headerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
	public function typeList(){
		$riddle = M('riddle');
		$count  = $riddle->query('select count(*) as count from fanwe_riddle group by type order by id asc'); //分类的对应的谜语个数
		$this->assign('count',$count);
		$this->display();
	}
	public function search(){
		$search   = $_GET['search'];
		$miyu_rad = $_GET['miyu_rad'];
		$riddle   = M('riddle');
		import('ORG.Util.Page');
		if($miyu_rad=='mimian'){
			$count = $riddle->where('name like "%'.$search.'%"')->count(); //按谜面搜索
		}else if($miyu_rad=='midi'){
			$count = $riddle->where('answer like "%'.$search.'%"')->count(); //按谜底搜索
		}else if($miyu_rad=='miyufl'){
			$count = $riddle->where('type like "%'.$search.'%"')->count(); //按谜语分类搜索
		}
		$Page       = new Page($count,10);
		$nowPage    = isset($_GET['p'])?$_GET['p']:1;
		$Page -> setConfig("first","首页");
		$Page -> setConfig("last", "尾页");
		$Page -> setConfig("prev","&lt;&lt;");
		$Page -> setConfig("next","&gt;&gt;");
		$Page -> setConfig("theme","%first%%upPage%%linkPage%%downPage%%end% 共%totalPage%页");
		
		$show       = $Page->show();
		$preg 		= '/<span\s+class=\'current\'>(\d+)<\/span>/is';
		preg_match($preg,$show,$match);
		$arr 		= preg_split($preg,$show);
		if($count < 11){
			$show 	= "";
		}else{
			$show 	= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		if($miyu_rad=='mimian'){
			$resultInfo = $riddle->where('name like "%'.$search.'%"')->limit($Page->firstRow.','.$Page->listRows)->select();
		}else if($miyu_rad=='midi'){
			$resultInfo = $riddle->where('answer like "%'.$search.'%"')->limit($Page->firstRow.','.$Page->listRows)->select();
		}else if($miyu_rad=='miyufl'){
			$resultInfo = $riddle->where('type like "%'.$search.'%"')->limit($Page->firstRow.','.$Page->listRows)->select();
		}
		foreach($resultInfo as $key => $val){
			$resultInfo[$key]['name'] = preg_replace('/\s/','',$val['name']); //去除谜题换行符
			$resultInfo[$key]['answer'] = preg_replace('/\s/','',$val['answer']); //去除谜底换行符
		}
		$this->assign('nowPage',$nowPage-1); //模板页分类最后一条数据样式的判断条件用到
		$this->assign('page',$show);
		$this->assign('search',$search);
		$this->assign('miyu_rad',$miyu_rad); //按谜面 谜底 谜语分类 查询
		$this->assign('count',$count);
		$this->assign('resultInfo',$resultInfo);
		$this->display();
	}
	public function type(){
		$i_page   = $_GET['i_page'];
		$typeid   = $_GET['type'];
		require ROOT_PATH . '/App/Home/Conf/riddle.php';
		$type     = $riddleType[$typeid];
		$riddle   = M('riddle');
		import('ORG.Util.Page');
		$count  	= $riddle->where('type = "'.$type.'"')->count();
		$Page       = new Page($count,10);
		$nowPage    = isset($_GET['p'])?$_GET['p']:1;
		$Page -> setConfig("first","首页");
		$Page -> setConfig("last", "尾页");
		$Page -> setConfig("prev","&lt;&lt;");
		$Page -> setConfig("next","&gt;&gt;");
		$Page -> setConfig("theme","%first%%upPage%%linkPage%%downPage%%end% 共%totalPage%页");
		$show       = $Page->show();
		$preg 		= '/<span\s+class=\'current\'>(\d+)<\/span>/is';
		preg_match($preg,$show,$match);
		$arr 		= preg_split($preg,$show);
		if($count < 11){
			$show 	= "";
		}else{
			$show 	= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		$resultInfo = $riddle->where('type = "'.$type.'"')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($resultInfo as $key => $val){
			$resultInfo[$key]['name'] = preg_replace('/\s/','',$val['name']); //去除谜题换行符
			$resultInfo[$key]['answer'] = preg_replace('/\s/','',$val['answer']); //去除谜底换行符
		}
		$this->assign('page',$show);
		$this->assign('typeid',$typeid);
		$this->assign('type',$type);
		$this->assign('nowPage',$nowPage-1); //模板页分类最后一条数据样式的判断条件用到
		$this->assign('count',$count);
		$this->assign('resultInfo',$resultInfo);
		$this->display();
	}
}
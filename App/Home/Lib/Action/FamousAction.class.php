<?php 
/**
 * 名人名言查询控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-6 下午5:52:34
 * @version 1.0
 */
class FamousAction extends Action{
	/**
	 * 头尾部加载信息关键字等
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-6-17 下午8:04:23
	 */
	function _initialize(){
		$this->assign('flag','jiaoyu');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$famous_type 		= M('famous_type');
		$list 				= $famous_type->where(1)->order('id')->limit(10)->select();
		$this->assign('list',$list);
		$this->display();
	}
	/**
	 * 操作数据库在数据库中根据id查询相应的信息
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-6 下午5:55:45
	 * @return array
	 */
	public function search(){
		require ROOT_PATH . '/App/Home/Conf/hotSearch.php';
		if($_GET['hot']){
			$hot   			= $_GET['hot'];
			$search			= $hotSearch[$hot];
		}else{
			$search   		= urldecode($_GET['search']);
		}
		$famous   			= M('famous');
		import('ORG.Util.Page');
		$count    			= $famous->where('name like "%'.$search.'%" or content like "%'.$search.'%"')->count();
		$Page     			= new Page($count,20);
		$nowPage  			= isset($_GET['p'])?$_GET['p']:1;
		$Page -> setConfig("first","首页");
		$Page -> setConfig("last", "尾页");
		$Page -> setConfig("prev","&lt;&lt;");
		$Page -> setConfig("next","&gt;&gt;");
		$Page -> setConfig("theme","%first%%upPage%%linkPage%%downPage%%end% 共%totalPage%页");
		$show     			= $Page->show();
		$preg 				= '/<span\s+class=\'current\'>(\d+)<\/span>/is';
		preg_match($preg,$show,$match);
		$arr 				= preg_split($preg,$show);
		if($count < 21){
			$show 			= "";
		}else{
			$show 			= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		$list     = $famous->where('name like "%'.$search.'%" or content like "%'.$search.'%"')->order('id')->page($nowPage.','.$Page->listRows)->select();
		$this->assign('search',$search);
		$this->assign('nowPage',$nowPage-1);
		$this->assign('page',$show);
		$this->assign('count',$count);
		$this->assign('list',$list);
		$this->display();
	}
	public function searchList(){
		$type = $_GET['type'];
		$famous_type = M('famous_type');
		import('ORG.Util.Page');
		$count  			= $famous_type->where('type = '.$type)->count();
		$Page           	= new Page($count,20);
		$nowPage        	= isset($_GET['p'])?$_GET['p']:1;
		$Page -> setConfig("first","首页");
		$Page -> setConfig("last", "尾页");
		$Page -> setConfig("prev","&lt;&lt;");
		$Page -> setConfig("next","&gt;&gt;");
		$Page -> setConfig("theme","%first%%upPage%%linkPage%%downPage%%end% 共%totalPage%页");
		$show           	= $Page->show();
		$preg 				= '/<span\s+class=\'current\'>(\d+)<\/span>/is';
		preg_match($preg,$show,$match);
		$arr 				= preg_split($preg,$show);
		if($count < 21){
			$show 			= "";
		}else{
			$show 			= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		$result = $famous_type->where('type = '.$type)->limit($Page->firstRow.','.$Page->listRows)->select();
		switch($type){
			case 1:
				$type_name 	= '自由';
				break;
			case 2:
				$type_name 	= '勇气';
				break;
			case 3:
				$type_name 	= '君子';
				break;
			case 4:
				$type_name 	= '知识';
				break;
			case 5:
				$type_name 	= '愿望';
				break;
			case 6:
				$type_name 	= '国家';
				break;
			case 7:
				$type_name 	= '尊严';
				break;
			case 8:
				$type_name 	= '教育';
				break;
			case 9:
				$type_name 	= '诚实';
				break;
			case 10:
				$type_name 	= '努力';
				break;
			case 11:
				$type_name 	= '懒惰';
				break;
			case 12:
				$type_name 	= '生命';
				break;
			case 13:
				$type_name 	= '心理';
				break;
			case 14:
				$type_name 	= '积极';
				break;
			case 15:
				$type_name 	= '健康';
				break;
			case 16:
				$type_name 	= '历史';
				break;
			case 17:
				$type_name 	= '妇女';
				break;
			case 18:
				$type_name 	= '勤奋';
				break;
			case 19:
				$type_name 	= '希望';
				break;
			case 20:
				$type_name 	= '诚信';
				break;
			case 21:
				$type_name 	= '信仰';
				break;
			default:
				break;	
		}
		$this->assign('type_name',$type_name);
		$this->assign('nowPage',$nowPage-1);
		$this->assign('page',$show);
		$this->assign('count',$count);
		$this->assign('result',$result);
		$this->display();
	} 
}
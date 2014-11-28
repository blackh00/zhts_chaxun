<?php
/**
 * 免费起名所对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-6 下午5:52:34
 * @version 1.0
 */
class FreeNameAction extends Action
{	
	function _initialize(){
		$this->assign('flag','zonghe');
		$this->assign('footerFlag',1);
		$this->assign('headInfo', setHead());
	}
	/**
	 * 搜索功能
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-6-15 下午5:29:16
	 */
	public function index(){
		$this->display();
	}
	/**
	 * 操作数据库在数据库中根据id查询相应的信息
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-6 下午5:55:45
	 * @return array
	 */
	public function show(){
		$length   = $_GET['len'];
		$xing     = $_GET['type'];
  		$xing     = str_replace(' ','',$xing);
  		if(strlen($xing)>6)
  			$xing =mb_substr($xing,0,2,'utf-8');
		require ROOT_PATH . '/App/Home/Conf/xingShi.php';
		$type     = $xingShi[$xing];
		$setsex   = $_GET['sex'];
		$freename = M('freename');
		import('ORG.Util.Page'); // 导入分页类
		if($setsex == 0){
			if(empty($length)){
				$count    = $freename->where('type='.$type)->count(); // 查询满足要求的总记录数
			}else{
				$count    = $freename->where('length='.$length.' and type='.$type)->count(); // 查询满足要求的总记录数
			}
		}else{
			$count   	  = $freename->where('sex='.$setsex.' and type='.$type)->count(); // 查询满足要求的总记录数
		}
		$Page             = new Page($count,100); // 实例化分页类 传入总记录数
		$nowPage          = isset($_GET['p'])?$_GET['p']:1; // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		if($setsex == 0){
			if(empty($length)){
				$list     = $freename->where('type='.$type)->order('id')->page($nowPage.','.$Page->listRows)->select();
			}else{
				$list     = $freename->where('length ='.$length.' and type='.$type)->order('id')->page($nowPage.','.$Page->listRows)->select();
			}
		}else{
			$list         = $freename->where('sex='.$setsex.' and type='.$type)->order('id')->page($nowPage.','.$Page->listRows)->select();
		}
		foreach($list as $key =>$val){
			if(strlen($xing)==3){
				$list[$key]['ming']= mb_substr(($val['name']),1,2,'utf-8');
			}else{
				$list[$key]['ming']= mb_substr(($val['name']),2,2,'utf-8');
			}
		}
		$Page -> setConfig("first","首页");
		$Page -> setConfig("last", "尾页");
		$Page -> setConfig("prev","&lt;&lt;");
		$Page -> setConfig("next","&gt;&gt;");
		$Page -> setConfig("theme","%first%%upPage%%linkPage%%downPage%%end% 共%totalPage%页");
		$show     = $Page->show(); // 分页显示输出
		$preg 			  = '/<span\s+class=\'current\'>(\d+)<\/span>/is';
		preg_match($preg,$show,$match);
		$arr 			  = preg_split($preg,$show);
		if($count <= 100){
			$show 		  = "";
		}else{
			$show 		  = $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		$this->assign('xing',$xing);
		$this->assign('setsex',$setsex);
		$this->assign('length',$length);
		$this->assign('page',$show); // 赋值分页输出
		$this->assign('list',$list);
		$this->display();
	}		
}
<?php
class DrugAction extends Action{
	function _initialize(){
		$this->assign('flag','zonghe');
		$this->assign('footerFlag',1);
		$this->assign('headerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
	public function result(){
		$flags		= $_GET['flags'];
		if($flags=='ks'){
			$keyword	= $_GET['drug_key'];
			$keyword	= str_replace(' ','',$keyword);
			$category 	= $_GET['category'];
			if ($keyword=='') {
				$where	= 'category = "'.$category.'"';
			}else{
				$where 	= 'pname like "%'.$keyword.'%" and category = "'.$category.'"';
			}
			$drug     	= M('drug');
			import('ORG.Util.Page');
			$count 		= $drug->where($where)->count();
			$Page       = new Page($count,15);
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
			if($count < 16){
				$show 	= "";
			}else{
				$show 	= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
			}
			$resultInfo = $drug->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
			
			$pages = $_GET['p'];
			if(!$pages){
			$startItem = 0;
			}else{
			$startItem = ($pages-1)*15;
			}
			
			$this->assign('startItem',$startItem);
			
			$this->assign('page',$show);
			$this->assign('count',$count);
			$this->assign('keyword',$keyword);
			$this->assign('category',$category);
			$this->assign('resultInfo',$resultInfo);
		}else if($flags=='gj'){
			$appnum 	= $_GET['appnum'];
			$pname	 	= $_GET['pname'];
			$ename	 	= $_GET['ename'];
			$name	 	= $_GET['name'];
			$category 	= $_GET['category'];
			$unit	 	= $_GET['unit'];
			$appnum2 	= $_GET['appnum2'];
			$code	 	= $_GET['code'];
			$where		= '';
			if ($appnum!= '') {
				$where = $where.'appnum like "%'.$appnum.'%" and ';
			}
			if ($pname != '') {
				$where 	= $where.'pname like "%'.$pname.'%" and ';
			}
			if ($ename != '') {
				$where 	= $where.'ename like "%'.$ename.'%" and ';
			}
			if ($name  != '') {
				$where 	= $where.'name like "%'.$name.'%" and ';
			}
			if ($category!= '') {
				$where 	= $where.'category like "%'.$category.'%" and ';
			}
			if ($unit  != '') {
				$where 	= $where.'unit like "%'.$unit.'%" and ';
			}
			if ($appnum2!='') {
				$where 	= $where.'appnum2 like "%'.$appnum2.'%" and ';
			}
			if ($code	!='') {
				$where 	= $where.'code like "%'.$code.'%" and ';
			}
			$where		= rtrim($where,'and ');
			$drug     	= M('drug');
			import('ORG.Util.Page');
			$count 		= $drug->where($where)->count();
			$Page       = new Page($count,15);
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
			if($count < 16){
				$show 	= "";
			}else{
				$show 	= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
			}
			$resultInfo = $drug->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
			
			$pages = $_GET['p'];
			if(!$pages){
				$startItem = 0;
			}else{
				$startItem = ($pages-1)*15;
			}
				
			$this->assign('startItem',$startItem);
			
			$this->assign('page',$show);
			$this->assign('count',$count);
			$this->assign('appnum',$appnum);
			$this->assign('pname',$pname);
			$this->assign('ename',$ename);
			$this->assign('name',$name);
			$this->assign('category',$category);
			$this->assign('unit',$unit);
			$this->assign('appnum2',$appnum2);
			$this->assign('code',$code);
			$this->assign('resultInfo',$resultInfo);
		}
		$this->assign('flags',$flags);
		$this->display();
	}
	public function detail(){
		$id 	= $_GET['id'];
		$drug	= M('drug');
		$info 	= $drug->where('id = '.$id)->select();
		$this->assign('info',$info);
		$this->display();
	}
}
<?php
/**
 * 成语大全对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-16 下午5:12:52
 * @version 1.0
 */
class PhraseAction extends Action{
	/*
	 * 所有action默认调用的方法
	*/
	function _initialize(){
		$this->assign("flag","jiaoyu");
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含
	}
	public function index(){
		$phrase        		= M('phrase');
		$weekSearch     	= $phrase->field('id,name')->order('count desc,id asc')->limit('4')->select();
		$this->assign('weekSearch',$weekSearch);
		$this->display();
	}
	/**
	 * 详细页面
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-20 下午2:34:06
	 */
	public function show(){
		$search         	= $_GET['id'];
		if(empty($search)){
			$search     	= $_GET['search'];
			$phraseType     = M('phrase_type');
			$phraseName     = $phraseType->where('id = '.$search)->getField('name');
			$searchFirst    = mb_substr($phraseName,0,1,'utf-8');
			$phrase         = M('phrase');
			$result         = $phrase->where('name = "'.$phraseName.'"')->select();
			
		}else{
			$phrase         = M('phrase');
			$phraseName     = $phrase->where('id = '.$search)->getField('name');
			$searchFirst    = mb_substr($phraseName,0,1,'utf-8');
			$result     	= $phrase->where('id = '.$search)->select();
		}
		$resultInfo    		= $phrase->where('name !="'.$phraseName.'" and name like "'.$searchFirst.'%"')->order('id')->limit(20)->select();
		$weekSearch     	= $phrase->field('id,name')->order('count desc,id asc')->limit('4')->select();
		$phrase->where('name = "'.$phraseName.'"')->setInc('count',1);
		$this->assign('search',$phraseName);
		$this->assign('result',$result);
		$this->assign('resultInfo',$resultInfo);
		$this->assign('weekSearch',$weekSearch);
		$this->display();
	}
	/**
	 * 搜索功能
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-20 下午2:34:06
	 */
	public function search(){
		$search        		= $_GET['search'];
		$search        	 	= str_replace(' ','',$search);
		$phrase         	= M('phrase');
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
		$weekSearch     	= $phrase->field('id,name')->order('count desc,id asc')->limit('4')->select();
		$count          	= $phrase->where('name like "%'.$search.'%"')->count();
		$Page           	= new Page($count,5);
		$nowPage        	= isset($_GET['p'])?$_GET['p']:1;
		$startItem 			= ($nowPage-1)*5;
		//$result           = $phrase->where('name like "%'.$search.'%"')->Distinct('name')->order('id')->page($nowPage.','.$Page->listRows)->select();
		$result         	= $phrase->query('select distinct name,spell,content,id  from fanwe_phrase where name like "%'.$search.'%" order by id asc limit '.$startItem.','.$Page->listRows);
		
		$Page -> setConfig("first","首页");
		$Page -> setConfig("last", "尾页");
		$Page -> setConfig("theme","%first%%upPage%%linkPage%%downPage%%end% 共%totalPage%页");
		
		$show           	= $Page->show();
		$preg 				= '/<span\s+class=\'current\'>(\d+)<\/span>/is';
		preg_match($preg,$show,$match);
		$arr 				= preg_split($preg,$show);
		//dump($arr);
		// 组装
		if($count < 6){
			$show 			= "";
		}else{
			$show 			= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		$this->assign('page',$show);
		$this->assign('search',$search);
		$this->assign('count',$count);
		$this->assign('result',$result);
		$this->assign('weekSearch',$weekSearch);
		$this->display();
	}
	/**
	 * 成语列表页面
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-20 下午2:35:15
	 */
	public function typelist(){
		$type           	= $_GET['type'];
		if(empty($type)){
			$type       	= '1';
		}
		require ROOT_PATH . '/App/Home/Conf/chengYu.php';
		$chengyu     		= $chengYu[$type];
		//$type           	= safeEncoding($type,$outEncoding = 'UTF-8');
		$phraseType     	= M('phrase_type');
		$phrase         	= M('phrase');
		$result         	= $phraseType->where('type = "'.$chengyu.'"')->select();
		$weekSearch     	= $phrase->field('id,name')->order('count desc,id asc')->limit('4')->select();
		$this->assign('type',$chengyu);
		$this->assign('result',$result);
		$this->assign('weekSearch',$weekSearch);
		$this->display();
	}
}
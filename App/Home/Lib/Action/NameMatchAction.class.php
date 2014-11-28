<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-23 下午6:04:18
 * @version 1.0
 */
class NameMatchAction extends Action{
	
	// 控制器初始化。
	public function _initialize(){
		$flag="zonghe";
		$this->assign('flag',$flag);
		$this->assign('headInfo',setHead());
	}
	
	// 姓名配对首页显示。
	public function index(){
		
		$this->display();
	}
	
	// 姓名配对搜索结果显示。
	public function search(){
		if(isset($_POST['formcheck']) && $_POST['formcheck'] == 'submit'){
			if(isset($_POST['name1']) && $_POST['name1'] != '' && isset($_POST['name2']) && $_POST['name2'] != ''){
				$match=M('bihua');
				
				// 计算第一个姓名的笔画数。
				$data['hanzi']=array('like','%'.mb_substr($_POST['name1'], 0,1,'utf-8').'%');
				$bihua01=$match->where($data)->getField('num');
				
				if(mb_substr($_POST['name1'], 1,1,'utf-8')){
					$data['hanzi']=array('like','%'.mb_substr($_POST['name1'], 1,1,'utf-8').'%');
					$bihua02=$match->where($data)->getField('num');
				}
				
				if(mb_substr($_POST['name1'], 2,1,'utf-8')){
					$data['hanzi']=array('like','%'.mb_substr($_POST['name1'], 2,1,'utf-8').'%');
					$bihua03=$match->where($data)->getField('num');
				}
				
				if(mb_substr($_POST['name1'], 3,1,'utf-8')){
					$data['hanzi']=array('like','%'.mb_substr($_POST['name1'], 3,1,'utf-8').'%');
					$bihua04=$match->where($data)->getField('num');				
				}
				
				$bihua1=$bihua01+$bihua02+$bihua03+$bihua04;
				
				// 计算第二个姓名的笔画数。
				$data['hanzi']=array('like','%'.mb_substr($_POST['name2'], 0,1,'utf-8').'%');
				$bihua11=$match->where($data)->getField('num');
				
				if(mb_substr($_POST['name2'], 1,1,'utf-8')){
					$data['hanzi']=array('like','%'.mb_substr($_POST['name1'], 1,1,'utf-8').'%');
					$bihua12=$match->where($data)->getField('num');
				}
				
				if(mb_substr($_POST['name2'], 2,1,'utf-8')){
					$data['hanzi']=array('like','%'.mb_substr($_POST['name1'], 2,1,'utf-8').'%');
					$bihua13=$match->where($data)->getField('num');
				}
				
				if(mb_substr($_POST['name2'], 3,1,'utf-8')){
					$data['hanzi']=array('like','%'.mb_substr($_POST['name1'], 3,1,'utf-8').'%');
					$bihua14=$match->where($data)->getField('num');
				}
				
				$bihua2=$bihua11+$bihua12+$bihua13+$bihua14;
				$bihua=$bihua1+$bihua2;	

				if($bihua > 100){
					$bihua = $bihua%100;
				}
				$nameMatch=M('name_match');
				$data['bihua']=array('like','%'.$bihua.'%');
				$record=$nameMatch->where($data)->find();
				$this->assign('record',$record);
				$this->assign('name1',$_POST['name1']);
				$this->assign('name2',$_POST['name2']);
			}else{
				$this->error('姓名输入不格式不正确。',"SITE_DYNAMIC_URL/namematch/");
				return false;
			}
		}else{
			$this->error('姓名输入不格式不正确。',"SITE_DYNAMIC_URL/namematch/");
			return false;
		}
		
		$this->display();
	}
}
<?php
/**
 * 成语接龙
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-9 下午4:52:52
 * @version 1.0
 */
class IdiomAction extends Action{
	function _initialize(){
		$this->assign('flag','jiaoyu');
		$this->assign('footerFlag',1);
		$this->assign('headerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
	public function result(){
		$start 			= $_GET['start'];                             	//起始成语
		$idiom_length 	= $_GET['idiom_length'];						//成语的字数
		$idiom_count 	= $_GET['idiom_count'];							//搜索显示出来的个数
		$idiom_hot_rand = $_GET['idiom_hot_rand'];						//热门成语还是随机搜索
		$mod 			= $_GET['mod'];									//顺接逆接
		
		$length 		= mb_strlen($start);							//起始成语的长度
		$mod0[0] 		= mb_substr($start,$length-3,3);				//取最后一个字
		$mod1[0] 		= mb_substr($start,0,3);						//取第一个字
		switch($idiom_length){
			case 0:
				$where_length = '';
				break;
			case 1:
				$where_length = 'and length = 0 ';
				break;
			case 2:
				$where_length = 'and length = 1 ';
				break;
			default:
				break;
		}
		switch($idiom_count){
			case 0:
				$iCount = 1;
				break;
			case 1:
				$iCount = 2;
				break;
			case 2:
				$iCount = 3;
				break;
			case 3:
				$iCount = 10;
				break;
			default:
				break;
		}
		if($idiom_hot_rand == 0){
			$where_hot_rand = '';
		}else{
			$where_hot_rand = 'order by rand()';
		}
		//起始成语为空不做查询处理
		if($start !=''){
			$idiom = M('phrase');
			//顺接查询
			if($mod == 0){
				for($i=0;$i<$iCount;$i++){
					$resultInfo[$i] = $idiom->query('select name from fanwe_phrase where name like "'.$mod0[$i].'%"'.$where_length.$where_hot_rand.'limit 1');
					$length0 = mb_strlen($resultInfo[$i][0]['name']);							
					$mod0[$i+1] = mb_substr($resultInfo[$i][0]['name'],$length0-3,3);
					//查出指定个数之前查不到数据则退出循环
					if(!$mod0[$i+1]){
						$resultInfo[$i][0]['name'] = '<em>温馨提示：<img src="STATIC_URL/images/anlian/cy_2.gif" width="35" height="29" /> 哈哈，已经到龙尾了！！</em>';
						break;
					}
				}
			}else{ //逆接查询
				for($i=0;$i<$iCount;$i++){
					$resultInfo[$i] = $idiom->query('select name from fanwe_phrase where name like "%'.$mod1[$i].'"'.$where_length.$where_hot_rand.'limit 1');
					$mod1[$i+1] = mb_substr($resultInfo[$i][0]['name'],0,3);
					if(!$mod1[$i+1]){
						$resultInfo[$i][0]['name'] = '<em>温馨提示：<img src="STATIC_URL/images/anlian/cy_2.gif" width="35" height="29" /> 哈哈，已经到龙尾了！！</em>';
						break;
					}
				}
			}
		}
		$this->assign('i',$i);
		$this->assign('start',$start);
		$this->assign('idiom_length',$idiom_length);
		$this->assign('idiom_count',$idiom_count);
		$this->assign('iCount',$iCount);
		$this->assign('idiom_hot_rand',$idiom_hot_rand);
		$this->assign('mod',$mod);
		$this->assign('resultInfo',$resultInfo);
		$this->display();
	}
}
<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-9 下午5:13:28
 * @version 1.0
 */
class ThreeHundredTangPoemsAction extends Action{
		
	public function _initialize(){
		$this->assign('headerFlag',1);
		$this->assign('flag','jiaoyu');
		$this->assign('headInfo',setHead());
	}
	
	// 唐诗三百首首页显示。
	public function index(){
		$tangShi=M('tang_shi_sbs');
		$category=array(1=>'五言绝句',2=>'七言绝句',3=>'五言律诗',4=>'七言律诗',5=>'五言古诗',6=>'七言古诗',7=>'五言乐府',8=>'七言乐府');
		$this->assign('category',$category);
		$record1=$tangShi->where("category=1")->select();
		$record2=$tangShi->where("category=2")->select();
		$record3=$tangShi->where("category=3")->select();
		$record4=$tangShi->where("category=4")->select();
		$record5=$tangShi->where("category=5")->select();
		$record6=$tangShi->where("category=6")->select();
		$record7=$tangShi->where("category=7")->select();
		$str="杜甫（39首）-李白（30首）-王维（29首）-李商隐（24首）-孟浩然（15首）-韦应物（12首）-刘长卿（11首）-杜牧（10首）-王昌龄（8首）-岑参（7首）-李颀（7首）-白居易（6首）-卢纶（6首）-柳宗元（5首）-张祜（5首）-韩愈（4首）-元稹（4首）-温庭筠（4首）";
		$record8=explode('-',$str);		
		$this->assign('record1',$record1);
		$this->assign('record2',$record2);
		$this->assign('record3',$record3);
		$this->assign('record4',$record4);
		$this->assign('record5',$record5);
		$this->assign('record6',$record6);
		$this->assign('record7',$record7);
		$this->assign('record8',$record8);
		$this->display();
	}
	// 显示唐诗三百首详细页面。
	public function showDetailedPage(){
		$tangShi=M('tang_shi_sbs');
		$record=$tangShi->where("id=".$_GET['id'])->find();
		$this->assign('record',$record);
		$category=array(1=>'五言绝句',2=>'七言绝句',3=>'五言律诗',4=>'七言律诗',5=>'五言古诗',6=>'七言古诗',7=>'乐府');
		$this->display();
	}
	// 每位作者的作品。
	public function author(){
		$aut=M('tang_shi_author');
		$rec=M('tang_shi_sbs');
		if(isset($_GET['author']) &&  $_GET['author'] !=''){
			$_GET['author']=trim($_GET['author']);
			$data['author']=array('like','%'.$_GET['author'].'%');
			$record=$aut->where($data)->find();	
			$record1=$rec->where($data)->select();	
			$this->assign('author',$_GET['author']);
			$this->assign('record1',$record1);
			$this->assign('record',$record);
		}else{
			$this->display('noFound');
			return true;
		}	
		$str="杜甫（39首）-李白（30首）-王维（29首）-李商隐（24首）-孟浩然（15首）-韦应物（12首）-刘长卿（11首）-杜牧（10首）-王昌龄（8首）-岑参（7首）-李颀（7首）-白居易（6首）-卢纶（6首）-柳宗元（5首）-张祜（5首）-韩愈（4首）-元稹（4首）-温庭筠（4首）";
		$record8=explode('-',$str);
		$this->assign('record8',$record8);
		$this->display();
	}
	// 按作者姓名笔画列出。
	public function biHua(){
		$str='李白 (30首) -杜甫 (39首) -王维 (29首) -王昌龄 (8首) -岑参 (7首) -元结 (2首) -李颀 (7首) -白居易 (6首) -李商隐 (24首) -王勃 (1首) -杜审言 (1首) -沈佺期 (2首) -宋之问 (1首) -王湾 (1首) -李益 (3首) -司空曙 (3首) -杜牧 (10首) -杜荀鹤 (1首) -元稹 (4首) -王之涣 (2首) -李端 (1首) -王建 (1首) -李频 (1首) -西鄙人 (1首) -王翰 (1首) -杜秋娘 (1首) -孟浩然(15首) -邱为(1首) -常建(2首) -韦应物(12首) -柳宗元(5首) -孟郊(2首) -高适(1首) -唐玄宗(1首) -马戴(2首) -崔涂(2首) -韦庄(2首) -崔颢(4首) -祖咏(2首) -崔曙(1首) -皇甫冉(1首) -秦韬玉(1首) -金昌绪(1首) -柳中庸(1首) -张九龄 (3首) -綦毋潜 (1首) -陈子昂 (1首) -刘长卿 (11首) -刘禹锡 (4首) -张藉 (1首) -许浑 (2首) -温庭筠 (4首) -张乔 (1首) -皎然 (1首) -裴迪 (1首) -张祜 (5首) -贾岛 (1首) -贺知章 (1首) -张旭 (1首) -张继 (1首) -韩翎 (2首) -刘方平 (2首) -朱庆余 (2首) -郑畋 (1首) -陈陶 (1首) -张泌 (1首) -无名氏 (1首) -韩愈 (4首) -骆宾王 (1首) -钱起 (3首) -韩翃 (2首) -刘眘虚 (1首) -戴叔伦 (1首) -卢纶 (6首) -薛逢 (1首) -权德舆 (1首) -顾况 (1首)';
		$record8=explode('-', $str);
		$this->assign('record8',$record8);
		$this->display();
	}
	// 按作者姓名笔画列出。
	public function search(){
		$rec=M(tang_shi_sbs);
		if(isset($_REQUEST['key_t']) && $_REQUEST['key_t'] != '' && isset($_REQUEST['word']) && $_REQUEST['word'] != ''){
			if($_REQUEST['key_t']==1){
				//$data['author']=array('like','%'.$_GET['word'].'%');
				$per=8;
				$sql="select * from `fanwe_tang_shi_sbs` where author like '%".$_REQUEST['word']."%' ";
				$all_count_query = mysql_query($sql);
				$num = mysql_num_rows($all_count_query);
				mysql_free_result($all_count_query);
				$cur = @$_REQUEST['page'] > 0 ? $_REQUEST['page'] : 1;
				$total = $num % $per == 0 ? floor($num/$per) : floor($num/$per) + 1;
				$total=$total==0?1:$total;
				$cur = @$_REQUEST['page'] > $total ? $total : $cur;
				$end = ($cur + 4) > $total?$total:($cur + 4);
				$start = ($end - 4) > 0?($end - 4):1;
				$end = ($start + 4) > $total?$total:($start + 4);
				$sql.=" order by `id` desc  limit ".($cur-1)*$per.",".$per." ";
					
				$salons_query = mysql_query($sql);   // 获得本页结果。
				while($row=mysql_fetch_assoc($salons_query)){
					$list[]=$row;
				}
				//print_r($list);	
				//echo $total;exit;
				mysql_free_result($salons_query);
				if(!$num){
					$this->assign('word',$_REQUEST['word']);
					$this->display('noFound');
					return false;
				}
				
				$this->assign('key_t',$_REQUEST['key_t']);
				$this->assign('word',$_REQUEST['word']);
				$this->assign('total',$total);
				$this->assign('start',$start);
				$this->assign('end',$end);
				$this->assign('cur',$cur);
				$this->assign('list',$list);
			}elseif($_REQUEST['key_t']==2){
				//$data['author']=array('like','%'.$_GET['word'].'%');
				$per=8;
				$sql="select * from `fanwe_tang_shi_sbs` where title like '%".$_REQUEST['word']."%' ";
				$all_count_query = mysql_query($sql);
				$num = mysql_num_rows($all_count_query);
				mysql_free_result($all_count_query);
				$cur = @$_REQUEST['page'] > 0 ? $_REQUEST['page'] : 1;
				$total = $num % $per == 0 ? floor($num/$per) : floor($num/$per) + 1;
				$total=$total==0?1:$total;
				$cur = @$_REQUEST['page'] > $total ? $total : $cur;
				$end = ($cur + 4) > $total?$total:($cur + 4);
				$start = ($end - 4) > 0?($end - 4):1;
				$end = ($start + 4) > $total?$total:($start + 4);
				$sql.=" order by `id` desc  limit ".($cur-1)*$per.",".$per." ";
					
				$salons_query = mysql_query($sql);   // 获得本页结果。
				while($row=mysql_fetch_assoc($salons_query)){
					$list[]=$row;
				}
				//print_r($list);
				//echo $total;exit;
				mysql_free_result($salons_query);
				if(!$num){
					$this->assign('word',$_REQUEST['word']);
					$this->display('noFound');
					return false;
				}
				
				$this->assign('key_t',$_REQUEST['key_t']);
				$this->assign('word',$_REQUEST['word']);
				$this->assign('total',$total);
				$this->assign('start',$start);
				$this->assign('end',$end);
				$this->assign('cur',$cur);
				$this->assign('list',$list);
				
			}elseif($_REQUEST['key_t']==3){
				$per=8;
				$sql="select * from `fanwe_tang_shi_sbs` where content like '%".$_REQUEST['word']."%' ";
				$all_count_query = mysql_query($sql);
				$num = mysql_num_rows($all_count_query);
				mysql_free_result($all_count_query);
				$cur = @$_REQUEST['page'] > 0 ? $_REQUEST['page'] : 1;
				$total = $num % $per == 0 ? floor($num/$per) : floor($num/$per) + 1;
				$total=$total==0?1:$total;
				$cur = @$_REQUEST['page'] > $total ? $total : $cur;
				$end = ($cur + 4) > $total?$total:($cur + 4);
				$start = ($end - 4) > 0?($end - 4):1;
				$end = ($start + 4) > $total?$total:($start + 4);
				$sql.=" order by `id` desc  limit ".($cur-1)*$per.",".$per." ";
					
				$salons_query = mysql_query($sql);   // 获得本页结果。
				while($row=mysql_fetch_assoc($salons_query)){
					$list[]=$row;
				}
				mysql_free_result($salons_query);
				if(!$num){
					$this->assign('word',$_REQUEST['word']);
					$this->display('noFound');
					return false;
				}
				$this->assign('key_t',$_REQUEST['key_t']);
				$this->assign('word',$_REQUEST['word']);
				$this->assign('total',$total);
				$this->assign('start',$start);
				$this->assign('end',$end);
				$this->assign('cur',$cur);
				$this->assign('list',$list);
			}else{
				$this->display('noFound');
				return false;
			}
		}else{
			$this->display('noFound');
			return false;
		}
		$this->display();
	}
	// 按作者姓名笔画列出。
	public function noFounds(){
		$this->display();
	}
}
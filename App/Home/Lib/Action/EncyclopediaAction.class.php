<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-10 下午2:40:12
 * @version 1.0
 */
class EncyclopediaAction extends Action{
	
	// 控制器初始化方法。
	public function _initialize(){
		$flag="jiaoyu";
		$this->assign('flag',$flag);
		$this->assign('headInfo',setHead());
	}
	
	// 百科全书首页显示
	public function index(){
		$ency = M('encyclopedia');
		$record=$ency->order('id desc')->limit(1,48)->select();
		$this->assign('record',$record);
		$this->display();
	}
	
	// 显示百科全书列表页。
	public function lists(){
		import("ORG.Util.Page");
		$ency = M('encyclopedia');
		$per=117;
		$sql="select * from `fanwe_encyclopedia`";
		$all_count_query = mysql_query($sql);
		$num = mysql_num_rows($all_count_query);
		mysql_free_result($all_count_query);
		$cur = @$_GET['page'] > 0 ? $_GET['page'] : 1;
		$total = $num % $per == 0 ? floor($num/$per) : floor($num/$per) + 1;
		$total=$total==0?1:$total;
		$cur = @$_GET['page'] > $total ? $total : $cur;
		$end = ($cur + 4) > $total?$total:($cur + 4);
		$start = ($end - 4) > 0?($end - 4):1;
		$end = ($start + 4) > $total?$total:($start + 4);
		$sql.=" order by `id` desc  limit ".($cur-1)*$per.",".$per." ";
			
		$salons_query = mysql_query($sql);   // 获得本页结果。
		while($row=mysql_fetch_assoc($salons_query)){
			$list[]=$row;
		}	
		//echo $end;exit;
		mysql_free_result($salons_query);	
		/* import("ORG.Util.Page");
		$ency = M('encyclopedia');
		$count = $ency->count();
		$page = new Page($count,117);
		$nowPage = isset($_GET['p']) ? $_GET['p']:1; 
		$list = $ency->order('id')->page($nowPage.",".$page->listRows)->select();
		$show = $page->show(); */
		
		// 分页显示。
		/* if($cur-1<1){
			echo'<a>&#8249;</a>';
		}else{
			echo'<a href="salons_list.php?';
			echo'page='.($cur-1).'">&#8249;</a>';
		}
		
		for( $i=$start; $i<=$end; $i++ ){
			if($cur==$i){
				$class='class="current"';
			}else{$class='';
			}
			echo  "<a href='salons_list.php?page=".$i."' $class>".$i."</a>";
		}
		
		if($cur+1>$total){
			echo "<a>&#8250;</a>";
		}else{
			echo '<a href="salons_list.php?';
			echo'page='.($cur+1).'">&#8250;</a>';
		}		 */
		
		$this->assign('total',$total);
		$this->assign('start',$start);
		$this->assign('end',$end);
		$this->assign('cur',$cur);
		$this->assign('list',$list);
		//echo $num."---";
		//var_dump($list);exit;
		$this->display();
	}
	
	// 显示百科全书详细页面。
	public function showDetaile(){
		//isset($_GET['id']) && $_GET['id'] != ''
		if(isset($_GET['id']) && $_GET['id'] != ''){
			$encyDetaileShow=M('encyclopedia');
			$record=$encyDetaileShow->where("id=".$_GET['id'])->find();
			$num=$encyDetaileShow->where("id=".$_GET['id'])->count();
			if(!$num){
				$this->display('noFound');
				return false;
			}
			$this->assign("record",$record);
			$this->display();
		}elseif(isset($_GET['title']) && $_GET['title'] != ''){
			$encyDetaileShow=M('encyclopedia');
			$data['title']=array('like','%'.$_GET['title'].'%');
			$num=$encyDetaileShow->where($data)->count();
			if(!$num){
				$this->assign('title',$_GET['title']);
				$this->display('noFound');
				return false;
			}
			$record=$encyDetaileShow->where($data)->find();
			$this->assign("record",$record);
			$this->display();
		}else{
			$error="访问出错，数据库没有此数据。";
			$this->assign("error",$error);
			$this->display('noFound');
		}				
	}
	
	// 未找到查询结果页面。
	public function noFound(){
		
		$this->display();
	}
	
	
}
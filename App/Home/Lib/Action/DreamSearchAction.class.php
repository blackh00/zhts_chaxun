<?php
/**
 * 周公解梦
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @UpdateDate: 2013-7-11 下午3:15:25
 * @version 1.0
 */
class DreamSearchAction extends Action{
	// 控制器初始化方法。
	public function _initialize(){
		$this->assign('flag','zonghe');
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	public function index(){
		$dream=M(dream);
		//处理整体分类页面的数据。
		if($_REQUEST['cate']=="人物"){
			$m1='on';
		} elseif ($_REQUEST['cate']=="动物"){
			$m2='on';
		} elseif ($_REQUEST['cate']=="植物"){
			$m3='on';
		} elseif ($_REQUEST['cate']=="物品"){
			$m4='on';
		} elseif ($_REQUEST['cate']=="活动"){
			$m5='on';
		} elseif ($_REQUEST['cate']=="生活"){
			$m6='on';
		} elseif ($_REQUEST['cate']=="自然"){
			$m7='on';
		} elseif ($_REQUEST['cate']=="鬼神"){
			$m8='on';
		} elseif ($_REQUEST['cate']=="建筑"){
			$m9='on';
		} elseif ($_REQUEST['cate']=="其它"){
			$m10='on';
		}
		if(!isset($_REQUEST['cate'])){
			$m1='on';
			$_REQUEST['cate']="人物";
		}
		$category=$dream->Distinct(true)->field('category')->select();
		foreach ($category as $key => $va){
			//$map['name'] = array('like','thinkphp%');			
			$map['category']=array('like',"%".$va['category']."%");
			$record[]=$dream->where($map)->select();
		}
		foreach ($category as $key=>$var){
			$arr[]=$var['category'];
		}	
		$this->assign('m1',$m1);
		$this->assign('m2',$m2);
		$this->assign('m3',$m3);
		$this->assign('m4',$m4);
		$this->assign('m5',$m5);
		$this->assign('m6',$m6);
		$this->assign('m7',$m7);
		$this->assign('m8',$m8);
		$this->assign('m9',$m9);
		$this->assign('m10',$m10);
		$this->assign('arr',$arr);
		$this->assign('category',$category);
		$this->assign('record',$record);
	    $this->display();
	}		
	public function titleDetail(){
		import("ORG.Util.Page");
		$dream=M(dream);
		// 处理整体分类页面的数据。	
		if($_REQUEST['cate']=="人物"){
			$m1='on';
		} elseif ($_REQUEST['cate']=="动物"){
			$m2='on';
		} elseif ($_REQUEST['cate']=="植物"){
			$m3='on';
		} elseif ($_REQUEST['cate']=="物品"){
			$m4='on';
		} elseif ($_REQUEST['cate']=="活动"){
			$m5='on';
		} elseif ($_REQUEST['cate']=="生活"){
			$m6='on';
		} elseif ($_REQUEST['cate']=="自然"){
			$m7='on';
		} elseif ($_REQUEST['cate']=="鬼神"){
			$m8='on';
		} elseif ($_REQUEST['cate']=="建筑"){
			$m9='on';
		} elseif ($_REQUEST['cate']=="其它"){
			$m10='on';
		} 
		if(!isset($_REQUEST['cate'])){
			$m1='on';
			$_REQUEST['cate']="人物";
		}
		$cate_count = $_REQUEST['cate'];
		$category	= $dream->Distinct(true)->field('category')->select();
		$count  	= $dream->where('category = "'.$cate_count.'"')->count();
		$Page       = new Page($count,81);
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
		if($count < 82){
			$show 	= "";
		}else{
			$show 	= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		$list = $dream->where('category = "'.$cate_count.'"')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('page',$show);
		$this->assign('m1',$m1);
		$this->assign('m2',$m2);
		$this->assign('m3',$m3);
		$this->assign('m4',$m4);
		$this->assign('m5',$m5);
		$this->assign('m6',$m6);
		$this->assign('m7',$m7);
		$this->assign('m8',$m8);
		$this->assign('m9',$m9);
		$this->assign('m10',$m10);
		$this->assign('list',$list);
		$this->assign('category',$category);
		$this->display();
	}
	// 搜索页面处理。
	public function dreamsearch(){
	    $drdata = $_POST[dr];		
 		$dreams = M('dream');
		$where ="title like '%".$drdata."%'";
		$data  = $dreams->where($where)->select();
		$oneDetail = $data[0];
 		if($data==null || !isset($_POST[dr]) || $_POST[dr] == ''){
 			$drdata = $_POST[dr];
 			$keyWord=$_REQUEST['dr'];
 			$this->assign('keyWord',$keyWord);
			$this->display('DreamSearch:notFound');
			return false;
		}	
		$where="category = '".$data[0]['category']."'";
		$bottomTitle=$dreams->where($where)->select();
		$this->assign('bottomTitle',$bottomTitle);
		$this->assign('dreamTitle',$_POST[dr]);
		$this->assign('oneDetail',$oneDetail);
		$this->assign('prompt',$prompt);		
		$this->assign('drdata',$drdata);
		$this->assign('data',$data);
		$this->display('DreamSearch:search'); 
    } 
    public function contentDetail(){
    	if(isset($_REQUEST['id']) && $_REQUEST['id'] != ''){
    		$dream=M('dream');
    		$data['id']=$_REQUEST['id'];
    		$record=$dream->where($data)->find();
    		$count=$dream->where($data)->count();
			if($count){
				$where="category = '".$record['category']."'";
				$bottomTitle=$dream->where($where)->select();
				$this->assign('bottomTitle',$bottomTitle);
				$this->assign('record',$record);
				$this->display();
			}else{
				$this->display('DreamSearch:notFound');
			}
    	} else {   	
    		$keyWord=$_REQUEST['dr'];
    		$this->assign('keyWord',$keyWord);
    		$this->display('DreamSearch:notFound');
    	}
    }  
}
?>


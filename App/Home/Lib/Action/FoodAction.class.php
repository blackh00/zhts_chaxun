<?php
/**
 * 食物热量所对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-6 下午5:52:34
 * @version 1.0
 */
class FoodAction extends Action
{
	function _initialize(){
		require ROOT_PATH . '/App/Home/Conf/foodSearch.php';
		$this->assign("foodSearch", $foodSearch);
		$this->assign("foodSearch_home", $foodSearch);
		$this->assign("flag", "zonghe");		//所属频道tag
		$this->assign("headInfo", setHead());	//设置头部信息
		 // 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示包含
		$this->assign("footerFlag", 1);			//底部js，1代表调用
	}
	/**
	 * 操作数据库在数据库中根据id查询相应的信息
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-6 下午5:55:45
	 * @return array
	 */
	public function index(){
		$this->display();
	}
	/**
	 * 食物分类页面
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-6-13 下午4:35:58
	 */
	public function foodList(){
		$type 		= $_GET['type'];
		if(empty($type)){
			$type 	= 1;
		}
		require ROOT_PATH . '/App/Home/Conf/food.php';
		$type 		= $foodType[$type];
		$food 		= M('food');
		$food_type 	= M('food_type');
		import('ORG.Util.Page');
		$sub_type 	= $food_type->field('id,sub_type')->where('type = "'.$type.'"')->order('id desc')->select();
		$count  	= $food->where('type = "'.$type.'"')->count();
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
		$result = $food->where('type = "'.$type.'"')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('page',$show);
		$this->assign('sub_type',$sub_type);
		$this->assign('type',$type);
		$this->assign('result',$result);
		$this->display();
	}
	/**
	 * 食物子分类页面
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-6-13 下午4:35:00
	 */
	public function foodSubList(){
		$subType = $_GET['subtype'];
		$foodType = M('food_type');
		$subType = $foodType->field('type,sub_type')->where('id ='.$subType)->select();
		$sub_type = $foodType->where('type ="'.$subType[0]['type'].'"')->order('id desc')->select();
		$food = M('food');
		$count =$food->where('sub_type = "'.$subType[0]['sub_type'].'"')->count();
		import('ORG.Util.Page');
		$Page		= new Page($count,10);
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
		$result =$food->where('sub_type = "'.$subType[0]['sub_type'].'"')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('page',$show);
		$this->assign('type',$subType[0]['type']);
		$this->assign('sub_type',$sub_type);
		$this->assign('result',$result);
		$this->display();
	}
	/**
	 * 食物详细页面
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-6-13 下午4:34:21
	 */
	public function detail(){
		$id			= $_GET['id'];
		$food 		= M('food');
		$resultInfo = $food->where('id='.$id)->select();
		$field 		= $food->field('type,sub_type,image')->where('id='.$id)->select();
		$sub_type 	= $field[0]['sub_type'];
		$food_type	= M('food_type');
		$sub_type	= $food_type->field('id')->where('sub_type="'.$sub_type.'"')->select();
		$sub_type_id= $sub_type[0]['id'];
		//键值对应分类
		require ROOT_PATH . '/App/Home/Conf/food.php';
		$foodType 	= array_flip($foodType);
		$type 		= $field[0]['type'];
		$type		= $foodType[$type];
		
		$info =array();
		$infoArrList= array();
		foreach($resultInfo as $key => $value){
			//营养信息数据处理
			$infomation 	= explode(',',$value['information']);
			$infoArr 		= array();
			for($i=0;$i<count($infomation)-1;$i++){
				$infoArr[$i]= trim($infomation[$i]);
				$infoArrList= explode('#',$infoArr[$i]);
				$info[$i]['information_name'] = $infoArrList[0];
				$info[$i]['information_value'] = $infoArrList[1];
			}
			//相关食物信息处理
			$related_food 	= explode(',',$value['related_food']);
			$relatedArr		= array();
			$relatedArrList = array();
			for($i=0;$i<count($related_food)-1;$i++){
				$relatedArr[$i]= trim($related_food[$i]);
				$related_id=$food->field('id')->where('name ="'.$relatedArr[$i].'"')->select();
				$relatedArrList[$i]['name']=$relatedArr[$i];
				$relatedArrList[$i]['id']=$related_id[0]['id'];
			}
		}
		$this->assign('image',$field[0]['image']);          //图片
		$this->assign('type',$type);						//分类
		$this->assign('sub_type',$sub_type_id);				//子分类
		$this->assign('resultInfo',$resultInfo);			//食物信息
		$this->assign('relatedArrList',$relatedArrList);	//相关食物信息
		$this->assign('info_jy',$info);						//简要营养信息	
		$this->assign('info_xx',$info);						//详细营养信息
		$this->display();
	}
	/**
	 * 食物搜索页面
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-6-13 下午4:35:32
	 */
	public function search(){
		$search  			= $_GET['search'];
		$search  			= str_replace(' ','',$search);
		$food = M('food');
		import('ORG.Util.Page');
		$count  			= $food->where('name like "%'.$search.'%"')->count();
		$Page           	= new Page($count,10);
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
		if($count < 11){
			$show 			= "";
		}else{
			$show 			= $arr[0].'<a class="current" href="#">'.$match[1].'</a>'.$arr[1];
		}
		$result = $food->where('name like "%'.$search.'%"')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('page',$show);
		$this->assign('search',$search);
		$this->assign('result',$result);
		$this->display();
	}
}
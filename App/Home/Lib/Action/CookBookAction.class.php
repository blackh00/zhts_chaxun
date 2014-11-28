<?php 
/**
 * 菜谱大全
 * 
 * @copyright (C)2012 ZHTS Inc.
 * @project KEFU
 * @author Vonwey <vonwey@qq.com>
 * @CreateDate: 2013-6-8 上午8:51:51
 * @version 1.0
 *
 * @ModificationHistory  
 * Who          When                What 
 * --------     ----------          ------------------------------------------------ 
 * Linmaogan   2013-6-8 上午8:51:51      todo
 */
class CookBookAction extends Action{
	/**
	 * 初始值
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-8 上午8:50:42
	 */
	function _initialize(){
		$this->assign("flag","shenghuo");
		$this->assign("headerFlag",1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	/**
	 * 菜谱分类展示
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-8 上午8:51:00
	 */
	public function index(){
		$CookBook = M("cookbook_type");
		$result = $CookBook
					->table("fanwe_cookbook_tag")
					->join("fanwe_cookbook_type on fanwe_cookbook_tag.type_id = fanwe_cookbook_type.id")
					->field('fanwe_cookbook_type.id as type_id ,fanwe_cookbook_type.* ,fanwe_cookbook_tag.*')
					->select();
		foreach ($result as $key=>$value){
			$list[$value['type_id']][0]   = $value['classification'];
			$list[$value['type_id']][1][] = $value;
		}
		$this->assign("list",$list);
		//print_r($list);
		$this->display();
	}
	/**
	 * 搜索页面
	 * @see Action::show()
	 */
	public function show(){
		$search      = $_GET['search'];
		$cookbook    = M('cookbook_content');
		import('ORG.Util.Page'); // 导入分页类
		$count       = $cookbook->where('cookbook_tags like "%'.$search.'%" or cookbook_name like "%'.$search.'%" or cookbook_taste like "%'.$search.'%" or cookbook_time like "%'.$search.'%" or cookbook_difficulty like "%'.$search.'%" or cookbook_taste like "%'.$search.'%" or cookbook_time like "%'.$search.'%" or cookbook_ingredients_name like "%'.$search.'%"')->count(); // 查询满足要求的总记录数
		$Page        = new Page($count,10); // 实例化分页类 传入总记录数
		$nowPage     = isset($_GET['p'])?$_GET['p']:1; // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$resultInfo  = $cookbook->where('cookbook_tags like "%'.$search.'%" or cookbook_name like "%'.$search.'%" or cookbook_taste like "%'.$search.'%" or cookbook_time like "%'.$search.'%" or cookbook_difficulty like "%'.$search.'%" or cookbook_taste like "%'.$search.'%" or cookbook_time like "%'.$search.'%" or cookbook_ingredients_name like "%'.$search.'%"')->order('id')->page($nowPage.','.$Page->listRows)->select();
		
		$Page -> setConfig("first","首页");
		$Page -> setConfig("last", "尾页");
		$Page -> setConfig("theme","%first%%upPage%%linkPage%%downPage%%end% 共%totalPage%页");
		
		$show        = $Page->show(); // 分页显示输出
		$show        = str_replace("CookBook","caipu",$show);
		$this->assign('page',$show); // 赋值分页输出
		$this->assign('resultInfo',$resultInfo);
		
		
		$this->assign('search',$search); 
		$this->assign('count',$count); 
		
		if($count > 0){
			$display = "show";
		}else {
			$this->guess($taste);
			$display = "shownone";
		}
		
		$this->display($display);
	}
	/**
	 * 菜谱的详细页面
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-15 上午11:41:17
	 */
	public function dish(){
		$id          = $_GET['id'];
		$cookbook    = M('cookbook_content');
		$resultInfo  = $cookbook->where('id = '.$id)->select();
		
		//标签
		$cookbook_tags = explode("\n",$resultInfo[0]['cookbook_tags']);
		foreach ($cookbook_tags as $value){
			$tags[] = trim($value);
		}
		
		//所用材料
		$ingredients_name = explode("|",$resultInfo[0]['cookbook_ingredients_name']);
		$ingredients_amount = explode("|",$resultInfo[0]['cookbook_ingredients_amount']);
		$length = count($ingredients_name);
		for($i=0;$i<$length;$i++){
			$ingredients[$i]['name'] = $ingredients_name[$i];
			$ingredients[$i]['amount'] = $ingredients_amount[$i];
		}
		//做法步骤
		$step_pic = explode("|",$resultInfo[0]['cookbook_step_pic']);
		$step_content = explode("|",$resultInfo[0]['cookbook_step_content']);
		$length = count($step_pic);
		for($i=0;$i<$length;$i++){
			$step[$i]['pic'] = $step_pic[$i];
			$step[$i]['content'] = $step_content[$i];
		}
		
		//其他做法
		$this->guess();
		//猜你喜欢
		$this->other($resultInfo[0]['cookbook_name']);
		
		$this->assign('tags',$tags);
		$this->assign('step_length',$length);
		$this->assign('tagrand',$tags[0]);//可能喜欢
		$this->assign('ingredients',$ingredients);
		$this->assign('step',$step);
		$this->assign('resultInfo',$resultInfo);
		$this->display();
	}
	/**
	 * 猜你喜欢
	 * 查询 同菜系 同类型 或同样难度的菜谱
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-15 下午2:18:14
	 */
	public function guess(){
		$cookbook    = M('cookbook_content');
		$guess  = $cookbook->query("select *from fanwe_cookbook_content order by rand() limit 4 ");
		$this->assign('guess',$guess);
	}
	/**
	 * 其他做法
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-6-17 上午9:40:54
	 */
	public function other($name){
		$cookbook    = M('cookbook_content');
		$other  = $cookbook->query("select *from fanwe_cookbook_content where cookbook_name = '$name' limit 4 ");
		$this->assign('other',$other);
	}
}

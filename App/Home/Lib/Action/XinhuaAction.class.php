<?php
/**
 * 新华字典查询对应的控制器
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-8 上午10:31:40
 * @version 1.0
 */
class XinhuaAction extends Action{
	/**
	 * 所有action默认调用的方法
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-15 上午9:12:54
	 */
	function _initialize(){
		$this->assign("flag","jiaoyu");
		$this->assign("footerFlag",1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	/**
	 * 直接查找字，以及按部首，按拼音查找
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-8 上午11:43:54
	 */
	public function index(){
		header("Content-Type:text/html;charset=utf-8");
		$this->display();
	}
	/**
	 * 显示查询结果
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-8 上午11:44:32
	 */
	public function show(){
		$search     = $_POST['search'];
		$search     = str_replace(' ','',$search);
		$sid        = checkStr($search);
		if($sid == 5){	//在搜索框查询汉字
			$search = mb_substr($search,0,1,'utf-8');
			$xinhua = M('xinhua');
			$result = $xinhua->where('zi = "'.$search.'"')->select();
			$this->assign('result',$result);
			$this->display();
		}else if($sid == 7){ //在搜索框查询拼音
			$pinyin = strtolower($search); 
			$this->pinyin($pinyin);
		}
		if(empty($search)){
			$search = $_GET['search'];
			$xinhua = M('xinhua');
			$result = $xinhua->where('zi = "'.$search.'"')->select();
			$this->assign('result',$result);
			$this->display();
		}
	}
	/**
	 * 部首列表按笔画排序
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-8 下午4:27:21
	 */
	public function bslist(){
		$this->display();
	}
	/**
	 * 按部首查询
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-15 下午4:14:15
	 */
	public function bushou(){
		$id         = $_GET['id'];
		require ROOT_PATH . '/App/Home/Conf/buShou.php';
		$bushou     = $buShou[$id];
		$xinhua     = M('xinhua');
		$result     = $xinhua->where('bushou = "'.$bushou.'"')->select();
		$resultInfo = array();
		foreach($result as $key => $val){
			$resultInfo[$val['bihua']][] = $val;
		}
		$this->assign('id',$id);
		$this->assign('resultInfo',$resultInfo);
		$this->display();
	}
	/**
	 * 拼音列表按首字母排序
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-8 下午4:27:25
	 */
	public function pylist(){
		$this->display();
	}
	/**
	 * 按拼音查找
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-15 下午4:16:16
	 */
	public function pinyin($pinyin=""){
		if(empty($pinyin)){
			$id     = $_GET['id'];
			require ROOT_PATH . '/App/Home/Conf/pinYin.php';
			$pinyin = $pinYin[$id];
		}
		$xinhua     = M('xinhua');
		$result     = $xinhua->where('py = "'.$pinyin.'"')->order('bihua')->select();
		$resultInfo = array();
		foreach($result as $key => $val){
			$resultInfo[$val['bihua']][] = $val;
		}
		$this->assign('resultInfo',$resultInfo);
		$this->display('pinyin');
	}
	/**
	 * 按笔画查找
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-15 下午2:04:02
	 */
	public function bhlist(){
		$id         = $_GET['id'];
		$xinhua     = M('xinhua');
		$result     = $xinhua->where('bihua = "'.$id.'"')->order('pinyin')->select();
		$resultInfo = array();
		foreach($result as $key => $val){
			$zimu 					  = str_split($val['py']);
			$val['py']  			  = $zimu[0];
			$resultInfo[$val['py']][] = $val;
		}
		$this->assign('resultInfo',$resultInfo);
		$this->display();
	}
}
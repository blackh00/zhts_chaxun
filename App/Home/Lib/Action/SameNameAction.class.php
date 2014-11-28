<?php
/**
 * 同名同姓查询对应的控制器
 *
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-5-7 上午9:49:45
 * @version 1.0
 */
class SameNameAction extends Action{
	function _initialize(){
		$this->assign('flag','zonghe');
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
	/**
	 * 查询同名同姓排名
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-5-7 上午9:51:42
	 * @return array
	 */
	public function fullname(){
		// 获取回调函数名
		$callback 	= $_REQUEST['callback'];
		$fullname   = $_REQUEST['fullname'];
		$username   = iconv("utf-8//IGNORE","gb2312",$fullname);
		$url        = "http://www.360hy.com/ourname/tmtx3.asp?username=".$username;
		$result     = getByNetFun($url); // 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
		$result     = iconv("gb2312","utf-8//IGNORE",$result);
		$reg        = '/<tr align="center">[^\w]*?<td>(.*?)<\/td>.*?<td><font class="bigname">(.*?)<\/font><\/td>.*?<td>(.*?)<\/td>[^\w]*?<\/tr>/is';
		preg_match($reg,$result,$matchInfo); // 匹配获取自己需要格式的数据
		if(empty($matchInfo)){
			$info['falg']   =  0;
			$info['mc'] 	=  '-';
			$info['xm'] 	=  $fullname;
			$info['h4'] 	=  '恭喜你!';
			$info['h5'] 	=  '全国与您同名同姓的人数少于100人!';
			$info 			=  json_encode($info);
			echo $callback."($info)"; 
		}else{
			$info['flag']   =  1;
			$info['mc'] 	=  $matchInfo[1];
			$info['xm'] 	=  $matchInfo[2];
			$info['tmshu'] 	=  $matchInfo[3];
			$info 			=  json_encode($info);
			echo $callback."($info)";
		}
	}
	/**
	 * 查询姓氏排名
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-7-1 下午1:37:22
	 */
	public function surname(){
		// 获取回调函数名
		$callback 	= $_REQUEST['callback'];
		$surname  	= $_REQUEST['surname'];
		$username   = iconv("utf-8//IGNORE","gb2312",$surname);
		$url        = "http://www.360hy.com/ourname/xs.asp?username=".$username;
		$result     = getByNetFun($url); // 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
		$result     = iconv("gb2312","utf-8//IGNORE",$result);
		$reg        = '/<tr align="center">.*?<td height="30"><font style="font-size:20px"><strong>(.*?)<\/strong><\/font><\/td>.*?<td><font class="bigname">(.*?)<\/font><\/td>.*?<td><font style="font-size:20px"><strong>(.*?)<\/strong><\/font><\/td>.*?<\/tr>/is';
		preg_match($reg,$result,$matchInfo); // 匹配获取自己需要格式的数据
		if(empty($matchInfo)){
			$info['falg']   =  0;
			$info['mc'] 	=  '-';
			$info['xm'] 	=  $surname;
			$info['h4'] 	=  '恭喜你!';
			$info['h5'] 	=  '全国与您同姓的人数少于100人!';
			$info 			=  json_encode($info);
			echo $callback."($info)"; 
		}else{
			$info['flag']   =  1;
			$info['mc'] 	=  $matchInfo[1];
			$info['xm'] 	=  $matchInfo[2];
			$info['tmshu'] 	=  $matchInfo[3];
			$info 			=  json_encode($info);
			echo $callback."($info)";
		}
	}
	/**
	 * 查询名字排名
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-7-1 下午1:37:34
	 */
	public function name(){
		// 获取回调函数名
		$callback 	= $_REQUEST['callback'];
		$name   	= $_REQUEST['name'];
		$username   = iconv("utf-8//IGNORE","gb2312",$name);
		$url        = "http://www.360hy.com/ourname/tm2.asp?username=".$username;
		$result     = getByNetFun($url); // 调用自定义方法通过网络接口查询方法在系统目录下的functions.php文件内
		$result     = iconv("gb2312","utf-8//IGNORE",$result);
		$reg        = '/<tr align="center">.*?<td width="19%"><strong>名次<\/strong><\/td>.*?<td width="31%"><strong>名字<\/strong><\/td>.*?<td width="50%"><strong>重复人数（每千万人）<\/strong><\/td>.*?<\/tr>.*?<tr align="center">.*?<td>(.*?)<\/td>.*?<td><font class="bigname">(.*?)<\/font><\/td>.*?<td>(.*?)<\/td>.*?<\/tr>/is';
		preg_match($reg,$result,$matchInfo); // 匹配获取自己需要格式的数据
		if(empty($matchInfo)){
			$info['falg']   =  0;
			$info['mc'] 	=  '-';
			$info['xm'] 	=  $name;
			$info['h4'] 	=  '恭喜你!';
			$info['h5'] 	=  '全国与您同名的人数少于100人!';
			$info 			=  json_encode($info);
			echo $callback."($info)"; 
		}else{
			$info['flag']   =  1;
			$info['mc'] 	=  $matchInfo[1];
			$info['xm'] 	=  $matchInfo[2];
			$info['tmshu'] 	=  $matchInfo[3];
			$info 			=  json_encode($info);
			echo $callback."($info)";
		}
	}
}
	
<?php
/**
 * 彩票模块
 * 
 * @copyright (C)2012 ZHTS Inc.
 * @project project_name
 * @author Vonwey <vonwey@qq.com>
 * @CreateDate: 2013-9-16 上午11:31:04
 * @version 1.0
 *
 * @ModificationHistory  
 * Who          When                What 
 * --------     ----------          ------------------------------------------------ 
 * Vonwey   2013-9-16 上午11:31:04      todo
 */
class Lottery2Action extends Action{
	/**
	 * 构造函数
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-5-30 下午3:13:13
	 */
	function _initialize(){
		header("Content-Type:text/html;charset=utf-8");
		$this->assign("flag","shenghuo");
		$this->assign("headerFlag",1);
		$this->assign("footerFlag",1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	/**
	 * 福彩开奖结果
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-5-30 下午3:14:30
	 */
	public function index(){
		/**
		 *  双色球
		 */
		$content = @file_get_contents("http://kaijiang.500.com/ssq.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['shangsheqiu']['qihao'] = strip_tags($qihao[0][0]);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
		$redballs[]=strip_tags($redball[0][0]);
		$redballs[]=strip_tags($redball[0][1]);
		$redballs[]=strip_tags($redball[0][2]);
		$redballs[]=strip_tags($redball[0][3]);
		$redballs[]=strip_tags($redball[0][4]);
		$redballs[]=strip_tags($redball[0][5]);
		$data['shangsheqiu']['redballs'] = $redballs;
		$redball = $redballs = NULL;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		$blueball=strip_tags($blueball[0][0]);
		$data['shangsheqiu']['blueball'] = $blueball;
		$blueball=NULL;
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', '', $jiangchiguncun);
		$jiangchiguncun=str_replace('&nbsp;', '', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['shangsheqiu']['jiangchiguncun'] = trim($jiangchiguncun);
		
		/**
		 * 福彩3D
		 */
		$content = @file_get_contents("http://kaijiang.500.com/sd.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['fucai3d']['qihao'] = strip_tags($qihao[0][0]);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$data['fucai3d']['balls'] = $balls;
		$ball = $balls = NULL;
		
		/**
		 * 七乐彩
		 */
		$content = @file_get_contents("http://kaijiang.500.com/qlc.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['qilecai']['qihao'] = strip_tags($qihao[0][0]);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redballs);
		$redball[]=strip_tags($redballs[0][0]);
		$redball[]=strip_tags($redballs[0][1]);
		$redball[]=strip_tags($redballs[0][2]);
		$redball[]=strip_tags($redballs[0][3]);
		$redball[]=strip_tags($redballs[0][4]);
		$redball[]=strip_tags($redballs[0][5]);
		$redball[]=strip_tags($redballs[0][6]);
		$data['qilecai']['redballs']=$redball;
		$redball = $redballs = NULL;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		$data['qilecai']['blueball']=strip_tags($blueball[0][0]);
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', ' ', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['qilecai']['jiangchiguncun']=$jiangchiguncun;
		
		$this->assign("data",$data);
		$this->assign("selectValue","中国体彩");
		$this->display();
	}
	/**
	 * 体彩开奖结果
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-9-16 下午6:44:40
	 */
	public function ticai(){
		/**
		 *  排列三
		 */
		$content = @file_get_contents("http://kaijiang.500.com/pls.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['pailiesan']['qihao'] = strip_tags($qihao[0][0]);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$data['pailiesan']['balls']=$balls;
		$balls = $ball = NULL;
		
		/**
		 *  七星彩
		 */
		$content = @file_get_contents("http://kaijiang.500.com/qxc.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['qixingcai']['qihao']=strip_tags($qihao[0][0]);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$balls[]=strip_tags($ball[0][3]);
		$balls[]=strip_tags($ball[0][4]);
		$balls[]=strip_tags($ball[0][5]);
		$balls[]=strip_tags($ball[0][6]);
		$data['qixingcai']['balls']=$balls;
		$balls = $ball = NULL;
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', ' ', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['qixingcai']['jiangchiguncun']=trim($jiangchiguncun);
		
		/**
		 * 超级大乐透
		 */
		$content = @file_get_contents("http://kaijiang.500.com/dlt.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['daletou']['qihao'] = strip_tags($qihao[0][0]);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
		$redballs[]=strip_tags($redball[0][0]);
		$redballs[]=strip_tags($redball[0][1]);
		$redballs[]=strip_tags($redball[0][2]);
		$redballs[]=strip_tags($redball[0][3]);
		$redballs[]=strip_tags($redball[0][4]);
		$data['daletou']['redballs']=$redballs;
		$redballs=$redball=NUll;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		$blueballs[]=strip_tags($blueball[0][0]);
		$blueballs[]=strip_tags($blueball[0][1]);
		$data['daletou']['blueballs']=$blueballs;
		$blueballs=$blueball=NULL;
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', ' ', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['daletou']['jiangchiguncun']=$jiangchiguncun;
		
		/**
		 * 22选5
		 */
		$content = @file_get_contents("http://kaijiang.500.com/eexw.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['22xuan5']['qihao']=strip_tags($qihao[0][0]);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$balls[]=strip_tags($ball[0][3]);
		$balls[]=strip_tags($ball[0][4]);
		$data['22xuan5']['balls']=$balls;
		$balls=$ball=NULL;
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', ' ', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['22xuan5']['jiangchiguncun']=$jiangchiguncun;
	
		$this->assign("data",$data);
		$this->assign("selectValue","中国福利彩票");
		$this->display();
	}
	/**
	 * 双色球开奖结果
	 */
	public function shuangseqiu(){
		// 获取数据
		$content = @file_get_contents("http://kaijiang.500.com/ssq.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['shuangseqiu']['qihao']=strip_tags($qihao[0][0]);
		
		// 开奖公告
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$data['shuangseqiu']['notice']=strip_tags($notice[0][0]);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
		$redballs[]=strip_tags($redball[0][0]);
		$redballs[]=strip_tags($redball[0][1]);
		$redballs[]=strip_tags($redball[0][2]);
		$redballs[]=strip_tags($redball[0][3]);
		$redballs[]=strip_tags($redball[0][4]);
		$redballs[]=strip_tags($redball[0][5]);
		$data['shuangseqiu']['redballs']=$redballs;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		$data['shuangseqiu']['blueball']=strip_tags($blueball[0][0]);
		
		// 出球顺序
		preg_match('/出球顺序：<\/td>\s*<td>\s*.*/',$content,$order);
		$order=strip_tags($order[0]);
		$order=mb_substr($order,5,strlen($order),"utf8");
		$data['shuangseqiu']['order']=trim($order);
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', '', $jiangchiguncun);
		$jiangchiguncun=str_replace('&nbsp;', '', $jiangchiguncun);
		$data['shuangseqiu']['jiangchiguncun']=trim($jiangchiguncun);
		
		// 开奖详情
		$prizeNum=array("一","二","三","四","五");
		foreach($prizeNum as $value){
			preg_match("/" . $value . "等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
			}
			unset($value[3]);
			$prize[]=$value;
		}
		$data['shuangseqiu']['prize']=$prize;
		
		$this->assign("data",$data['shuangseqiu']);
		$this->assign("isticai","0");	// 福彩
		$this->assign("selectValue","中国福利彩票");
		$this->display();
	}
	/**
	 * 福彩3D开奖结果
	 */
	public function fucai3d(){
		// 获取数据
		$content = @file_get_contents("http://kaijiang.500.com/sd.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['fucai3d']['qihao']=strip_tags($qihao[0][0]);
		
		// 开奖公告
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$data['fucai3d']['notice']=strip_tags($notice[0][0]);
		
		// 开奖号码
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$data['fucai3d']['balls']=$balls;
		
		// 号码类型
		preg_match('/<font class=\"cfont1\">.*<\/font>/i', $content, $type);
		$data['fucai3d']['type']=strip_tags($type[0]);
		
		// 开奖详情
		$prizeNum=array("单选","组六");
		foreach($prizeNum as $value){
			preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
			}
			unset($value[3]);
			$prize[]=$value;
		}
		$data['fucai3d']['prize']=$prize;
		
		$this->assign("data",$data['fucai3d']);
		$this->assign("isticai","0");	// 福彩
		$this->assign("selectValue","中国福利彩票");
		$this->display();
	}
	/**
	 * 七乐彩
	 */
	public function qilecai(){
		// 获取数据
		$content = @file_get_contents("http://kaijiang.500.com/qlc.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['qilecai']['qihao']=strip_tags($qihao[0][0]);
		
		// 开奖公告
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=strip_tags($notice[0][0]);
		$data['qilecai']['notice']=$notice;
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
		$redballs[]=strip_tags($redball[0][0]);
		$redballs[]=strip_tags($redball[0][1]);
		$redballs[]=strip_tags($redball[0][2]);
		$redballs[]=strip_tags($redball[0][3]);
		$redballs[]=strip_tags($redball[0][4]);
		$redballs[]=strip_tags($redball[0][5]);
		$redballs[]=strip_tags($redball[0][6]);
		$data['qilecai']['redball']=$redballs;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		$data['qilecai']['blueball']=strip_tags($blueball[0][0]);
		
		// 出球顺序
		preg_match('/出球顺序：<\/td>\s*<td>\s*.*/',$content,$order);
		$order=strip_tags($order[0]);
		$order=mb_substr($order,5,strlen($order),"utf8");
		$data['qilecai']['order']=$order;
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun[0]),"utf8");
		$jiangchiguncun=str_replace('元', ' ', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['qilecai']['jiangchiguncun']=$jiangchiguncun;
		
		// 开奖详情
		$prizeNum=array("一等奖","二等奖","三等奖","四等奖","五等奖");
		foreach($prizeNum as $value){
			preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
			}
			unset($value[3]);
			$prize[]=$value;
		}
		$data['qilecai']['prize']=$prize;
		
		$this->assign("data",$data['qilecai']);
		$this->assign("isticai","0");	// 福彩
		$this->assign("selectValue","中国福利彩票");
		$this->display();
	}
	/**
	 * 22选5
	 */
	public function eexuan5(){
		// 获取数据
		$content = @file_get_contents("http://kaijiang.500.com/eexw.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$qihao = strip_tags($qihao[0][0]);
		$data['22xuan5']['qihao']=$qihao;
			
		// 开奖公告
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=strip_tags($notice[0][0]);
		$data['22xuan5']['notice']=$notice;
		
		// 开奖号码
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$balls[]=strip_tags($ball[0][3]);
		$balls[]=strip_tags($ball[0][4]);
		$data['22xuan5']['balls']=$balls;
		
		// 出球顺序
		preg_match('/出球顺序：<\/td>\s*<td>\s*.*/',$content,$order);
		$order=strip_tags($order[0]);
		$order=mb_substr($order,5,strlen($order),"utf8");
		$data['22xuan5']['order']=$order;
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', ' ', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['22xuan5']['jiangchiguncun']=$jiangchiguncun;
		
		// 开奖详情
		$prizeNum=array("一","二","三");
		foreach($prizeNum as $value){
			preg_match("/" . $value . "等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
			}
			unset($value[3]);
			$prize[]=$value;
		}
		$data['22xuan5']['prize']=$prize;
		
		$this->assign("data",$data['22xuan5']);
		$this->assign("isticai","1");	// 体彩
		$this->assign("selectValue","中国体彩");
		$this->display();
	}
	/**
	 * 排列三
	 */
	public function pailie3(){
		// 获取数据
		$content = @file_get_contents("http://kaijiang.500.com/pls.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$qihao = strip_tags($qihao[0][0]);
		$data['pailie3']['qihao']=$qihao;
		
		// 开奖公告
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=strip_tags($notice[0][0]);
		$data['pailie3']['notice']=$notice;
		
		// 开奖号码
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$data['pailie3']['balls']=$balls;
		
		// 开奖类型
		preg_match('/<font class=\"cfont1\">.*<\/font>/i', $content, $type);
		$data['pailie3']['type']=strip_tags($type[0]);
		
		// 开奖详情
		$prizeNum=array("排列三直选","排列三组六");
		foreach($prizeNum as $value){
			preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
			}
			unset($value[3]);
			$prize[]=$value;
		}
		$data['pailie3']['prize']=$prize;
		
		$this->assign("data",$data['pailie3']);
		$this->assign("isticai","1");	// 体彩
		$this->assign("selectValue","中国体彩");
		$this->display();
	}
	/**
	 * 七星彩
	 */
	public function qixingcai(){
		// 获取数据。
		$content = @file_get_contents("http://kaijiang.500.com/qxc.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['qixingcai']['qihao']=strip_tags($qihao[0][0]);
			
		// 开奖公告
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$data['qixingcai']['notice']=strip_tags($notice[0][0]);
		
		// 开奖号码
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$balls[]=strip_tags($ball[0][3]);
		$balls[]=strip_tags($ball[0][4]);
		$balls[]=strip_tags($ball[0][5]);
		$balls[]=strip_tags($ball[0][6]);
		$data['qixingcai']['balls']=$balls;
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', ' ', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['qixingcai']['jiangchiguncun']=$jiangchiguncun;
		
		// 开奖详情
		$prizeNum=array("一等奖","二等奖","三等奖","四等奖","五等奖");
		foreach($prizeNum as $value){
			preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
			}
			unset($value[3]);
			$prize[]=$value;
		}
		$data['qixingcai']['prize']=$prize;
		
		$this->assign("data",$data['qixingcai']);
		$this->assign("isticai","1");	// 体彩
		$this->assign("selectValue","中国体彩");
		$this->display();
	}
	/**
	 * 超级大乐透
	 */
	public function daletou(){
		// 获取数据
		$content = @file_get_contents("http://kaijiang.500.com/dlt.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['daletou']['qihao']=strip_tags($qihao[0][0]);
			
		// 开奖公告
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$data['daletou']['notice']=strip_tags($notice[0][0]);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
		$redballs[]=strip_tags($redball[0][0]);
		$redballs[]=strip_tags($redball[0][1]);
		$redballs[]=strip_tags($redball[0][2]);
		$redballs[]=strip_tags($redball[0][3]);
		$redballs[]=strip_tags($redball[0][4]);
		$data['daletou']['redballs']=$redballs;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		$blueballs[]=strip_tags($blueball[0][0]);
		$blueballs[]=strip_tags($blueball[0][1]);
		$data['daletou']['blueballs']=$blueballs;
		
		// 出球顺序
		preg_match('/出球顺序：<\/td>\s*<td>\s*.*/',$content,$order);
		$order=strip_tags($order[0]);
		$order=mb_substr($order,5,strlen($order),"utf8");
		$data['daletou']['order']=$order;
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1\">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', '', $jiangchiguncun);
		$jiangchiguncun=str_replace('&nbsp;', '', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['daletou']['jiangchiguncun']=$jiangchiguncun;
		
		
		// 开奖详情 - 追加
		preg_match_all("/追加<\/td>\s*<td>\s*(.*)<\/td>\s*<td>\s*(.*)\s*<\/td>/",$content,$prizeAdd);
		
		// 开奖详情 - 基本
		$prizeNum=array("一等奖","二等奖","三等奖","四等奖","五等奖","六等奖","七等奖");
		foreach($prizeNum as $key=>$value){
			preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*(.*)\s*<\/td>\s*<td>\s*(.*)\s*<\/td>/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
			}
			
			$value[4]="追加";
			$value[5]=$prizeAdd[1][$key];
			$value[6]=$prizeAdd[2][$key];
			$prize[]=$value;
		}
		$data['daletou']['prize']=$prize;
		
		// 八等奖
		preg_match("/八等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*(.*)\s*<\/td>/",$content,$prize8);
		$prize8=str_replace('<td>', '', $prize8);
		$prize8=explode('</td>', $prize8[0]);
		$data['daletou']['prize'][6][8]=$prize8;
		
		$this->assign("data",$data['daletou']);
		$this->assign("isticai","1");	// 体彩
		$this->assign("selectValue","中国体彩");
		$this->display();
	}
	/**
	 * 规则介绍
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-9-16 下午2:17:26
	 */
	public function rule(){
		$this->display();
	}
	/**
	 * 开奖结果
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-9-16 下午2:48:15
	 */
	public function result(){
		$this->display();
	}
	/**
	 * 开奖查询
	 *
	 * @author Vonwey <vonwey@qq.com>
	 * @CreateDate: 2013-5-30 下午4:58:43
	 */
	public function search(){
		$this->display();
	}
	/**
	 * 奖项搜索
	 */
	public function sousuo(){
		if(empty($_POST['myselect']))return false;
		switch ($_POST['myselect']){
			case "中国福利彩票":
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/');
				break;
			case "中国体彩":
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/ticai');
				break;
			case "双色球":
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/shuangseqiu');
				break;
			case "福彩3D":
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/fucai3d');
				break;
			case "七乐彩":
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/qilecai');
				break;
			case "22选5":
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/eexuan5');
				break;
			case "排列三":
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/pailie3');
				break;
			case "七星彩":
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/qixingcai');
				break;
			case "超级大乐透":
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/daletou');
				break;
			default:
				redirect(C('SITE_DYNAMIC_URL') . '/lottery/');
				break;
		}
	}
}
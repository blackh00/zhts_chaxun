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
class LotteryAction extends Action{
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
		$data['shuangseqiu']['qihao'] = strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['shuangseqiu']['notice']=strip_tags($notice);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
		$redballs[]=strip_tags($redball[0][0]);
		$redballs[]=strip_tags($redball[0][1]);
		$redballs[]=strip_tags($redball[0][2]);
		$redballs[]=strip_tags($redball[0][3]);
		$redballs[]=strip_tags($redball[0][4]);
		$redballs[]=strip_tags($redball[0][5]);
		$data['shuangseqiu']['redballs'] = $redballs;
		$redball = $redballs = NULL;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		$blueball=strip_tags($blueball[0][0]);
		$data['shuangseqiu']['blueball'] = $blueball;
		$blueball=NULL;
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', '', $jiangchiguncun);
		$jiangchiguncun=str_replace('&nbsp;', '', $jiangchiguncun);
		$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
		$data['shuangseqiu']['jiangchiguncun'] = trim($jiangchiguncun);
		
		/**
		 * 福彩3D
		 */
		$content = @file_get_contents("http://kaijiang.500.com/sd.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['fucai3d']['qihao'] = strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['fucai3d']['notice']=strip_tags($notice);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$data['fucai3d']['balls'] = $balls;
		$ball = $balls = NULL;
		
		// 奖池滚存
		$data['fucai3d']['jiangchiguncun'] = 0;
		
		/**
		 * 七乐彩
		 */
		$content = @file_get_contents("http://kaijiang.500.com/qlc.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['qilecai']['qihao'] = strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['qilecai']['notice']=strip_tags($notice);
		
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
		
		/**
		 *  排列三
		 */
		$content = @file_get_contents("http://kaijiang.500.com/pls.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['pailie3']['qihao'] = strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['pailie3']['notice']=strip_tags($notice);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$data['pailie3']['balls']=$balls;
		$balls = $ball = NULL;
		
		/**
		 *  七星彩
		 */
		$content = @file_get_contents("http://kaijiang.500.com/qxc.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['qixingcai']['qihao']=strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['qixingcai']['notice']=strip_tags($notice);
		
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
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['daletou']['notice']=strip_tags($notice);
		
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
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['22xuan5']['notice']=strip_tags($notice);
		
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
		$this->assign("selectValue","中国体彩");
		$this->display();
	}
	
	/**
	  * 用于返回数据给手机的接口
	  */
	 public function searchApi(){
		// 定义返回的数据
		$returnData = array(); 
		
		$returnData['data'] = array();
		
		/**
		 *  双色球
		 */
		$content = @file_get_contents("http://kaijiang.500.com/ssq.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		$returnData['data'][0]['name'] = "双色球";
		$returnData['data'][0]['id'] = 'shuangseqiuApi';
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);		
		$returnData['data'][0]['current_number'] = strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$returnData['data'][0]['date']=strip_tags($notice);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
		$redballs[]=strip_tags($redball[0][0]);
		$redballs[]=strip_tags($redball[0][1]);
		$redballs[]=strip_tags($redball[0][2]);
		$redballs[]=strip_tags($redball[0][3]);
		$redballs[]=strip_tags($redball[0][4]);
		$redballs[]=strip_tags($redball[0][5]);
		$returnData['data'][0]['open_number'] = $redballs;
		$redball = $redballs = NULL;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		$blueball=strip_tags($blueball[0][0]);
		if(!is_array($blueball)){
			$returnData['data'][0]['special_number'] = array($blueball);
		}else{
			$returnData['data'][0]['special_number'] = $blueball;
		}
		
		$blueball=NULL;
		
		/**
		 * 福彩3D
		 */
		$content = @file_get_contents("http://kaijiang.500.com/sd.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		$returnData['data'][1]['name'] = "福彩3D";
		$returnData['data'][1]['id'] = 'fucai3dApi';
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$returnData['data'][1]['current_number'] = strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$returnData['data'][1]['date']=strip_tags($notice);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$returnData['data'][1]['open_number'] = $balls;
		$ball = $balls = NULL;
		$returnData['data'][1]['special_number'] = array();
		
		/**
		 * 七乐彩
		 */
		$content = @file_get_contents("http://kaijiang.500.com/qlc.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		$returnData['data'][2]['name'] = "七乐彩";
		$returnData['data'][2]['id'] = 'qilecaiApi';
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$returnData['data'][2]['current_number'] = strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$returnData['data'][2]['date']=strip_tags($notice);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redballs);
		$redball[]=strip_tags($redballs[0][0]);
		$redball[]=strip_tags($redballs[0][1]);
		$redball[]=strip_tags($redballs[0][2]);
		$redball[]=strip_tags($redballs[0][3]);
		$redball[]=strip_tags($redballs[0][4]);
		$redball[]=strip_tags($redballs[0][5]);
		$redball[]=strip_tags($redballs[0][6]);
		$returnData['data'][2]['open_number']=$redball;
		$redball = $redballs = NULL;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		if(!is_array(strip_tags($blueball[0][0]))){
			$returnData['data'][2]['special_number']=array(strip_tags($blueball[0][0]));
		}else{
			$returnData['data'][2]['special_number'] = strip_tags($blueball[0][0]);
		}
		
		/**
		 *  排列三
		 */
		$content = @file_get_contents("http://kaijiang.500.com/pls.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		$returnData['data'][3]['name'] = "排列三";
		$returnData['data'][3]['id'] = 'pailie3Api';
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$returnData['data'][3]['current_number'] = strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$returnData['data'][3]['date']=strip_tags($notice);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$returnData['data'][3]['open_number']=$balls;
		$balls = $ball = NULL;
		
		$returnData['data'][3]['special_number'] = array();
		
		/**
		 *  七星彩
		 */
		$content = @file_get_contents("http://kaijiang.500.com/qxc.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		$returnData['data'][4]['name'] = "七星彩";
		$returnData['data'][4]['id'] = 'qixingcaiApi';
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$returnData['data'][4]['current_number']=strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$returnData['data'][4]['date']=strip_tags($notice);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$balls[]=strip_tags($ball[0][3]);
		$balls[]=strip_tags($ball[0][4]);
		$balls[]=strip_tags($ball[0][5]);
		$balls[]=strip_tags($ball[0][6]);
		$returnData['data'][4]['open_number']=$balls;
		$balls = $ball = NULL;
		$returnData['data'][4]['special_number'] = array();
		
		/**
		 * 超级大乐透
		 */
		$content = @file_get_contents("http://kaijiang.500.com/dlt.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		$returnData['data'][5]['name'] = "大乐透";
		$returnData['data'][5]['id'] = 'daletouApi';
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$returnData['data'][5]['current_number']=strip_tags($qihao[0][0]);
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$returnData['data'][5]['date']=strip_tags($notice);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
		$redballs[]=strip_tags($redball[0][0]);
		$redballs[]=strip_tags($redball[0][1]);
		$redballs[]=strip_tags($redball[0][2]);
		$redballs[]=strip_tags($redball[0][3]);
		$redballs[]=strip_tags($redball[0][4]);
		$returnData['data'][5]['open_number']=$redballs;
		$redballs=$redball=NUll;
		
		// 蓝球
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
		$blueballs[]=strip_tags($blueball[0][0]);
		$blueballs[]=strip_tags($blueball[0][1]);
		
		
		$returnData['data'][5]['special_number']=$blueballs;
		
		
		$blueballs=$blueball=NULL;
		
		
		
		/**
		 * 22选5
		 */
		$content = @file_get_contents("http://kaijiang.500.com/eexw.shtml");
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		$returnData['data'][6]['name'] = "22选5";
		$returnData['data'][6]['id'] = 'eexuan5Api';
		// 期号
	preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$returnData['data'][6]['current_number']=strip_tags($qihao[0][0]);
		
		// 开奖日期
	preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$returnData['data'][6]['date']=strip_tags($notice);
		
		// 开奖结果
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$balls[]=strip_tags($ball[0][3]);
		$balls[]=strip_tags($ball[0][4]);
		$returnData['data'][6]['open_number']=$balls;
		$redballs=$redball=NUll;
		
	
		$returnData['data'][6]['special_number']=array();
	
		
		
		if($returnData['data'][0] && $returnData['data'][1] && $returnData['data'][2] && $returnData['data'][3] && $returnData['data'][4] && $returnData['data'][5] && $returnData['data'][6]){
			$returnData['state'] = 0;
			$returnData['error_info'] = "OK";
		
		} else {
			$returnData['state'] = -1;
			$returnData['error_info'] = "服务器接口数据有误！";
		}
		
		$returnData['size'] = count($returnData['data']);
		echo json_encode($returnData);
	 
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
		// 获取期数
		if($_GET['qishu']){
			$url = "http://kaijiang.500.com/shtml/ssq/".$_GET['qishu'].".shtml";
		}else{
			$url="http://kaijiang.500.com/ssq.shtml";
		}
		
		// 获取数据
		$content = @file_get_contents($url);
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['shuangseqiu']['qihao']=strip_tags($qihao[0][0]);
		
		// 历史期号
		$contentx = @file_get_contents("http://kaijiang.500.com/ssq.shtml");
		$contentx = iconv('GB2312', 'UTF-8//IGNORE', $contentx);
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contentx, $qihaox);
		$qihaox=strip_tags($qihaox[0][0]);
		for($i=0;$i<5000;$i++){
			$history[]=sprintf("%05d",$qihaox - $i);
		}
		$data['shuangseqiu']['history']=$history;
		
		// 获取期号
		if($_GET['qishu']){
			$data['shuangseqiu']['qihao']=$_GET['qishu'];
			$data['shuangseqiu']['qihaoAdd']=intval($_GET['qishu']) + 1;
			$data['shuangseqiu']['qihaoCut']=intval($_GET['qishu']) - 1;
		}else{
			$data['shuangseqiu']['qihaoAdd']=intval($data['shuangseqiu']['qihao']) + 1;
			$data['shuangseqiu']['qihaoCut']=intval($data['shuangseqiu']['qihao']) - 1;
		}
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['shuangseqiu']['notice']=strip_tags($notice);
		
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
		
		// 本期销量
		preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>/',$content,$xiaoliang);
		$xiaoliang=strip_tags($xiaoliang[0]);
		$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
		$xiaoliang=str_replace('元', '', $xiaoliang);
		$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
		$data['shuangseqiu']['xiaoliang']=trim($xiaoliang);
		
		// 奖池滚存
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
		$jiangchiguncun=strip_tags($jiangchiguncun[0]);
		$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
		$jiangchiguncun=str_replace('元', '', $jiangchiguncun);
		$jiangchiguncun=str_replace('&nbsp;', '', $jiangchiguncun);
		$data['shuangseqiu']['jiangchiguncun']=trim($jiangchiguncun);
		
		// 开奖详情
		$prizeNum=array("一","二","三","四","五","六");
		$prizecon=array("中6+1","中6+0","中5+1","中5+0/4+1","中4+0/3+1","中2+1/1+1/0+1");
		foreach($prizeNum as $key=>$value){
			preg_match("/" . $value . "等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
				$value[$k+1]=$prizecon[$key];
			}
			unset($value[3]);
			$prize[]=$value;
		}
		$data['shuangseqiu']['prize']=$prize;
		
		$data['shuangseqiu']['name']="双色球";
		
		$this->assign("data",$data['shuangseqiu']);
		$this->display();
	}
	
	/**
	 * 双色球开奖结果 手机api
	 */
	public function shuangseqiuApi(){
		
		// 获取客户端传递过来的期数
		if($_GET['current_number']){
			$_GET['qishu'] = $_GET['current_number'];		
		}else{
			exit;
		}
		
		if($_GET['num']){
			$num = $_GET['num'];
		}else{
			$num = 5;
		}
		
		// 定义变量保存返回的数据
		$returnData = array();
		$returnData['data'] = array();
		// 获取连续num的数据保存到数组中
		for($i=0;$i<$num;$i++){
			$redballs = array();
			$url = "http://kaijiang.500.com/shtml/ssq/".($_GET['qishu']-$i).".shtml";	
			// 获取数据
			$content = @file_get_contents($url);
			$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
			// 期号
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
			$returnData['data'][$i]['current_number']=strip_tags($qihao[0][0]);
			
			// 开奖日期
			preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
			$notice=$notice[0][0];
			$notice=mb_substr($notice,30,10,"utf8");
			$notice=str_replace("年", "-", $notice);
			$notice=str_replace("月", "-", $notice);
			$notice=str_replace("日", "", $notice);
			$returnData['data'][$i]['date']=strip_tags($notice);
			
			// 本期销量
			preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>/',$content,$xiaoliang);
			$xiaoliang=strip_tags($xiaoliang[0]);
			$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
			$xiaoliang=str_replace('元', '', $xiaoliang);
			$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
			$returnData['data'][$i]['sale']=trim($xiaoliang);
			
			// 奖池滚存
			preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
			$jiangchiguncun=strip_tags($jiangchiguncun[0]);
			$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
			$jiangchiguncun=str_replace('元', '', $jiangchiguncun);
			$jiangchiguncun=str_replace('&nbsp;', '', $jiangchiguncun);
			$returnData['data'][$i]['money_pool']=trim($jiangchiguncun);
			
			// 红球
			preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
			$redballs[]=strip_tags($redball[0][0]);
			$redballs[]=strip_tags($redball[0][1]);
			$redballs[]=strip_tags($redball[0][2]);
			$redballs[]=strip_tags($redball[0][3]);
			$redballs[]=strip_tags($redball[0][4]);
			$redballs[]=strip_tags($redball[0][5]);
			$returnData['data'][$i]['open_number']=$redballs;
		
			// 蓝球
			preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
			$returnData['data'][$i]['special_number']=array(strip_tags($blueball[0][0]));
			
			// 开奖详情
			$returnData['data'][$i]['details'] = array();
			$prizeNum=array("一","二","三","四","五","六");
			$prizecon=array("中6+1","中6+0","中5+1","中5+0/4+1","中4+0/3+1","中2+1/1+1/0+1");
			foreach($prizeNum as $key=>$value){
				preg_match("/" . $value . "等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
				$value=str_replace('<td>', '', $value);
				$value=explode('</td>', $value[0]);
				foreach ($value as $k=>$v){
					$value[$k]=trim($v);
					$value[$k+1]=$prizecon[$key];
				}
				unset($value[3]);
				$value['prise'] = $value[0];
				$value['conditions'] = $value[4];
				$value['win_count'] = $value[1];
				$value['money'] = $value[2];
				unset($value[0]);unset($value[1]);unset($value[2]);unset($value[4]);
				$prize[]=$value;
			}
			$returnData['data'][$i]['details']=$prize;
						
			
			
		}
		if(!$returnData['data']){
			$returnData['error']=-1; // 代表数据库返回数据有误
			$returnData['error_info'] = "服务器数据有误";
			$returnData['data'] = array();
		}else{
			$returnData['error']=0; // 代表数据返回正常
			$returnData['error_info'] = "OK";
		}
		if($_GET['flag']){
			dump($returnData);
		}else{
			echo json_encode($returnData);
		}
		
	}
	/**
	 * 福彩3D开奖结果
	 */
	public function fucai3d(){
		
		// 获取期数
		if($_GET['qishu']){
			$url = "http://kaijiang.500.com/shtml/sd/".$_GET['qishu'].".shtml";
		}else{
			$url="http://kaijiang.500.com/sd.shtml";
		}
		
		// 获取数据
		$content = @file_get_contents($url);
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['fucai3d']['qihao']=strip_tags($qihao[0][0]);
		
		// 历史期号
		$contentx = @file_get_contents("http://kaijiang.500.com/sd.shtml");
		$contentx = iconv('GB2312', 'UTF-8//IGNORE', $contentx);
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contentx, $qihaox);
		$qihaox=strip_tags($qihaox[0][0]);
		$qihao = mb_substr($qihaox,4,3,"utf8");
		for($i=0;$i<intval($qihao);$i++){
			$history[]="2013" . sprintf("%03d",intval($qihao) - $i);
		}
		$data['fucai3d']['history']=$history;
		
		
		// 获取期号
		if($_GET['qishu']){
			$data['fucai3d']['qihao']=$_GET['qishu'];
			$data['fucai3d']['qihaoAdd']=intval($_GET['qishu']) + 1;
			$data['fucai3d']['qihaoCut']=intval($_GET['qishu']) - 1;
		}else{
			$data['fucai3d']['qihaoAdd']=intval($data['fucai3d']['qihao']) + 1;
			$data['fucai3d']['qihaoCut']=intval($data['fucai3d']['qihao']) - 1;
		}
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['fucai3d']['notice']=strip_tags($notice);
		
		// 开奖号码
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$data['fucai3d']['balls']=$balls;
		
		// 号码类型
		preg_match('/<font class=\"cfont1\">.*<\/font>/i', $content, $type);
		$data['fucai3d']['type']=strip_tags($type[0]);
		
		// 本期销量
		preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>/',$content,$xiaoliang);
		$xiaoliang=strip_tags($xiaoliang[0]);
		$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
		$xiaoliang=str_replace('元', '', $xiaoliang);
		$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
		$data['fucai3d']['xiaoliang']=trim($xiaoliang);
		
		// 奖池滚存
		$data['fucai3d']['jiangchiguncun']=0;
		
		// 中奖条件
		$prizeCon=array("定位中三码","不定位中三码");
		
		// 开奖详情
		$prizeNum=array("单选","组三");
		foreach($prizeNum as $key=>$value){
			preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			if($key==1){
				if($value[0]==""){
					preg_match("/组六<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
				}
			}
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
				$value[4]=$prizeCon[$key];
			}
			unset($value[3]);
			
			$prize[]=$value;
		}
		$data['fucai3d']['prize']=$prize;
		
		$data['fucai3d']['name']="福彩3D";
// 		dump($data);
		
		$this->assign("data",$data['fucai3d']);
		$this->display();
	}
	
	/**
	 * 福彩3D开奖结果 用于手机Api
	 */
	public function fucai3dApi(){
		
		// 获取客户端传递过来的期数
		if($_GET['current_number']){
			$_GET['qishu'] = $_GET['current_number'];		
		}else{
			exit;
		}
		
		if($_GET['num']){
			$num = $_GET['num'];		
		}else{
			$num = 5;		
		}
		
		// 定义变量 保存返回的数据
		$returnData = array();
		$returnData['data'] = array();
		
		// 获取连续num的数据保存到数组中
		for($i=0;$i<$num;$i++){
			$balls = array();
			$url =	"http://kaijiang.500.com/shtml/sd/".($_GET['qishu']-$i).".shtml";
						
			// 获取数据
			$content = @file_get_contents($url);
			$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
			
			// 期号
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
			$returnData['data'][$i]['current_number']=strip_tags($qihao[0][0]);
			
			// 开奖日期
			preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
			$notice=$notice[0][0];
			$notice=mb_substr($notice,30,10,"utf8");
			$notice=str_replace("年", "-", $notice);
			$notice=str_replace("月", "-", $notice);
			$notice=str_replace("日", "", $notice);
			$returnData['data'][$i]['date']=strip_tags($notice);
			
			// 本期销量
			preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>/',$content,$xiaoliang);
			$xiaoliang=strip_tags($xiaoliang[0]);
			$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
			$xiaoliang=str_replace('元', '', $xiaoliang);
			$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
			$returnData['data'][$i]['sale']=trim($xiaoliang);
			
			
			
			
			// 奖池滚存
			$returnData['data'][$i]['money_pool'] = 0;
			
			// 开奖号码
			preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
			$balls[]=strip_tags($ball[0][0]);
			$balls[]=strip_tags($ball[0][1]);
			$balls[]=strip_tags($ball[0][2]);
			$returnData['data'][$i]['open_number']=$balls;
			
			$returnData['data'][$i]['special_number'] = array();
			
			// 中奖条件
			$prizeCon=array("定位中三码","不定位中三码");
			
			// 开奖详情
			$prizeNum=array("单选","组三");
			foreach($prizeNum as $key=>$value){
				preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
				if($key==1){
					if($value[0]==""){
						preg_match("/组六<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
					}
				}
				$value=str_replace('<td>', '', $value);
				$value=explode('</td>', $value[0]);
				foreach ($value as $k=>$v){
					$value[$k]=trim($v);
					$value[4]=$prizeCon[$key];
					if(!$value[4]){
						$value[4] = "";					
					}
				}
				unset($value[3]);
				$value['prise'] = $value[0];
				$value['conditions'] = $value[4];
				$value['win_count'] = $value[1];
				$value['money'] = $value[2];
				unset($value[0]);unset($value[1]);unset($value[2]);unset($value[4]);
				$prize[]=$value;
			}
			$returnData['data'][$i]['details']=$prize;

		}
		if(!$returnData['data']){
			$returnData['error']=-1; // 代表数据库返回数据有误
			$returnData['error_info'] = "服务器数据有误";
			$returnData['data'] = array();
		}else{
			$returnData['error']=0; // 代表数据返回正常
			$returnData['error_info'] = "OK";
		}			
		if($_GET['flag']){
			dump($returnData);
		}else{
			echo json_encode($returnData);
		}				
	}
	/**
	 * 七乐彩
	 */
	public function qilecai(){
		
		// 获取期数
		if($_GET['qishu']){
			$url = "http://kaijiang.500.com/shtml/qlc/".$_GET['qishu'].".shtml";
		}else{
			$url="http://kaijiang.500.com/qlc.shtml";
		}
		
		// 获取数据
		$content = @file_get_contents($url);
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['qilecai']['qihao']=strip_tags($qihao[0][0]);
		
		// 历史期号
		$contentx = @file_get_contents("http://kaijiang.500.com/qlc.shtml");
		$contentx = iconv('GB2312', 'UTF-8//IGNORE', $contentx);
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contentx, $qihaox);
		$qihaox=strip_tags($qihaox[0][0]);
		for($i=0;$i<5000;$i++){
			$history[]=sprintf("%05d",$qihaox - $i);
		}
		$data['qilecai']['history']=$history;
		
		// 获取期号
		if($_GET['qishu']){
			$data['qilecai']['qihao']=$_GET['qishu'];
			$data['qilecai']['qihaoAdd']=intval($_GET['qishu']) + 1;
			$data['qilecai']['qihaoCut']=intval($_GET['qishu']) - 1;
		}else{
			$data['qilecai']['qihaoAdd']=intval($data['qilecai']['qihao']) + 1;
			$data['qilecai']['qihaoCut']=intval($data['qilecai']['qihao']) - 1;
		}
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['qilecai']['notice']=strip_tags($notice);
		
		// 本期销量
		preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>/',$content,$xiaoliang);
		$xiaoliang=strip_tags($xiaoliang[0]);
		$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
		$xiaoliang=str_replace('元', '', $xiaoliang);
		$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
		$data['qilecai']['xiaoliang']=trim($xiaoliang);
		
		// 红球
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
		$redballs[]=strip_tags($redball[0][0]);
		$redballs[]=strip_tags($redball[0][1]);
		$redballs[]=strip_tags($redball[0][2]);
		$redballs[]=strip_tags($redball[0][3]);
		$redballs[]=strip_tags($redball[0][4]);
		$redballs[]=strip_tags($redball[0][5]);
		$redballs[]=strip_tags($redball[0][6]);
		$data['qilecai']['redballs']=$redballs;
		
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
		
		// 中奖条件
		$prizeCon=array("中7+0","中6+1","中6+0","中5+1","中5+0","中4+1");
		
		// 开奖详情
		$prizeNum=array("一等奖","二等奖","三等奖","四等奖","五等奖","六等奖");
		foreach($prizeNum as $key=>$value){
			preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
				$value[3]=$prizeCon[$key];
			}
			$prize[]=$value;
		}
		$data['qilecai']['prize']=$prize;
		
		$data['qilecai']['name']="七乐彩";
		
		$this->assign("data",$data['qilecai']);
		$this->display();
	}
	
	/**
	 * 七乐彩
	 */
	public function qilecaiApi(){
		
		// 获取客户端提交过来的期数
		if($_GET['current_number']){
			$_GET['qishu'] = $_GET['current_number'];		
		}else{
			exit;
		}
		
		if($_GET['num']){
			$num = $_GET['num'];
		}else{
			$num = 5;
		}
		
		// 定义变量保存返回的数据
		$returnData = array();
		$returnData['data'] = array();
		
		// 获取连续num条数据保存到数组中
		for($i=0;$i<$num;$i++){
			$redballs = array();
			$url = "http://kaijiang.500.com/shtml/qlc/".($_GET['qishu']-$i).".shtml";
						
			// 获取数据
			$content = @file_get_contents($url);
			$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
			
			// 期号
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
			$returnData['data'][$i]['current_number']=strip_tags($qihao[0][0]);
			
			// 开奖日期
			preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
			$notice=$notice[0][0];
			$notice=mb_substr($notice,30,10,"utf8");
			$notice=str_replace("年", "-", $notice);
			$notice=str_replace("月", "-", $notice);
			$notice=str_replace("日", "", $notice);
			$returnData['data'][$i]['date']=strip_tags($notice);
			
			// 本期销量
			preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>/',$content,$xiaoliang);
			$xiaoliang=strip_tags($xiaoliang[0]);
			$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
			$xiaoliang=str_replace('元', '', $xiaoliang);
			$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
			$returnData['data'][$i]['sale']=trim($xiaoliang);
			
			// 奖池滚存
			preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
			$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun[0]),"utf8");
			$jiangchiguncun=str_replace('元', ' ', $jiangchiguncun);
			$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
			$returnData['data'][$i]['money_pool']=trim($jiangchiguncun);
			
			// 红球
			preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
			$redballs[]=strip_tags($redball[0][0]);
			$redballs[]=strip_tags($redball[0][1]);
			$redballs[]=strip_tags($redball[0][2]);
			$redballs[]=strip_tags($redball[0][3]);
			$redballs[]=strip_tags($redball[0][4]);
			$redballs[]=strip_tags($redball[0][5]);
			$redballs[]=strip_tags($redball[0][6]);
			$returnData['data'][$i]['open_number']=$redballs;
			
			// 蓝球
			preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
			$returnData['data'][$i]['special_number']=strip_tags($blueball[0][0]);
			
			// 中奖条件
			$prizeCon=array("中7+0","中6+1","中6+0","中5+1","中5+0","中4+1");
			
			// 开奖详情
			$prizeNum=array("一等奖","二等奖","三等奖","四等奖","五等奖","六等奖");
			foreach($prizeNum as $key=>$value){
				preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
				$value=str_replace('<td>', '', $value);
				$value=explode('</td>', $value[0]);
				foreach ($value as $k=>$v){
					$value[$k]=trim($v);
					$value[3]=$prizeCon[$key];
				}
				
				$value['prise'] = $value[0];
				$value['conditions'] = $value[4];
				$value['win_count'] = $value[1];
				$value['money'] = $value[2];
				unset($value[0]);unset($value[1]);unset($value[2]);unset($value[4]);
				$prize[]=$value;
				
			}
			$returnData['data'][$i]['details']=$prize;
			
			// $data['qilecai']['name']="七乐彩";
			
			
		}
		if(!$returnData['data']){
				$returnData['error']=-1; // 代表数据库返回数据有误
				$returnData['error_info'] = "服务器数据有误";
				$returnData['data'] = array();
			}else{
				$returnData['error']=0; // 代表数据返回正常
				$returnData['error_info'] = "OK";
			}
			if($_GET['flag']){
				dump($returnData);
			}else{
				echo json_encode($returnData);
		}			
	}
	
	/**
	 * 22选5
	 */
	public function eexuan5(){
		// 获取期数
		if($_GET['qishu']){
			$url = "http://kaijiang.500.com/shtml/eexw/".$_GET['qishu'].".shtml";
		}else{
			$url="http://kaijiang.500.com/eexw.shtml";
		}
		
		// 获取数据
		$content = @file_get_contents($url);
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$qihao = strip_tags($qihao[0][0]);
		$data['22xuan5']['qihao']=$qihao;
		
		// 历史期号
		$contentx = @file_get_contents("http://kaijiang.500.com/eexw.shtml");
		$contentx = iconv('GB2312', 'UTF-8//IGNORE', $contentx);
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contentx, $qihaox);
		$qihaox=strip_tags($qihaox[0][0]);
		for($i=0;$i<5000;$i++){
			$history[]=sprintf("%05d",$qihaox - $i);
		}
		$data['22xuan5']['history']=$history;
			
		// 获取期号
		if($_GET['qishu']){
			$data['22xuan5']['qihao']=$_GET['qishu'];
			$data['22xuan5']['qihaoAdd']=intval($_GET['qishu']) + 1;
			$data['22xuan5']['qihaoCut']=intval($_GET['qishu']) - 1;
		}else{
			$data['22xuan5']['qihaoAdd']=intval($data['22xuan5']['qihao']) + 1;
			$data['22xuan5']['qihaoCut']=intval($data['22xuan5']['qihao']) - 1;
		}
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['22xuan5']['notice']=strip_tags($notice);
		
		// 本期销量
		preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>&nbsp;/',$content,$xiaoliang);
		$xiaoliang=strip_tags($xiaoliang[0]);
		$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
		$xiaoliang=str_replace('元', '', $xiaoliang);
		$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
		$data['22xuan5']['xiaoliang']=trim($xiaoliang);
		
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
		
		// 中奖条件
		$prizeCon=array("中5","中4","中3");
		
		// 开奖详情
		$prizeNum=array("一","二","三");
		foreach($prizeNum as $key=>$value){
			preg_match("/" . $value . "等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
				$value[3]=$prizeCon[$key];
			}
			unset($value[3]);
			$prize[]=$value;
		}
		$data['22xuan5']['prize']=$prize;
		
		$data['22xuan5']['name']="22选5";
		
		$this->assign("data",$data['22xuan5']);
		$this->display();
	}
	/**
	 * 排列三
	 */
	public function pailie3(){
		
		// 获取期数
		if($_GET['qishu']){
			$url = "http://kaijiang.500.com/shtml/pls/".$_GET['qishu'].".shtml";
		}else{
			$url="http://kaijiang.500.com/pls.shtml";
		}
		
		// 获取数据
		$content = @file_get_contents($url);
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$qihao = strip_tags($qihao[0][0]);
		$data['pailie3']['qihao']=$qihao;
		
		// 历史期号
		$contentx = @file_get_contents("http://kaijiang.500.com/pls.shtml");
		$contentx = iconv('GB2312', 'UTF-8//IGNORE', $contentx);
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contentx, $qihaox);
		$qihaox=strip_tags($qihaox[0][0]);
		for($i=0;$i<5000;$i++){
			$history[]=sprintf("%05d",$qihaox - $i);
		}
		$data['pailie3']['history']=$history;
		
		// 获取期号
		if($_GET['qishu']){
			$data['pailie3']['qihao']=$_GET['qishu'];
			$data['pailie3']['qihaoAdd']=intval($_GET['qishu']) + 1;
			$data['pailie3']['qihaoCut']=intval($_GET['qishu']) - 1;
		}else{
			$data['pailie3']['qihaoAdd']=intval($data['pailie3']['qihao']) + 1;
			$data['pailie3']['qihaoCut']=intval($data['pailie3']['qihao']) - 1;
		}
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['pailie3']['notice']=strip_tags($notice);
		
		// 本期销量
		preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>/',$content,$xiaoliang);
		$xiaoliang=strip_tags($xiaoliang[0]);
		$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
		$xiaoliang=str_replace('元', '', $xiaoliang);
		$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
		$data['pailie3']['xiaoliang']=trim($xiaoliang);
		
		// 奖池滚存
		$data['pailie3']['jiangchiguncun']=0;
		
		// 开奖号码
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
		$balls[]=strip_tags($ball[0][0]);
		$balls[]=strip_tags($ball[0][1]);
		$balls[]=strip_tags($ball[0][2]);
		$data['pailie3']['balls']=$balls;
		
		// 开奖类型
		preg_match('/<font class=\"cfont1\">.*<\/font>/i', $content, $type);
		$data['pailie3']['type']=strip_tags($type[0]);
		
		// 中奖条件
		$prizeCon=array("定位中三码","不定位中三码");
		
		// 开奖详情
		$prizeNum=array("排列三直选","排列三组三");
		foreach($prizeNum as $key=>$value){
			preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			if($key==1){
				if($value[0]==""){
					preg_match("/排列三组六<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
				}
			}
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
				$value[3]=$prizeCon[$key];
			}
			$prize[]=$value;
		}
		$data['pailie3']['prize']=$prize;
		
		$data['pailie3']['name']="排列三";
		
		$this->assign("data",$data['pailie3']);
		$this->display();
	}
	
	/**
	 * 排列三
	 */
	public function pailie3Api(){
		
		// 获取客户端传递过来的期数
		if($_GET['current_number']){
			$_GET['qishu'] = $_GET['current_number'];		
		}else{
			exit;
		}
		
		if($_GET['num']){
			$num = $_GET['num'];
		}else{
			$num = 5;
		}
		
		// 定义变量保存返回的数据
		$returnData = array();
		$returnData['data'] = array();
		
		// 获取连续num的数据保存到数组中
		for($i=0;$i<$num;$i++){	
			$balls = array();
			$url = "http://kaijiang.500.com/shtml/pls/".($_GET['qishu']-$i).".shtml";
			// 获取数据
			$content = @file_get_contents($url);
			$content = iconv('GB2312', 'UTF-8//IGNORE', $content);			
			// 期号
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
			$qihao = strip_tags($qihao[0][0]);
			$returnData['data'][$i]['current_number']=$qihao;
			
			// 开奖日期
			preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
			$notice=$notice[0][0];
			$notice=mb_substr($notice,30,10,"utf8");
			$notice=str_replace("年", "-", $notice);
			$notice=str_replace("月", "-", $notice);
			$notice=str_replace("日", "", $notice);
			$returnData['data'][$i]['date']=strip_tags($notice);
			
			// 本期销量
			preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>/',$content,$xiaoliang);
			$xiaoliang=strip_tags($xiaoliang[0]);
			$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
			$xiaoliang=str_replace('元', '', $xiaoliang);
			$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
			$returnData['data'][$i]['sale']=trim($xiaoliang);
			
			// 奖池滚存
			$returnData['data'][$i]['money_pool']=0;
			
			// 开奖号码
			preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
			$balls[]=strip_tags($ball[0][0]);
			$balls[]=strip_tags($ball[0][1]);
			$balls[]=strip_tags($ball[0][2]);
			$returnData['data'][$i]['open_number']=$balls;
			
			$returnData['data'][$i]['special_number'] = array();

			// 中奖条件
			$prizeCon=array("定位中三码","不定位中三码");
			
			// 开奖详情
			$prizeNum=array("排列三直选","排列三组三");
			foreach($prizeNum as $key=>$value){
				preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
				if($key==1){
					if($value[0]==""){
						preg_match("/排列三组六<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
					}
				}
				$value=str_replace('<td>', '', $value);
				$value=explode('</td>', $value[0]);
				foreach ($value as $k=>$v){
					$value[$k]=trim($v);
					$value[3]=$prizeCon[$key];
				}
				unset($value[3]);
				$value['prise'] = $value[0];
				$value['conditions'] = $value[4];
				$value['win_count'] = $value[1];
				$value['money'] = $value[2];
				unset($value[0]);unset($value[1]);unset($value[2]);unset($value[4]);
				$prize[]=$value;
			}
			$returnData['data'][$i]['details']=$prize;
		}
		if(!$returnData['data']){
				$returnData['error']=-1; // 代表数据库返回数据有误
				$returnData['error_info'] = "服务器数据有误";
				$returnData['data'] = array();
		}else{
				$returnData['error']=0; // 代表数据返回正常
				$returnData['error_info'] = "OK";
		}
		if($_GET['flag']){
			dump($returnData);
		}else{
			echo json_encode($returnData);
		}
	}
	/**
	 * 七星彩
	 */
	public function qixingcai(){
		// 获取期数
		if($_GET['qishu']){
			$url = "http://kaijiang.500.com/shtml/qxc/".$_GET['qishu'].".shtml";
		}else{
			$url="http://kaijiang.500.com/qxc.shtml";
		}
		
		// 获取数据
		$content = @file_get_contents($url);
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['qixingcai']['qihao']=strip_tags($qihao[0][0]);
		
		// 历史期号
		$contentx = @file_get_contents("http://kaijiang.500.com/qxc.shtml");
		$contentx = iconv('GB2312', 'UTF-8//IGNORE', $contentx);
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contentx, $qihaox);
		$qihaox=strip_tags($qihaox[0][0]);
		for($i=0;$i<5000;$i++){
			$history[]=sprintf("%05d",$qihaox - $i);
		}
		$data['qixingcai']['history']=$history;
			
		// 获取期号
		if($_GET['qishu']){
			$data['qixingcai']['qihao']=$_GET['qishu'];
			$data['qixingcai']['qihaoAdd']=intval($_GET['qishu']) + 1;
			$data['qixingcai']['qihaoCut']=intval($_GET['qishu']) - 1;
		}else{
			$data['qixingcai']['qihaoAdd']=intval($data['qixingcai']['qihao']) + 1;
			$data['qixingcai']['qihaoCut']=intval($data['qixingcai']['qihao']) - 1;
		}
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['qixingcai']['notice']=strip_tags($notice);
		
		// 本期销量
		preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>&nbsp;/',$content,$xiaoliang);
		$xiaoliang=strip_tags($xiaoliang[0]);
		$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
		$xiaoliang=str_replace('元', '', $xiaoliang);
		$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
		$data['qixingcai']['xiaoliang']=trim($xiaoliang);
		
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
		
		// 中奖条件
		$prizeCon=array("定位中7码","定位中连续6码","定位中连续5码","定位中连续4码","定位中连续3码","定位中连续2码");
		
		// 开奖详情
		$prizeNum=array("一等奖","二等奖","三等奖","四等奖","五等奖","六等奖");
		foreach($prizeNum as $key=>$value){
			preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
			$value=str_replace('<td>', '', $value);
			$value=explode('</td>', $value[0]);
			foreach ($value as $k=>$v){
				$value[$k]=trim($v);
				$value[3]=$prizeCon[$key];
			}
			$prize[]=$value;
		}
		$data['qixingcai']['prize']=$prize;
		
		$data['qixingcai']['name']="七星彩";
		
		$this->assign("data",$data['qixingcai']);
		$this->display();
	}
	
	/**
	 * 七星彩
	 */
	public function qixingcaiApi(){
		
		// 获取客户端传递过来的期数
		if($_GET['current_number']){
			$_GET['qishu'] = $_GET['current_number'];
		}else{
			exit;
		}
		
		if($_GET['num']){
			$num = $_GET['num'];	
		}else{
			$num = 5;
		}
		
		// 定义变量保存返回的数据
		$returnData = array();
		$returnData['data'] = array();
		
		for($i=0;$i<$num;$i++){	
			$balls = array();
			$url = "http://kaijiang.500.com/shtml/qxc/".($_GET['qishu']-$i).".shtml";		
			// 获取数据
			$content = @file_get_contents($url);
			$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
			
			// 期号
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
			$returnData['data'][$i]['current_number']=strip_tags($qihao[0][0]);
			
			// 开奖日期
			preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
			$notice=$notice[0][0];
			$notice=mb_substr($notice,30,10,"utf8");
			$notice=str_replace("年", "-", $notice);
			$notice=str_replace("月", "-", $notice);
			$notice=str_replace("日", "", $notice);
			$returnData['data'][$i]['date']=strip_tags($notice);
			
			// 本期销量
			preg_match('/本期销量：<span\s*class=\"cfont1 \">.*<\/span>&nbsp;/',$content,$xiaoliang);
			$xiaoliang=strip_tags($xiaoliang[0]);
			$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
			$xiaoliang=str_replace('元', '', $xiaoliang);
			$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
			$returnData['data'][$i]['sale']=trim($xiaoliang);
			
			// 奖池滚存
			preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$content,$jiangchiguncun);
			$jiangchiguncun=strip_tags($jiangchiguncun[0]);
			$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
			$jiangchiguncun=str_replace('元', ' ', $jiangchiguncun);
			$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
			$returnData['data'][$i]['money_pool']=trim($jiangchiguncun);
			
			// 开奖号码
			preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $content, $ball);
			$balls[]=strip_tags($ball[0][0]);
			$balls[]=strip_tags($ball[0][1]);
			$balls[]=strip_tags($ball[0][2]);
			$balls[]=strip_tags($ball[0][3]);
			$balls[]=strip_tags($ball[0][4]);
			$balls[]=strip_tags($ball[0][5]);
			$balls[]=strip_tags($ball[0][6]);
			$returnData['data'][$i]['open_number']=$balls;
			$returnData['data'][$i]['special_number'] = array();
			
			
			
			
			
			
			
			// 中奖条件
			$prizeCon=array("定位中7码","定位中连续6码","定位中连续5码","定位中连续4码","定位中连续3码","定位中连续2码");
			
			// 开奖详情
			$prizeNum=array("一等奖","二等奖","三等奖","四等奖","五等奖","六等奖");
			foreach($prizeNum as $key=>$value){
				preg_match("/" . $value . "<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/",$content,$value);
				$value=str_replace('<td>', '', $value);
				$value=explode('</td>', $value[0]);
				foreach ($value as $k=>$v){
					$value[$k]=trim($v);
					$value[3]=$prizeCon[$key];
				}				
				$value['prise'] = $value[0];
				$value['conditions'] = $value[4];
				$value['win_count'] = $value[1];
				$value['money'] = $value[2];
				unset($value[0]);unset($value[1]);unset($value[2]);unset($value[4]);
				$prize[]=$value;				
			}
			$returnData['data'][$i]['details']=$prize;						
		}
		if(!$returnData['data']){
				$returnData['error']=-1; // 代表数据库返回数据有误
				$returnData['error_info'] = "服务器数据有误";
				$returnData['data'] = array();
			}else{
				$returnData['error']=0; // 代表数据返回正常
				$returnData['error_info'] = "OK";
			}
			if($_GET['flag']){
				dump($returnData);
			}else{
				echo json_encode($returnData);
		}
		
	}
	
	/**
	 * 超级大乐透
	 */
	public function daletou(){
		// 获取期数
		if($_GET['qishu']){
			$url = "http://kaijiang.500.com/shtml/dlt/".$_GET['qishu'].".shtml";
		}else{
			$url="http://kaijiang.500.com/dlt.shtml";
		}
		
		// 获取数据
		$content = @file_get_contents($url);
		$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
		
		// 期号
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
		$data['daletou']['qihao']=strip_tags($qihao[0][0]);
			
		// 获取期号
		if($_GET['qishu']){
			$data['daletou']['qihao']=$_GET['qishu'];
			$data['daletou']['qihaoAdd']=intval($_GET['qishu']) + 1;
			$data['daletou']['qihaoCut']=intval($_GET['qishu']) - 1;
		}else{
			$data['daletou']['qihaoAdd']=intval($data['daletou']['qihao']) + 1;
			$data['daletou']['qihaoCut']=intval($data['daletou']['qihao']) - 1;
		}
		
		// 历史期号
		$contentx = @file_get_contents("http://kaijiang.500.com/dlt.shtml");
		$contentx = iconv('GB2312', 'UTF-8//IGNORE', $contentx);
		preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contentx, $qihaox);
		$qihaox=strip_tags($qihaox[0][0]);
		for($i=0;$i<5000;$i++){
			$history[]=sprintf("%05d",$qihaox - $i);
		}
		$data['daletou']['history']=$history;
		
		// 开奖日期
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
		$notice=$notice[0][0];
		$notice=mb_substr($notice,30,10,"utf8");
		$notice=str_replace("年", "-", $notice);
		$notice=str_replace("月", "-", $notice);
		$notice=str_replace("日", "", $notice);
		$data['daletou']['notice']=strip_tags($notice);
		
		// 本期销量
		preg_match('/本期销量：<span\s*class=\"cfont1\">.*<\/span>&nbsp;&nbsp;&nbsp;/',$content,$xiaoliang);
		$xiaoliang=strip_tags($xiaoliang[0]);
		$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
		$xiaoliang=str_replace('元', '', $xiaoliang);
		$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
		$data['daletou']['xiaoliang']=trim($xiaoliang);
		
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
		
		// 中奖条件
		$prizeCon=array("中5+2","中5+1","中5+0","中4+2","中4+1","中4+0/中3+2");
		
		// 开奖详情 - 基本
		$prizeNum=array("一等奖","二等奖","三等奖","四等奖","五等奖","六等奖");
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
			$value[7]=$prizeCon[$key];
			$prize[]=$value;
		}
		$data['daletou']['prize']=$prize;
		
		// 八等奖
		preg_match("/八等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*(.*)\s*<\/td>/",$content,$prize8);
		$prize8=str_replace('<td>', '', $prize8);
		$prize8=explode('</td>', $prize8[0]);
		$data['daletou']['prize'][6][8]=$prize8;
		
		$data['daletou']['name']="超级大乐透";
		
		$this->assign("data",$data['daletou']);
		$this->display();
	}
	
	/**
	 * 超级大乐透 手机app接口
	 */
	public function daletouApi(){
	
		// 获取客户端传递过来的期数
		if($_GET['current_number']){
			$_GET['qishu'] = $_GET['current_number'];		
		}else{
			exit;
		}
		
		if($_GET['num']){
			$num = $_GET['num'];
		}else{
			$num = 5;
		}
		
		// 定义变量保存返回的数据
		$returnData = array();
		$returnData['data'] = array();
		// 获取连续num的数据保存到数组中
		for($i=0;$i<$num;$i++){
			$redballs = array();
			$blueballs = array();
			$url = "http://kaijiang.500.com/shtml/dlt/".($_GET['qishu']-$i).".shtml";
						
			// 获取数据
			$content = @file_get_contents($url);
			$content = iconv('GB2312', 'UTF-8//IGNORE', $content);
			
			// 期号
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $content, $qihao);
			$returnData['data'][$i]['current_number']=strip_tags($qihao[0][0]);
			
			// 开奖日期
			preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $content, $notice);
			$notice=$notice[0][0];
			$notice=mb_substr($notice,30,10,"utf8");
			$notice=str_replace("年", "-", $notice);
			$notice=str_replace("月", "-", $notice);
			$notice=str_replace("日", "", $notice);
			$returnData['data'][$i]['date']=strip_tags($notice);
			
			// 本期销量
			preg_match('/本期销量：<span\s*class=\"cfont1\">.*<\/span>&nbsp;&nbsp;&nbsp;/',$content,$xiaoliang);
			$xiaoliang=strip_tags($xiaoliang[0]);
			$xiaoliang=mb_substr($xiaoliang,5,strlen($xiaoliang),"utf8");
			$xiaoliang=str_replace('元', '', $xiaoliang);
			$xiaoliang=str_replace('&nbsp;', '', $xiaoliang);
			$returnData['data'][$i]['sale']=trim($xiaoliang);
			
			// 奖池滚存
			preg_match('/奖池滚存：<span\s*class=\"cfont1\">.*/',$content,$jiangchiguncun);
			$jiangchiguncun=strip_tags($jiangchiguncun[0]);
			$jiangchiguncun=mb_substr($jiangchiguncun,5,strlen($jiangchiguncun),"utf8");
			$jiangchiguncun=str_replace('元', '', $jiangchiguncun);
			$jiangchiguncun=str_replace('&nbsp;', '', $jiangchiguncun);
			$jiangchiguncun=$jiangchiguncun ? $jiangchiguncun : 0;
			$returnData['data'][$i]['money_pool']=trim($jiangchiguncun);
			
			// 红球
			preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $content, $redball);
			$redballs[]=strip_tags($redball[0][0]);
			$redballs[]=strip_tags($redball[0][1]);
			$redballs[]=strip_tags($redball[0][2]);
			$redballs[]=strip_tags($redball[0][3]);
			$redballs[]=strip_tags($redball[0][4]);
			$returnData['data'][$i]['open_number']=$redballs;
			
			// 蓝球
			preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $content, $blueball);
			$blueballs[]=strip_tags($blueball[0][0]);
			$blueballs[]=strip_tags($blueball[0][1]);
			$returnData['data'][$i]['special_number']=$blueballs;
			
			// 开奖详情 - 追加
			preg_match_all("/追加<\/td>\s*<td>\s*(.*)<\/td>\s*<td>\s*(.*)\s*<\/td>/",$content,$prizeAdd);
			
			// 中奖条件
			$prizeCon=array("中5+2","中5+1","中5+0","中4+2","中4+1","中4+0/中3+2");
			
			// 开奖详情 - 基本
			$prizeNum=array("一等奖","二等奖","三等奖","四等奖","五等奖","六等奖");
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
				$value[7]=$prizeCon[$key];
				$value['prise'] = $value[0];
				$value['conditions'] = $value[7];
				$value['win_count'] = $value[2];
				$value['money'] = $value[3];
				unset($value[0]);unset($value[1]);unset($value[2]);unset($value[3]);
				unset($value[4]);unset($value[5]);unset($value[6]);unset($value[7]);
				$prize[]=$value;
			}
			$returnData['data'][$i]['details']=$prize;						
		}
		if(!$returnData['data']){
				$returnData['error']=-1; // 代表数据库返回数据有误
				$returnData['error_info'] = "服务器数据有误";
				$returnData['data'] = array();
		}else{
				$returnData['error']=0; // 代表数据返回正常
				$returnData['error_info'] = "OK";
		}
		if($_GET['flag']){
			dump($returnData);
		}else{
			echo json_encode($returnData);
		}
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
	public function lottery(){
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
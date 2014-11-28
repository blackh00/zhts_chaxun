<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-20 下午4:31:30
 * @version 1.0
 */
class CaiPiaoAction extends Action{
	
	// 控制器初始化方法。
	function _initialize(){
	
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	// 彩票首页  ,福彩页面。
	public function index(){
		//echo preg_match("/乐透/", $_POST['caipiao']);
		if(isset($_POST['caipiao']) && preg_match("/双/", $_POST['caipiao'])){
			$this->redirect('SITE_DYNAMIC_URL/caipiao/shuangSeQiu/');
			return true;
		} else if(isset($_POST['caipiao']) && preg_match("/3D/", $_POST['caipiao'])){
			$this->redirect('SITE_DYNAMIC_URL/caipiao/sanDi/');
			return true;
		} else if(isset($_POST['caipiao']) && preg_match("/七乐/", $_POST['caipiao'])){
			$this->redirect('SITE_DYNAMIC_URL/caipiao/qiLeCai/');
			return true;
		} else if(isset($_POST['caipiao']) && preg_match("/22/", $_POST['caipiao'])){
			$this->redirect('SITE_DYNAMIC_URL/caipiao/erErXuanWu/');
			return true;
		} else if(isset($_POST['caipiao']) && preg_match("/三/", $_POST['caipiao'])){
			$this->redirect('SITE_DYNAMIC_URL/caipiao/paiLieSan/');
			return true;
		} else if(isset($_POST['caipiao']) && preg_match("/七星/", $_POST['caipiao'])){
			$this->redirect('SITE_DYNAMIC_URL/caipiao/qiXingCai/');
			return true;
		} else if(isset($_POST['caipiao']) && preg_match("/乐透/", $_POST['caipiao'])){
			$this->redirect('SITE_DYNAMIC_URL/caipiao/daLeTou/');
			return true;
		} else {
			//echo "321";
		}
		
		$color1=1;
		$cacheCaiPiao = Cache::getInstance('file');
		$data88=$cacheCaiPiao->get('data88');
		if(!isset($data88) || $data88 == false){
			// 双色球 期号  号码  滚存。。。
			$contents1 = @file_get_contents("http://kaijiang.500.com/ssq.shtml");
			$contents1 = iconv('GB2312', 'UTF-8//IGNORE', $contents1);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents1, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe01']=$shuangSe01;
			//print_r($data['shuangSe01']);exit;
			
			preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents1, $shuangSe3);
			$shuangSe03[]=strip_tags($shuangSe3[0][0]);
			$shuangSe03[]=strip_tags($shuangSe3[0][1]);
			$shuangSe03[]=strip_tags($shuangSe3[0][2]);
			$shuangSe03[]=strip_tags($shuangSe3[0][3]);
			$shuangSe03[]=strip_tags($shuangSe3[0][4]);
			$shuangSe03[]=strip_tags($shuangSe3[0][5]);
			$data['shuangSe02']=$shuangSe03;
			//print_r($shuangSe03);exit;
			preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents1, $shuangSe4);
			$shuangSe04=strip_tags($shuangSe4[0][0]);
			$data['shuangSe03']=$shuangSe04;
			
			preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents1,$shuangSe7);
			$shuangSe07=strip_tags($shuangSe7[0]);
			$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
			$shuangSe07=str_replace('元', ' ', $shuangSe07);
			$data['shuangSe04']=$shuangSe07;
			//print_r($shuangSe07);
			
			
			// 福彩3D 期号  号码  滚存。。。
			$contents = @file_get_contents("http://kaijiang.500.com/sd.shtml");
			$contents = iconv('GB2312', 'UTF-8//IGNORE', $contents);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe05']=$shuangSe01;
			//print_r($shuangSe01);exit
			preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents, $shuangSe33);
			$shuangSe033[]=strip_tags($shuangSe33[0][0]);
			$shuangSe033[]=strip_tags($shuangSe33[0][1]);
			$shuangSe033[]=strip_tags($shuangSe33[0][2]);
			$data['shuangSe06']=$shuangSe033;
			//print_r($shuangSe03);exit;
			
			
			// 七乐彩 期号  号码  滚存。。。
			$contents2 = @file_get_contents("http://kaijiang.500.com/qlc.shtml");
			$contents2 = iconv('GB2312', 'UTF-8//IGNORE', $contents2);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents2, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe07']=$shuangSe01;
			//print_r($shuangSe01);exit;
			preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents2, $shuangSe38);
			$shuangSe038[]=strip_tags($shuangSe38[0][0]);
			$shuangSe038[]=strip_tags($shuangSe38[0][1]);
			$shuangSe038[]=strip_tags($shuangSe38[0][2]);
			$shuangSe038[]=strip_tags($shuangSe38[0][3]);
			$shuangSe038[]=strip_tags($shuangSe38[0][4]);
			$shuangSe038[]=strip_tags($shuangSe38[0][5]);
			$shuangSe038[]=strip_tags($shuangSe38[0][6]);
			$data['shuangSe08']=$shuangSe038;
			//print_r($shuangSe03);exit;
			preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents2, $shuangSe4);
			$shuangSe04=strip_tags($shuangSe4[0][0]);
			$data['shuangSe09']=$shuangSe04;
			//print_r($shuangSe04);exit;
			preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents2,$shuangSe7);
			$shuangSe07=strip_tags($shuangSe7[0]);
			$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
			$shuangSe07=str_replace('元', ' ', $shuangSe07);
			$data['shuangSe10']=$shuangSe07;
			//print_r($shuangSe07);
			$cacheCaiPiao->set('data88',$data,5);
			$this->assign('data8',$data);			
		} else {
			$this->assign('data8',$data88);
			//echo "321";
			$footerFlag=1;
			$headerFlag=1;
			$this->assign('headerFlag',$headerFlag);
			$this->assign('footerFlag',$footerFlag);
			$this->assign('color1',$color1);
			$this->assign('color2',$color2);
			$titleKey='彩票查询-快查';
			$this->assign('titleKey',$titleKey);
			$flag="shenghuo";
			$this->assign('flag',$flag);
			$this->display();
			return true;
		}
		$footerFlag=1;
		$headerFlag=1;
		$this->assign('headerFlag',$headerFlag);
		$this->assign('footerFlag',$footerFlag);
		$this->assign('color1',$color1);
		$this->assign('color2',$color2);
		$titleKey='彩票查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="shenghuo";
		$this->assign('flag',$flag);
		$this->display();
	}
	
	// 体育彩票页面。
	public function tiCaiPage(){
		$color2=2;
		$cacheCaiPiao = Cache::getInstance('file');
		$data9=$cacheCaiPiao->get('data9');
		if(!isset($data9) || $data9 == false){
			// 排列三 期号  号码  滚存。。。		
			$contents3 = @file_get_contents("http://kaijiang.500.com/pls.shtml");
			$contents3 = iconv('GB2312', 'UTF-8//IGNORE', $contents3);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents3, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe01']=$shuangSe01;
			//print_r($shuangSe01);exit;
			preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents3, $shuangSe3);
			$shuangSe03[]=strip_tags($shuangSe3[0][0]);
			$shuangSe03[]=strip_tags($shuangSe3[0][1]);
			$shuangSe03[]=strip_tags($shuangSe3[0][2]);
			$data['shuangSe02']=$shuangSe03;
			//print_r($shuangSe03);exit;
			
			
			// 七星彩 期号  号码  滚存。。。
			$contents31 = @file_get_contents("http://kaijiang.500.com/qxc.shtml");
			$contents31 = iconv('GB2312', 'UTF-8//IGNORE', $contents31);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents31, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe04']=$shuangSe01;
			//print_r($shuangSe01);exit;
			preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents31, $shuangSe33);
			$shuangSe033[]=strip_tags($shuangSe33[0][0]);
			$shuangSe033[]=strip_tags($shuangSe33[0][1]);
			$shuangSe033[]=strip_tags($shuangSe33[0][2]);
			$shuangSe033[]=strip_tags($shuangSe33[0][3]);
			$shuangSe033[]=strip_tags($shuangSe33[0][4]);
			$shuangSe033[]=strip_tags($shuangSe33[0][5]);
			$shuangSe033[]=strip_tags($shuangSe33[0][6]);
			$data['shuangSe05']=$shuangSe033;
			//print_r($shuangSe03);exit;
			preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents31,$shuangSe7);
			$shuangSe07=strip_tags($shuangSe7[0]);
			$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
			$shuangSe07=str_replace('元', ' ', $shuangSe07);
			$data['shuangSe06']=$shuangSe07;
			//print_r($shuangSe07);
			
			
			// 超级大乐透 期号  号码  滚存。。。
			$contents311 = @file_get_contents("http://kaijiang.500.com/dlt.shtml");
			$contents311 = iconv('GB2312', 'UTF-8//IGNORE', $contents311);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents311, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe07']=$shuangSe01;
			//print_r($shuangSe01);exit;
			preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents311, $shuangSe32);
			$shuangSe032[]=strip_tags($shuangSe32[0][0]);
			$shuangSe032[]=strip_tags($shuangSe32[0][1]);
			$shuangSe032[]=strip_tags($shuangSe32[0][2]);
			$shuangSe032[]=strip_tags($shuangSe32[0][3]);
			$shuangSe032[]=strip_tags($shuangSe32[0][4]);
			$data['shuangSe08']=$shuangSe032;
			//print_r($shuangSe03);exit;
			preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents311, $shuangSe4);
			$shuangSe04[]=strip_tags($shuangSe4[0][0]);
			$shuangSe04[]=strip_tags($shuangSe4[0][1]);
			$data['shuangSe09']=$shuangSe04;
			//print_r($shuangSe04);exit;
			preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents311,$shuangSe7);
			$shuangSe07=strip_tags($shuangSe7[0]);
			$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
			$shuangSe07=str_replace('元', ' ', $shuangSe07);
			$data['shuangSe10']=$shuangSe07;
			//print_r($shuangSe07);
			
			
			// 22选5 期号  号码  滚存。。。
			$contents35 = @file_get_contents("http://kaijiang.500.com/eexw.shtml");
			$contents35 = iconv('GB2312', 'UTF-8//IGNORE', $contents35);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents35, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe11']=$shuangSe01;
			//print_r($shuangSe01);exit;
			preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $contents35, $shuangSe2);
			$shuangSe02=strip_tags($shuangSe2[0][0]);
			$data['shuangSe12']=$shuangSe02;
			//print_r($shuangSe02);exit;
			preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents35, $shuangSe31);
			$shuangSe031[]=strip_tags($shuangSe31[0][0]);
			$shuangSe031[]=strip_tags($shuangSe31[0][1]);
			$shuangSe031[]=strip_tags($shuangSe31[0][2]);
			$shuangSe031[]=strip_tags($shuangSe31[0][3]);
			$shuangSe031[]=strip_tags($shuangSe31[0][4]);
			$data['shuangSe13']=$shuangSe031;
			//print_r($shuangSe03);exit;
			preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents35,$shuangSe7);
			$shuangSe07=strip_tags($shuangSe7[0]);
			$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
			$shuangSe07=str_replace('元', ' ', $shuangSe07);
			$data['shuangSe14']=$shuangSe07;
			//print_r($shuangSe07);
			$cacheCaiPiao->set('data9',$data,5);
			$this->assign('data9',$data);
		} else {
				$this->assign('data9',$data9);
				//echo "321";
				$footerFlag=1;
				$this->assign('footerFlag',$footerFlag);
				$headerFlag=1;
				$this->assign('headerFlag',$headerFlag);
				$this->assign('color1',$color1);
				$this->assign('color2',$color2);
				$titleKey='彩票查询-快查';
				$this->assign('titleKey',$titleKey);
				$flag="shenghuo";
				$this->assign('flag',$flag);
				$this->display();
				return true;
		}
		
		$footerFlag=1;
		$headerFlag=1;
		$this->assign('headerFlag',$headerFlag);
		$this->assign('footerFlag',$footerFlag);
		$this->assign('color1',$color1);
		$this->assign('color2',$color2);
		$titleKey='彩票查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="shenghuo";
		$this->assign('flag',$flag);
		$this->display('tiCaiPage');
	}
	
	// 双色球开奖页面。
	public function shuangSeQiu(){
		
		//获取双色球开奖的最新数据。
		$color1=1;
		$cacheCaiPiao = Cache::getInstance('file');
		$data55=$cacheCaiPiao->get('data55');
				
		if(!isset($data55) || $data55==array()){	
			$contents1 = @file_get_contents("http://kaijiang.500.com/ssq.shtml");
			$contents1 = iconv('GB2312', 'UTF-8//IGNORE', $contents1);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents1, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe01']=$shuangSe01;
			//print_r($shuangSe01);exit;
		}else{
			$this->assign('data55',$data55);
			$footerFlag=1;
			$headerFlag=1;
			$this->assign('headerFlag',$headerFlag);
			$this->assign('footerFlag',$footerFlag);
			$this->assign('color1',$color1);
			$titleKey='彩票查询-快查';
			$this->assign('titleKey',$titleKey);
			$flag="shenghuo";
			$this->assign('flag',$flag);
			$this->display();
			//var_dump($data55);
			//echo "321";
			return true;
		}
		
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $contents1, $shuangSe2);
		$shuangSe02=strip_tags($shuangSe2[0][0]);
		$data['shuangSe02']=$shuangSe02;
		//print_r($shuangSe02);exit;
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents1, $shuangSe3);
		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
		$shuangSe03[]=strip_tags($shuangSe3[0][5]);
		$data['shuangSe03']=$shuangSe03;
		//print_r($shuangSe03);exit;
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents1, $shuangSe4);
		$shuangSe04=strip_tags($shuangSe4[0][0]);
		$data['shuangSe04']=$shuangSe04;
		//print_r($shuangSe04);exit;
		preg_match('/出球顺序：<\/td>\s*<td>\s*.*/',$contents1,$shuangSe5);
		$shuangSe05=strip_tags($shuangSe5[0]);
		$shuangSe05=mb_substr($shuangSe05,5,strlen($shuangSe05),"utf8");
		$data['shuangSe05']=$shuangSe05;
		//print_r($shuangSe05);
		//preg_match('/本期销量：.*/',$contents,$shuangSe6);
		//print_r($shuangSe6);
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents1,$shuangSe7);
		$shuangSe07=strip_tags($shuangSe7[0]);
		$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
		$shuangSe07=str_replace('元', ' ', $shuangSe07);
		$data['shuangSe07']=$shuangSe07;
		//print_r($shuangSe07);
		
		//获得一等奖数据。
		preg_match('/一等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents1,$shuangSe8);
		$shuangSe08=strip_tags($shuangSe8[0]);
		$shuangSe08=str_replace('一等奖', '', $shuangSe08);
		$shuangSe08=explode(',', $shuangSe08);
		$shuangSe08[0]=trim($shuangSe08[0]);
		$n8='';
		for($i=0;$i < strlen($shuangSe08[0]);$i++){
			if(in_array(substr($shuangSe08[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n8.=substr($shuangSe08[0], $i,1);
			}else{
				break;
			}
		}
		$m8=str_replace($n8, '', $shuangSe08[0]);
		$data['n8']=$n8;
		$data['m8']=$m8;
		$data['shuangSe08']=$shuangSe08;
		//print_r($n8);
		//print_r($shuangSe08);
		
		//获得二等奖数据。
		preg_match('/二等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents1,$shuangSe9);
		$shuangSe09=strip_tags($shuangSe9[0]);
		$shuangSe09=str_replace('二等奖', '', $shuangSe09);
		$shuangSe09=explode(',', $shuangSe09);
		$shuangSe09[0]=trim($shuangSe09[0]);
		$n9='';
		for($i=0;$i < strlen($shuangSe09[0]);$i++){
			if(in_array(substr($shuangSe09[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n9.=substr($shuangSe09[0], $i,1);
			}else{
				break;
			}
		}
		$m9=str_replace($n9, '', $shuangSe09[0]);
		$data['n9']=$n9;
		$data['m9']=$m9;
		$data['shuangSe09']=$shuangSe09;
		//echo $n9;
		//var_dump($shuangSe09[0]);
		
		//获得三等奖数据。
		preg_match('/三等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents1,$shuangSe10);
		$shuangSe10=strip_tags($shuangSe10[0]);
		$shuangSe10=str_replace('三等奖', '', $shuangSe10);
		$shuangSe10=explode(',', $shuangSe10);
		$shuangSe10[0]=trim($shuangSe10[0]);
		$n10='';
		for($i=0;$i < strlen($shuangSe10[0]);$i++){
			if(in_array(substr($shuangSe10[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n10.=substr($shuangSe10[0], $i,1);
			}else{
				break;
			}
		}
		$m10=str_replace($n10, '', $shuangSe10[0]);
		$data['n10']=$n10;
		$data['m10']=$m10;
		$data['shuangSe10']=$shuangSe10;
		//echo $n10;
		//print_r($shuangSe10);
		
		//获得四等奖数据。
		preg_match('/四等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents1,$shuangSe11);
		$shuangSe11=strip_tags($shuangSe11[0]);
		$shuangSe11=str_replace('四等奖', '', $shuangSe11);
		$shuangSe11=explode(',', $shuangSe11);
		$shuangSe11[0]=trim($shuangSe11[0]);
		$n11='';
		for($i=0;$i < strlen($shuangSe11[0]);$i++){
			if(in_array(substr($shuangSe11[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n11.=substr($shuangSe11[0], $i,1);
			}else{
				break;
			}
		}
		$m11=str_replace($n11, '', $shuangSe11[0]);
		$data['n11']=$n11;
		$data['m11']=$m11;
		$data['shuangSe11']=$shuangSe11;
		//print_r($shuangSe11);
		
		//获得五等奖数据。
		preg_match('/五等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents1,$shuangSe12);
		$shuangSe12=strip_tags($shuangSe12[0]);
		$shuangSe12=str_replace('五等奖', '', $shuangSe12);
		$shuangSe12=explode(',', $shuangSe12);
		$shuangSe12[0]=trim($shuangSe12[0]);
		$n12='';
		for($i=0;$i < strlen($shuangSe12[0]);$i++){
			if(in_array(substr($shuangSe12[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n12.=substr($shuangSe12[0], $i,1);
			}else{
				break;
			}
		}
		$m12=str_replace($n12, '', $shuangSe12[0]);
		$data['n12']=$n12;
		$data['m12']=$m12;
		$data['shuangSe12']=$shuangSe12;
		//print_r($shuangSe12);
		//preg_match('/六等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents,$shuangSe13);
		//print_r($shuangSe13);		
		
		//赋值变量到前端模板显示。
		$cacheCaiPiao->set('data55',$data,5);
		$this->assign('data55',$data);				
		$footerFlag=1;
		$headerFlag=1;
		$this->assign('headerFlag',$headerFlag);
		$this->assign('footerFlag',$footerFlag);
		$this->assign('color1',$color1);
		$titleKey='彩票查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="shenghuo";
		$this->assign('flag',$flag);
		$this->display();
	}
	
	// 福彩三D开奖页面。
	public function sanDi(){
		
		//获取福彩三D开奖的最新数据。
		$color1=1;
		$cacheCaiPiao = Cache::getInstance('file');
		$data6=$cacheCaiPiao->get('data6');		
		//初始化缓存duiixang
		//$cacheCaiPiao = Cache::getInstance('file');
		//var_dump($cacheCaiPiao);exit;
		/* $cacheCaiPiao->set('name','ThinkPHP');  // 缓存name数据
		$value = $cacheCaiPiao->get('name');  // 获取缓存的name数据
		$cacheCaiPiao->rm('name');  // 删除缓存的name数据 */	
		//$cacheCaiPiao->set('name','thinkphp',2*3600);
		//$value=$cacheCaiPiao->get('name');
		//echo $value."369"; exit; 
		
		if(!isset($data6) || $data6 == false){
			$contents = @file_get_contents("http://kaijiang.500.com/sd.shtml");
			$contents = iconv('GB2312', 'UTF-8//IGNORE', $contents);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe01']=$shuangSe01;
			//print_r($shuangSe01);exit
		}else{
			$this->assign('data6',$data6);
			$footerFlag=1;
			$headerFlag=1;
			$this->assign('headerFlag',$headerFlag);
			$this->assign('footerFlag',$footerFlag);
			$this->assign('color1',$color1);
			$titleKey='彩票查询-快查';
			$this->assign('titleKey',$titleKey);
			$flag="shenghuo";
			$this->assign('flag',$flag);
			$this->display();
			echo "321";
			return true;
		}
			
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $contents, $shuangSe2);
		$shuangSe02=strip_tags($shuangSe2[0][0]);
		$data['shuangSe02']=$shuangSe02;
		//print_r($shuangSe02);exit;
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents, $shuangSe3);
		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
		$data['shuangSe03']=$shuangSe03;
		//print_r($shuangSe03);exit;
		preg_match('/<font class=\"cfont1\">.*<\/font>/i', $contents, $shuangSe4);
		$shuangSe04=$shuangSe4[0];
		$shuangSe04=strip_tags($shuangSe04);
		$data['shuangSe04']=$shuangSe04;
		//print_r($shuangSe04);exit;
		
		preg_match('/单选<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents,$shuangSe5);
		$shuangSe05=$shuangSe5[0];
		$shuangSe05=strip_tags($shuangSe05);
		$shuangSe05=str_replace('单选', '', $shuangSe05);
		$shuangSe05=explode(',', $shuangSe05);
		//print_r($shuangSe05);exit;
		$shuangSe05[0]=trim($shuangSe05[0]);
		$n5='';
		for($i=0;$i < strlen($shuangSe05[0]);$i++){
			if(in_array(substr($shuangSe05[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n5.=substr($shuangSe05[0], $i,1);
			}else{
				break;
			}
		}
		$m5=str_replace($n5, '', $shuangSe05[0]);
		$data['n5']=$n5;
		$data['m5']=$m5;
		$data['shuangSe05']=$shuangSe05;
		//print_r($shuangSe05);exit;
		
		preg_match('/'.$shuangSe04.'<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents,$shuangSe6);
		$shuangSe06=$shuangSe6[0];
		$shuangSe06=strip_tags($shuangSe06);
		$shuangSe06=str_replace($shuangSe04, '', $shuangSe06);
		$shuangSe06=explode(',', $shuangSe06);
		//print_r($shuangSe06);exit;
		$shuangSe06[0]=trim($shuangSe06[0]);
		$n6='';
		for($i=0;$i < strlen($shuangSe06[0]);$i++){
			if(in_array(substr($shuangSe06[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n6.=substr($shuangSe06[0], $i,1);
			}else{
				break;
			}
		}
		$m6=str_replace($n6, '', $shuangSe06[0]);
		$data['n6']=$n6;
		$data['m6']=$m6;
		$data['shuangSe06']=$shuangSe06;
		//print_r($shuangSe06);exit;
		
		//赋值变量到前端模板显示。	
		$cacheCaiPiao->set('data6',$data,2);
		$this->assign('data6',$data);
		$footerFlag=1;
		$headerFlag=1;
		$this->assign('headerFlag',$headerFlag);
		$this->assign('footerFlag',$footerFlag);
		$this->assign('color1',$color1);
		$titleKey='彩票查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="shenghuo";
		$this->assign('flag',$flag);
		$this->display();
	}
	
	// 七乐彩开奖页面。
	public function qiLeCai(){
		
		//获取七乐彩开奖的最新数据。
		$color1=1;
		$cacheCaiPiao = Cache::getInstance('file');
		$data7 = $cacheCaiPiao->get('data7');
		if(!isset($data7) || $data7 == false){
			$contents2 = @file_get_contents("http://kaijiang.500.com/qlc.shtml");
			$contents2 = iconv('GB2312', 'UTF-8//IGNORE', $contents2);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents2, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe01']=$shuangSe01;
			//print_r($shuangSe01);exit;
		}else{
			$this->assign('data7',$data7);
			$footerFlag=1;
			$headerFlag=1;
			$this->assign('headerFlag',$headerFlag);
			$this->assign('footerFlag',$footerFlag);
			$this->assign('color1',$color1);
			$titleKey='彩票查询-快查';
			$this->assign('titleKey',$titleKey);
			$flag="shenghuo";
			$this->assign('flag',$flag);
			$this->display();
			//echo "321";
			return true;
		}
		
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $contents2, $shuangSe2);
		$shuangSe02=strip_tags($shuangSe2[0][0]);
		$data['shuangSe02']=$shuangSe02;
		//print_r($shuangSe02);exit;
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents2, $shuangSe3);
		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
		$shuangSe03[]=strip_tags($shuangSe3[0][5]);
		$shuangSe03[]=strip_tags($shuangSe3[0][6]);
		$data['shuangSe03']=$shuangSe03;
		//print_r($shuangSe03);exit;
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents2, $shuangSe4);
		$shuangSe04=strip_tags($shuangSe4[0][0]);
		$data['shuangSe04']=$shuangSe04;
		//print_r($shuangSe04);exit;
		preg_match('/出球顺序：<\/td>\s*<td>\s*.*/',$contents2,$shuangSe5);
		$shuangSe05=strip_tags($shuangSe5[0]);
		$shuangSe05=mb_substr($shuangSe05,5,strlen($shuangSe05),"utf8");
		$data['shuangSe05']=$shuangSe05;
		//print_r($shuangSe05);
		//preg_match('/本期销量：.*/',$contents2,$shuangSe6);
		//print_r($shuangSe6);
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents2,$shuangSe7);
		$shuangSe07=strip_tags($shuangSe7[0]);
		$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
		$shuangSe07=str_replace('元', ' ', $shuangSe07);
		$data['shuangSe07']=$shuangSe07;
		//print_r($shuangSe07);
		
		//获得一等奖数据。
		preg_match('/一等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents2,$shuangSe8);
		$shuangSe08=strip_tags($shuangSe8[0]);
		$shuangSe08=str_replace('一等奖', '', $shuangSe08);
		$shuangSe08=explode(',', $shuangSe08);
		$shuangSe08[0]=trim($shuangSe08[0]);
		$n8='';
		for($i=0;$i < strlen($shuangSe08[0]);$i++){
			if(in_array(substr($shuangSe08[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n8.=substr($shuangSe08[0], $i,1);
			}else{
				break;
			}
		}
		$m8=str_replace($n8, '', $shuangSe08[0]);
		$data['n8']=$n8;
		$data['m8']=$m8;
		$data['shuangSe08']=$shuangSe08;
		//print_r($n8);
		//print_r($shuangSe08);
		
		//获得二等奖数据。
		preg_match('/二等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents2,$shuangSe9);
		$shuangSe09=strip_tags($shuangSe9[0]);
		$shuangSe09=str_replace('二等奖', '', $shuangSe09);
		$shuangSe09=explode(',', $shuangSe09);
		$shuangSe09[0]=trim($shuangSe09[0]);
		$n9='';
		for($i=0;$i < strlen($shuangSe09[0]);$i++){
			if(in_array(substr($shuangSe09[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n9.=substr($shuangSe09[0], $i,1);
			}else{
				break;
			}
		}
		$m9=str_replace($n9, '', $shuangSe09[0]);
		if(!trim($m9)){
			$m9=$n9;
		}
		$data['n9']=$n9;
		$data['m9']=$m9;
		$data['shuangSe09']=$shuangSe09;
		//echo $n9;
		//var_dump($shuangSe09[0]);
		
		//获得三等奖数据。
		preg_match('/三等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents2,$shuangSe10);
		$shuangSe10=strip_tags($shuangSe10[0]);
		$shuangSe10=str_replace('三等奖', '', $shuangSe10);
		$shuangSe10=explode(',', $shuangSe10);
		$shuangSe10[0]=trim($shuangSe10[0]);
		$n10='';
		for($i=0;$i < strlen($shuangSe10[0]);$i++){
			if(in_array(substr($shuangSe10[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n10.=substr($shuangSe10[0], $i,1);
			}else{
				break;
			}
		}
		$m10=str_replace($n10, '', $shuangSe10[0]);
		$data['n10']=$n10;
		$data['m10']=$m10;
		$data['shuangSe10']=$shuangSe10;
		//echo $n10;
		//print_r($shuangSe10);
		
		//获得四等奖数据。
		preg_match('/四等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents2,$shuangSe11);
		$shuangSe11=strip_tags($shuangSe11[0]);
		$shuangSe11=str_replace('四等奖', '', $shuangSe11);
		$shuangSe11=explode(',', $shuangSe11);
		$shuangSe11[0]=trim($shuangSe11[0]);
		$n11='';
		for($i=0;$i < strlen($shuangSe11[0]);$i++){
			if(in_array(substr($shuangSe11[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n11.=substr($shuangSe11[0], $i,1);
			}else{
				break;
			}
		}
		$m11=str_replace($n11, '', $shuangSe11[0]);
		$data['n11']=$n11;
		$data['m11']=$m11;
		$data['shuangSe11']=$shuangSe11;
		//print_r($shuangSe11);
		
		//获得五等奖数据。
		preg_match('/五等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents2,$shuangSe12);
		$shuangSe12=strip_tags($shuangSe12[0]);
		$shuangSe12=str_replace('五等奖', '', $shuangSe12);
		$shuangSe12=explode(',', $shuangSe12);
		$shuangSe12[0]=trim($shuangSe12[0]);
		$n12='';
		for($i=0;$i < strlen($shuangSe12[0]);$i++){
			if(in_array(substr($shuangSe12[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n12.=substr($shuangSe12[0], $i,1);
			}else{
				break;
			}
		}
		$m12=str_replace($n12, '', $shuangSe12[0]);
		$data['n12']=$n12;
		$data['m12']=$m12;
		$data['shuangSe12']=$shuangSe12;
		// print_r($shuangSe12);
		
		//赋值变量到前端模板显示。
		$cacheCaiPiao->set('data7',$data,3);
		$this->assign('data7',$data);
		$footerFlag=1;
		$headerFlag=1;
		$this->assign('headerFlag',$headerFlag);
		$this->assign('footerFlag',$footerFlag);
		$this->assign('color1',$color1);
		$titleKey='彩票查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="shenghuo";
		$this->assign('flag',$flag);
		$this->display();
	}
	
	// 22选五开奖页面。
	public function erErXuanWu(){
		
		// 获取22选五的最新数据。
		$color2=2;
		$cacheCaiPiao = Cache::getInstance('file');
		$contents3=$cacheCaiPiao->get('contents3');
					
		//var_dump($contents3);
		$data1=$cacheCaiPiao->get('data1');
		if(!isset($data1) || $data1 == array()){
			$contents3 = @file_get_contents("http://kaijiang.500.com/eexw.shtml");
			$contents3 = iconv('GB2312', 'UTF-8//IGNORE', $contents3);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents3, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe01']=$shuangSe01;
			//print_r($shuangSe01);exit;
		}else{
			$footerFlag=1;
			$headerFlag=1;
			$this->assign('headerFlag',$headerFlag);
			$this->assign('footerFlag',$footerFlag);
			$this->assign('data1',$data1);
			$this->assign('color2',$color2);
			$titleKey='彩票查询-快查';
			$this->assign('titleKey',$titleKey);
			$flag="shenghuo";
			$this->assign('flag',$flag);
			$this->display();
			return  true;
		}
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $contents3, $shuangSe2);
		$shuangSe02=strip_tags($shuangSe2[0][0]);
		$data['shuangSe02']=$shuangSe02;
		//print_r($shuangSe02);exit;
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents3, $shuangSe3);
		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
		$data['shuangSe03']=$shuangSe03;
		//print_r($shuangSe03);exit;
		//preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents3, $shuangSe4);
		//$shuangSe04=strip_tags($shuangSe4[0][0]);
		//print_r($shuangSe04);exit;
		preg_match('/出球顺序：<\/td>\s*<td>\s*.*/',$contents3,$shuangSe5);
		$shuangSe05=strip_tags($shuangSe5[0]);
		$shuangSe05=mb_substr($shuangSe05,5,strlen($shuangSe05),"utf8");
		$data['shuangSe05']=$shuangSe05;
		//print_r($shuangSe05);
		//preg_match('/本期销量：.*/',$contents,$shuangSe6);
		//print_r($data);
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents3,$shuangSe7);
		$shuangSe07=strip_tags($shuangSe7[0]);
		$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
		$shuangSe07=str_replace('元', ' ', $shuangSe07);
		$data['shuangSe07']=$shuangSe07;
		//print_r($shuangSe07);
		
		//获得一等奖数据。
		preg_match('/一等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents3,$shuangSe8);
		$shuangSe08=strip_tags($shuangSe8[0]);
		$shuangSe08=str_replace('一等奖', '', $shuangSe08);
		$shuangSe08=explode(',', $shuangSe08);
		$shuangSe08[0]=trim($shuangSe08[0]);
		$n8='';
		for($i=0;$i < strlen($shuangSe08[0]);$i++){
			if(in_array(substr($shuangSe08[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n8.=substr($shuangSe08[0], $i,1);
			}else{
				break;
			}
		}
		$m8=str_replace($n8, '', $shuangSe08[0]);
		$data['n8']=$n8;
		$data['m8']=$m8;
		$data['shuangSe08']=$shuangSe08;
		//print_r($n8);
		//print_r($shuangSe08);
		
		//获得二等奖数据。
		preg_match('/二等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents3,$shuangSe9);
		$shuangSe09=strip_tags($shuangSe9[0]);
		$shuangSe09=str_replace('二等奖', '', $shuangSe09);
		$shuangSe09=explode(',', $shuangSe09);
		$shuangSe09[0]=trim($shuangSe09[0]);
		$n9='';
		for($i=0;$i < strlen($shuangSe09[0]);$i++){
			if(in_array(substr($shuangSe09[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n9.=substr($shuangSe09[0], $i,1);
			}else{
				break;
			}
		}
		$m9=str_replace($n9, '', $shuangSe09[0]);
		$data['n9']=$n9;
		$data['m9']=$m9;
		$data['shuangSe09']=$shuangSe09;
		//echo $n9;
		//var_dump($shuangSe09[0]);
		
		//获得三等奖数据。
		preg_match('/三等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents3,$shuangSe10);
		$shuangSe10=strip_tags($shuangSe10[0]);
		$shuangSe10=str_replace('三等奖', '', $shuangSe10);
		$shuangSe10=explode(',', $shuangSe10);
		$shuangSe10[0]=trim($shuangSe10[0]);
		$n10='';
		for($i=0;$i < strlen($shuangSe10[0]);$i++){
			if(in_array(substr($shuangSe10[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n10.=substr($shuangSe10[0], $i,1);
			}else{
				break;
			}
		}
		$m10=str_replace($n10, '', $shuangSe10[0]);
		$data['n10']=$n10;
		$data['m10']=$m10;
		$data['shuangSe10']=$shuangSe10;
		//echo $n10;
		//print_r($data);
		$data1=$cacheCaiPiao->get('data1');
		if(!isset($data1) || $data1 == array()){
			$cacheCaiPiao->set('data1',$data,5);
		}
		//print_r($data);
		//var_dump($data1);exit;
		$this->assign('data1',$data);		
		$footerFlag=1;
		$headerFlag=1;
		$this->assign('headerFlag',$headerFlag);
		$this->assign('footerFlag',$footerFlag);
		$this->assign('color2',$color2);
		$titleKey='彩票查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="shenghuo";
		$this->assign('flag',$flag);
		$this->display();
	}
	
	// 大乐透开奖页面。
	public function daLeTou(){
		
		// 获取超级大乐透的最新数据。
		$color2=2;
		$cacheCaiPiao = Cache::getInstance('file');					
		//var_dump($contents3);
		$data2=$cacheCaiPiao->get('data2');
		if(!isset($data2) || $data2 == array()){
			$contents3 = @file_get_contents("http://kaijiang.500.com/dlt.shtml");
			$contents3 = iconv('GB2312', 'UTF-8//IGNORE', $contents3);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents3, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe01']=$shuangSe01;
			//print_r($shuangSe01);exit;
		}else{
			$footerFlag=1;
			$headerFlag=1;
			$this->assign('headerFlag',$headerFlag);
			$this->assign('footerFlag',$footerFlag);
			$this->assign('data2',$data2);
			$this->assign('color2',$color2);
			$titleKey='彩票查询-快查';
			$this->assign('titleKey',$titleKey);
			$flag="shenghuo";
			$this->assign('flag',$flag);
			$this->display();
			return  true;
		}
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $contents3, $shuangSe2);
		$shuangSe02=strip_tags($shuangSe2[0][0]);
		$data['shuangSe02']=$shuangSe02;
		//print_r($shuangSe02);exit;
		preg_match_all('/<li class=\"ball_red\">.*<\/li>/i', $contents3, $shuangSe3);
		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
		$data['shuangSe03']=$shuangSe03;
		//print_r($shuangSe03);exit;
		preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents3, $shuangSe4);
		$shuangSe04[]=strip_tags($shuangSe4[0][0]);
		$shuangSe04[]=strip_tags($shuangSe4[0][1]);
		$data['shuangSe04']=$shuangSe04;
		//print_r($shuangSe04);exit;
		preg_match('/出球顺序：<\/td>\s*<td>\s*.*/',$contents3,$shuangSe5);
		$shuangSe05=strip_tags($shuangSe5[0]);
		$shuangSe05=mb_substr($shuangSe05,5,strlen($shuangSe05),"utf8");
		$data['shuangSe05']=$shuangSe05;
		//print_r($shuangSe05);
		//preg_match('/本期销量：.*/',$contents,$shuangSe6);
		//print_r($data);
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents3,$shuangSe7);
		$shuangSe07=strip_tags($shuangSe7[0]);
		$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
		$shuangSe07=str_replace('元', ' ', $shuangSe07);
		$data['shuangSe07']=$shuangSe07;
		//print_r($shuangSe07);
		
		//获得一等奖数据。
		preg_match('/一等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*(.*)\s*<\/td>\s*<td>\s*(.*)\s*<\/td>/',$contents3,$shuangSe8);
		$shuangSe08=strip_tags($shuangSe8[0]);
		$shuangSe08=str_replace('一等奖', '', $shuangSe08);
		$shuangSe08=str_replace('基本', '', $shuangSe08);
		$shuangSe08=explode(',', $shuangSe08);
		$shuangSe08[0]=trim($shuangSe08[0]);
		$n8='';
		for($i=0;$i < strlen($shuangSe08[0]);$i++){
			if(in_array(substr($shuangSe08[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n8.=substr($shuangSe08[0], $i,1);
			}else{
				break;
			}
		}
		$m8=str_replace($n8, '', $shuangSe08[0]);
		$data['n8']=$n8;
		$data['m8']=$m8;
		$data['shuangSe08']=$shuangSe08;
		//echo $m8;
		//print_r($shuangSe08);
				
		//一等奖追加奖金。
		preg_match_all('/追加<\/td>\s*<td>\s*(.*)<\/td>\s*<td>\s*(.*)\s*<\/td>/',$contents3,$shuangSe88);
		$shuangSe088=strip_tags($shuangSe88[0][0]);
		$shuangSe088=str_replace('一等奖', '', $shuangSe088);
		$shuangSe088=str_replace('追加', '', $shuangSe088);
		$shuangSe088=explode(',', $shuangSe088);
		$shuangSe088[0]=trim($shuangSe088[0]);
		$n88='';
		for($i=0;$i < strlen($shuangSe088[0]);$i++){
			if(in_array(substr($shuangSe088[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n88.=substr($shuangSe088[0], $i,1);
			}else{
				break;
			}
		}
		$m88=str_replace($n88, '', $shuangSe088[0]);
		$data['n88']=$n88;
		$data['m88']=$m88;
		$data['shuangSe088']=$shuangSe088;
		//echo $n88;
		//print_r($shuangSe088);
		
		//二等奖追加奖金。
		//preg_match_all('/追加<\/td>\s*<td>\s*(.*)<\/td>\s*<td>\s*(.*)\s*<\/td>/',$contents3,$shuangSe88);
		$shuangSe099=strip_tags($shuangSe88[0][1]);
		$shuangSe099=str_replace('一等奖', '', $shuangSe099);
		$shuangSe099=str_replace('追加', '', $shuangSe099);
		$shuangSe099=explode(',', $shuangSe099);
		$shuangSe099[0]=trim($shuangSe099[0]);
		$n99='';
		for($i=0;$i < strlen($shuangSe099[0]);$i++){
			if(in_array(substr($shuangSe099[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n99.=substr($shuangSe099[0], $i,1);
			}else{
				break;
			}
		}
		$m99=str_replace($n99, '', $shuangSe099[0]);
		$data['n99']=$n99;
		$data['m99']=$m99;
		$data['shuangSe099']=$shuangSe099;
		//echo $m99;
		//print_r($shuangSe099);
		
		//三等奖追加奖金。
		//preg_match_all('/追加<\/td>\s*<td>\s*(.*)<\/td>\s*<td>\s*(.*)\s*<\/td>/',$contents3,$shuangSe88);
		$shuangSe000=strip_tags($shuangSe88[0][2]);
		$shuangSe000=str_replace('一等奖', '', $shuangSe000);
		$shuangSe000=str_replace('追加', '', $shuangSe000);
		$shuangSe000=explode(',', $shuangSe000);
		$shuangSe000[0]=trim($shuangSe000[0]);
		$n00='';
		for($i=0;$i < strlen($shuangSe000[0]);$i++){
			if(in_array(substr($shuangSe000[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n00.=substr($shuangSe000[0], $i,1);
			}else{
				break;
			}
		}
		$m00=str_replace($n00, '', $shuangSe000[0]);
		$data['n00']=$n00;
		$data['m00']=$m00;
		$data['shuangSe000']=$shuangSe000;
		//echo $m00;
		//print_r($shuangSe000);
		
		
		//获得二等奖数据。
		preg_match('/二等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*(.*)\s*<\/td>\s*<td>\s*(.*)\s*<\/td>/',$contents3,$shuangSe9);
		$shuangSe09=strip_tags($shuangSe9[0]);
		$shuangSe09=str_replace('二等奖', '', $shuangSe09);
		$shuangSe09=str_replace('基本', '', $shuangSe09);
		$shuangSe09=explode(',', $shuangSe09);
		$shuangSe09[0]=trim($shuangSe09[0]);
		$n9='';
		for($i=0;$i < strlen($shuangSe09[0]);$i++){
			if(in_array(substr($shuangSe09[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n9.=substr($shuangSe09[0], $i,1);
			}else{
				break;
			}
		}
		$m9=str_replace($n9, '', $shuangSe09[0]);
		$data['n9']=$n9;
		$data['m9']=$m9;
		$data['shuangSe09']=$shuangSe09;
		//echo $n9;
		//var_dump($shuangSe09[0]);
		
		//获得三等奖数据。
		preg_match('/三等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*(.*)\s*<\/td>\s*<td>\s*(.*)\s*<\/td>/',$contents3,$shuangSe10);
		$shuangSe10=strip_tags($shuangSe10[0]);
		$shuangSe10=str_replace('三等奖', '', $shuangSe10);
		$shuangSe10=str_replace('基本', '', $shuangSe10);
		$shuangSe10=explode(',', $shuangSe10);
		$shuangSe10[0]=trim($shuangSe10[0]);
		$n10='';
		for($i=0;$i < strlen($shuangSe10[0]);$i++){
			if(in_array(substr($shuangSe10[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n10.=substr($shuangSe10[0], $i,1);
			}else{
				break;
			}
		}
		$m10=str_replace($n10, '', $shuangSe10[0]);
		$data['n10']=$n10;
		$data['m10']=$m10;
		$data['shuangSe10']=$shuangSe10;
		//echo $n10;
		//print_r($data);
		$data2=$cacheCaiPiao->get('data2');
		if(!isset($data2) || $data2 == array()){
			$cacheCaiPiao->set('data2',$data,5);
		}
		//print_r($data);
		//var_dump($data2);exit;
		$this->assign('data2',$data);		
		$footerFlag=1;
		$headerFlag=1;
		$this->assign('headerFlag',$headerFlag);
		$this->assign('footerFlag',$footerFlag);
		$this->assign('color2',$color2);
		$titleKey='彩票查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="shenghuo";
		$this->assign('flag',$flag);
		$this->display();
	}
	
	// 排列三开奖页面。
	public function paiLieSan(){
		
		//获取排列三开奖的最新数据。
		$color2=2;
		$cacheCaiPiao = Cache::getInstance('file');
		$data4=$cacheCaiPiao->get('data4');
		if(!isset($data4) || $data4 == array()){
			$contents = @file_get_contents("http://kaijiang.500.com/pls.shtml");
			$contents = iconv('GB2312', 'UTF-8//IGNORE', $contents);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe01']=$shuangSe01;
			//print_r($shuangSe01);exit;
		}else{
			$this->assign('data4',$data4);
			//print_r($data4);
			$footerFlag=1;
			$headerFlag=1;
			$this->assign('headerFlag',$headerFlag);
			$this->assign('footerFlag',$footerFlag);
			$this->assign('color2',$color2);
			$titleKey='彩票查询-快查';
			$this->assign('titleKey',$titleKey);
			$flag="shenghuo";
			$this->assign('flag',$flag);
			$this->display();
			return true;
		}
		
		//初始化缓存duiixang
		//$cacheCaiPiao = Cache::getInstance('file');
		//var_dump($cacheCaiPiao);exit;
		/* $cacheCaiPiao->set('name','ThinkPHP');  // 缓存name数据
		 $value = $cacheCaiPiao->get('name');  // 获取缓存的name数据
		$cacheCaiPiao->rm('name');  // 删除缓存的name数据 */	
		//$cacheCaiPiao->set('name','thinkphp',2*3600);
		//$value=$cacheCaiPiao->get('name');
		//echo $value."369"; exit;
		
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $contents, $shuangSe2);
		$shuangSe02=strip_tags($shuangSe2[0][0]);
		$data['shuangSe02']=$shuangSe02;
		//print_r($shuangSe02);exit;
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents, $shuangSe3);
		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
		$data['shuangSe03']=$shuangSe03;
		//print_r($shuangSe03);exit;
		preg_match('/<font class=\"cfont1\">.*<\/font>/i', $contents, $shuangSe4);
		$shuangSe04=$shuangSe4[0];
		$shuangSe04=strip_tags($shuangSe04);
		$data['shuangSe04']=$shuangSe04;
		//var_dump($shuangSe04);exit;
		
		preg_match('/排列三直选<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents,$shuangSe5);
		$shuangSe05=$shuangSe5[0];
		$shuangSe05=strip_tags($shuangSe05);
		$shuangSe05=str_replace('排列三直选', '', $shuangSe05);
		$shuangSe05=explode(',', $shuangSe05);
		//print_r($shuangSe05);exit;
		$shuangSe05[0]=trim($shuangSe05[0]);
		$n5='';
		for($i=0;$i < strlen($shuangSe05[0]);$i++){
			if(in_array(substr($shuangSe05[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n5.=substr($shuangSe05[0], $i,1);
			}else{
				break;
			}
		}
		$m5=str_replace($n5, '', $shuangSe05[0]);
		$data['n5']=$n5;
		$data['m5']=$m5;
		$data['shuangSe05']=$shuangSe05;
		//print_r($shuangSe05);exit;
		
		preg_match('/'.$shuangSe04.'<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents,$shuangSe6);
		$shuangSe06=$shuangSe6[0];
		$shuangSe06=strip_tags($shuangSe06);
		$shuangSe06=str_replace($shuangSe04, '', $shuangSe06);
		$shuangSe06=explode(',', $shuangSe06);
		//print_r($shuangSe06);exit;
		$shuangSe06[0]=trim($shuangSe06[0]);
		$n6='';
		for($i=0;$i < strlen($shuangSe06[0]);$i++){
			if(in_array(substr($shuangSe06[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n6.=substr($shuangSe06[0], $i,1);
			}else{
				break;
			}
		}
		$m6=str_replace($n6, '', $shuangSe06[0]);
		$data['n6']=$n6;
		$data['m6']=$m6;
		$data['shuangSe06']=$shuangSe06;
		//print_r($shuangSe06);exit;
		
		//赋值变量到前端模板显示。
		$cacheCaiPiao->set('data4',$data,5);
		$this->assign('data4',$data);
		//print_r($data);
		$footerFlag=1;
		$headerFlag=1;
		$this->assign('headerFlag',$headerFlag);
		$this->assign('footerFlag',$footerFlag);
		$this->assign('color2',$color2);
		$titleKey='彩票查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="shenghuo";
		$this->assign('flag',$flag);
		$this->display();
	}
	
	// 七星彩开奖页面。
	public function qiXingCai(){
		// 获取七星彩的最新数据。
		$color2=2;
		$cacheCaiPiao = Cache::getInstance('file');					
		$data3=$cacheCaiPiao->get('data3');
		if(!isset($data3) || $data3 == array()){
			$contents3 = @file_get_contents("http://kaijiang.500.com/qxc.shtml");
			$contents3 = iconv('GB2312', 'UTF-8//IGNORE', $contents3);
			preg_match_all('/<font class=\"cfont2\">.*<\/font>/i', $contents3, $shuangSe1);
			$shuangSe01 = $shuangSe1[0][0];
			$shuangSe01 = strip_tags($shuangSe01);
			$data['shuangSe01']=$shuangSe01;
			//print_r($shuangSe01);exit;
		}else{
			$footerFlag=1;
			$headerFlag=1;
			$this->assign('headerFlag',$headerFlag);
			$this->assign('footerFlag',$footerFlag);
			$this->assign('data3',$data3);
			$this->assign('color2',$color2);
			$titleKey='彩票查询-快查';
			$this->assign('titleKey',$titleKey);
			$flag="shenghuo";
			$this->assign('flag',$flag);
			$this->display();
			//echo "321";
			//print_r($data3);
			return  true;
		}
		preg_match_all('/<span class=\"span_right\">.*<\/span>/i', $contents3, $shuangSe2);
		$shuangSe02=strip_tags($shuangSe2[0][0]);
		$data['shuangSe02']=$shuangSe02;
		//print_r($shuangSe02);exit;
		preg_match_all('/<li class=\"ball_orange\">.*<\/li>/i', $contents3, $shuangSe3);
		$shuangSe03[]=strip_tags($shuangSe3[0][0]);
		$shuangSe03[]=strip_tags($shuangSe3[0][1]);
		$shuangSe03[]=strip_tags($shuangSe3[0][2]);
		$shuangSe03[]=strip_tags($shuangSe3[0][3]);
		$shuangSe03[]=strip_tags($shuangSe3[0][4]);
		$shuangSe03[]=strip_tags($shuangSe3[0][5]);
		$shuangSe03[]=strip_tags($shuangSe3[0][6]);
		$data['shuangSe03']=$shuangSe03;
		//print_r($shuangSe03);exit;
		//preg_match_all('/<li class=\"ball_blue\">.*<\/li>/i', $contents3, $shuangSe4);
		//$shuangSe04=strip_tags($shuangSe4[0][0]);
		//print_r($shuangSe04);exit;
		//preg_match('/出球顺序：<\/td>\s*<td>\s*.*/',$contents3,$shuangSe5);
		//$shuangSe05=strip_tags($shuangSe5[0]);
		//$shuangSe05=mb_substr($shuangSe05,5,strlen($shuangSe05),"utf8");
		//$data['shuangSe05']=$shuangSe05;
		//print_r($shuangSe05);
		//preg_match('/本期销量：.*/',$contents,$shuangSe6);
		//print_r($data);
		preg_match('/奖池滚存：<span\s*class=\"cfont1 \">.*/',$contents3,$shuangSe7);
		$shuangSe07=strip_tags($shuangSe7[0]);
		$shuangSe07=mb_substr($shuangSe07,5,strlen($shuangSe07),"utf8");
		$shuangSe07=str_replace('元', ' ', $shuangSe07);
		$data['shuangSe07']=$shuangSe07;
		//print_r($shuangSe07);
		
		//获得一等奖数据。
		preg_match('/一等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents3,$shuangSe8);
		$shuangSe08=strip_tags($shuangSe8[0]);
		$shuangSe08=str_replace('一等奖', '', $shuangSe08);
		$shuangSe08=explode(',', $shuangSe08);
		$shuangSe08[0]=trim($shuangSe08[0]);
		$n8='';
		for($i=0;$i < strlen($shuangSe08[0]);$i++){
			if(in_array(substr($shuangSe08[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n8.=substr($shuangSe08[0], $i,1);
			}else{
				break;
			}
		}
		$m8=str_replace($n8, '', $shuangSe08[0]);
		$data['n8']=$n8;
		$data['m8']=$m8;
		$data['shuangSe08']=$shuangSe08;
		//print_r($n8);
		//print_r($shuangSe08);
		
		//获得二等奖数据。
		preg_match('/二等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents3,$shuangSe9);
		$shuangSe09=strip_tags($shuangSe9[0]);
		$shuangSe09=str_replace('二等奖', '', $shuangSe09);
		$shuangSe09=explode(',', $shuangSe09);
		$shuangSe09[0]=trim($shuangSe09[0]);
		$n9='';
		for($i=0;$i < strlen($shuangSe09[0]);$i++){
			if(in_array(substr($shuangSe09[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n9.=substr($shuangSe09[0], $i,1);
			}else{
				break;
			}
		}
		$m9=str_replace($n9, '', $shuangSe09[0]);
		$data['n9']=$n9;
		$data['m9']=$m9;
		$data['shuangSe09']=$shuangSe09;
		//echo $n9;
		//var_dump($shuangSe09[0]);
		
		//获得三等奖数据。
		preg_match('/三等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents3,$shuangSe10);
		$shuangSe10=strip_tags($shuangSe10[0]);
		$shuangSe10=str_replace('三等奖', '', $shuangSe10);
		$shuangSe10=explode(',', $shuangSe10);
		$shuangSe10[0]=trim($shuangSe10[0]);
		$n10='';
		for($i=0;$i < strlen($shuangSe10[0]);$i++){
			if(in_array(substr($shuangSe10[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n10.=substr($shuangSe10[0], $i,1);
			}else{
				break;
			}
		}
		$m10=str_replace($n10, '', $shuangSe10[0]);
		$data['n10']=$n10;
		$data['m10']=$m10;
		$data['shuangSe10']=$shuangSe10;
		//echo $n10;
		//print_r($shuangSe10);
		
		//获得四等奖数据。
		preg_match('/四等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents3,$shuangSe11);
		$shuangSe11=strip_tags($shuangSe11[0]);
		$shuangSe11=str_replace('四等奖', '', $shuangSe11);
		$shuangSe11=explode(',', $shuangSe11);
		$shuangSe11[0]=trim($shuangSe11[0]);
		$n11='';
		for($i=0;$i < strlen($shuangSe11[0]);$i++){
			if(in_array(substr($shuangSe11[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n11.=substr($shuangSe11[0], $i,1);
			}else{
				break;
			}
		}
		$m11=str_replace($n11, '', $shuangSe11[0]);
		$data['n11']=$n11;
		$data['m11']=$m11;
		$data['shuangSe11']=$shuangSe11;
		//echo $n11;
		//print_r($shuangSe11);
		
		//获得四等奖数据。
		preg_match('/五等奖<\/td>\s*<td>\s*.*<\/td>\s*<td>\s*.*/',$contents3,$shuangSe12);
		$shuangSe12=strip_tags($shuangSe12[0]);
		$shuangSe12=str_replace('五等奖', '', $shuangSe12);
		$shuangSe12=explode(',', $shuangSe12);
		$shuangSe12[0]=trim($shuangSe12[0]);
		$n12='';
		for($i=0;$i < strlen($shuangSe12[0]);$i++){
			if(in_array(substr($shuangSe12[0], $i,1),array('1','2','3','4','5','6','7','8','9','0'))){
				$n12.=substr($shuangSe12[0], $i,1);
			}else{
				break;
			}
		}
		$m12=str_replace($n12, '', $shuangSe12[0]);
		$data['n12']=$n12;
		$data['m12']=$m12;
		$data['shuangSe12']=$shuangSe12;
		//echo $n12;
		//print_r($shuangSe12);
		
		// print_r($data);
		$data3=$cacheCaiPiao->get('data3');
		if(!isset($data3) || $data3 == array()){
			$cacheCaiPiao->set('data3',$data,5);
		}
		//print_r($data);
		//var_dump($data1);exit;
		$this->assign('data3',$data);		
		$footerFlag=1;
		$headerFlag=1;
		$this->assign('headerFlag',$headerFlag);
		$this->assign('footerFlag',$footerFlag);
		$this->assign('color2',$color2);
		$titleKey='彩票查询-快查';
		$this->assign('titleKey',$titleKey);
		$flag="shenghuo";
		$this->assign('flag',$flag);
		$this->display();
	}
}
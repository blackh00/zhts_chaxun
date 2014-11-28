<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-27 下午5:32:02
 * @version 1.0
 */
class HoroscopeAction extends Action{
	
	
	// 控制器初始化方法。
	function _initialize(){
	
		$flag="zonghe";
		$this->assign('flag',$flag);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
		$this->assign("footerFlag", 1); 
	}
	
	//星座运势首页显示。
	public function index(){
		
		/* echo "今天:".date("Ymd")."<br>";
		echo "明天:".date("Ymd",strtotime("+1 day")). "<br>";
		echo "一周后:".date("Ymd",strtotime("+1 week")). "<br>";  */
		
		// 定义星座数组、日期数组。
		$horoscopeCategory=array('aries'=>'白羊座','taurus'=>'金牛座','gemini'=>'双子座','cancer'=>'巨蟹座','leo'=>'狮子座','virgo'=>'处女座','libra'=>'天秤座','scorpio'=>'天蝎座','sagittarius'=>'射手座','capricorn'=>'魔羯座','aquarius'=>'水瓶座','pisces'=>'双鱼座');
		$horoscopeDate=array('aries'=>'3.21-4.19','taurus'=>'4.20-5.20','gemini'=>'5.21-6.21','cancer'=>'6.22-7.22','leo'=>'7.23-8.22','virgo'=>'8.23-9.22','libra'=>'9.23-10.23','scorpio'=>'10.24-11.22','sagittarius'=>'11.23-12.21','capricorn'=>'12.22-1.19','aquarius'=>'1.20-2.18','pisces'=>'2.19-3.20');
		
		
		if(!isset($_REQUEST['cate']) || $_REQUEST['cate'] == ''){
			$cate='aries';
		}else{
			$cate=$_REQUEST['cate'];
		}
		$cacheCaiPiao = Cache::getInstance('file');
		$data=$cacheCaiPiao->get('data');
		if(isset($data[$cate]) && $data[$cate] != array() && $data[$cate] != null){
			
			
			$today=date('d',time());  // 获得今天多少号。
			$tomorrow=date('d',strtotime("+1 day")); // 获得明天多少号。
			$tomonth=date('m',strtotime("+1 day")); // 获得明天多少号。
			$toyear=date('Y',strtotime("+1 day")); // 获得明天多少号。
			
			
			// 获得今天是多少周。
			$datearr = getdate();
			$year = strtotime($datearr['year'].'-1-1');
			$startdate = getdate($year);
			$firstweekday = 7-$startdate['wday'];//获得第一周几天
			$yday = $datearr['yday']+1-$firstweekday;//今年的第几天
			$week = ceil($yday/7)+1;//取到第几周
			// print_r($datearr);
			// echo "明天:".date("d",strtotime("+1 day")). "<br>";
			
			$month=date('m',time()); // 获得今天是多少月。
			$year=date('Y',time()); // 获得今年的年份。
			
			$this->assign('today',$today);
			$this->assign('tomorrow',$tomorrow);
			$this->assign('week',$week);
			$this->assign('month',$month);
			$this->assign('year',$year);
			$this->assign('tomonth',$tomonth);
			$this->assign('toyear',$toyear);
			
			$this->assign('cate',$cate);
			$this->assign('data',$data);
			$this->assign('horoscopeCategory',$horoscopeCategory);
			$this->assign('horoscopeDate',$horoscopeDate);
			$titleKey='星座运势查询-快查';
			$this->assign('titleKey',$titleKey);
			//echo "321";
			//var_dump($data);
			$this->display();
			return true;
		}
		
		
		
		// 获得星座运势今日运势的数据。		
		$contents = @file_get_contents("http://vip.astro.sina.com.cn/iframe/astro/view/".$cate."/day/");
		preg_match('/综合运势<\/h4>\s*<p>\s*.*\s*<\/p>/', $contents, $arr1);
		$str1 = preg_match_all('/<img/', $arr1[0],$temp);
		$data1['zonghe']=$str1;
		//var_dump($str1);exit;
		
		preg_match('/爱情运势<\/h4>\s*<p>\s*.*\s*<\/p>/', $contents, $arr2);
		$str2 = preg_match_all('/<img/', $arr2[0],$temp);
		$data1['aiqing']=$str2;
		//0var_dump($str2);exit;
		
		preg_match('/工作状况<\/h4>\s*<p>\s*.*\s*<\/p>/', $contents, $arr3);
		$str3 = preg_match_all('/<img/', $arr3[0],$temp);
		$data1['gongzuo']=$str3;
		//var_dump($str3);exit;
		
		preg_match('/理财投资<\/h4>\s*<p>\s*.*\s*<\/p>/', $contents, $arr4);
		$str4 = preg_match_all('/<img/', $arr4[0],$temp);
		$data1['licai']=$str4;
		//var_dump($str4);exit;
		
		preg_match('/健康指数<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $arr5);
		$str5=$arr5[1];
		$data1['jiankang']=$str5;
		//var_dump($str5);exit;
		
		preg_match('/商谈指数<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $arr6);
		$str6=$arr6[1];
		$data1['shangtan']=$str6;
		//var_dump($str6);exit;
		
		preg_match('/幸运颜色<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $arr7);
		$str7=$arr7[1];
		$data1['yanse']=$str7;
		//var_dump($str7);exit;
		
		preg_match('/幸运数字<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $arr8);
		$str8=$arr8[1];
		$data1['shuzi']=$str8;
		//var_dump($str8);exit;
		
		preg_match('/速配星座<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $arr9);
		$str9=$arr9[1];
		$data1['supei']=$str9;
		//var_dump($str9);exit;	

		preg_match('/<div class=\"lotconts\">(.*)<\/div>/', $contents, $arr10);
		$str10=$arr10[1];
		$str10=strip_tags($str10);
		$str10=trim($str10);
		$data1['gaishu']=$str10;
		//var_dump($str10);exit;
		
		
		
		
		
		// 获得星座运势明日运势的数据。
		$contents = @file_get_contents("http://vip.astro.sina.com.cn/iframe/astro/view/".$cate."/day/".date("Ymd",strtotime("+1 day")));
		preg_match('/综合运势<\/h4>\s*<p>\s*.*\s*<\/p>/', $contents, $tarr1);
		$tstr1 = preg_match_all('/<img/', $tarr1[0],$temp);
		$data2['zonghe']=$tstr1;
		//var_dump($tstr1);exit;
		
		preg_match('/爱情运势<\/h4>\s*<p>\s*.*\s*<\/p>/', $contents, $tarr2);
		$tstr2 = preg_match_all('/<img/', $tarr2[0],$temp);
		$data2['aiqing']=$tstr2;
		//0var_dump($tstr2);exit;
		
		preg_match('/工作状况<\/h4>\s*<p>\s*.*\s*<\/p>/', $contents, $tarr3);
		$tstr3 = preg_match_all('/<img/', $tarr3[0],$temp);
		$data2['gongzuo']=$tstr3;
		//var_dump(t$str3);exit;
		
		preg_match('/理财投资<\/h4>\s*<p>\s*.*\s*<\/p>/', $contents, $tarr4);
		$tstr4 = preg_match_all('/<img/', $tarr4[0],$temp);
		$data2['licai']=$tstr4;
		//var_dump($tstr4);exit;
		
		preg_match('/健康指数<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $tarr5);
		$tstr5=$tarr5[1];
		$data2['jiankang']=$tstr5;
		//var_dump($tstr5);exit;
		
		preg_match('/商谈指数<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $tarr6);
		$tstr6=$tarr6[1];
		$data2['shangtan']=$tstr6;
		//var_dump($tstr6);exit;
		
		preg_match('/幸运颜色<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $tarr7);
		$tstr7=$tarr7[1];
		$data2['yanse']=$tstr7;
		//var_dump($tstr7);exit;
		
		preg_match('/幸运数字<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $tarr8);
		$tstr8=$tarr8[1];
		$data2['shuzi']=$tstr8;
		//var_dump($tstr8);exit;
		
		preg_match('/速配星座<\/h4>\s*<p>\s*(.*)\s*<\/p>/', $contents, $tarr9);
		$tstr9=$tarr9[1];
		$data2['supei']=$tstr9;
		//var_dump($tstr9);exit;
		
		preg_match('/<div class=\"lotconts\">(.*)<\/div>/', $contents, $tarr10);
		$tstr10=$tarr10[1];
		$data2['gaishu']=$tstr10;
		//var_dump($tstr10);exit;
		
		
		
				
		
		// 获得星座运势本周运势的数据。
		$contents = @file_get_contents("http://vip.astro.sina.com.cn/iframe/astro/view/".$cate."/weekly/");
		preg_match('/<h4>\s*整体运势\s*(.*)\s*<\/h4>\s*<p>(.*)<\/p>/', $contents, $brr1);		
		$bstr1=preg_match_all('/<img/', $brr1[1],$temp);
		$bstr2=$brr1[2];
		$bstr2=trim($bstr2);
		$data3['zhengti1']=$bstr1;
		$data3['zhengti2']=$bstr2;
		//var_dump($bstr1);
		//var_dump($bstr2);exit;
		
		preg_match('/<h4>爱情运势<\/h4>\s<em>(.*)<\/em>\s*<p>(.*)<\/p>/', $contents, $brr2);
		$bstr3=preg_match_all('/<img/', $brr2[1],$temp);
		$bstr4=$brr2[2];
		$bstr4=trim($bstr4);
		$data3['aiqing1']=$bstr3;
		$data3['aiqing2']=$bstr4;
		//echo $bstr3; echo $bstr4;exit;
		
		preg_match('/<h4>\s*健康运势\s*(.*)\s*<\/h4>\s*<p>(.*)<\/p>/', $contents, $brr3);
		$bstr5=preg_match_all('/<img/', $brr3[1],$temp);
		$bstr6=$brr3[2];
		$bstr6=trim($bstr6);
		$data3['jiankang1']=$bstr5;
		$data3['jiankang2']=$bstr6;
		//var_dump($bstr5);
		//var_dump($bstr6);exit;
		
		preg_match('/<h4>\s*工作学业运\s*(.*)\s*<\/h4>\s*<p>(.*)<\/p>/', $contents, $brr4);
		$bstr7=preg_match_all('/<img/', $brr4[1],$temp);
		$bstr8=$brr4[2];
		$bstr8=trim($bstr8);
		$data3['gongzuo1']=$bstr7;
		$data3['gongzuo2']=$bstr8;
		//var_dump($bstr7);
		//var_dump($bstr8);exit;
		
		preg_match('/<h4>\s*性欲指数\s*(.*)\s*<\/h4>\s*<p>(.*)<\/p>/', $contents, $brr5);
		$bstr9=preg_match_all('/<img/', $brr5[1],$temp);
		$bstr10=$brr5[2];
		$bstr10=trim($bstr10);
		$data3['xingyu1']=$bstr9;
		$data3['xingyu2']=$bstr10;
		//var_dump($bstr9);
		//var_dump($bstr10);exit;
		
		preg_match('/<h4>红心日<\/h4>\s*<p>\s*(.*)/', $contents, $brr6);
		$strTemp=$brr6[1];
		$bstr11=preg_replace('/[0-9]{0,}/', '' ,$strTemp);
		$bstr11=strip_tags($bstr11);
		$bstr11=trim($bstr11);
		$bstr12=preg_replace('/[^0-9]{0,}/', '' ,$strTemp);
		$bstr12=strip_tags($bstr12);
		$bstr12=trim($bstr12);
		$data3['honger1']=$bstr11;
		$data3['honger2']=$bstr12;
		//echo $bstr11; echo $bstr12;exit;
		
		preg_match('/<h4>黑梅日<\/h4>\s*<p>\s*(.*)/', $contents, $brr6);
		$strTemp=$brr6[1];
		$bstr13=preg_replace('/[0-9]{0,}/', '' ,$strTemp);
		$bstr13=strip_tags($bstr13);
		$bstr13=trim($bstr13);
		$bstr14=preg_replace('/[^0-9]{0,}/', '' ,$strTemp);
		$bstr14=strip_tags($bstr14);
		$bstr14=trim($bstr14);
		$data3['heimei1']=$bstr13;
		$data3['heimei2']=$bstr14;
		//echo $bstr13; echo $bstr14;exit;
		
		
		
		// 获得星座运势本月运势的数据。
		$contents = @file_get_contents("http://vip.astro.sina.com.cn/iframe/astro/view/".$cate."/monthly/");
		preg_match('/<h4>\s*整体运势\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)/', $contents, $crr1);
		$cstr1=preg_match_all('/<img/', $crr1[1],$temp);
		$cstr2=$crr1[2].$crr1[3];
		$cstr2=strip_tags($cstr2);
		$cstr2=trim($cstr2);
		$data4['zhengti1']=$cstr1;
		$data4['zhengti2']=$cstr2;
		//var_dump($cstr1);
		//var_dump($cstr2);exit;
		
		preg_match('/<h4>\s*爱情运势\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)\s*(.*)/', $contents, $crr2);
		$cstr3=preg_match_all('/<img/', $crr2[1],$temp);
		$cstr4=$crr2[2].$crr2[3].$crr2[4];
		$cstr4=strip_tags($cstr4);
		$cstr4=trim($cstr4);
		$data4['aiqing1']=$cstr3;
		$data4['aiqing2']=$cstr4;
		//var_dump($cstr3);
		//var_dump($cstr4);exit;
		
		preg_match('/<h4>\s*投资理财运\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)/', $contents, $crr3);
		$cstr5=preg_match_all('/<img/', $crr3[1],$temp);
		$cstr6=$crr3[2].$crr3[3];
		$cstr6=strip_tags($cstr6);
		$cstr6=trim($cstr6);
		$data4['touzhi1']=$cstr5;
		$data4['touzhi2']=$cstr6;
		//var_dump($cstr5);
		//var_dump($cstr6);exit;
		
		preg_match('/<h4>\s*解压方式\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)/', $contents, $crr4);
		//$cstr7=preg_match_all('/<img/', $crr4[1],$temp);
		$cstr8=$crr4[2].$crr4[3];
		$cstr8=strip_tags($cstr8);
		
		$cstr8=trim($cstr8);
		$cstr8=preg_replace('/解压方式：/', '', $cstr8);
		$data4['jieya2']=$cstr8;
		//var_dump($cstr7);
		//var_dump($cstr8);exit;
		
		preg_match('/<h4>\s*开运小秘诀\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)/', $contents, $crr5);
		//$cstr9=preg_match_all('/<img/', $crr5[1],$temp);
		$cstr10=$crr5[2].$crr5[3];
		$cstr10=strip_tags($cstr10);
		$cstr10=trim($cstr10);
		$cstr10=preg_replace('/幸运物：/', '', $cstr10);
		$data4['kaiyun2']=$cstr10;
		//var_dump($cstr9);
		//var_dump($cstr10);exit;
		
		
		
		
		// 获得星座运势本年运势的数据。
		$contents = @file_get_contents("http://vip.astro.sina.com.cn/iframe/astro/view/".$cate."/year/");
		preg_match('/<h4>\s*整体概况\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)/', $contents, $drr1);
		$dstr1=preg_match_all('/<img/', $drr1[1],$temp);
		$dstr2=$drr1[2].$drr1[3];
		$dstr2=strip_tags($dstr2);
		$dstr2=trim($dstr2);
		$data5['zhengti1']=$dstr1;
		$data5['zhengti2']=$dstr2;
		//var_dump($dstr1);
		//var_dump($dstr2);exit;
		
		preg_match('/<h4>\s*功课学业\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)/', $contents, $drr2);
		$dstr3=preg_match_all('/<img/', $drr2[1],$temp);
		$dstr4=$drr2[2].$drr2[3];
		$dstr4=strip_tags($dstr4);
		$dstr4=trim($dstr4);
		$data5['gongke1']=$dstr3;
		$data5['gongke2']=$dstr4;
		//var_dump($dstr3);
		//var_dump($dstr4);exit;
		
		preg_match('/<h4>\s*工作职场\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)/', $contents, $drr3);
		$dstr5=preg_match_all('/<img/', $drr3[1],$temp);
		$dstr6=$drr3[2].$drr3[3];
		$dstr6=strip_tags($dstr6);
		$dstr6=trim($dstr6);
		$data5['gongzuo1']=$dstr5;
		$data5['gongzuo2']=$dstr6;
		//var_dump($dstr5);
		//var_dump($dstr6);exit;
		
		preg_match('/<h4>\s*金钱理财\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)/', $contents, $drr4);
		$dstr7=preg_match_all('/<img/', $drr4[1],$temp);
		$dstr8=$drr4[2].$drr4[3];
		$dstr8=strip_tags($dstr8);
		$dstr8=trim($dstr8);
		$data5['jinqian1']=$dstr7;
		$data5['jinqian2']=$dstr8;
		//var_dump($dstr7);
		//var_dump($dstr8);exit;
		
		preg_match('/<h4>\s*恋爱婚姻\s*(.*)\s*<\/h4>\s*<p>(.*)\s*(.*)/', $contents, $drr5);
		$dstr9=preg_match_all('/<img/', $drr5[1],$temp);
		$dstr10=$drr5[2].$drr5[3];
		$dstr10=strip_tags($dstr10);
		$dstr10=trim($dstr10);
		$data5['lianai1']=$dstr9;
		$data5['lianai2']=$dstr10;
		//var_dump($dstr9);
		//var_dump($dstr10);exit;	
		$data[$cate][]=$data1;		
		$data[$cate][]=$data2;
		$data[$cate][]=$data3;
		$data[$cate][]=$data4;
		$data[$cate][]=$data5;
		$cacheCaiPiao->set('data',$data,36000);
		//echo "123";
		//var_dump($data);
		
		$today=date('d',time());  // 获得今天多少号。
		$tomorrow=date('d',strtotime("+1 day")); // 获得明天多少号。
		$tomonth=date('m',strtotime("+1 day")); // 获得明天多少号。
		$toyear=date('Y',strtotime("+1 day")); // 获得明天多少号。
		
		
		// 获得今天是多少周。
		$datearr = getdate();
		$year = strtotime($datearr['year'].'-1-1');
		$startdate = getdate($year);
		$firstweekday = 7-$startdate['wday'];//获得第一周几天
		$yday = $datearr['yday']+1-$firstweekday;//今年的第几天
		$week = ceil($yday/7)+1;//取到第几周
		
		// print_r($datearr);
		// echo "明天:".date("d",strtotime("+1 day")). "<br>";
		
		$month=date('m',time()); // 获得今天是多少月。
		$year=date('Y',time()); // 获得今年的年份。
		
		$this->assign('today',$today);
		$this->assign('tomorrow',$tomorrow);
		$this->assign('week',$week);
		$this->assign('month',$month);
		$this->assign('year',$year);
		$this->assign('tomonth',$tomonth);
		$this->assign('toyear',$toyear);
		$this->assign('cate',$cate);
		$this->assign('data',$data);
		$this->assign('horoscopeCategory',$horoscopeCategory);
		$this->assign('horoscopeDate',$horoscopeDate);
		$titleKey='星座运势查询-快查';
		$this->assign('titleKey',$titleKey);
		$this->display();
	}
}
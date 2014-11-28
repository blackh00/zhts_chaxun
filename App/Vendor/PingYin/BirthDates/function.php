<?php
require_once('rli.php');

// 十天干

$a[21] = "甲";;
$a[22] = "乙";
$a[23] = "丙";
$a[24] = "丁";
$a[25] = "戊";
$a[26] = "己";
$a[27] = "庚";
$a[28] = "辛";
$a[29] = "壬";
$a[20] = "癸";

// 十二地支
$a[31] = "子";
$a[32] = "丑";
$a[33] = "寅";
$a[34] = "卯";
$a[35] = "辰";
$a[36] = "巳";
$a[37] = "午";
$a[38] = "未";
$a[39] = "申";
$a[40] = "酉";
$a[41] = "戌";
$a[30] = "亥";



// '星期名
$WeekName[0] = " * ";
$WeekName[1] = "星期日";
$WeekName[2] = "星期一";
$WeekName[3] = "星期二";
$WeekName[4] = "星期三";
$WeekName[5] = "星期四";
$WeekName[6] = "星期五";
$WeekName[7] = "星期六";

// '天干名称
$TianGan[0] = "甲";
$TianGan[1] = "乙";
$TianGan[2] = "丙";
$TianGan[3] = "丁";
$TianGan[4] = "戊";
$TianGan[5] = "己";
$TianGan[6] = "庚";
$TianGan[7] = "辛";
$TianGan[8] = "壬";
$TianGan[9] = "癸";

// '地支名称
$DiZhi[0] = "子";
$DiZhi[1] = "丑";
$DiZhi[2] = "寅";
$DiZhi[3] = "卯";
$DiZhi[4] = "辰";
$DiZhi[5] = "巳";
$DiZhi[6] = "午";
$DiZhi[7] = "未";
$DiZhi[8] = "申";
$DiZhi[9] = "酉";
$DiZhi[10] = "戌";
$DiZhi[11] = "亥";

// '属相名称
$ShuXiang[0] = "鼠";
$ShuXiang[1] = "牛";
$ShuXiang[2] = "虎";
$ShuXiang[3] = "兔";
$ShuXiang[4] = "龙";
$ShuXiang[5] = "蛇";
$ShuXiang[6] = "马";
$ShuXiang[7] = "羊";
$ShuXiang[8] = "猴";
$ShuXiang[9]="鸡";
$ShuXiang[10]="狗";
$ShuXiang[11]="猪";

// '到此，完成了农历向阳历的转换
$bzyear=$_POST['nian'];
$bzmonth=$_POST['yue'];
$bzday=$_POST['ri'];
$bztime=$_POST['hh'];
$nian1=$_POST['nian'];
$yue1=$_POST['yue'];
$ri1=$_POST['ri'];
$hh1=$_POST['hh'];
$sx=$ShuXiang[($_POST['nian'] - 1900) % 12];
$nlnian = $TianGan[(($_POST['nian'] - 4) % 60) % 10].$DiZhi[(($_POST['nian'] - 4) % 60) % 12];
$lunar = new Lunar();
$yige_org_date=$lunar->convertSolarToLunar($_POST['nian'],$_POST['yue'], $_POST['ri']);
// echo $yige_org_date[0]."-".$yige_org_date[1]."-".$yige_org_date[2];


// '确定节气 yz 月支  起运基数 qyjs
$md=$bzmonth * 100 + $bzday;
if($md >= 204 && $md <= 305){
	$mz=3;
	$qyjs=(($bzmonth - 2) * 30 + $bzday - 4)/3;
}
if($md >= 306 && $md <=404){
	$mz=4;
	$qyjs=(($bzmonth - 3) * 30 +$bzday - 6)/3;
}
if($md >= 405 && $md <=504){
	$mz=5;
	$qyjs=(($bzmonth - 4) * 30 +$bzday - 5)/3;
}
if($md >= 505 && $md <=605){
	$mz=6;
	$qyjs=(($bzmonth - 5) * 30 +$bzday - 5)/3;
}
if($md >= 606 && $md <=706){
	$mz=7;
	$qyjs=(($bzmonth - 6) * 30 +$bzday - 6)/3;
}
if($md >= 707 && $md <=807){
	$mz=8;
	$qyjs=(($bzmonth - 7) * 30 +$bzday - 7)/3;
}
if($md >= 808 && $md <=907){
	$mz=8;
	$qyjs=(($bzmonth - 8) * 30 +$bzday - 8)/3;
}
if($md >= 908 && $md <=1007){
	$mz=10;
	$qyjs=(($bzmonth - 9) * 30 +$bzday - 8)/3;
}
if($md >= 1008 && $md <=1106){
	$mz=11;
	$qyjs=(($bzmonth - 10) * 30 +$bzday - 8)/3;
}
if($md >= 1107 && $md <=1207){
	$mz=0;
	$qyjs=(($bzmonth - 11) * 30 +$bzday - 7)/3;
}
if($md >= 1208 && $md <=1231){
	$mz=1;
	$qyjs=($bzday - 8)/3;
}
if($md >= 101 && $md <=105){
	$mz=1;
	$qyjs=(30 + $bzday - 4)/3;
}
if($md >= 106 && $md <=203){
	$mz=2;
	$qyjs=(($bzmonth - 1) * 30 + $bzday - 6) / 3;
}


// '确定年干和年支 yg 年干 yz 年支
if($md >= 204 && $md <=1231){
	$yg=($bzyear-3)%10;
	$yz=($bzyear-3)%12;
}
if($md >=101 && $md <= 203){
	$yg=($bzyear-4)%10;
	$yz=($bzyear-4)%12;
}

// '确定月干 mg 月干
if($mz>2 && $mz<=11){
	$mg=($yg*2 + $mz +8)%10;
}else{
	$mg=( $yg*2 + $mz)%10;
}

// '从公元0年到目前年份的天数 yearlast
 $yearlast = ($bzyear - 1) * 5 + ($bzyear - 1) / 4 - ($bzyear - 1) / 100 + ($bzyear - 1) / 400;
 
// '计算某月某日与当年1月0日的时间差（以日为单位）yearday
 $yearday=0;
 for($i=1;$i<=$bzmonth-1;$i++){
 	switch($i){
 		case 1: $yearday=$yearday+31;break;
 		case 3: $yearday=$yearday+31;break;
 		case 5: $yearday=$yearday+31;break;
 		case 7: $yearday=$yearday+31;break;
 		case 8: $yearday=$yearday+31;break;
 		case 10: $yearday=$yearday+31;break;
 		case 12: $yearday=$yearday+31;break;
 		case 4: $yearday=$yearday+30;break;
 		case 6: $yearday=$yearday+30;break;
 		case 9: $yearday=$yearday+30;break;
 		case 11: $yearday=$yearday+30;break;
 		case 2: if(($bzyear % 4 == 0) && (($bzyear % 100) != 0) || ($bzyear % 400 == 0)){$yearday=$yearday+29;}else{$yearday=$yearday+28;};break;
 		default:break;
 	}
 }
 $yearday=$yearday+$bzday;
 
// '计算日的六十甲子数 day60
 $day60 = ($yearlast + $yearday + 6015) % 60;
 
// '确定 日干 dg  日支  dz
  $dg = $day60 % 10;
  $dz = $day60 % 12;
  
  
// '确定 时干 tg 时支 tz
  $tz =(($bztime + 3) / 2) % 12;
  
  if($tz==0){
  	$tg=($dg*2 + $tz)%10;
  }else{
  	$tg=($dg*2 + $tz +8)%10;
  }



// '到此，完成各地支所纳天干的确定任务
$yg1=$a[20 + $yg];
$yz1=$a[30 + $yz];
$mg1=$a[20 + $mg];
$mz1=$a[30 + $mz];
$dg1=$a[20 + $dg];
$dz1=$a[30 + $dz];
$tg1=$a[20 + $tg];
$tz1=$a[30 + $tz];
$ygz=$a[20 + $yg].$a[30 + $yz];
$mgz=$a[20 + $mg].$a[30 + $mz];
$dgz=$a[20 + $dg].$a[30 + $dz];
$tgz=$a[20 + $tg].$a[30 + $tz];


function layin($tgdz){
	$res=M('birthdate_jiazi');
	$layin=$res->where("jiazi='".$tgdz."'")->find();
	$num=$res->where("jiazi='".$tgdz."'")->count();
	return $layin['layin'];
}

function tgdzwh($tgdz){
		
	switch ($tgdz){
	case "子": $wh="水";break;
	case "亥": $wh="水";break;
	case "寅": $wh="木";break;
	case "卯": $wh="木";break;
	case "巳": $wh="火";break;
	case "午": $wh="火";break;
	case "申": $wh="金";break;
	case "酉": $wh="金";break;
	case "辰": $wh="土";break;
	case "戌": $wh="土";break;
	case "丑": $wh="土";break;
	case "未": $wh="土";break;
	case "甲": $wh="木";break;
	case "乙": $wh="木";break;
	case "丙": $wh="火";break;
	case "丁": $wh="火";break;
	case "戊": $wh="土";break;
	case "己": $wh="土";break;
	case "庚": $wh="金";break;
	case "辛": $wh="金";break;
	case "壬": $wh="水";break;
	case "癸": $wh="水";break;
	default:break;
	}
	return $wh;
}

function siji($yue){
	switch($yue){
		case '1': $sj="冬";break;
		case '2': $sj="冬";break;
		case '3': $sj="春";break;
		case '4': $sj="春";break;
		case '5': $sj="春";break;
		case '6': $sj="夏";break;
		case '7': $sj="夏";break;
		case '8': $sj="夏";break;
		case '9': $sj="秋";break;
		case '10': $sj="秋";break;
		case '11': $sj="秋";break;
		case '12': $sj="冬";break;
		default:break;
	}
	$siji=$sj;
	return $siji;
}

function DiZhi($i){
	switch($i){
	case 0:$dz="子";break;
	case 1:$dz="丑";break;
	case 2:$dz="丑";break;
	case 3:$dz="寅";break;
	case 4:$dz="寅";break;
	case 5:$dz="卯";break;
	case 6:$dz="卯";break;
	case 7:$dz="辰";break;
	case 8:$dz="辰";break;
	case 9:$dz="巳";break;
	case 10:$dz="巳";break;
	case 11:$dz="午";break;
	case 12:$dz="午";break;
	case 13:$dz="未";break;
	case 14:$dz="未";break;
	case 15:$dz="申";break;
	case 16:$dz="申";break;
	case 17:$dz="酉";break;
	case 18:$dz="酉";break;
	case 19:$dz="戌";break;
	case 20:$dz="戌";break;
	case 21:$dz="亥";break;
	case 22:$dz="亥";break;
	case 23:$dz="子";break;
	default:break;
	}
	return $dz;
}


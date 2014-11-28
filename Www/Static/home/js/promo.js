/**
 * 点击变色效果
 */
$(function(){
	$('.pindao ul li').click(function(){
		$('.pindao ul li').removeClass('def');
		$(this).addClass('def');
	});
	$('.week_nav a').click(function(){
		$('.week_nav a').removeClass('def');
		$(this).addClass('def');
	});
	$('.pd_list ul li').click(function(){
		$('.pd_list ul li').removeClass('def');
		$(this).addClass('def');
	});
});
function select(n){
	var num = n;
	switch(num){
		case 1: 
			$('.pd_list ul').hide();
			$('#zhongyang').show();
			break;
		case 2: 
			$('.pd_list ul').hide();
			$('#jiaoyu').show();
			break;
		case 3: 
			$('.pd_list ul').hide();
			$('#zhongshu').show();
			break;
		case 4: 
			$('.pd_list ul').hide();
			$('#yangshi').show();
			break;
		case 5: 
			$('.pd_list ul').hide();
			$('#beiguang').show();
			break;
		case 6: 
			$('.pd_list ul').hide();
			$('#shuzi').show();
			break;
		default:
			break;
	}
}
/**
var nowTime = new Date();
var y 		= nowTime.getFullYear();
var m		= nowTime.getMonth()+1;
var d		= nowTime.getDate();
var time	= y+'年'+m+'月'+d+'日';
**/
var wk  = $('.week_nav .def').html();
switch(wk){
	case '星期一':
		wk  = '周一';
		break;
	case '星期二':
		wk  = '周二';
		break;
	case '星期三':
		wk  = '周三';
		break;
	case '星期四':
		wk  = '周四';
		break;
	case '星期五':
		wk  = '周五';
		break;
	case '星期六':
		wk  = '周六';
		break;
	case '星期日':
		wk  = '周日';
		break;
	default:
		break;
}
var id	= $('.pindao .def a').html();
switch(id){
	// 央视
	case '中央电视台':
		id	= 1;
		break;
	case '中国教育电视台':
		id	= 2;
		break;
	case '中数传媒':
		id	= 3;
		break;
	case '央视风云':
		id	= 4;
		break;
	case '北广传媒':
		id	= 5;
		break;
	case '数字频道':
		id	= 6;
		break;
	// 卫视
	case '各省卫视':
		id	= 1;
		break;
	case '动漫频道':
		id	= 2;
		break;
	case '电影频道':
		id	= 3;
		break;
	// 境外
	case '数字/收费频道':
		id	= 1;
		break;
	case '体育频道':
		id	= 2;
		break;
	case '音乐频道':
		id	= 3;
		break;
	case '科教频道':
		id	= 4;
		break;
	case '影视频道':
		id	= 5;
		break;
	case '国际资讯/财经频道':
		id	= 6;
		break;
	// 本地
	case '广东电视台':
		id	= 1;
		break;
	case '深圳电视台':
		id	= 2;
		break;
	case '广州电视台':
		id	= 3;
		break;
	case '珠海电视台':
		id	= 4;
		break;
	case '潮州电视台':
		id	= 5;
		break;
	case '湛江电视台':
		id	= 6;
		break;
	case '佛山电视台':
		id	= 7;
		break;
	case '肇庆电视台':
		id	= 8;
		break;
	case '惠州电视台':
		id	= 9;
		break;
	case '中山电视台':
		id	= 10;
		break;
	case '汕头电视台':
		id	= 11;
		break;
	case '茂名电视台':
		id	= 12;
		break;
	default:
		break;
}
var program	= $('.pd_list .def a').html();
switch(program){
	case 'CCTV-1（综合）':
		program = 'CCTV-1';
		break;
	case 'CCTV-2（财经）':
		program = 'CCTV-2';
		break;
	case 'CCTV-3（综艺）':
		program = 'CCTV-3';
		break;
	case 'CCTV-4中文国际（亚）':
		program = 'CCTV-4亚洲';
		break;
	case 'CCTV-5（体育）':
		program = 'CCTV-5';
		break;
	case 'CCTV-6（电影）':
		program = 'CCTV-6';
		break;
	case 'CCTV-7（军事 农业）':
		program = 'CCTV-7';
		break;
	case 'CCTV-8（电视剧）':
		program = 'CCTV-8';
		break;
	case 'CCTV-9（纪录）':
		program = 'CCTV-9';
		break;
	case 'CCTV-10（科教）':
		program = 'CCTV-10';
		break;
	case 'CCTV-11（戏曲）':
		program = 'CCTV-11';
		break;
	case 'CCTV-12（社会与法）':
		program = 'CCTV-12';
		break;
	case 'CCTV-13（新闻）':
		program = 'CCTV新闻频道';
		break;
	case 'CCTV-14（少儿）':
		program = 'CCTV少儿频道';
		break;
	case 'CCTV-15（音乐）':
		program = 'CCTV音乐频道';
		break;
	default:
		break;
}
function showInfo(c,m,p,w){
	if(c==1){ //央视
		if(w==''){
			window.location.href=$CONFIG['siteDynamicUrl']+"/promo/result/?id="+m+"&program="+p+"&week="+wk;
		}else{
			window.location.href=$CONFIG['siteDynamicUrl']+"/promo/result/?id="+id+"&program="+program+"&week="+w;
		}
	}else if(c==2){ //卫视
		if(w==''){
			window.location.href=$CONFIG['siteDynamicUrl']+"/promo/result_ws/?id="+m+"&program="+p+"&week="+wk;
		}else{
			window.location.href=$CONFIG['siteDynamicUrl']+"/promo/result_ws/?id="+id+"&program="+program+"&week="+w;
		}
	}else if(c==4){ //境外
		if(w==''){
			window.location.href=$CONFIG['siteDynamicUrl']+"/promo/result_jw/?id="+m+"&program="+p+"&week="+wk;
		}else{
			window.location.href=$CONFIG['siteDynamicUrl']+"/promo/result_jw/?id="+id+"&program="+program+"&week="+w;
		}
	}else if(c==5){ //本地
		if(w==''){
			window.location.href=$CONFIG['siteDynamicUrl']+"/promo/result_bd/?id="+m+"&program="+p+"&week="+wk;
		}else{
			window.location.href=$CONFIG['siteDynamicUrl']+"/promo/result_bd/?id="+id+"&program="+program+"&week="+w;
		}
	}
	
}
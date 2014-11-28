//JS获取url传递过来的参数
function getQueryString(name){
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}
//获取当前日期
var nowTime = new Date();
var y 		= nowTime.getFullYear();
var m		= nowTime.getMonth()+1;
var d		= nowTime.getDate();
new YMDselect('year7','month7','day7',y,m,d);
$(function(){
	$("#month7").change(function(){
		mm  	= $('#month7 :selected').html();
		month 	= mm.replace('月','');
		if(month<10){
			month	= '0'+month;
		}
		year		= getQueryString('year');
		if(year==null){
			yy  = $('#year7 :selected').html();
			year= yy.replace('年','');
		}
		day		= getQueryString('day');
		if(day==null){
			dd  = $('#day7 :selected').html();
			day = dd.replace('日','');
			if(day<10){
				day	= '0'+day;
			}
		}
		window.location.href=$CONFIG['siteDynamicUrl']+'/history/index/?year='+year+'&month='+month+'&day='+day;
	});
	$("#day7").change(function(){
		dd  	= $('#day7 :selected').html();
		day 	= dd.replace('日','');
		if(day<10){
			day	= '0'+day;
		}
		year	= getQueryString('year');
		if(year==null){
			yy  = $('#year7 :selected').html();
			year= yy.replace('年','');
		}
		month	= getQueryString('month');
		if(month==null){
			mm  = $('#month7 :selected').html();
			month = mm.replace('月','');
			if(month<10){
				month	= '0'+month;
			}
		}
		window.location.href=$CONFIG['siteDynamicUrl']+'/history/index/?year='+year+'&month='+month+'&day='+day;
	});
})
/**
$(function(){
	$("#month7").change(function(){
		yy  	= $('#year7 :selected').html();
		mm  	= $('#month7 :selected').html();
		dd  	= $('#day7 :selected').html();
		year 	= yy.replace('年','');
		month 	= mm.replace('月','');
		day 	= dd.replace('日','');
		if(month<10){
			month	= '0'+month;
		}
		if(day<10){
			day	= '0'+day;
		}
		//window.location.href='http://d.chaxun.me/history/index/year/'+year+'/month/'+month+'/day/'+day+'/';
		window.location.href=$CONFIG['siteDynamicUrl']+'/history/index/year/'+year+'/month/'+month+'/day/'+day+'/';
	});
	$("#day7").change(function(){
		yy  	= $('#year7 :selected').html();
		mm  	= $('#month7 :selected').html();
		dd  	= $('#day7 :selected').html();
		year 	= yy.replace('年','');
		month 	= mm.replace('月','');
		day 	= dd.replace('日','');
		if(month<10){
			month	= '0'+month;
		}
		if(day<10){
			day	= '0'+day;
		}
		//window.location.href='http://d.chaxun.me/history/index/year/'+year+'/month/'+month+'/day/'+day+'/';
		window.location.href=$CONFIG['siteDynamicUrl']+'/history/index/year/'+year+'/month/'+month+'/day/'+day+'/';
	});
})
**/
//图片rel
$(document).ready(function(){
	// 使用each（）方法来获得每个元素的属性	
	$('.nameInfo').each(function(){
		$(this).qtip({
			content: {
				// 设置您要使用的文字图像的HTML字符串，正确的src URL加载图像
				text: $('<img />').attr("src",$(this).attr('rel')),
				url: $(this).attr('rel'), // 使用的URL加载的每个元素的rel属性
				title:{
					text: $(this).attr("title")					
				}
			},
			position: {
				corner: {
					target: 'rightTop', // 定位上面的链接工具提示
					tooltip: 'leftBottom'
				},
				adjust: {
					screen: true // 在任何时候都保持提示屏幕上的
				}
			},
			show: { 
				when: 'mouseover', //或click 
				solo: true // 一次只显示一个工具提示
			},
			hide: {when:'mouseout'},
			style: {
				tip: true, // 设置一个语音气泡提示在指定工具提示角落的工具提示
				border: {
					width: 3,
					radius: 0
				},
				name: 'light', // 使用默认的淡样式
				width:{min: 0,
            				max: 5000
							} 
			}
		})
	});
});
//分类当前状态样式
$(document).ready(function(){
	$('.shijian_bd>ul>li').hover(function(){
		$(this).addClass('def')
	},function(){
		$(this).removeClass('def')
	})
})
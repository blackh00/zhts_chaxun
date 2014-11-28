//JS获取url传递过来的参数
function getQueryString(name){
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}
//从频道页面带yunshi参数跳转过来 ，取消默认的current
$(function(){
	var yunshi = getQueryString('yunshi');
	if(yunshi == 'month'){
		$('#today').removeClass('current');
		$('#date_today').attr('style','display:none');
		$('#today_content').attr('style','display:none');
		$('#month').addClass('current');
		$('#date_month').attr('style','display:block');
		$('#month_content').attr('style','display:block');
	}else if(yunshi == 'tomorrow'){
		$('#today').removeClass('current');
		$('#date_today').attr('style','display:none');
		$('#today_content').attr('style','display:none');
		$('#tomorrow').addClass('current');
		$('#date_tomorrow').attr('style','display:block');
		$('#tomorrow_content').attr('style','display:block');
	}else if(yunshi == 'week'){
		$('#today').removeClass('current');
		$('#date_today').attr('style','display:none');
		$('#today_content').attr('style','display:none');
		$('#week').addClass('current');
		$('#date_week').attr('style','display:block');
		$('#week_content').attr('style','display:block');
	}else if(yunshi == 'year'){
		$('#today').removeClass('current');
		$('#date_today').attr('style','display:none');
		$('#today_content').attr('style','display:none');
		$('#year').addClass('current');
		$('#date_year').attr('style','display:block');
		$('#year_content').attr('style','display:block');
	}
});

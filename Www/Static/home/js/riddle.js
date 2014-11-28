//输入验证
function riddleCheck(){
	var search= $("#search").val();
	if(search ==''){
		alert('请输入您要查找的关键字！');
		return false;
	}else{
		$("#searchForm").submit();
	}
}
//鼠标移动效果
$('.miyu_ul2>li').hover(function(){
	$('.miyu_ul2>li').removeClass('on');
	$(this).addClass('on');
	},function(){
	$('.miyu_ul2>li').removeClass('on');
});
//查看答案
function pop_show(event ,s, j){
	var str = navigator.appVersion;
	var event = event || window.event;
	var src = event.target || event.srcElement;
	s = '<p style="float:left;font-size:14px;">'+ j + '</p><p style="float:right;font-size:14px;">答案：' + s +'</p><div style="clear:both;"></div>';
	src.parentNode.innerHTML = s;
}
//判断是否是数字
function isInt(str){
	var reg = /^(-|\+)?\d+$/ ;
	return reg.test(str);
}
//分页跳转处理
function get_type_page(){
	var typeid = $('#typeid').val();
	var i_page = $('#i_page').val();
	if(isInt(i_page)==true){
		window.location.href = $CONFIG['siteDynamicUrl']+'/riddle/type/type/'+typeid+'/p/'+i_page;
	}else{
		alert('请输入正确数字');
	}
}
function get_search_page(){
	var miyu_rad = $('#miyu_radio').val();
	var search = $('#search').val();
	var i_page = $('#i_page').val();
	if(isInt(i_page)==true){
		window.location.href = $CONFIG['siteDynamicUrl']+'/riddle/search/search/'+search+'/miyu_rad/'+miyu_rad+'/p/'+i_page;
	}else{
		alert('请输入正确数字');
	}
}
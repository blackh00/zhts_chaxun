//频道页面选择验证
function submit_xzys(){
	var xingzuo = $('#xingzuo').attr('value');
	if(xingzuo == 'search'){
		alert('请选择星座！');
	}else{
		document.getElementById('form').submit();
	}
}
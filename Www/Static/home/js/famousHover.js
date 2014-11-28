$('.msg_list_detail li').hover(function(){
$(this).addClass('def');
},function(){
$(this) .removeClass('def');
}); 
function famousCheck(){
	var keyword = $('#keyword').val();
	if(keyword == '请输入人名或名人语录'){
		alert('请输入人名或名人语录');
		return false;
	}else{
		$('#form').submit();
	}
}
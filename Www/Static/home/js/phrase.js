$(function(){
	var dd = $("#chengyukey").val();
	$('.ancient_result h6 .chenyukey').each(function(key,val){
		var content = $(val).html();
		content = content.replace(dd,"<b>"+dd+"</b>");
		$(val).html(content);
	});
});
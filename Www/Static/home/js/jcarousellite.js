$(document).ready(function(){
			
		 	$("a").click( function () { 
		 		var duum = $(this).attr("id");
				var cnum = $("#id"+duum+" li").size();
				var i=0;
		 		var a_id=$(this).attr("class");
		 		var n = $("#id"+duum+" li").index($("#id"+duum+" li").filter(":visible"));
		 		if(a_id=="next"){
                	i = n >= cnum-1 ? 0 : n+1;
	            }else{
	                i = n < 0 ? cnum-1 : n-1;
	            }
	            $("#id"+duum+" li").hide().eq(i).fadeIn("fast");
		 	});

			$('.shiqu_nav li').hover(function(){
				$(this).addClass('on')
				},function(){
					$(this).removeClass('on')
					})
					
					$('.dazhou_bg').children().hover(function(){
				$(this).addClass('on')
				},function(){
					$(this).removeClass('on')
					})

		});
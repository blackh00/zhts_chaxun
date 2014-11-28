// JavaScript Document
$(document).ready(function(){
	$(".select_box input , .select_box1 input,.cp_select_box input,.cp_select_box1 input,.select_box3 input,.cy_select input").click(function(){
		var thisinput=$(this);
		var thisul=$(this).parent().find("ul");
		if(thisul.css("display")=="none"){
			if(thisul.height()>200){thisul.css({height:"200"+"px","overflow-y":"scroll" })};
			thisul.fadeIn("0");
			thisul.hover(function(){},function(){thisul.fadeOut("0");})
			thisul.find("li").click(function(){thisinput.val($(this).text());thisul.fadeOut("0");}).hover(function(){$(this).addClass("hover");},function(){$(this).removeClass("hover");});
			}
		else{
			thisul.fadeOut("0");
			}
	})
});


$(document).ready(function(){
	$(".select_box4 input").click(function(){
		var thisinput=$(this);
		var thisul=$(this).parent().find(".changdu");
		if(thisul.css("display")=="none"){
			if(thisul.height()>300){thisul.css({height:"200"+"px","overflow-y":"scroll" })};
			thisul.show();
			thisul.find("li").click(function(){thisinput.val($(this).text());thisul.hide();}).hover(function(){$(this).addClass("hover");},function(){$(this).removeClass("hover");});
			}
		else{
			thisul.show("normal");
			}
	})
	$('.guanbi').click(function(){
		$(".changdu").hide()
		})
});

$(document).ready(function(){
	$("#lottery_type").change(function(){
		window.location.href=$CONFIG['siteDynamicUrl'] + "/lottery/" + $(this).children('option:selected').val();
	});
});

$(document).ready(function(){
	$("#lottery_help").change(function(){
		window.location.href=$CONFIG['siteDynamicUrl'] + "/lottery/" + $(this).children('option:selected').val();
	});
});

$(document).ready(function(){ 
	$("#lottery_qihao").change(function(){
		window.location.href=window.location.href + "/qishu/" + $(this).children('option:selected').val();
	});
});


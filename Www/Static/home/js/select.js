// JavaScript Document
/***
$(document).ready(function(){
	$(".select_box input , .select_box1 input").click(function(){
		var thisinput=$(this);
		var thisul=$(this).parent().find("ul");
		if(thisul.css("display")=="none"){
			if(thisul.height()>200){thisul.css({height:"200"+"px","overflow-y":"scroll" })};
			thisul.fadeIn("100");
			thisul.hover(function(){},function(){thisul.fadeOut("100");})
			thisul.find("li").click(function(){thisinput.val($(this).text());thisul.fadeOut("100");}).hover(function(){$(this).addClass("hover");},function(){$(this).removeClass("hover");});
			}
		else{
			thisul.fadeOut("fast");
			}
	})
});   **/

// JavaScript Document
$(document).ready(function(){
	$(".select_box input , .select_box3 input , .select_box1 input,.cp_select_box input,.cp_select_box1 input").click(function(){
		var thisinput=$(this);
		var thisul=$(this).parent().find("ul");
		if(thisul.css("display")=="none"){
			if(thisul.height()>200){thisul.css({height:"200"+"px","overflow-y":"scroll" })};
			thisul.fadeIn("100");
			thisul.hover(function(){},function(){thisul.fadeOut("100");})
			thisul.find("li").click(function(){thisinput.val($(this).text());thisul.fadeOut("100");$(".week"+$(this).attr("name")).show().siblings(".weekconent").hide();}).hover(function(){$(this).addClass("hover");},function(){$(this).removeClass("hover");});
			}
		else{
			thisul.fadeOut("fast");
			}
	});
	
	// 为输入框添加回车事件
	 $("#myselect").keypress(function(event){
		var e = event||window.event;
		if(e.keyCode=="13"){
			$('#form1').submit();
		}
		});
});


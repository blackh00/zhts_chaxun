/**
 * 计量单位换算器切换tab功能
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-23 下午4:11:36
 * @version 1.0
 */
$('#cd').click(function(){
	$('.danwe_nav ul li').removeClass('def');
	$('#cd').addClass('def');
	$('#wendu,#gonglv,#mianji,#tiji,#redu,#yali,#zhongliang').hide();
	$('#changdu').show();
	data_reset();
});
$('#wd').click(function(){
	$('.danwe_nav ul li').removeClass('def');
	$('#wd').addClass('def');
	$('#changdu,#gonglv,#mianji,#tiji,#redu,#yali,#zhongliang').hide();
	$('#wendu').show();
	data_reset();
});
$('#rd').click(function(){
	$('.danwe_nav ul li').removeClass('def');
	$('#rd').addClass('def');
	$('#changdu,#gonglv,#mianji,#tiji,#wendu,#yali,#zhongliang').hide();
	$('#redu').show();
	data_reset();
});
$('#gl').click(function(){
	$('.danwe_nav ul li').removeClass('def');
	$('#gl').addClass('def');
	$('#changdu,#wendu,#mianji,#tiji,#redu,#yali,#zhongliang').hide();
	$('#gonglv').show();
	data_reset();
});
$('#yl').click(function(){
	$('.danwe_nav ul li').removeClass('def');
	$('#yl').addClass('def');
	$('#changdu,#gonglv,#mianji,#tiji,#redu,#wendu,#zhongliang').hide();
	$('#yali').show();
	data_reset();
});
$('#zl').click(function(){
	$('.danwe_nav ul li').removeClass('def');
	$('#zl').addClass('def');
	$('#changdu,#gonglv,#mianji,#tiji,#redu,#yali,#wendu').hide();
	$('#zhongliang').show();
	data_reset();
});
$('#mj').click(function(){
	$('.danwe_nav ul li').removeClass('def');
	$('#mj').addClass('def');
	$('#changdu,#gonglv,#wendu,#tiji,#redu,#yali,#zhongliang').hide();
	$('#mianji').show();
	data_reset();
});
$('#tj').click(function(){
	$('.danwe_nav ul li').removeClass('def');
	$('#tj').addClass('def');
	$('#changdu,#gonglv,#mianji,#wendu,#redu,#yali,#zhongliang').hide();
	$('#tiji').show();
	data_reset();
});
//计量单位计算器单位选择功能
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
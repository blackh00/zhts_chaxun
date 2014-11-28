function showMenu(e){
	$(e).next(".credentialsMenu").toggle();
}
$(document).bind("click",function(e){
	if($(e.target).parents(".credentialsMenu").length == 0 && $(e.target).attr("class") !== "dropdown_a"){
		$(".credentialsMenu").css({display: "none"});
	}
})
function showdiv(){
	$("#pic_"+ctype).show();
	$("#pic_new").hide();
}
//证书名字
$("input[name='title']").bind("keyup",function(e){
	var val = $(this).val().substring(0.5);
	$("input[name='title']").val(val);
	$(".zjName").html(val);
	showdiv();
}).bind("focus",function(e){
	if($(this).val() == "最多5字"){
		$(this).val("");
	}
}).bind("blur",function(e){
	if($(this).val() == ""){
		$(this).val("最多5字");
		$(".zjName").html('<img src=$CONFIG["staticUrl"]+"/images/funnyweb/normal_zjName.png" />');
	}
})
//颁发机构
$("input[name='org']").bind("keyup",function(e){
	var val = common.cutStr($(this).val(),24);
	$("input[name='org']").val(val);
	$(".orgName").html(val);
	showdiv()
}).bind("focus",function(e){
	if($(this).val() == "最多12字"){
		$(this).val("");
	}
}).bind("blur",function(e){
	if($(this).val() == ""){
		$(this).val("最多12字");
		$(".orgName").html('<img src=$CONFIG["staticUrl"]+"/images/funnyweb/normal_orgName.png" />');
	}
})
//姓名
$("input[name^='name']").bind("keyup",function(e){
	var val = common.cutStr($(this).val(),8);
	$("input[name='"+e.target.name+"']").val(val);
	$("span[name='i"+e.target.name+"']").html(val);
	$(".iName2").html(val);
	$(".normal").attr("class","enter");
	showdiv();
}).bind("focus",function(e){
	if($(this).val() == "最多4字"){
		$(this).val("");
	}
}).bind("blur",function(e){
	if($(this).val() == ""){
		$(this).val("最多4字");
	}
})
//性别
$(".select_inner select").bind("change",function(e){
	var sel = $(this).val();
	if(sel ==1){
		sel = '男';
	}else{
		sel = '女';
	}
	$("input[name='sex']").val(sel);
	$("span[name='isex']").html(sel);
	showdiv();
})
//年龄
$("input[name^='age']").bind("keyup",function(e){
	var val = $(this).val().replace(/^0|[^\d]/g,'');
	$("input[name='"+e.target.name+"']").val(val);
	$("span[name='i"+e.target.name+"']").html(val);
	showdiv();
}).bind("focus",function(e){
	if($(this).val() == "最多2个数字"){
		$(this).val("");
	}
}).bind("blur",function(){
	if($(this).val() == ""){
		$(this).val("最多2个数字");
	}
})
//证书内容
$("#cont").bind("keyup",function(e){
	var val = common.cutStr($(this).val(),112)
	$(this).val(val);
	$("#icont").html(val);
	$(".normal").attr("class","enter");
	showdiv();
})
//日期
var D = new Date();
$("span[name='idate']").html(D.getFullYear()+"-"+(D.getMonth()+1)+"-"+D.getDate());

var ctype = 1;//1:diy 2:普通 3:结婚 4:奖状
function changeCred(){
	$(".credentialsMenu").hide();
	$("ul[id^='form_']").hide();
	$("div[id^='pic_']").hide();
	$(".select_inner select").attr("disabled",false);
	if(arguments[0] === undefined){//diy
		$("#form_diy").show();
		$("#pic_1").show();
		$("input[name='title']").attr("disabled",false).val("最多5字");
		$("input[name='sourceImg']").val('default');
		ctype = 1;
	}else if(arguments[0] && arguments[2] === undefined){//普通
		$("#form_common").show();
		$("#pic_2").show();
		$("#normal_image_2").hide();
		$("#normal_image_1").show();
		$("#pic_2 .backImage").attr("src",$CONFIG["staticUrl"]+"/images/funnyweb/"+arguments[0]+".png");
		$("#normal .customInput input").attr("value",arguments[1]);
		$("input[name='title']").attr("disabled","disabled").val(arguments[1]);
		$("input[name='sourceImg']").val(arguments[0]);
		ctype = 2;
	}else if(arguments[2]){//结婚和好老公
		if(arguments[2] == 1){
			$("#form_merry").show();
			$("#pic_3").show();
			$("#pic_3 .backImage").attr("src",$CONFIG["staticUrl"]+"/images/funnyweb/"+arguments[0]+".png");
			$("input[name='title']").attr("disabled","disabled").val(arguments[1]);
			$("input[name='sourceImg']").val(arguments[0]);
			ctype = 3;
		}else if(arguments[2] == 2){
			$("#form_award").show();
			$("#pic_4").show();
			$("#pic_4 .backImage").attr("src",$CONFIG["staticUrl"]+"/images/funnyweb/"+arguments[0]+".png");
			$("input[name='title']").attr("disabled","disabled").val(arguments[1]);
			$("input[name='sourceImg']").val(arguments[0]);
			ctype = 4;
		}
	}
	if(arguments[0] !== undefined && arguments[0].match(/^n/)){
		$("span[name='isex']").html("男");
		$(".select_inner select").val("1");
		$(".select_inner input").val("1");
		$(".select_inner select").attr("disabled","disabled");
	}else if(arguments[0] !== undefined && arguments[0].match(/^v/)){
		$("span[name='isex']").html("女");
		$(".select_inner select").val("2");
		$(".select_inner input").val("2");
		$(".select_inner select").attr("disabled","disabled");
	}
}
//通用函数
var common = {
	getLength:function(str){
		var realLength = 0,
			len = str.length,
			charCode = -1;
	    for (var i = 0; i < len; i++) {
	        charCode = str.charCodeAt(i);
	        if (charCode >= 0 && charCode <= 128){
	        	realLength += 1;
	        }else{
	        	realLength += 2;
	        }
	    }
	    return realLength;
	},
	cutStr:function(str,limit){
		var realLength = 0,
			len = str.length,
			charCode = -1,
			subLength = 0;
	    for (var i = 0; i < len; i++) {
	        charCode = str.charCodeAt(i);
	        if (charCode >= 0 && charCode <= 128){
	        	realLength += 1;
	        }else{
	        	realLength += 2;
	        }
	        subLength++;
	        if(realLength == limit){
	        	return str.substring(0,subLength);
	        	break;
	        }
	        if(realLength >= limit){
	        	return str.substring(0,subLength-1);
	        	break;
	        }
	    }
	    return str;
	},
	getFullPath:function(obj) {//得到图片的完整路径
    if (obj) {  
        //ie  
        if (window.navigator.userAgent.indexOf("MSIE") >= 1) {  
            return obj.value;  
        //    return document.selection.createRange().text;  
        }  
        //firefox  
        else if (window.navigator.userAgent.indexOf("Firefox") >= 1) {  
            if (obj.files) {  
                return window.URL.createObjectURL(obj.files[0]);
            }  
            return obj.value;  
        }  
        return obj.value;  
    }  
}
};
//验证表单
function checkform(form){
	var success = true;
	$("#"+form+" input[type='text']").each(function(o){
		if($(this).val() == "" || new RegExp("^最多","g").test($(this).val())){
			success = false;
			return false;
		}
	})
	return success;
}
window.onload = function(){
	$("input[name='title']").attr("disabled",false).val("最多5字");
	$("select[name='ssex']").attr("disabled",false);
	$(".credentialsMenu").html($("#zjMenu").html());
}
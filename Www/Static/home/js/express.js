/**
*功能：与快递相关js
*作者：yumao
*联系方式:QQ:916564404
*创建日期:2013/4/18
*/
function changeContent(id,obj){
	
	// 如果鼠标移动到常用功能查询选项则它显示，快递相关的信息隐藏
	// 如果鼠标移动到快递查询选项则它显示，常用功能的信息隐藏
	if(id=="content_1"){
		$("#content_1").show();
		$("#ym_kuaidibox").hide();
		
	} else if(id=="ym_kuaidibox"){
		$("#content_1").hide();
		$("#ym_kuaidibox").show();
	}
	$(obj).addClass('nhover');
	$(obj).siblings("li").removeClass('nhover');
}
/*
 *为快递链接添加点击效果
 *
 */
function ExpressClick(key,obj){

	// 获取点击连接对应的快递的信息
	var expressItem = expressInfo[key];
	
	// 获取当前a标签代表的快递公司名
	var content = expressItem[0];
	
	$(obj).siblings("a").removeClass('k_hover');
	$(obj).parent().parent().find("li").find("a").removeClass('k_hover');
	$(obj).addClass('k_hover');
	$("#ym_kuaidiming").html(content);
	$("#kuaidi1_name").html(expressItem[3]);
	$("#kuaidi_ru").html(" 例如，您可以输入：<span id='testExample'>"+expressItem[4]+"</span>");
	$("#ym_kuaidiming").html(content);
	$("#expressKey").val(key);
	$("#jieguo_bor").html('');
	$("#jieguo_bor").css({"border":"0px"});
}
/*
 *点击快递首页的提交按钮通过ajax处理数据的方法
 *
 */
function ajaxSubmit(obj){
	if((typeof obj)=="object"){
		// 在点击查询前先通过ajax的正则判断数据是否合法
		var expressNum = $(obj).siblings("#expressNum").val();
		
		// 去除空格
		expressNum = expressNum.replace(/\s+/g,"");	
		var key = $("#expressKey").val();
	}else{
		var expressNum = obj;
		var key = getkey;
	}

	
	// 获取点击连接对应的快递的信息
	var expressItem = expressInfo[key];
	
	// 先用js判断所提交数据是否符合匹配规则如果是采用ajax提交
	if(expressNum.match(expressItem[5]) || ! expressItem[5]){
		
		// 符合匹配规则用ajax提交数据
		// var url = "/"+expressModule+"/search";
		$.ajax({
			url:$CONFIG['siteDynamicUrl']+"/"+expressModule+"/search",
			dataType:'jsonp',
			type:"get",
			data:{"expressNum":expressNum,"key":key},
			jsonp:'callback',
			// 数据搜索中显示等待中
			beforeSend:function(){
				$("#jieguo_bor").css({"border":"1px solid #8FBFFD","width":"498px","float":"left"});
				$("#jieguo_bor").html("<center><img src='"+$CONFIG['staticUrl']+"/images/loading.gif' /></center>");
			},
			success:function(data){
			if(data['errorNum'] == "1"){
				$("#kuaidi_ru").html("<font color='red'>您输入的订单号不合法且不能为空请检查后重输</font>");
			}else{
				
				
				$("#jieguo_bor").html('');
				if(data['data'].length>0){
					for(var key in data["data"]){
						//alert(info["data"][key]["time"]);
						// 用jquery追加li
						if(key==0){
							$("#jieguo_bor").prepend('<li class="k_end"><div class="time">'+data["data"][key]["time"]+'</div><div class="k_weizhi"><p>'+data["data"][key]["context"]+'</p></div></li>');
						}else if(key==data["data"].length-1){
							$("#jieguo_bor").prepend('<li><div class="time">'+data["data"][key]["time"]+'</div><div class="weizhi_top"><p>'+data["data"][key]["context"]+'</p></div></li>');
						}else{
							$("#jieguo_bor").prepend('<li><div class="time">'+data["data"][key]["time"]+'</div><div class="k_weizhi"><p>'+data["data"][key]["context"]+'</p></div></li>');
						}
						
						
					}
				}else{
					$("#jieguo_bor").append("<li style='color:red'>对不起，您传递的账单号未找到</li><span style='display:none' id='errorflag'>2</span>");
				}
				//$("#jieguo_bor").html
				//alert(info["data"][1]["time"]);
				
			}
			}
		});
	
	}else{
		$("#kuaidi_ru").html("<font color='red'>对不起，您还没有输入快递单号，或输入有误，请检查后重新输入,再查询！</font>");
		// 清掉结果框中的值并隐藏框
		$("#jieguo_bor").html('');
		$("#jieguo_bor").css({"border":"0px"});
	}
}


$(function(){
// 获取从频道页中提交过来的url中的参数
var str = window.location.href;
var matchArr = str.match(/expressNum=(.+?)&key=(\d+)/);
if(matchArr && matchArr[1]){
	var getexpressNum = matchArr[1];
	getkey = matchArr[2];
	var keyname = $(".demok li:nth-child(1) a:nth-child(" + (parseInt(getkey) + 2) + ")"); 
	ExpressClick(getkey,keyname);
	ajaxSubmit(getexpressNum);
}

/*
 *
 *有url地址跳转的提交
 */
function urlSubmit(){
	// 在点击查询前先通过ajax的正则判断数据是否合法
	var expressNum = $("#expressNum").val();
 
	// 去除空格
	expressNum = expressNum.replace(/\s+/g,"");
	var key = $("#expressKey").val();

	// 获取点击连接对应的快递的信息
	var expressItem = expressInfo[key];
	if(expressNum.match(expressItem[5])){
		$("#ym_kuaidiform").submit();
	}else{
		$("#kuaidi_ru").html("<font color='red'>对不起，您还没有输入快递单号，或输入有误，请检查后重新输入,再查询！</font>");
	}
}
	
/*
 * 快递查询按钮点击之后表单提交
 *
 */
 $("#Button1").click(function(){
	urlSubmit();		
 })
 /*
  *添加回车事件回车事件提交查询数据
  */
 $("#expressNum").keypress(function(event){
 
	var e = event||window.event;
	if(e.keyCode=="13"){
	
		// 如果flag的值是express代表是快递页面用ajax提交
		if($("#expressNum").attr("flag")=="express"){
			var obj = $("#Button1");
			ajaxSubmit(obj);
		}else{
		
		// flag的值不是express代表是首页不用ajax提交
			urlSubmit();
		}
		return false;
	}	
 })
 // 鼠标点击输入框时出现的效果
 $("#expressNum").click(function(){
	var key = $("#expressKey").val();
	
	// 获取点击连接对应的快递的信息
	var expressItem = expressInfo[key];
	$("#kuaidi_ru").html(" 例如，您可以输入：<span id='testExample'>"+expressItem[4]+"</span>");
	if($("#errorflag").html()=='2'){
		$("#jieguo_bor").html('');
		$("#jieguo_bor").css({"border":"0px"});
	}
 })
})
var shoujiModule = new Array('shouji');
$(function(){

	// 获取从频道页中提交过来的url中的参数
	var str = window.location.href;
	var phoneNum = str.match(/phoneNum=(\d+)/);
	if(phoneNum && phoneNum[1]){
		chahao(phoneNum[1]);
	}
	//alert(phoneNum[1]);
	function chahao(getphoneNum){
		//alert("1111111");
		// 定义手机号码匹配规则
		var reg = /^((\+86-)|(86-))?(13[0-9]|15[0-9]|18[0-9]|147)(\d{4,8})$/;
		
		// 获取提交过来的电话号码
		
		if(getphoneNum){
			var phoneNum = getphoneNum;
		}else{
			var phoneNum = $("#pl_sousuotxt").val();
		}
		// 去除空格
		phoneNum = phoneNum.replace(/\s+/g,"");	
		// 如果手机数据不匹配则输出提示信息
		if(phoneNum.match(reg)){
		
			// 如果匹配则通过ajax往服务器端提交数据
			$.ajax({
				url:$CONFIG['siteDynamicUrl']+"/"+shoujiModule+"/search",
				dataType:'jsonp', 
				type:"get",	
				data:{"phoneNum":phoneNum},
				jsonp:'callback',
				success:function(returnInfo) {
			
					if(returnInfo["errorNum"] == "1"){
						$("#resultInfo").html('<p><font color="red">您搜索的电话号码不合法，请仔细检查</font></p>');
					}else if(returnInfo["errorNum"] == "2"){
						$("#resultInfo").html('<p><font color="red">您搜索的电话号码没找到或不存在，请仔细检查</font></p>');
					}else{
						$("#resultInfo").html('<div class="pl_jieguo"> <ul class="pl_jieguoc"> <li>手机号码：<span>'+returnInfo['MobileNumber']+'</span> <a target="_blank" href="'+$CONFIG['siteDynamicUrl']+'/mobilenum/mobilenumSearch/mobile/'+returnInfo['MobileNumber']+'">（查吉凶）</a></li><li>手机号码归属地：<span>'+returnInfo['MobileArea']+'</span></li> <li>手机卡类型：<span>'+returnInfo['MobileType']+'</span></li><li>电话区号：<span>'+returnInfo['AreaCode']+'</span></li><li>城市邮编：<span>'+returnInfo['PostCode']+'</span></li></ul></div>');
					}
				}
			})
		} else {
			$("#resultInfo").html('<p><font color="red">您搜索的电话号码不合法，请仔细检查</font></p>');
		}
	}
	$("#Button1").click(function(){
		chahao("");
	});
	$("#pl_sousuotxt").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		chahao("");
	}
	})
});
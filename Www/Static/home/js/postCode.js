function searchCode($p){
	
	// 获取用户输入的邮编号
	var inputPostCode = $("#inputPostCode").val();
	if(!inputPostCode || inputPostCode=="请输入地址或邮编号码"){
		// 从url中获取
		var str = window.location.href;
		inputPostCode = str.match(/inputPostCode=(.*?)&/);
		inputPostCode = inputPostCode[1];
		inputPostCode = decodeURI(inputPostCode);
	}
	// 去除空格
	inputPostCode = inputPostCode.replace(/\s+/g,"");	
	
	// 定义验证邮编的正则
	var re = /^[1-9]\d{5}$/; // 代表用户输入的是邮编号
	var re2 = /^[^\w?？><\/\\&*%$#@!！~,，.。;；:：'‘"“]*$/; // 代表用户输入的是地址
	
	if(inputPostCode.match(re) || inputPostCode.match(re2)){
		
		// 通过ajax到后台请求数据
		$.ajax({
				url:$CONFIG['siteDynamicUrl']+"/youbiansousuo/search",
				dataType:'jsonp', 
				type:"get",	
				data:{"inputPostCode":inputPostCode,"p":$p},
				jsonp:'callback',
				// 数据搜索中显示等待中
				beforeSend:function(){
					$("#resultInfo").html("<center><img src='"+$CONFIG['staticUrl']+"/images/loading.gif' /></center>");
				},
				success:function(returnInfo){
					//alert(returnInfo[1]['address']);
					
					
					// 如果返回的是没有查询到的信息则显示提示否则遍历returnInfo 往$youbian2_c节点中添加新的节点
					if(returnInfo['errorInfo']){
						$("#resultInfo").html("<font color='red'>"+returnInfo['errorInfo']+"</font>");
					} else {
						// 创建节点
						var $youbian2_c = $('<div class="youbian2_c" style="border-bottom:1px solid #CBE9FF;"></div>');
						// 把头信息添加上
						$youbian2_c.append('<div class="youbian2_c1 ts">市、县、区名</div>');
						$youbian2_c.append('<div class="youbian2_c2 ts">邮政编码</div>');
						
						// 开始遍历添加节点
						for(var i in returnInfo){
							if(returnInfo[i]['postcodeNum']){
								$youbian2_c.append('<div class="youbian2_c1">'+returnInfo[i]['address']+'</div>');
								$youbian2_c.append('<div class="youbian2_c2">'+returnInfo[i]['postcodeNum']+'</div>');
							}else if(returnInfo[i]['address']){
								$youbian2_c.append('<div class="youbian2_c1">'+returnInfo[i]['address']+'</div>');
								$youbian2_c.append('<div class="youbian2_c2">'+inputPostCode+'</div>');
							}
						}
						// 把youbian2_c节点追加到$("#resultInfo")节点中
						$("#resultInfo").html('');
						$("#resultInfo").append($youbian2_c);
					}
					
					
					// 清除掉#youbian2_fenye对象中的数据
					$("#youbian2_fenye").html('');
					if(returnInfo['page']){

						// 把分页添加到youbian2_fenye中
						$("#youbian2_fenye").html(returnInfo['page']);
					}
				}
			})
		
	}else{
		alert("邮编格式不对，请输入正确的邮编")
	}
}

$(function(){
	// 获取从频道页中提交过来的url中的参数
	var str = window.location.href;
	var inputPostCode = str.match(/inputPostCode=(.*?)&/);
	
	// 手动调用一次邮编搜索
	if(inputPostCode && inputPostCode[1]){
		searchCode(1);
	}
 // 为输入框添加回车事件
 $("#inputPostCode").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		searchCode(1);
	}
	})

})

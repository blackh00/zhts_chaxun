var shenfenzhengModule = 'shenfenzheng';
$(function(){
	// 获取从频道页中提交过来的url中的参数
	var str = window.location.href;
	var identityNum = str.match(/identityNum=(\d+X|\d+)/);
	if(identityNum && identityNum[1]){
		shenfenAjaxSubmit(identityNum[1]);
	}
	/*
	 *通过ajax提交ajax数据与处理的方法
	 */
	function shenfenAjaxSubmit(getidentityNum){
		if(getidentityNum){
			// 获取用户输入的身份证号码
			var identityNum = getidentityNum;
		} else {
		
			// 获取用户输入的身份证号码
			var identityNum = $("#identityNum").val();
			
			// 去除空格
			identityNum = identityNum.replace(/\s+/g,"");
		}
		// 定义匹配规则
		var reg = /(^\d{15}$)|(^\d{17}([0-9]|X)$)/;
		if(identityNum.match(reg)){
			var url;
			// 如果数据匹配则到服务利用ajax到后端获取数据
			$.ajax({
					url:$CONFIG['siteDynamicUrl']+"/"+shenfenzhengModule+"/search",
					dataType:'jsonp', 
					type:"get",					
					data:{"identityNum":identityNum},
					jsonp:'callback',
					beforeSend:function(){
						$("#sfz_say").html("<center><img src='"+$CONFIG['staticUrl']+"/images/loading.gif' /></center>");
					},					
					success:function(identityInfo) {  
					if(identityInfo['errorNum'] == "1"){
						$("#sfz_say").html("<li><font color='red'>您输入的身份证号码不合法请重输</font></li>");
					}else if(identityInfo['errorNum'] == "2"){
						$("#sfz_say").html("<li><font color='red'>您输入的身份证号码不存在</font></li>");
					}else{
						var birthday = identityInfo['birthday'].substr(0,4)+"年"+identityInfo['birthday'].substr(4,2)+"月"+identityInfo['birthday'].substr(6,2)+"日";
						
						$("#resultInfo").html("<div class='pl_jieguo'><ul class='sfz_jieguoc' id='sfz_say'><li>号码：<span>"+identityInfo['identity_num']+"</span></li><li>地区：<span>"+identityInfo['address']+"</span></li><li>生日：<span>"+birthday+"</span></li><li>性别：<span>"+identityInfo['sex']+"</span></li></ul></div><div class='sfz_jieguoline'></div>");
					}
				}
			})
		}else{
			$("#sfz_say").html("<li><font color='red'>您输入的身份证号码不合法请重输</font></li>");
		}	
	
	}
	
	/*
	 * 点击提交按钮
	 */
	$("#Button1").click(function(){
		shenfenAjaxSubmit("");
	});
	
	/*
     *添加回车事件回车事件提交查询数据
     */
	$("#identityNum").keypress(function(event){
		var e = event||window.event;
		if(e.keyCode=="13"){
			shenfenAjaxSubmit("");
		}
	})
})
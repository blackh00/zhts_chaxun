$(function(){
	
	// 如果匹配则通过ajax往服务器端提交数据
	$.ajax({
		url:$CONFIG['siteDynamicUrl']+"/tianqi/index",
		dataType:'jsonp', 
		type:"get",	
		jsonp:'callback',
		data:{"isajax":1},
		success:function(returnInfo) {
			alert(returnInfo['aa']);
		}
	})
})

/***yumao add***/
$(function(){
	
	$("#btn").click(function(){
	
		
		// 获取id="s_province" 中的值即得到省份值
		var s_province = $("#s_province").val();
		
		// 获取s_city中的值即得到市值
		var s_city = $("#s_city").val();
		
		// 得到区或县对应的值
		var s_county = $("#s_county").val();
		
		// 组装url
		var url = $CONFIG['siteDynamicUrl']+"/tianqi/index/province/"+s_province+"/city/"+s_city+"/county/"+s_county;
		
		// 页跳转
		if(s_province!="省份"){
			window.location.href = url;
		}else{
			alert("请选择地点");
		}
		
	})
})
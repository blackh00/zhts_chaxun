// 搜索页面获取url中传过来的参数
var strUrl = window.location.href;

// 获取URL中的搜索参数
var sousuo = strUrl.match(/searchInfo=(.*)$/);
if(!sousuo){
	sousuo = strUrl.match(/searchInfo=(.*?)&/);
}

// 保存匹配数据的数组
var matchTools = new Array();


if(sousuo && sousuo[1]){
	// 解析url中的中文
	sousuo[1] = decodeURI(sousuo[1]);
	
	// 遍历searchTools对象
	for(i in searchTools){
		
		var j=0;
		// 获取到每一个对象的名字
		//alert(searchTools[i]['name']);
		if(searchTools[i]['name'].indexOf(sousuo[1]) != -1){
			matchTools[j] =  searchTools[i];
			j++;
		}
	
	}
	// 如果没有找到相关
	if(matchTools.length < 1){
	var noresult = '<div class="nojieguo_bor"><div class="jieguobg"><p>对不起，没有找到<span>“'+sousuo[1]+'”</span>相关的工具</p> <input type="button" class="sousuo_fanhui" value="" id="Button3"></div><div class="caini"></div><div class="caini_txt"><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/jiaotongweigui/">交通违章查询</a></p><p><a target="_blank" href="#">驾驶证扣分查询</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/express/">快递查询</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/xingzuoyunshi/">星座查询</a></p><p><a target="_blank" href="#">婚姻树/财富船</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/dreamsearch/">周公解梦</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/tianqi/">天气预报</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/rili/">万年历</a></p></div></div>';
	$("#resultkuang").html(noresult);
	}else{
		
		var hasresult = '<div style="margin-top:10px; border-top:1px solid #e6e6e6;" class="content"><div class="contit"><h1>太棒了，与“<span>'+sousuo[1]+'</span>”相关的工具有<span>'+matchTools.length+'</span>个：</h1></div><ul>';
		for(var j in matchTools){
			hasresult +='<li><a target="_blank" href="'+$CONFIG['siteUrl']+'/'+matchTools[j]['module']+'/"><img src="'+matchTools[j]['pic']+'"><div class="link_txt"><p>'+matchTools[j]['name']+'</p><span>'+matchTools[j]['details']+'</span></div></a></li>';
		}
		
		hasresult +='</ul><div class="w"><div class="caini"></div><div class="caini_txt"><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/jiaotongweigui/">交通违章查询</a></p><p><a target="_blank" href="#">驾驶证扣分查询</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/express/">快递查询</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/xingzuoyunshi/">星座查询</a></p><p><a target="_blank" href="#">婚姻树/财富船</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/dreamsearch/">周公解梦</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/tianqi/">天气预报</a></p><p><a target="_blank" href="'+$CONFIG['siteUrl']+'/rili/">万年历</a></p></div></div></div>';
		$("#resultkuang").html(hasresult);
	}
	
}else{
	alert('请输入工具名或工具包含的部分文字');
	//$("#resultkuang").html(noresult);
}
function getCookie(objName)
{ //获取指定名称的cookie的值
	var arrStr = document.cookie.split("; ");
	for(var i = 0;i < arrStr.length;i ++){
	var temp = arrStr[i].split("=");
	if(temp[0] == objName) return unescape(temp[1]);
	} 
}
function addCookie(objName,objValue,objHours)
{	//添加cookie
	var str = objName + "=" + escape(objValue);
	if(objHours > 0){ //为0时不设定过期时间，浏览器关闭时cookie自动消失
	var date = new Date();
	var ms = objHours*3600*1000;
	date.setTime(date.getTime() + ms);
	str += "; expires=" + date.toGMTString();
	}
	str += "; path=/";
	document.cookie = str;
}
// 用ajax获取d.kuaichale.com下面的ip地址
var SITE_DYNAMIC_URL = "http://d.kuaichale.com";
var SITE_URL = "http://www.kuaichale.com?from=baidu";

// 如果在cookies中保存ip地址则直接进行判断否则用ajax到快查网站上获取
if(getCookie('ipAddress')){
	if(getCookie('ipAddress').indexOf('北京')==-1 && getCookie('ipAddress').indexOf('深圳')==-1){
		window.location.href = SITE_URL;
	}
}else{
$.ajax({
			url:SITE_DYNAMIC_URL+"/ip/search",
			dataType:'jsonp', 
			type:"get",			
			jsonp:'callback',
			success:function(returnInfo){
				// 往客户端cookies中保存地址信息
				addCookie("ipAddress",returnInfo['country'],168);
				if(returnInfo['country'].indexOf('北京')==-1 && returnInfo['country'].indexOf('深圳')==-1){
					window.location.href = SITE_URL;
				}
			}
		})
}
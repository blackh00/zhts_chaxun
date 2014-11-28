// 保存ip模块经路由后url地址
var ipModule = new Array('ip');
var myLatlng= new google.maps.LatLng(0,0); // 初始化
var map;
var geocoder;
var markersArray = [];
var ipAddress;
var ipLatLng;
var ipLocation;
var ipArea;
function initialize() {

var myOptions = {

zoom: 12,

center: myLatlng,

mapTypeId: google.maps.MapTypeId.ROADMAP,
  mapTypeControl:false,
   navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
};

map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
var marker=new google.maps.Marker({position:myLatlng,map:map,title:"You are here!"});
geocoder = new google.maps.Geocoder();

};
function cha_ip(getip){

	// 获取到用户输入的ip
	if(getip){
		var ip = getip;
	}else{
		var ip = $('#ip_sousuotxt').val();
	}
	ip_chaxun(ip);
	
}
function cha_ipdefault(){
	// 获取到用户输入的ip
	var ip = $('#clientIp').val();
	ip_chaxun(ip);
}
function ip_chaxun(ip){

	// 去除两端空格
	ip = ip.replace(/\s+/g,"");
	
	// 定义ip匹配规则
	var res = /^((25[0-5]|2[0-4]\d|1?\d?\d)\.){3}(25[0-5]|2[0-4]\d|1?\d?\d)$/;
	
	// 定义匹配域名
	var res2 = /([a-z0-9][a-z0-9\-]*?\.(?:com|cn|net|org|gov|info|la|cc|co)(?:\.(?:cn|jp))?)$/;
	if(ip.match(res) || ip.match(res2)){
		$.ajax({
			url:$CONFIG['siteDynamicUrl']+"/"+ipModule+"/search",
			dataType:'jsonp', 
			type:"get",
			data:{"ip":ip},
			jsonp:'callback',
			success:function(returnInfo){
				if(returnInfo['errorNum']=="1"){
					alert('您所输的ip地址或域名地址格式不对');
				}else{
					// 解析数据
					//alert(data);
					
					ipAddress = returnInfo['ip'];
					
					ipLocation = returnInfo['country'];
					ipArea = returnInfo['area'];
					//setTimeout("",200);
				
					codeAddress(ipLocation);
					
					// 把返回数据显示到ip搜索下面的信息框
					
					$("#searchIp").html(ipAddress);
					$("#searchAddress").html(ipLocation);
					$("#searchData").html(ipLocation);
				}
			}
		})
	}else{
		alert("您输入的IP或域名格式不对，请重输");
	}
}

function codeAddress(address){
	geocoder.geocode( {'address': address}, function(results, status) {
			//alert("111111111");
            if (status == google.maps.GeocoderStatus.OK) {
                setMapCenter(results[0].geometry.location);
            } else {
                 alert('解析您的地理位置失败');
            }
    });
}
 function deleteOverlays() {
        if (markersArray) {
            for (i in markersArray) {
                markersArray[i].setMap(null);
            }
            markersArray.length = 0;
        }
    }
function setMapCenter(latLng){
      map.setCenter(latLng);

        var html = '<div style="line-height:25px;color:#555;width:200px;">'
                 + '<h5 style="font-size:14px;font-family:Arial;color:#333;">您的IP是:<b>' + ipAddress + '</b</h5>'
                 + '<h5 style="font-size:14px;font-family:Arial;color:#333;">您来自：<b>' + ipLocation + '</b></h5>'
                 + '<h5 style="font-size:14px;font-family:Arial;color:#333;">您来自：<b>'  + ipArea + '</b></h5>'
                 + '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: html
        });
        //先清除
        deleteOverlays();

        var marker = new google.maps.Marker({
            position: latLng,
            map: map,
            title: '你的IP对应的地址'
        });
        markersArray.push(marker);
        //默认打开信息窗口
        infowindow.open(map,marker);

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
 }
$(function(){

	// 获取从频道页中提交过来的url中的参数
	var str = window.location.href;
	var ip = str.match(/ip=(\d+\.\d+\.\d+\.\d+)/);
	if(!ip){
		ip = str.match(/ip=(.*?)&/);
	}
	if(ip && ip[1]){
		initialize();
		cha_ip(ip[1]);
	
	}else{
		
		// 如果是直接到ip查询页面则用ajax获取客户端当前ip
		if($("#submitFlag").val()=="0"){
		
			 // 如果用户cookies中保存localhostIp信息则不必通过ajax获取
			 // 获取cookie信息
			
			var cookieStr = document.cookie;
			var localhostIp;
			var localhostIpType;
			var cookieArr = cookieStr.split(";");
			for(var i=0;i<cookieArr.length;i++){
				var temp = cookieArr[i].split("=");
				if(temp[0].match(/localhostIpType/)){
					 localhostIpType = temp[1];
				}else if(temp[0].match(/localhostIp/)){
					localhostIp = temp[1];
				}
			}
			
			if(localhostIp){
				$("#clientIp").val(localhostIp);
				initialize();
				cha_ipdefault();
			}else{
				 // 在静态页面用ajax获取客户端当前ip
				$.ajax({
					url:$CONFIG['siteDynamicUrl']+"/"+ipModule+"/search",
					dataType:'jsonp', 
					type:"get",
					jsonp:'callback',
					success:function(returnInfo){
						//alert(returnInfo["ip"]);
						// 把获取到的ip显示出来
						$("#clientIp").val(returnInfo["ip"]);
						initialize();
						cha_ipdefault();
			
					}
				})	
			}
		
			
		}else{
			initialize();
			cha_ipdefault();
		}
	}
})
window.onload = function(){
/*
 *添加回车事件回车事件提交查询数据
 */
$("#ip_sousuotxt").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		cha_ip("");
	}
})
//initialize();

};
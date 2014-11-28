function getQueryString(name)
{
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}
var map = new BMap.Map("allMap");                        // 创建Map实例
map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);     // 初始化地图,设置中心点坐标和地图级别
map.addControl(new BMap.NavigationControl());               // 添加平移缩放控件
map.addControl(new BMap.ScaleControl());                    // 添加比例尺控件
map.addControl(new BMap.OverviewMapControl());              //添加缩略地图控件
map.enableScrollWheelZoom();                            //启用滚轮放大缩小
map.addControl(new BMap.MapTypeControl());          //添加地图类型控件
map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
map.enableInertialDragging();

function init_get(){
var _get = new Array();
var _req = location.search.substr(1);
if(!_req){return _get;}
_req = _req.split("&");
for(_i = 0; _i < _req.length; _i++){
_r = _req[_i].split("=");
_get[_r[0]] = unescape(_r[1]);
}
return _get;
}
var _g = init_get();

if(_g["address"]){

$('#mapName').val(_g["address"]);
var point = new BMap.Point(116.331398,39.897445);
map.centerAndZoom(point,12);
map.setCenter(_g['city']);
map.setZoom(12);
// 创建地址解析器实例
var myGeo = new BMap.Geocoder();
// 将地址解析结果显示在地图上,并调整地图视野
// 获取从频道页面中传递过来的地址



myGeo.getPoint(_g["address"], function(point){
if (point) {
map.centerAndZoom(point, 16);
map.addOverlay(new BMap.Marker(point));
}
}, _g['city']);
}
else
{
var str = window.location.href;
// 匹配数据
var re = /dizhi=(.*?)&/;
var addressMatch = str.match(re);
if(addressMatch && addressMatch[1]){

var cityurl = decodeURI(addressMatch[1]);

	map.setCenter(cityurl);
}else{
var myCity = new BMap.LocalCity();

myCity.get(myFun);
}
}

function myFun(result){
if(getQueryString('city')){
	var cityName = getQueryString('city');
}else{
	var cityName = result.name;
}
//var cityName = "深圳市";
/*for(var i in cityName){
alert(cityName[i]);
}*/
//var cityName = "深圳市";
map.setCenter(cityName);
$('#mapName').val(cityName);
}


function city()
{
var city = $('#mapName').val();
map.setCenter(city);
}
$("#mapName").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		city();
	}
})
function city2(city){
map.setCenter(city);
}
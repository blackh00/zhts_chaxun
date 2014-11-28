var nowjieqi;
var Request = new Object();
Request = GetRequest();
if(!Request['jq']){
	var today = new Date();
	var y=today.getFullYear();
	var m=today.getMonth()+1;
	var d=today.getDate();
	var NextDay = getStermNextDay(y,m,d);
	$("a[data='"+NextDay+"']").addClass("cur");
	
	if(NextDay == "小寒" || NextDay == "大寒")
	{
		if(m >=1 && d>20 )
			y =y+1
	}
	nowjieqi = NextDay;
	$("#jieqi_year").html(y);
	$("#jieqi_years").html('('+y);
	$("#jieqi_name").html(NextDay);
	$("#jieqi_name_time").html(NextDay);
	changeClass(NextDay)
	var jieEnglish = jieqiChinese[NextDay];
	var page_jieqi = NextDay;
	loadJs($CONFIG['siteUrl']+"/solar/js/"+jieEnglish+".js");
}else{
	var today = new Date();
	var y=today.getFullYear();
	var m=today.getMonth()+1;
	var d=today.getDate();
	
	var jieqiName = unescape(Request['jq']);
	var year = parseInt(Request['y']);
	var days = year;
	$(".cur").removeClass();
	page_jieqi = jieqiName;

	$("a[data='"+jieqiName+"']").addClass("cur");
	if(jieqiName == "小寒" || jieqiName == "大寒")
	{
		if(m >=1 && d>20 )
			days = parseInt(days)+1;
	}
	nowjieqi = jieqiName;
	$("#jieqi_year").html(year);
	$("#jieqi_years").html('('+year);
	$("#jieqi_name_time").html(jieqiName);
	$("#jieqi_name").html(jieqiName);
	changeClass(jieqiName)
	var jieEnglish = jieqiChinese[jieqiName];
	loadJs($CONFIG['siteUrl']+"/solar/js/"+jieEnglish+".js");
}
function changeJiqi(jieqiName,obj){
	var today = new Date().format("yyyy-MM-dd");
	var days = today.split("-");
	var year = parseInt(days[0]);
	$(".cur").removeClass();
	page_jieqi = jieqiName;
	var ele = obj || window.event;
	//ele = $(e.target).parent();
	ele.className ="cur";
	$("#jieqi_name").html(jieqiName);
	if(jieqiName == "小寒" || jieqiName == "大寒")
	{
		if(parseInt(days[1]) >=1 && days[2]>20 )
			days[0] = parseInt(days[0])+1;
	}
	nowjieqi = jieqiName;
	$("#jieqi_years").html(days[0]);
	$("#jieqi_name_time").html(jieqiName);
	var jieEnglish = jieqiChinese[jieqiName];
	$("#jieqi_years").html('('+days[0]);
	changeClass(jieqiName);
	loadJs($CONFIG['siteUrl']+"/solar/js/"+jieEnglish+".js");
}
function jieqiInfo(jieqi){
	//当年的谷雨时间
	var today = new Date().format("yyyy-MM-dd");
	var days = today.split("-");
	var year = parseInt(days[0]);
	var showyear = 2012;
	changeClass(jieqi);
	nl='';
	jieqi['2030'] == 'y'?nl=(parseInt(days[0])+1):nl=days[0];
	if(parseInt(days[1]) ==1 && days[2]<20 && (nowjieqi == '小寒' || nowjieqi == '大寒'))
	{nl= nl-1;}
		
	$("#jieqi_year_time").html(jieqi[nl]+')');
	$("#jieqi_jianjie").html('<p>'+jieqi["jianjie"]+'</p>');
	$("#jieqi_youlai").html('<p>'+jieqi["youlai"]+'</p>');
	$("#jieqi_xisu").html('<p>'+jieqi["xisu"]+'</p>');
	$("#jieqi_yangsheng").html('<p>'+jieqi["yangshen"]+'</p>');
	var tableHtml = '<table>';
	for(var i = 1;i <= 6;i++){
		tableHtml += "<tr>";
		for(var j = 1;j<=6;j++){
			if(j%2 == 1){
				tableHtml += "<th>"+showyear+"年"+page_jieqi+"时间</th>";
				showyear++;
			}else
				tableHtml += "<td>"+jieqi[showyear-1]+"</td>";
			}
		tableHtml += "</tr>";
	}
	tableHtml += "</table>";
	$("#jieqi_time_table").html(tableHtml);
}
function changeClass(jieqiName){
	if(jieqiName=="立春"||jieqiName=="雨水"||jieqiName=="惊蛰"||jieqiName=="春分"||jieqiName=="清明"||jieqiName=="谷雨"){
		$('#ssbox').removeClass('season_summer');
		$('#ssbox').removeClass('season_autumn');
		$('#ssbox').removeClass('season_winter');
		$('#ssbox').addClass('season_spring');
	}else if(jieqiName=="立夏"||jieqiName=="小满"||jieqiName=="芒种"||jieqiName=="夏至"||jieqiName=="小暑"||jieqiName=="大暑"){
		$('#ssbox').removeClass('season_spring');
		$('#ssbox').removeClass('season_autumn');
		$('#ssbox').removeClass('season_winter');
		$('#ssbox').addClass('season_summer');
	}else if(jieqiName=="立秋"||jieqiName=="处暑"||jieqiName=="白露"||jieqiName=="秋分"||jieqiName=="寒露"||jieqiName=="霜降"){
		$('#ssbox').removeClass('season_spring');
		$('#ssbox').removeClass('season_summer');
		$('#ssbox').removeClass('season_winter');
		$('#ssbox').addClass('season_autumn');
	}else if(jieqiName=="立冬"||jieqiName=="小雪"||jieqiName=="大雪"||jieqiName=="冬至"||jieqiName=="小寒"||jieqiName=="大寒"){
		$('#ssbox').removeClass('season_spring');
		$('#ssbox').removeClass('season_summer');
		$('#ssbox').removeClass('season_autumn');
		$('#ssbox').addClass('season_winter');
	}
}
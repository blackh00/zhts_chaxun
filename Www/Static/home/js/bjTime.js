function set(time){
    var week = '日一二三四五六';
	var beijingTimeZone = 8;
	var timeOffset = ((-1 * (new Date()).getTimezoneOffset()) - (beijingTimeZone * 60)) * 60000;
	var now = new Date(time - timeOffset);
	document.getElementById('beijing_time').innerHTML = p(now.getHours())+'<span style="color:white;padding-right:3px;">:</span>'+p(now.getMinutes())+'<span style="color:white;padding-left:3px;">:</span>'+p(now.getSeconds());
	document.getElementById('date_time').innerHTML = p(now.getFullYear())+'年'+p(now.getMonth()+1)+'月'+p(now.getDate())+'日 周'+p(week.charAt(now.getDay()));
	var now = new Date();
	document.getElementById('local_time').innerHTML = p(now.getHours())+':'+p(now.getMinutes())+':'+p(now.getSeconds())+'  　'+p(now.getFullYear())+'年'+p(now.getMonth()+1)+'月'+p(now.getDate())+'日 周'+p(week.charAt(now.getDay()));
}
function p(s) {
	return s < 10 ? '0' + s : s;
}
$.ajax({
	url:$CONFIG['siteDynamicUrl']+"/bjtime/reback",
	dataType:'jsonp',
	type:"get",
	jsonp:'callback',
	success:function(data){
		var time = data['bjtime'];
		setInterval(function() {
			set(time);
			time = Number(time);
			time += 1000;
		},1000);
		set(time);
	}
});



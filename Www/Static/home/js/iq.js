$(document).ready(function(){
	$(".select_box input , .select_box1 input,.cp_select_box input,.cp_select_box1 input,.select_box3 input,.cy_select input").click(function(){
		var thisinput=$(this);
		var thisul=$(this).parent().find("ul");
		if(thisul.css("display")=="none"){
			if(thisul.height()>200){thisul.css({height:"200"+"px","overflow-y":"scroll" })};
			thisul.fadeIn("0");
			thisul.hover(function(){},function(){thisul.fadeOut("0");})
			thisul.find("li").click(function(){thisinput.val($(this).text());thisul.fadeOut("0");}).hover(function(){$(this).addClass("hover");},function(){$(this).removeClass("hover");});
		}else{
			thisul.fadeOut("0");
		}
	})
});
var timerID = null;
var timerRunning = false;
startday = new Date();
clockStart = startday.getTime();
var storea = 0;

function startTest() {
	$("#pageTitle").html("IQ智商测试题");
	$("#mod_iq").hide();
	$("#mod_iq_item").show();
	$('#iq_time').show();
	startclock();
}

function initStopwatch() {
	var myTime = new Date();
	return ((myTime.getTime() - clockStart) / 1000);
}

function stopclock() {
	if (timerRunning)
		clearTimeout(timerID);
	timerRunning = false;
}

function showtime() {
	var tSecs = Math.round(initStopwatch());
	var iSecs = tSecs % 60;
	var iMins = Math.round((tSecs - 30) / 60);
	var sSecs = "" + ((iSecs > 9) ? iSecs : "0" + iSecs);
	var sMins = "" + ((iMins > 9) ? iMins : "0" + iMins);
	$('#iq_time').html("计时" + sMins + ":" + sSecs);
	if($('#iq_time').html() == '计时20:00'){
		jisuanfenshu();
		return false;
	}
	timerID = setTimeout("showtime()", 1000);
	timerRunning = true;
}

function startclock() {
	// Make sure the clock is stopped
	stopclock();
	startday = new Date();
	clockStart = startday.getTime();
	showtime();
}

function jisuanfenshu() {
	var f = $('#myForm')[0];
	if(f.group1[2].checked){storea += 6}
	if(f.group2[1].checked){storea += 6}
	if(f.group3[0].checked){storea += 6}
	if(f.group4[1].checked){storea += 6}
	if(f.group5[0].checked){storea += 6}
	if(f.group6[0].checked){storea += 6}
	if(f.group7[2].checked){storea += 6}
	if(f.group8[1].checked){storea += 6}
	if(f.group9[1].checked){storea += 6}
	if(f.group10[3].checked){storea += 5}
	if(f.group11[2].checked){storea += 5}
	if(f.group12[0].checked){storea += 5}
	if(f.group13[2].checked){storea += 5}
	if(f.group14[3].checked){storea += 5}
	if(f.group15[2].checked){storea += 5}
	if(f.group16[2].checked){storea += 5}
	if(f.group17[1].checked){storea += 5}
	if(f.group18[3].checked){storea += 5}
	if(f.group19[3].checked){storea += 5}
	if(f.group20[3].checked){storea += 5}
	if(f.group21[2].checked){storea += 5}
	if(f.group22[2].checked){storea += 5}
	if(f.group23[3].checked){storea += 5}
	if(f.group24[1].checked){storea += 5}
	if(f.group25[0].checked){storea += 5}
	if(f.group26[0].checked && f.group26[3].checked){storea += 5}
	if(f.group27[1].checked && f.group27[2].checked){storea += 5}
	if(f.group28[0].checked && f.group28[3].checked){storea += 5}
	if(f.group29[1].checked && f.group29[3].checked){storea += 5}
	if(f.group30[3].checked){storea += 5}
	if(f.group31[2].checked){storea += 5}
	if(f.group32[1].checked){storea += 5}
	if(f.group33[2].checked){storea += 5}
	var i = $('#iq_time').html();
	stopclock();
	if(storea < 70){
		$('#info').html('弱智');
	}else if(storea >= 70 && storea <= 89){
		$('#info').html('智力低下');		
	}else if(storea >= 90 && storea <= 99){
		$('#info').html('智力中等');
	}else if(storea >= 100 && storea <= 109){
		$('#info').html('智力中上');
	}else if(storea >= 110 && storea <= 119){
		$('#info').html('智力优秀');
	}else if(storea >= 120 && storea <= 129){
		$('#info').html('智力非常优秀');
	}else if(storea >= 130 && storea <= 139){
		$('#info').html('智力非常非常优秀');
	}else{
		$('#info').html('天才');		
	}
	$('#cYellow').html(i);
	$('#cYellow_stro').html(storea);
	storea = 0;
    if(document.body.scrollHeight < window.screen.height)
    	h = window.screen.height+50;
    else
    	h =  document.body.scrollHeight+50;
	$('#mask').show();
	$('#popup_iq').show();
	
}

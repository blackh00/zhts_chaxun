$(function () {
	$(".jieguo").hide();
	$("#jisuan_vonwey").click(function(){
		state = CalculatePre($("#EntTime").val(),$("#circle").val());
		$(".jisuan").hide();
		if(state == 1){
			$(".yc").addClass("yc_bg2");
			$(".yc_bg1").removeClass("yc_bg1").addClass("yc_bg2");
			$(".jieguo1").show();
		}else{
			$(".yc_bg1").removeClass("yc_bg1");
			$(".yc_bg2").removeClass("yc_bg2");
			$(".jieguo0").show();
		}
	});
});
function CalculatePre(time,average)
{
     iYear = parseInt(time.split("-")[0]);
     iMonth = parseInt(time.split("-")[1]);
     iDay = parseInt(time.split("-")[2]);

     perior = 280+parseInt(average)-28;
     ov =  DateAdd(iMonth+'/'+iDay+'/'+iYear,parseInt(average)-28);
     ovTime = ov.getFullYear()+'-'+(ov.getMonth()+1) +'-'+ ov.getDate();
     
     PreDay = DateAdd(iMonth+'/'+iDay+'/'+iYear,perior);
     $(".years").html(PreDay.getFullYear());
     $(".months").html(PreDay.getMonth()+1);
     $(".days").html(PreDay.getDate());
     
     now = new Date();
     now1 = now.getFullYear()+'-'+ (now.getMonth()+1)+'-'+now.getDate();
     betweenday = daysBetween(PreDay.getFullYear()+'-'+(PreDay.getMonth()+1)+'-'+PreDay.getDate(),now1);
     $(".alldays").html(betweenday);
     if(betweenday>0){
         week = parseInt(daysBetween(now1,ovTime)/7)+1;
         weekarray = ["一","二","三","四","五","六","七","八","九","十",
                      "十一","十二","十三","十四","十五","十六","十七","十八","十九","二十",
                      "二十一","二十二","二十三","二十四","二十五","二十六","二十七","二十八","二十九","三十",
                      "三十一","三十二","三十三","三十四","三十五","三十六","三十七","三十八","三十九","四十",
                      ];
         if(week>0){
        	 $(".noweeks").show();
        	 $(".weeks").html(weekarray[week-1]);
        	 $("#myselect").attr("value","第" + weekarray[week-1] + "周");
			 $(".week" + week).show().siblings(".weekconent").hide();
         }else{
        	 $(".noweeks").hide();
        	 $("#myselect").attr("value","第一周");
			 $(".week1").show().siblings(".weekconent").hide();
         }
         
         return 1;
     }else {
		 $(".noweeks").hide();
		 $(".week1").show().siblings(".weekconent").hide();
         return 0;
     }
}
function DateAdd(time,Number){ 
    return new Date(Date.parse(time) + (86400000 * Number));  
}  
function daysBetween(DateOne,DateTwo)  
{   
    var OneYear = parseInt(DateOne.split("-")[0]);  
    var OneMonth =  parseInt(DateOne.split("-")[1]);;  
    var OneDay =  parseInt(DateOne.split("-")[2]);;  
    var TwoYear = parseInt(DateTwo.split("-")[0]);  
    var TwoMonth =  parseInt(DateTwo.split("-")[1]);;  
    var TwoDay =  parseInt(DateTwo.split("-")[2]);;  
    var cha=((Date.parse(OneMonth+'/'+OneDay+'/'+OneYear)- Date.parse(TwoMonth+'/'+TwoDay+'/'+TwoYear))/86400000);   
    return cha;  
} 
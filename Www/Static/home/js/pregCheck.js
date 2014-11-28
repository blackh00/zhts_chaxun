function CalculatePre(type)
{
	 $("#"+type+'R').hide();
	 $("#detailtxt").hide();
		 
	 $("#"+type).val( $("#iyear").val()+"-"+$("#imonth").val()+"-"+$("#iday").val());
     time = $("#"+type).val();
     iYear = parseInt(time.split("-")[0]);
     iMonth = parseInt(time.split("-")[1]);
     iDay = parseInt(time.split("-")[2]);
     if(!chkDate(time)){
         alert("日期格式输入有误，例如2008-5-1");
         $("#"+type).focus();
         return false;
     }
     if(!iYear || !iMonth || !iDay){
         alert("日期格式输入有误，例如2008-5-1");
         $("#"+type).focus();
         return false;
     }
	  if(iYear > 2050 || iYear < 2000 ){
         alert("请输入准确的年份！");
         $("#"+type).focus();
         return false;
     }

     if(type == 'LastPer'){
         average = $("#averagePer").val();
         if(!average){
             alert("请选择平均月经周期");
             $("#averagePer").focus();
             return false;
         }
         perior = 280+parseInt(average)-28;
         ov =  DateAdd(iMonth+'/'+iDay+'/'+iYear,parseInt(average)-28);
         ovTime = ov.getFullYear()+'-'+(ov.getMonth()+1) +'-'+ ov.getDate();
     }
     PreDay = DateAdd(iMonth+'/'+iDay+'/'+iYear,perior);
     $("#Result"+type).html(PreDay.getFullYear()+'年'+ (PreDay.getMonth()+1)+'月'+PreDay.getDate()+'日');
     now = new Date();
     now1 = now.getFullYear()+'-'+ (now.getMonth()+1)+'-'+now.getDate();
     betweenday = daysBetween(PreDay.getFullYear()+'-'+(PreDay.getMonth()+1)+'-'+PreDay.getDate(),now1);
     if(betweenday>0){
         $('#Result'+type+'Day').html(betweenday);
         week = parseInt(daysBetween(now1,ovTime)/7)+1;
         if(week>0 && betweenday<266 ){
             $("#P"+type+'Day').html(week);
             $("#W"+type).show();
         }else{
             $("#W"+type).hide();
         }
         $("#daybetween"+type).show();
     }else {
         $("#W"+type).hide() ;
         $("#daybetween"+type).hide();
     }
     
     $("#"+type+'R').show();

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
function ShowMorePre(){
    $('#morePre').show();
    $('#morePre1').show();
}


function chkDate(sDate)
{
     var r=/\d{4}(?:-\d{1,2}){0,2}/
     //正则表达式，判断是否为yyyy-mm-dd,yyyy-mm,yyyy格式
     if(sDate.match(r)==sDate){
         var arr=sDate.split("-")
             switch(arr.length){
                 //根据不同的yyyy-mm-dd,yyyy-mm格式判断年月日数字是否正确
                 case 3:
                     arr[1]=arr[1]-1;
                     var tmpDate=new Date(arr[0],arr[1],arr[2]);
                     if(tmpDate.getMonth()==arr[1] && tmpDate.getFullYear()==arr[0]) return true;
                     break;
                 case 2:
                     if(arr[1]<13) return true;
                     break;
                 default:
                     return false;
             }
     }
     return false;
}
var ydate; 
function fGetDaysInMonth(iMonth, iYear) 
{
    var dPrevDate = new Date(iYear, iMonth, 0);
    return dPrevDate.getDate();
}
function  fBuildCal(iYear,iMonth,LastP,ThisP,NextP,LastY,ThisY,NextY)
{
   colorBg = new Array();
   colorBg[0] = new Array(7);
   colorBg[1] = new Array(7);
   colorBg[2] = new Array(7);
   colorBg[3] = new Array(7);
   colorBg[4] = new Array(7);
   colorBg[5] = new Array(7);
   colorBg[6] = new Array(7);
    var aMonth = new Array();
    aMonth[0] = new Array(7);
    aMonth[1] = new Array(7);
    aMonth[2] = new Array(7);
    aMonth[3] = new Array(7);
    aMonth[4] = new Array(7);
    aMonth[5] = new Array(7);
    aMonth[6] = new Array(7);
    var dCalDate = new Date(iYear, iMonth-1, 1);
    var LP= new Array();
    var TP= new Array();
    var NP= new Array();
    var LY= new Array();
    var TY= new Array();
    var NY= new Array();
    var iDayOfFirst = dCalDate.getDay();
    var iDaysInMonth = fGetDaysInMonth(iMonth, iYear);
    var iVarDate = 1;
    var i, d, w;
    aMonth[0][0] = "日";
    aMonth[0][1] = "一";
    aMonth[0][2] = "二";
    aMonth[0][3] = "三";
    aMonth[0][4] = "四";
    aMonth[0][5] = "五";
    aMonth[0][6] = "六";
    LP[0] = parseInt(LastP['s'].getFullYear()*10000+(LastP['s'].getMonth()+1)*100+LastP['s'].getDate());
    LP[1] = parseInt(LastP['e'].getFullYear()*10000+(LastP['e'].getMonth()+1)*100+LastP['e'].getDate());
    TP[0] = parseInt(ThisP['s'].getFullYear()*10000+(ThisP['s'].getMonth()+1)*100+ThisP['s'].getDate());
    TP[1] = parseInt(ThisP['e'].getFullYear()*10000+(ThisP['e'].getMonth()+1)*100+ThisP['e'].getDate());
    NP[0] = parseInt(NextP['s'].getFullYear()*10000+(NextP['s'].getMonth()+1)*100+NextP['s'].getDate());
    NP[1] = parseInt(NextP['e'].getFullYear()*10000+(NextP['e'].getMonth()+1)*100+NextP['e'].getDate());
    LY[0] = parseInt(LastY['s'].getFullYear()*10000+(LastY['s'].getMonth()+1)*100+LastY['s'].getDate());
    LY[1] = parseInt(LastY['e'].getFullYear()*10000+(LastY['e'].getMonth()+1)*100+LastY['e'].getDate());
    TY[0] = parseInt(ThisY['s'].getFullYear()*10000+(ThisY['s'].getMonth()+1)*100+ThisY['s'].getDate());
    TY[1] = parseInt(ThisY['e'].getFullYear()*10000+(ThisY['e'].getMonth()+1)*100+ThisY['e'].getDate());
    NY[0] = parseInt(NextY['s'].getFullYear()*10000+(NextY['s'].getMonth()+1)*100+NextY['s'].getDate());
    NY[1] = parseInt(NextY['e'].getFullYear()*10000+(NextY['e'].getMonth()+1)*100+NextY['e'].getDate());

    for (d = iDayOfFirst; d < 7; d++) {
        aMonth[1][d] = iVarDate;
        value = iVarDate+iMonth*100+iYear*10000;
        if((LP[0] <= value && LP[1] >=value) || (TP[0] <= value && TP[1] >=value) || (NP[0] <= value && NP[1] >=value))
            colorBg[1][d] = 'class="date_3" title="这是排卵期，性生活受孕可能性大"';
        else if((LY[0] <= value && LY[1] >=value) || (TY[0] <= value && TY[1] >=value) || (NY[0] <= value && NY[1] >=value))
            colorBg[1][d] = 'class="date_1" title="这是月经期，注意经期卫生，请避免性生活"';
        else colorBg[1][d] = 'class="date_2" title="这是安全期，性生活一般不受孕"';
        iVarDate++;
    }
    for (w = 2; w < 7; w++) {
        for (d = 0; d < 7; d++) {
            if (iVarDate <= iDaysInMonth) {
                value = iVarDate+iMonth*100+iYear*10000;
                aMonth[w][d] = iVarDate;
                if((LP[0] <= value && LP[1] >=value) || (TP[0] <= value && TP[1] >=value) || (NP[0] <= value && NP[1] >=value))
                    colorBg[w][d] = 'class="date_3" title="这是排卵期，性生活受孕可能性大"';
                else if((LY[0] <= value && LY[1] >=value) || (TY[0] <= value && TY[1] >=value) || (NY[0] <= value && NY[1] >=value))
                    colorBg[w][d] = 'class="date_1" title="这是月经期，注意经期卫生，请避免性生活"';
                else colorBg[w][d] = 'class="date_2" title="这是安全期，性生活一般不受孕" ';

                iVarDate++;
            }
        }
    }
    return aMonth;
}

function fDrawCal(iYear, iMonth,myMonth,element) 
{
    var calendar_str;
    calendar_str = '<table ';
    if(element=='calendar2')calendar_str += 'style="left:340px"';
    calendar_str += 'class="date" border="0" cellpadding="0" cellspacing="0">';
    calendar_str += "<tr>";
    calendar_str += "<th>" + myMonth[0][0] + "</th>";
    calendar_str += "<th>" + myMonth[0][1] + "</th>";
    calendar_str += "<th>" + myMonth[0][2] + "</th>";
    calendar_str += "<th>" + myMonth[0][3] + "</th>";
    calendar_str += "<th>" + myMonth[0][4] + "</th>";
    calendar_str += "<th>" + myMonth[0][5] + "</th>";
    calendar_str += "<th>" + myMonth[0][6] + "</th>";
    calendar_str += "</tr>";
    calendar_str +='<tr><td colspan="7" class="caption">'+ iYear+' 年 '+ iMonth+' 月</td></tr>';

    for (w = 1; w <= 6; w++) {
        calendar_str +="<tr>";
            for (d = 0; d < 7; d++) {
                calendar_str +='<td ';
                if(colorBg[w][d])
                calendar_str +=colorBg[w][d];
                calendar_str +='>';
                if(myMonth[w][d])
                calendar_str += myMonth[w][d];
                else calendar_str +="&nbsp;";
                calendar_str +="</td>";
            }
        calendar_str +="</tr>";
    }
    calendar_str +="</table>";
    $("#"+element).html(calendar_str);
}

function getP(idate,average)
{
    var P= new Array();
    P['s'] = DateAdd((idate.getMonth()+1)+'/'+idate.getDate()+'/'+idate.getFullYear(),average-17);
    P['e'] = DateAdd((idate.getMonth()+1)+'/'+idate.getDate()+'/'+idate.getFullYear(),average-12);
    return P; 
}

function getLastP(idate,average)
{
    var PreDay = new Array();
    PreDay =getLastY(idate,average);
    return getP(PreDay['s'],average);
}
function getThisP(idate,average)
{
    return getP(idate,average);
}
function getNextP(idate,average)
{
    var PreDay = new Array();
    PreDay =getNextY(idate,average);
    return getP(PreDay['s'],average);
}
function getLastY(idate,average)
{
    var PreDay = new Array();
    PreDay['s'] = DateAdd((idate.getMonth()+1)+'/'+idate.getDate()+'/'+idate.getFullYear(),0-average);
    PreDay['e'] = DateAdd((idate.getMonth()+1)+'/'+idate.getDate()+'/'+idate.getFullYear(),0-average+ydate);
    return PreDay;
}
function getThisY(idate,average)
{
    var PreDay = new Array();
    PreDay['s'] = idate;
    PreDay['e'] = DateAdd((idate.getMonth()+1)+'/'+idate.getDate()+'/'+idate.getFullYear(),ydate);
    return PreDay;
}
function getNextY(idate,average)
{
    var PreDay = new Array();
    PreDay['s'] = DateAdd((idate.getMonth()+1)+'/'+idate.getDate()+'/'+idate.getFullYear(),average);
    PreDay['e'] = DateAdd((idate.getMonth()+1)+'/'+idate.getDate()+'/'+idate.getFullYear(),average+ydate);
    return PreDay;
}
function ReculerP(iYear,iMonth,iDay,average)
{
    tmp = new Date(iYear,iMonth-1,iDay);
    LastP = getLastP(tmp,average);
    ThisP = getThisP(tmp,average);
    NextP = getNextP(tmp,average);
    LastY = getLastY(tmp,average);
    ThisY = getThisY(tmp,average);
    NextY = getNextY(tmp,average);
    myMonth = fBuildCal(iYear,iMonth,LastP,ThisP,NextP,LastY,ThisY,NextY);
    fDrawCal(iYear, iMonth,myMonth,'calendar1');
    if(iMonth+1 >12){ iMonth = 1; iYear+=1;}
    else iMonth += 1;

    tmp = NextY['s'];
    if((tmp.getMonth+1)<iMonth)tmp = getNextY(tmp,average)['s'];

    LastP = getLastP(tmp,average);
    ThisP = getThisP(tmp,average);
    NextP = getNextP(tmp,average);
    LastY = getLastY(tmp,average);
    ThisY = getThisY(tmp,average);
    NextY = getNextY(tmp,average);
    myMonth = fBuildCal(iYear,iMonth,LastP,ThisP,NextP,LastY,ThisY,NextY);
    fDrawCal(iYear, iMonth,myMonth,'calendar2');
}

function DateAdd(time,Number)
{ 
     return new Date(Date.parse(time) + (86400000 * Number));  
} 

function DrawCalendar()
{
    $('#calendar1').html();
    $('#calendar2').html();
    time = $("#ysdate").val();
    if(!chkDate(time)){
        alert("日期格式输入有误，例如2008-5-1");
        $('#ysdate').focus();
        return false;
    }
    iYear = parseInt(time.split("-")[0]);
    //ydate = parseInt(document.getElementById("ydate").value)-1;
    ydate=4;
    iMonth = parseInt(time.split("-")[1]);
    iDay = parseInt(time.split("-")[2]);
    if(!iYear || !iMonth || !iDay){
        alert("日期格式输入有误，例如2008-5-1");
        $('#ysdate').focus();
        return false;
    }

    average = $("#vdate").val();
    ReculerP(iYear,iMonth,iDay,average);
    average = $("#cal").show();
}
function chkDate(sDate)
{
    var r=/\d{4}(?:-\d{1,2}){0,2}/
    //正则表达式，判断是否为yyyy-mm-dd,yyyy-mm,yyyy格式
    if(sDate.match(r)==sDate){
        var arr=sDate.split("-")
            switch(arr.length){
                //根据不同的yyyy-mm-dd,yyyy-mm格式判断年月日数字是否正确
                case 3:
                    arr[1] = arr[1]-1;
                    var tmpDate=new Date(arr[0],arr[1],arr[2]);
                    if(tmpDate.getMonth()==arr[1] && tmpDate.getFullYear()==arr[0]) return true;
                    break;
                case 2:
                    if(arr[1]<13) return true;
                    break;
                default:
                    return false;
            }
    }
    return false;
}

function cacu()
{
    var type='yuchanqi';
    var ts='';
    var c='';

    if(type == 'yuchanqi')
    {
        if(ts != '' && c != '')
        {
            $('#LastPer').val(ts);
            $('#averagePer').val(c);
            CalculatePre('LastPer');       
        }
//        $('#yuchanqi').show();
    }
    else if(type == 'painuanqi')
    {
        if(ts != '' && c != '')
        {
            $('#ysdate').val(ts);
            $('#vdate').val(c);
            DrawCalendar();
        }
//        $('#painuanqi').show();
    }
    else if(type == 'mianyijiezhong')
    {
//        $('#mianyijiezhong').show();
    }
}
$().ready(function(){
    cacu();
}
)
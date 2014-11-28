/**
 * 生日密码测试
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-12 上午10:16:38
 * @version 1.0
 */
//执行加载外部 JS 文件   
function loadJs(url, success) {  
  var domScript = document.createElement('script');  
  domScript.src = url;  
  success = success || function(){};  
  domScript.onload = domScript.onreadystatechange = function() {  
    if (!this.readyState || 'loaded' === this.readyState || 'complete' === this.readyState) {  
        this.onload = this.onreadystatechange = null;  
        success();  
        this.parentNode.removeChild(this);  
    }  
  }  
  document.getElementsByTagName('head')[0].appendChild(domScript);  
} 
function ChangeMonth()
{	
	var m = $("#month1").val();
	if(m == 2){
		$("#d30").hide();
		$("#d31").hide();
	}else if((m == 4)||(m == 6)||(m == 9)||(m == 11)){
		$("#d30").show();
		$("#d31").hide();
	}else{
		$("#d30").show();
		$("#d31").show();
	}
	return true;
}
function sub(){
	var m = $("#month1").val(),
		d = $("#day1").val();
	var url = $CONFIG['siteUrl']+"/birthday/js/"+m+"-"+d+".js?"+new Date().getTime();
	loadJs(url);
	$("#srtxt").hide();
	$("#mao").show();
	$("#srmm").show();
	if(m<10){
		m = '0'+m;
	}
	if(d<10){
		d = '0'+d;
	}
	var date = m + d;
	var index = '';
	if (date >= '0321' && date <= '0419')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz1.gif>");
	}
	else if (date >= '0420' && date <= '0520')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz2.gif>");
	}
	else if (date >= '0521' && date <= '0620')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz3.gif>");
	}
	else if (date >= '0621' && date <= '0722')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz4.gif>");
	}
	else if (date >= '0723' && date <= '0822')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz5.gif>");
	}
	else if (date >= '0823' && date <= '0922')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz6.gif>");
	}
	else if (date >= '0923' && date <= '1022')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz7.gif>");
	}
	else if (date >= '1023' && date <= '1121')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz8.gif>");
	}
	else if (date >= '1122' && date <= '1221')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz9.gif>");
	}
	else if (date >= '1122' && date <= '1231' || date >= '0101' && date <= '0119')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz10.gif>");
	}
	else if (date >= '0120' && date <= '0218')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz11.gif>");
	}
	else if (date >= '0219' && date <= '0320')
	{
		$('#xzgif').html("<img src="+$CONFIG['staticUrl']+"/images/anlian/xz12.gif>");
	}
	return;
}
function setData(con){
	var m = $("#month1").val(),
	d = $("#day1").val();
	$("#tit1").html(m+"月"+d+"日生日密码");
	$("#mima1").html(con.mima[0]);
	$("#mima2").html('<b>宫&nbsp;&nbsp;&nbsp;&nbsp;位：</b><br />'+con.mima[1]);
	$("#mima3").html('<b>星&nbsp;&nbsp;&nbsp;&nbsp;座：</b><br />'+con.mima[2]);
	
	$("#mima4").html("<p>"+con.mima[3]+"</p>");
	$("#mima5").html(con.mima[4]);
	$("#mima6").html(con.mima[5]);
	$("#mima7").html(con.mima[6]);
	$("#mima8").html("<p>"+con.mima[7]+"</p>");
	$("#mima9").html(con.mima[8]);
	$("#mima10").html(con.mima[9]);
	$("#mima11").html(con.mima[10]);
	$("#mima12").html(con.mima[11]);
	
	$("#tit2").html(m+"月"+d+"日生日花");
	$("#flower1").html('<b>'+m+"月"+d+"日：</b>"+con.flower[0]);
	$("#flower2").html('<b>花&nbsp;&nbsp;&nbsp;&nbsp;语</b>：'+con.flower[1]);
	$("#flower3").html('<b>花&nbsp;占&nbsp;卜</b>：'+con.flower[2]);
	$("#flower4").html('<b>幸&nbsp;运&nbsp;花：</b>'+con.flower[3]);
	$("#flower5").html('<b>花&nbsp;箴&nbsp;言：</b>'+con.flower[4]);
	
	$("#choc1").html('<b>日&nbsp;&nbsp;&nbsp;&nbsp;子</b>：'+con.choc[0]);
	$("#choc2").html('<b>巧&nbsp;克&nbsp;力</b>：'+con.choc[1]);
	$("#choc3").html('<b>成&nbsp;&nbsp;&nbsp;&nbsp;份：</b>'+con.choc[2]);
	$("#choc4").html('<b>特&nbsp;&nbsp;&nbsp;&nbsp;性：</b>'+con.choc[3]);
	$("#choc5").html('<b>生日占卜</b>：'+con.choc[4]);
	$("#choc5").html('<b>巧克力蜜语</b>：'+con.choc[5]);
	
	$("#tit4").html("<span>"+m+"月"+d+"日出生的名人</span>");
	$("#birth").html(con.birth);
	$("#tit5").html("<span>"+m+"月"+d+"日逝世的名人</span>");
	$("#die").html(con.die);
}
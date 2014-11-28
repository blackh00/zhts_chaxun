
/*数据服务类*/
var DataService = function(scriptid, url)
{
	this.scriptid = scriptid;
	this.url = url;
	this.thread = -1;
	this.interval = 30000;
	
	this.Request = function()
	{
		var server = arguments.callee.server;
		
		if(server.url.indexOf("?") == -1) server.url += "?";
		
		Common.AppendDataArray(server.scriptid, server.url + "&time=" + Common.Time());
	}
	
	this.Request.server = this;
	
	this.Start = function()
	{
		this.Stop();
		this.Request();
		this.thread = setInterval(this.Request, this.interval);
	}
	
	this.Stop = function()
	{
		if (this.thread != -1)
		{
			clearInterval(this.thread);
			this.thread = -1;
		}
	}
}

/*外汇实时行情*/
var FRunTimeQuote = new function()
{  
   this.url = "http://quote.forex.hexun.com/2010/Data/FRunTimeQuote.ashx";
   this.divID = "divQuote";
   this.scriptid = "divQuoteSCRIPT";
   
   this.code = "";
   this.dataArray = null;
   
   //闪烁效果处理
   this.timeObj = null;
   this.curColor = "";
   this.flashNum = 3;
   this.flashswitch = 0;
   
   this.CreateLink = function()
   {
	   var request = this.url + "?";
	   
	   if(this.code != "")
	   {
		  request += "code=" + this.code + "&";
	   }
	   
	   return request;
   }
  
   this.GetData = function(dataArr)
   {
		this.dataArray = dataArr;
		
		this.LoadMainQuote();
   }
   
   this.LoadMainQuote = function() // 外汇
   {
	  	var hc = new Array();
		
		// 代码0|名称1|最新价2|涨跌3|涨跌幅4|日期5
		// 开盘价6|最高价7|最低价8|昨收9|振幅10|买入价11|卖出价12

		//hc.push('<div class="gold_c_up">');
        hc.push('<div class="gold_c_up1"><strong>' + this.dataArray[1] + '</strong>(' + this.dataArray[0] + ')</div>');
        hc.push('<div class="gold_c_up2">' + this.ForamtPrice(this.dataArray[2], this.dataArray[3]) + '</div>');
        hc.push('<div class="gold_c_up3">' + this.GetPicture(this.dataArray[3]) + '<br /><span>' + this.ForamtPColor2(this.dataArray[2], this.dataArray[3], this.dataArray[3]) + '</span>(<span>' + this.ForamtPColor2(this.dataArray[2], this.dataArray[3], this.dataArray[4]) + '</span>)</div>');
        hc.push('<div class="gold_c_up4">开盘价 <span>' + this.ForamtPColor(this.dataArray[2], this.dataArray[9], this.dataArray[6]) + '</span>昨收价 ' + this.dataArray[9].toFixed(4) + '<br />最低价 <span>' + this.ForamtPColor(this.dataArray[2], this.dataArray[9], this.dataArray[8]) + '</span>最高价 <em>' + this.ForamtPColor(this.dataArray[2], this.dataArray[9], this.dataArray[7]) + '</em></div>');
        //hc.push('</div>');
		
		Common.$(this.divID).innerHTML = hc.join('');
	
		FRunTimeQuote.timeObj = setInterval(this.textFlash, 200);
   }
   
   this.GetPicture = function(updown)
   {
	  if(parseFloat(updown) > 0) return '<img src="' + $CONFIG['staticUrl'] + '/images/gold_up.gif" width="21" height="18" />';
	  else if(parseFloat(updown) < 0) return '<img src="' + $CONFIG['staticUrl'] + '/images/gold_down.gif" width="21" height="18" />';
	  else return '--&nbsp;';
   }
   
   this.ForamtPrice = function(price, updown) 
   {
	   if(parseFloat(price) == 0) return "停牌";
	   
	   var html = "";
	   
	   var color = "";
	  
	   if(parseFloat(updown) > 0) 
	   {
		  color = "#DC0000";
		  html = '<span class="current_red" id="newprice">' + price.toFixed(4) + '</span>';
	   }
	   else if(parseFloat(updown) < 0)
	   {
		  color = "#006600";
		  html = '<span class="current_green" id="newprice">' + price.toFixed(4) + '</span>';
	   }
	   else
	   {
	      color = "#000000";
		  html = '<span sytle="font-color:#000000;font-size:32px;font-weight:bold;" id="newprice">' + price.toFixed(4) + '</span>';
	   }
	   
	   FRunTimeQuote.curColor = color;
	   
	   return html;
   }
   
   this.ForamtPColor = function(price, preClose, pvalue)
   {
	  if(Number(price) == 0) return "--&nbsp;";
	  
	  var retvalue = '<span style="font-color:#000000">' + pvalue + '</span>';
	  
	  if(parseFloat(preClose) < parseFloat(pvalue))  retvalue = "<span class='red'>" + pvalue + "</span>";
	  else if(parseFloat(preClose) > parseFloat(pvalue)) retvalue = "<span class='green'>" + pvalue + "</span>";
	  
	  return retvalue;
   }
   
   this.ForamtPColor2 = function(price, updown, pvalue)
   {
	  if(Number(price) == 0) return "--&nbsp;";
	  
	  var retvalue = "<font color='#000000'>" + pvalue + "</font>";
	  
	  if(parseFloat(updown) > 0)       retvalue = "<font color='#DC0000'>" + pvalue + "</font>";
	  else if(parseFloat(updown) < 0)  retvalue = "<font color='#006600'>" + pvalue + "</font>";
	  
	  return retvalue;
   }
  
   this.ForamtSColor = function(price, pvalue)
   {
	   if(Number(price) == 0) return "--&nbsp;";
	   
	   return pvalue;
   }
   
   this.AutoReload = function()
	{
	   var dataService = new DataService(FRunTimeQuote.scriptid, FRunTimeQuote.CreateLink());
	   dataService.Start();
	}
   
   this.textFlash = function()
	{
		if(FRunTimeQuote.flashNum < 0)
		{
			Common.$("newprice").style.color = FRunTimeQuote.curColor;
			clearInterval(FRunTimeQuote.timeObj);
			
			return;
		}
		
		if(FRunTimeQuote.flashswitch == 0)
		{
			Common.$("newprice").style.color="#000000";
			FRunTimeQuote.flashswitch = 1;
		}
		else
		{
			Common.$("newprice").style.color = FRunTimeQuote.curColor;
			FRunTimeQuote.flashswitch = 0;
		}
		
		FRunTimeQuote.flashNum--;
	}
}


//判断浏览器
//判断浏览器
ff5 = navigator.appName == 'Netscape' ? true : false;//mozilla firefox   
ns4 = document.layers ? true : false;//Netscape   
ie4 = document.all ? true : false;//Microsoft   Internet   Explorer   

// static class
Common = new function(){
// private static fields 	

// public static method 
	this.$ = function(name)
	{
		return document.getElementById(name);
	}
	this._ = function(tagName)
	{
		return document.createElement(tagName);
	}
	this.Resize = function()
	{
		if(parent.document.getElementById("ifrName") != undefined){
			parent.document.getElementById("ifrName").style.height = document.body.scrollHeight + "px"; 
		}
	}
	this.GetDate = function(obj)
	{
		var date = new Date();
		var ss = date.getMonth()+1;
		var aa = ss;
		if(ss < 10 ) aa = "0" + ss; 
		var se = date.getDate();
		var sae = se;
		if(se < 10 ) sae = "0" + se;
		var tradedate = date.getFullYear()+ "-"  + aa + "-" + sae;
		Common.$(obj).value = tradedate;
	}
	this.Time = function()
	{
		var time = new Date();
		var h = time.getHours();
		var m = time.getMinutes();		
		var s = Math.floor(time.getSeconds()/10)*10; 
		var arg = (h<10 ? "0" + h : h) + "" + (m<10 ? "0" + m : m) + "" + (s<10 ? "0" + s : s);
		return arg;
	}
	this.IsDate = function(str)
	{
		var re = new RegExp(/^\d{4}-\d{2}-\d{2}$/);
		return re.test(str);
	}
	this.IsNumber = function(str)
	{
		var re = new RegExp(/^\d{1,}$/);
		return re.test(str);
	}
	this.IsDecimal = function(str)
	{
		var re = new RegExp(/^\d{1,}(.\d{1,}){0,1}$/);
		return re.test(str);
	}
	this.IsCode = function(str)
	{
		var re = new RegExp(/^\d{6}$/);
		return re.test(str);
	}
	this.IsCodeMarket = function(str)
	{
		var re = new RegExp(/^(\d{6}_\d{1}){1}(\|\d{6}_\d{1}){0,}$/);//
		return re.test(str);
	}
	this.IsHKCode = function(str)
	{
		var re = new RegExp(/^(\d{5}){1}(\|\d{5}){0,}$/);//90007|90001|90020|90006
		return re.test(str);
	}
	this.MarketString = function(str)
	{
		if(str == "1")
		{
			return "SH";
		}
		else
		{
			return "SZ";
		}
		return "SH";
	}
	this.AppendDataArray = function(id,url)
	{
		var obj = Common.$(id);
		if(obj){obj.parentNode.removeChild(obj);}
		var newscript = Common._("script");
		newscript.type = "text/javascript";
		newscript.src = url;
		newscript.id = id;
		document.getElementsByTagName('head')[0].appendChild(newscript); 
	}
	this.GetColor = function(value,fiducial)
	{
		if(value == undefined){
			return "--";
		}
		
		if(Number(value) == Number(fiducial)){
			return value;
		}
		else if(Number(value) > Number(fiducial)){
			return "<span class=\"red\">" + value + "</span>";
		}
		else if(Number(value) < Number(fiducial)){
			return "<span class=\"green\">" + value + "</span>";
		}
		return value;
	}
	this.GetColor2DEC = function(value,fiducial)
	{
		if(value == undefined){
			return "--";
		}
		
		if(Number(value) == Number(fiducial)){
			return value.toFixed(2);
		}
		else if(Number(value) > Number(fiducial)){
			return "<span class=\"red\">" + value.toFixed(2) + "</span>";
		}
		else if(Number(value) < Number(fiducial)){
			return "<span class=\"green\">" + value.toFixed(2) + "</span>";
		}
		return value;
	}
	this.GetColor3DEC = function(value,fiducial)
	{
		if(value == undefined){
			return "--";
		}
		
		if(Number(value) == Number(fiducial)){
			return value.toFixed(3);
		}
		else if(Number(value) > Number(fiducial)){
			return "<span class=\"red\">" + value.toFixed(3) + "</span>";
		}
		else if(Number(value) < Number(fiducial)){
			return "<span class=\"green\">" + value.toFixed(3) + "</span>";
		}
		return value;
	}
	this.GetColor4DEC = function(value,fiducial)
	{
		if(value == undefined){
			return "--";
		}
		
		if(Number(value) == Number(fiducial)){
			return value.toFixed(4);
		}
		else if(Number(value) > Number(fiducial)){
			return "<span class=\"red\">" + value.toFixed(4) + "</span>";
		}
		else if(Number(value) < Number(fiducial)){
			return "<span class=\"green\">" + value.toFixed(4) + "</span>";
		}
		return value;
	}
	this.GetColorClass = function(value,fiducial)
	{
		if(Number(value) == Number(fiducial)){
			return "";
		}
		else if(Number(value) > Number(fiducial)){
			return " class=\"red\"";
		}
		else if(Number(value) < Number(fiducial)){
			return " class=\"green\"";
		}
		return value;
	}
	this.GetParam = function (name)
	{
		var reg = new RegExp("(^|&|[?])" + name + "=([^&]*)(&|$)","i");   
    
		var r = window.document.location.href.match(reg);   

		if(r != null) return unescape(r[2]);   

		return null;  
	}
	
	this.GetParamEx = function (sourceInput, name)
	{
		var reg = new RegExp("(^|&|[?])" + name + "=([^&]*)(&|$)","i");   
    
		var r = sourceInput.match(reg);   

		if(r != null) return unescape(r[2]);   

		return null;  
	}

    this.AddFavorite = function(szURL, szTitle)
    {
		try
		{
			window.external.addFavorite(szURL, szTitle);
		}
		catch(e)
		{
			try
			{
			  window.sidebar.addPanel(szTitle, szURL, "Forex");
			}
			catch(e)
			{
				
			}
		}
    }
}



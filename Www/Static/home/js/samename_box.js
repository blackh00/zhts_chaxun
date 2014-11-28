//确决中文字符转换成unicode编码的函数
function uniencode(text) 
{ 
    text = escape(text.toString()).replace(/\+/g, "%2B"); 
    var matches = text.match(/(%([0-9A-F]{2}))/gi); 
    if (matches) 
    { 
        for (var matchid = 0; matchid < matches.length; matchid++) 
        { 
            var code = matches[matchid].substring(1,3); 
            if (parseInt(code, 16) >= 128) 
            { 
                text = text.replace(matches[matchid], '%u00' + code); 
            } 
        } 
    } 
    text = text.replace('%25', '%u0025'); 
  
    return text; 
}
//ajax请求同名同姓排名
function ajaxSubmitFull(obj){
	var fullname = $(obj).siblings("#fullname").val();
	if(fullname=='请输入您要查询的姓名'){
		alert('请输入您要查询的姓名');
		return false;
	}else{
		fullname = uniencode(fullname);
		window.location.href = $CONFIG['siteDynamicUrl']+"/samename/index/?fullname="+fullname;
	}
}
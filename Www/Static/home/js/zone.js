function check(){
	keyword = document.getElementById('search').value;
	if(keyword == '请输入您要查询的地名（如：上海）或区号（如：010）'){
		alert('请输入要查询的条件');
		return flase;
	}else if(/^\d+$/.test(keyword)){
		fnum(keyword);
	}else{
		fword(keyword);
	}
}
//根据区号查询地址	
function fnum(keyword){  
	$.ajax({
		url:$CONFIG['siteDynamicUrl']+'/zone/num',
		dataType:'jsonp',
		type:'get',
		data:{"keyword":keyword},
		jsonp:'callback',
		success:function(res){
			$('#jieguo').show();
			var str = '<h4>查询结果：</h4>';
			for(x in res)
			{	
				var city = uniencode(res[x]['address']);
				str += '<p><a href="'+$CONFIG['siteDynamicUrl']+'/ditu/?city='+city+'">查看地图&gt;&gt;</a>'+res[x]['province']+res[x]['address']+' 邮编：'+res[x]['code']+' 区号：'+res[x]['num']+'</p>';
			}
			$("#jieguo").html(str);
		}
		
	})
}
//根据地址查询区号
function fword(keyword){
	$.ajax({
		url:$CONFIG['siteDynamicUrl']+'/zone/word',
		dataType:'jsonp',
		type:'get',
		data:{"keyword":keyword},
		jsonp:'callback',
		success:function(res){
			$('#jieguo').show();
			var str = '<h4>查询结果：</h4>';
			for (x in res)
			{	
				var city = uniencode(res[x]['address']);
				str += '<p><a href="'+$CONFIG['siteDynamicUrl']+'/ditu/?city='+city+'">查看地图&gt;&gt;</a>'+res[x]['province']+res[x]['address']+' 邮编：'+res[x]['code']+' 区号：'+res[x]['num']+'</p>';
			}
			$("#jieguo").html(str);
		}
	});
}
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
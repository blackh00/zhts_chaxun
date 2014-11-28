//JS获取url传递过来的参数
function getQueryString(name){
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}
$(function(){
	var fullname = getQueryString('fullname');
	if(fullname){
		$.ajax({
			url:$CONFIG['siteDynamicUrl']+"/samename/fullname/",
			dataType:'jsonp',
			type:"get",
			data:{"fullname":fullname},
			jsonp:'callback',
			success:function(data){
				$('#shuru').show();
				$('#shuru2').hide();
				$('#shuru3').hide();
				$('#enter').hide();
				$('#result').show();
				$('#result2').hide();
				$('#result3').hide();
				$("#mc h3").html(data['mc']);
				$("#xm h3").html(data['xm']);
				var name = uniencode(data['xm']);
				var namehref_yy = $CONFIG['siteDynamicUrl']+'/yanyuceshi/?inputText='+name;
				$(".say-yy").attr('href',namehref_yy);
				$(".say_yy").attr('href',namehref_yy);
				$(".say-yy").html(data['xm']);
				var namehref_rp = $CONFIG['siteDynamicUrl']+'/character/?name='+name;
				$(".say-rp").attr('href',namehref_rp);
				$(".say_rp").attr('href',namehref_rp);
				$(".say-rp").html(data['xm']);
				if(data['flag']==1){
					$("#tmtxshu1").show();
					$("#tmtxshu2").hide();
					$("#tmtxshu1 h3").html(data['tmshu']);
				}else{
					$("#tmtxshu1").hide();
					$("#tmtxshu2").show();
					$("#tmtxshu2 h4").html(data['h4']);
					$("#tmtxshu2 h5").html(data['h5']);
				}
			}
		});
	}
});
//ajax请求同名同姓排名
function ajaxSubmitFull(){
	var fullname = $("#fullname").val();
	if(fullname=='请输入您要查询的姓名'){
		alert('请输入您要查询的姓名');
		return false;
	}else{
		$.ajax({
			url:$CONFIG['siteDynamicUrl']+"/samename/fullname/",
			dataType:'jsonp',
			type:"get",
			data:{"fullname":fullname},
			jsonp:'callback',
			success:function(data){
				$('#shuru').show();
				$('#shuru2').hide();
				$('#shuru3').hide();
				$('#enter').hide();
				$('#result').show();
				$('#result2').hide();
				$('#result3').hide();
				$("#mc h3").html(data['mc']);
				$("#xm h3").html(data['xm']);
				var name = uniencode(data['xm']);
				var namehref_yy = $CONFIG['siteDynamicUrl']+'/yanyuceshi/?inputText='+name;
				$(".say-yy").attr('href',namehref_yy);
				$(".say_yy").attr('href',namehref_yy);
				$(".say-yy").html(data['xm']);
				var namehref_rp = $CONFIG['siteDynamicUrl']+'/character/?name='+name;
				$(".say-rp").attr('href',namehref_rp);
				$(".say_rp").attr('href',namehref_rp);
				$(".say-rp").html(data['xm']);
				if(data['flag']==1){
					$("#tmtxshu1").show();
					$("#tmtxshu2").hide();
					$("#tmtxshu1 h3").html(data['tmshu']);
				}else{
					$("#tmtxshu1").hide();
					$("#tmtxshu2").show();
					$("#tmtxshu2 h4").html(data['h4']);
					$("#tmtxshu2 h5").html(data['h5']);
				}
			}
		});
	}
}
//ajax请求姓氏排名
function ajaxSubmitSur(){
	var surname = $("#surname").val();
	if(surname=='请输入您要查询的姓氏'){
		alert('请输入您要查询的姓氏');
		return false;
	}else{
		$.ajax({
			url:$CONFIG['siteDynamicUrl']+"/samename/surname/",
			dataType:'jsonp',
			type:"get",
			data:{"surname":surname},
			jsonp:'callback',
			success:function(data){
				$('#shuru').hide();
				$('#shuru2').show();
				$('#shuru3').hide();
				$('#enter').hide();
				$('#result').hide();
				$('#result2').show();
				$('#result3').hide();
				$("#mc2 h3").html(data['mc']);
				$("#xm2 h3").html(data['xm']);
				if(data['flag']==1){
					$("#txshu1").show();
					$("#txshu2").hide();
					$("#txshu1 h3").html(data['tmshu']);
				}else{
					$("#txshu1").hide();
					$("#txshu2").show();
					$("#txshu2 h4").html(data['h4']);
					$("#txshu2 h5").html(data['h5']);
				}
			}
		});
	}
}
function ajaxSubmitSur2(){
	var surname = $("#surname2").val();
	if(surname=='请输入您要查询的姓氏'){
		alert('请输入您要查询的姓氏');
		return false;
	}else{
		$.ajax({
			url:$CONFIG['siteDynamicUrl']+"/samename/surname/",
			dataType:'jsonp',
			type:"get",
			data:{"surname":surname},
			jsonp:'callback',
			success:function(data){
				$('#shuru').hide();
				$('#shuru2').show();
				$('#shuru3').hide();
				$('#enter').hide();
				$('#result').hide();
				$('#result2').show();
				$('#result3').hide();
				$("#mc2 h3").html(data['mc']);
				$("#xm2 h3").html(data['xm']);
				if(data['flag']==1){
					$("#txshu1").show();
					$("#txshu2").hide();
					$("#txshu1 h3").html(data['tmshu']);
				}else{
					$("#txshu1").hide();
					$("#txshu2").show();
					$("#txshu2 h4").html(data['h4']);
					$("#txshu2 h5").html(data['h5']);
				}
			}
		});
	}
}
//ajax请求名字排名
function ajaxSubmit(){
	var name = $("#name").val();
	if(name=='请输入您要查询的名字'){
		alert('请输入您要查询的名字');
		return false;
	}else{
		$.ajax({
			url:$CONFIG['siteDynamicUrl']+"/samename/name/",
			dataType:'jsonp',
			type:"get",
			data:{"name":name},
			jsonp:'callback',
			success:function(data){
				$('#shuru').hide();
				$('#shuru2').hide();
				$('#shuru3').show();
				$('#enter').hide();
				$('#result').hide();
				$('#result2').hide();
				$('#result3').show();
				$("#mc3 h3").html(data['mc']);
				$("#xm3 h3").html(data['xm']);
				if(data['flag']==1){
					$("#tmshu1").show();
					$("#tmshu2").hide();
					$("#tmshu1 h3").html(data['tmshu']);
				}else{
					$("#tmshu1").hide();
					$("#tmshu2").show();
					$("#tmshu2 h4").html(data['h4']);
					$("#tmshu2 h5").html(data['h5']);
				}
			}
		});
	}
}
function ajaxSubmit2(){
	var name = $("#name2").val();
	if(name=='请输入您要查询的名字'){
		alert('请输入您要查询的名字');
		return false;
	}else{
		$.ajax({
			url:$CONFIG['siteDynamicUrl']+"/samename/name/",
			dataType:'jsonp',
			type:"get",
			data:{"name":name},
			jsonp:'callback',
			success:function(data){
				$('#shuru').hide();
				$('#shuru2').hide();
				$('#shuru3').show();
				$('#enter').hide();
				$('#result').hide();
				$('#result2').hide();
				$('#result3').show();
				$("#mc3 h3").html(data['mc']);
				$("#xm3 h3").html(data['xm']);
				if(data['flag']==1){
					$("#tmshu1").show();
					$("#tmshu2").hide();
					$("#tmshu1 h3").html(data['tmshu']);
				}else{
					$("#tmshu1").hide();
					$("#tmshu2").show();
					$("#tmshu2 h4").html(data['h4']);
					$("#tmshu2 h5").html(data['h5']);
				}
			}
		});
	}
}
$("#fullname").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		ajaxSubmitFull();
	}
});
$("#surname").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		ajaxSubmitSur();
	}
});
$("#surname2").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		ajaxSubmitSur2();
	}
});
$("#name").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		ajaxSubmit();
	}
});
$("#name2").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		ajaxSubmit2();
	}
});
//确决中文字符转换成unicode编码的函数
function uniencode(text){ 
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
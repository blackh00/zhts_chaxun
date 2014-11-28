$(function () {
                function tabs(tabTit, on, tabCon) {
                    $(tabCon).each(function () {
                        $(this).children().eq(0).show();
                    });
                    $(tabTit).each(function () {
                        $(this).children().eq(0).addClass(on);
                    });
                    $(tabTit).children().click(function () {//鼠标"hover"的效果
                        $(this).addClass(on).siblings().removeClass(on);
                        var index = $(tabTit).children().index(this);
                        $(tabCon).children().eq(index).show().siblings().hide();
                    });
                }
                tabs(".tab-hd", "active", ".tab-bd");
            });
			
$(function () {
                function tabs(tabTit, on, tabCon) {
                    $(tabCon).each(function () {
                        $(this).children().eq(20).show();
                    });
                    $(tabTit).each(function () {
                        $(this).children().eq(20).addClass(on);
                    });
                    $(tabTit).children().click(function () {//鼠标"hover"的效果
                        $(this).addClass(on).siblings().removeClass(on);
                        var index = $(tabTit).children().index(this);
                        $(tabCon).children().eq(index).show().siblings().hide();
                    });
                }
				 tabs(".shiqu_nav", "active", ".shiqu_tab");
				  tabs(".dazhou_bg", "active", ".dazhou_con");
            });

 
 /**
  * yumao add 
  * 用ajax
  * 获取北京时间
  *
  */
$(function(){
	$.ajax({
		url:$CONFIG['siteDynamicUrl']+"/bjtime/reback",
		dataType:'jsonp',
		type:"get",
		jsonp:'callback',
		success:function(data){
			//alert('11111111');
			var time=data['bjtime'];
			setInterval(function() {
				set(time);
				time = Number(time);
				time += 1000;
			},1000);
		}		
	});
	
	// 每隔一秒中刷新一下时间的显示数据	
})
function p(s) {
	return s < 10 ? '0' + s : s;
}

function set(time){
    var week = '日一二三四五六';
	
	// 获取0时区的时间
	//$i 代表是第几个
	for(var $i=0;$i<=24;$i++){
		
		// 得到当前时区的时间
		if($i==0){ // 说明是东十二区
			var beijingTimeZone = 12;
		}else{
		
			var beijingTimeZone = $i-12;
		}
	
		var numIndex = $i;
		
		var timeOffset = ((-1 * (new Date()).getTimezoneOffset()) - (beijingTimeZone * 60)) * 60000;
		var now = new Date(time - timeOffset);
		$(".hourminutesecond :eq("+numIndex+")").html(p(now.getHours())+':'+p(now.getMinutes())+':'+p(now.getSeconds()));
		
		// 让中间大屏幕中时间发生变化
		$(".shi :eq("+numIndex+")").html(p(now.getHours()));
		$(".fen :eq("+numIndex+")").html(p(now.getMinutes()));
		$(".miao :eq("+numIndex+")").html(p(now.getSeconds()));
	}	
}

// 当前时区的其他城市切换


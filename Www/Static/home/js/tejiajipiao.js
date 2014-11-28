$.ajax({
			url:$CONFIG['siteDynamicUrl']+"/feiji/specialTicket",
			dataType:'jsonp', 
			type:"get",
			jsonp:'callback',
			success:function(returnInfo){
				
				// 清空#tejia1 div中的内容
				$("#tejia1").html("");
				//alert(returnInfo.length);
				 // 遍历returnInfo 对象
				for(var i in  returnInfo){
					
					// 创建ul对象
					if(i == "beijing"){
						var ul = $('<ul style="display:block;"></ul>'); 
					}else{
						var ul = $('<ul></ul>'); 
					}
					//alert(returnInfo[i].length);
					// 再遍历对象
					for(var j in returnInfo[i]){
						
						if(returnInfo[i][j]['path']){
							// 创建li对象
							var li = $('<li></li>');
							
							// 创建a对象
							var alink = $('<a href="'+returnInfo[i][j]['url']+'" target="_blank"></a>');
							
							// 创建span 对象
							if(j%2==0){
								var tj_span1 = $('<span class="tj_span1">'+returnInfo[i][j]['time']+'</span>');
							}else{
								var tj_span1 = $('<span class="tj_span1 ts1">'+returnInfo[i][j]['time']+'</span>');
							}
							
							var tj_span2 = $('<span class="tj_span2">'+returnInfo[i][j]['path']+'</span>');
							
							var tj_span3 = $('<span class="tj_span3">￥<strong>'+returnInfo[i][j]['price']+'</strong></span>');
							
							var tj_span4 = $('<span class="tj_span4">'+returnInfo[i][j]['discount']+'折</span>');
							
							// 往alink中追加span节点
							alink.append(tj_span1);
							alink.append(tj_span2);
							alink.append(tj_span3);
							alink.append(tj_span4);
							// 往li中追加节点
							li.append(alink);
							// 往ul中追加li
							ul.append(li);
						}
						
						
					}
					
					// 往#tejia1 div 中追加ul节点
					$("#tejia1").append(ul);
					$("#tejia1").append('<div style="clear:both; height:0; overflow:hidden;"></div>');
					//alert(returnInfo[i][1]['path']);
				}
			}
		})
$.ajax({
	url:$CONFIG['siteDynamicUrl']+"/feiji/hotelData",
	dataType:'jsonp', 
	type:"get",
	jsonp:'callback',
	success:function(resultInfo){
		$("#jiudian").html(""); // 清空jiudian div中的内容
		
		// 遍历resultInfo对象
		$(resultInfo).each(function(key,val){
			
			// 出现三个li就创键一个ul
			if(key % 3 == 0){
				if(key == 0){
				
					// 创建ul对象
					 ul = $('<ul style="display:block;"></ul>');
				} else {
				
					// 创建ul对象
					 ul = $('<ul></ul>');
				}
				
				// 把ul 追加到	$("#jiudian")中
				$("#jiudian").append(ul);
			}
			
			// 创建li对象
			var li = $('<li><a href="'+val['detailsUrl']+'" target="_blank"><img src="'+val['pic']+'" alt="" /></a><h4><a href="'+val['detailsUrl']+'" target="_blank">'+val['name']+'</a></h4><p><span>￥<strong>'+val['price']+'</strong>起</span>'+val['star']+'</p><p>位置：'+val['address']+'</p></li>');
			
			// 把li追加到ul中
			ul.append(li);
		})
		
		// 往$("#jiudian")中追加最后一个div
		$("#jiudian").append('<div style="clear:both; height:0; overflow:hidden;"></div>');
	}
})
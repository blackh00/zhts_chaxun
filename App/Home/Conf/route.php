<?php
/*
 *路由相关的配置
 *作者：yumao
 *联系方式:QQ:916564404
 */
 return array(	
	'URL_ROUTER_ON'	=> true,// 开启路由
	
	// 定义路由规则
	'URL_ROUTE_RULES'	=> array(
	
	/****关于频道首页的方法****/
	'jiaotong' 					=> 'm=Index&a=jiaotong',				// 交通出行频道首页所对应路由					
	'jiaoyu'					=> 'm=Index&a=jiaoyu',					// 教育学习频道首页
	'shenghuo'					=> 'm=Index&a=shenghuo',				// 生活频道首页对应路由
	'yule'						=> 'm=Index&a=yule',					// 娱乐频道首页对应路由
	'jinrong'					=> 'm=Index&a=jinrong',					// 金融频道首页对应路由
	'zonghe'					=> 'm=Index&a=zonghe', 					// 综合频道首页对应路由
	'search'					=> 'm=Index&a=search',					// 搜索频道对应路由
	
	/***十二生肖配对查询*****/
	'zodialmatch/:action'		=>  'm=ZodialMatch&a=:1',				// 十二生肖其他方法对应路由
    'zodialmatch'				=>  'm=ZodialMatch&a=index',			// 十二生肖查询首页对应路由
			
	/****ip搜索相关****/
	'ip/:action'				=>	'm=IpSearch&a=:1',   				// ip搜索其他方法对应路由
	'ip'						=>	'm=IpSearch&a=index',				// ip搜索首页index对应路由
	
	/****手机号码搜索相关***/
	'shouji/:action'			=>	'm=PhoneSearch&a=:1',				// 手机号码搜素其他方法对应路由
	'shouji'					=>	'm=PhoneSearch&a=index',			// 手机号码搜索index对应路由
	
	/****快递搜索相关******/
	'express/:action'			=>	'm=ExpressSearch&a=:1',				// 快递搜索其他方法对应路由
	'express' 					=>  'm=ExpressSearch&a=index',			// 快递搜索index方法对应路由
	
	/****飞机票搜索相关****/
	'feiji/:action' 			=>  'm=AirTicketSearch&a=:1',			// 飞机票搜索其他方法对应路由
	'feiji' 					=>  'm=AirTicketSearch&a=index',		// 飞机票搜索首页对应路由
	
	/****车牌号码搜索相关**/
	'chepaihao/:action' 		=>  'm=CarNumberSearch&a=:1',			// 车牌号搜索其他方法对应路由
	'chepaihao' 				=>  'm=CarNumberSearch&a=index',		// 车牌号搜索首页对应路由
	
	/****常用电话号码搜索相关***/
	'commontelphone/:action'	=>  'm=CommonTelphone&a=:1',			// 常用电话号码其他方法对应路由
	'commontelphone' 			=>  'm=CommonTelphone&a=index',			// 常用电话号码首页对应路由
	
	/****邮编搜索相关******/
	'youbian/:action'	   	 	=>  'm=PostcodeSearch&a=:1',			// 邮编搜索其他方法对应路由
	'youbian' 					=>  'm=PostcodeSearch&a=index',			// 邮编搜索首页对应路由
	
	/****交通标志相关******/
	'jiaotongbiaozhi/:action'	=>  'm=TrafficSignSearch&a=:1',			// 交通标志其他方法对应路由
	'jiaotongbiaozhi' 			=>  'm=TrafficSignSearch&a=index',		// 交通标志首页对应路由
	
	/****交通违规相关******/
	'jiaotongweigui/:action' 	=>  'm=TrafficViolateSearch&a=:1',		// 交通违规其他方法对应路由
	'jiaotongweigui' 			=>  'm=TrafficViolateSearch&a=index',	// 交通违规首页对应路由
	
	/****火车票相关********/
	'huochepiao/:action' 		=>  'm=TrainTicketSearch&a=:1',			// 火车票查询其他方法对应路由
	'huochepiao' 				=>  'm=TrainTicketSearch&a=index',		// 火车票查询首页对应路由
	
	/****生肖查询相关******/
	'shengxiao/:action' 		=>  'm=ShengxiaoSearch&a=:1',			// 生肖查询其他方法对应路由
	'shengxiao' 				=>  'm=ShengxiaoSearch&a=index',		// 生肖查询首页对应路由
	
	/***身份证查询相关*****/
	'shenfenzheng/:action'		=>	'm=IdentitySearch&a=:1',			// 身份证查询其他方法对应路由
	'shenfenzheng'				=>	'm=IdentitySearch&a=index',			// 身份证查询首页对应路由
	
	/***名人名言查询相关*****/
	'famous/:action'			=>	'm=Famous&a=:1',					// 名人名言查询其他方法对应路由
	'famous'					=>	'm=Famous&a=index',					// 名人名言查询首页对应路由
	
	/***电话区号查询相关*****/
	'zone/:action'				=>	'm=Zone&a=:1',						// 电话区号查询其他方法对应路由
	'zone'						=>	'm=Zone&a=index',					// 电话区号查询首页对应路由
	
	/***免费起名查询相关*****/
	'freename/:action'			=>	'm=FreeName&a=:1',					// 免费起名查询其他方法对应路由
	'freename'					=>	'm=FreeName&a=index',				// 免费起名查询首页对应路由
	
	/***食物热量查询相关*****/
	'food/:action'				=>	'm=Food&a=:1',						// 食物热量查询其他方法对应路由
	'food'						=>	'm=Food&a=index',					// 食物热量查询首页对应路由
	
	/***历史上的今天查询相关*****/
	'history/:action'			=>	'm=History&a=:1',					// 历史上的今天查询其他方法对应路由
	'history'					=>	'm=History&a=index',				// 历史上的今天查询首页对应路由

	/****翻译相关****/
	'fanyi/:action' 			=>  'm=Translation&a=:1',			    // 翻译其他方法对应路由
	'fanyi' 					=>  'm=Translation&a=index',		    // 翻译首页对应路由
			
	/***地图查询相关****/
	'ditu/:action'				=>	'm=MapSearch&a:1',					// 地图查询其他方法对应路由
	'ditu'						=>	'm=MapSearch&a=index',				// 地图查询首页对应路由

	/***风水命理相关****/
	'fengshui/:action'			=>	'm=Numerology&a=:1',				// 风水命理其他方法对应路由
	'fengshui'					=>	'm=Numerology&a=index',			    // 风水命理首页对应路由
	
	/***同名同姓相关****/
	'samename/:action'			=>	'm=SameName&a=:1',				    // 同名同姓其他方法对应路由
	'samename'					=>	'm=SameName&a=index',			    // 同名同姓首页对应路由
	
	/***标准体重相关****/
	'weightTest/:action'		=>	'm=WeightTest&a=:1',				// 标准体重其他方法对应路由
	'weightTest'				=>	'm=WeightTest&a=index',			    // 标准体重首页对应路由
	
	/***怀孕计算器相关****/
	'pregcheck/:action'			=>	'm=PregCheck&a=:1',				    // 怀孕计算器其他方法对应路由
	'pregcheck'					=>	'm=PregCheck&a=index',			    // 怀孕计算器首页对应路由

	/***手机号测吉凶相关****/
	'mobilenum/:action'			=>	'm=MobileNum&a=:1',				    // 手机号测吉凶其他方法对应路由
	'mobilenum'					=>	'm=MobileNum&a=index',			    // 手机号测吉凶首页对应路由
	
	/***姓名测试相关****/
	'xingmingces/:action'		=>	'm=NameTest&a=:1',				    // 姓名测试其他方法对应路由
	'xingmingces'				=>	'm=NameTest&a=index',			    // 姓名测试首页对应路由

	/***生辰八字测试相关****/
	'shengchengbazi/:action'	=>	'm=BirthDates&a=:1',				// 生辰八字测试其他方法对应路由
	'shengchengbazi'			=>	'm=BirthDates&a=index',			    // 生辰八字测试首页对应路由

	/***姓名测试相关****/
	'xingmingces/:action'		=>	'm=NameTest&a=:1',					// 姓名测试其他方法对应路由
	'xingmingces'				=>	'm=NameTest&a=index',				// 姓名测试首页对应路由

			
	/***新华字典相关****/
	'xinhua/:action'			=>	'm=Xinhua&a=:1',				    // 新华字典其他方法对应路由
	'xinhua'					=>	'm=Xinhua&a=index',			   		// 新华字典首页对应路由
	
	/***科学计算器相关****/
	'calculator/:action'		=>	'm=Calculator&a=:1',				// 科学计算器其他方法对应路由
	'calculator'				=>	'm=Calculator&a=index',			    // 科学计算器首页对应路由
	
	/***唐诗三百首相关****/
	'tangshisanbaishou/:action'	=>	'm=ThreeHundredTangPoems&a=:1',		// 唐诗三百首其他方法对应路由
	'tangshisanbaishou'			=>	'm=ThreeHundredTangPoems&a=index',	// 唐诗三百首首页对应路由
			
	/***计量单位换算器相关****/
	'converter/:action'			=>	'm=Converter&a=:1',					// 计量单位换算器其他方法对应路由
	'converter'					=>	'm=Converter&a=index',			    // 计量单位换算器首页对应路由
					
	/***历史朝代表相关****/
	'dynasty/:action'			=>	'm=Dynasty&a=:1',					// 历史朝代表其他方法对应路由
	'dynasty'					=>	'm=Dynasty&a=index',			    // 历史朝代表首页对应路由
	
	/***百科全书相关****/
	'encyclopedia/:action'		=>	'm=Encyclopedia&a=:1',				// 百科全书其他方法对应路由
	'encyclopedia'				=>	'm=Encyclopedia&a=index',			// 百科全书首页对应路由
	
	/***艳遇测试相关****/
	'yanyuceshi/:action'		=>	'm=YanYu&a=:1',				        // 艳遇测试其他方法对应路由
	'yanyuceshi'				=>	'm=YanYu&a=index',					// 艳遇测试首页对应路由						

	/***房贷计算器相关****/
	'buyhouse/:action'			=>	'm=BuyHouse&a=:1',					// 房贷计算器其他方法对应路由
	'buyhouse'					=>	'm=BuyHouse&a=index',				// 房贷计算器首页对应路由
	
	/***汇率转换相关***/
	'huilv/:action'				=>	'm=ExchangeRate&a=:1',				// 汇率转换其他方法对应路由
	'huilv'						=>	'm=ExchangeRate&a=index',				// 汇率转化首页对应的方法

	/***银行大全相关****/
	'bank/:action'				=>	'm=Bank&a=:1',						// 银行大全其他方法对应路由
	'bank'						=>	'm=Bank&a=index',					// 银行大全首页对应路由

	/***人品计算器相关****/
	'character/:action'			=>	'm=Character&a=:1',					// 人品计算器其他方法对应路由
	'character'					=>	'm=Character&a=index',				// 人品计算器首页对应路由
	
	/***脑筋急转弯相关****/
	'naojinjizhuanwan/:action'	=>	'm=Riddles&a=:1',			        // 脑筋急转弯其他方法对应路由
	'naojinjizhuanwan'			=>	'm=Riddles&a=index',		        // 脑筋急转弯首页对应路由
	

	/***黄金报价相关****/
	'huangjinbaojia/:action'	=>	'm=GoldPrice&a=:1',					// 黄金报价其他方法相关路由
	'huangjinbaojia'			=>	'm=GoldPrice&a=index',				// 黄金报价首页对应路由
	

	/***考试网相关****/
	'kaoshiwang/:action'		=>	'm=Examine&a=:1',			        // 考试网其他方法对应路由
	'kaoshiwang'				=>	'm=Examine&a=index',		        // 考试网首页对应路由
	
	/***谜语大全相关****/
	'riddle/:action'			=>	'm=Riddle&a=:1',			        // 谜语大全其他方法对应路由
	'riddle'					=>	'm=Riddle&a=index',		        	// 谜语大全首页对应路由

	/***汉字转拼音相关****/
	'hanzizhuanpinyin/:action'	=>	'm=HanZiToPinYin&a=:1',			    // 汉字转拼音其他方法对应路由
	'hanzizhuanpinyin'			=>	'm=HanZiToPinYin&a=index',		    // 汉字转拼音首页对应路由
	
	/***qq强制聊天相关****/
	'qqlt/:action'				=>	'm=Qqlt&a=:1',			    		// qq强制聊天其他方法对应路由
	'qqlt'						=>	'm=Qqlt&a=index',		   			// qq强制聊天首页对应路由
	
	/***金额大写转换相关****/
	'daxie/:action'				=>	'm=Daxie&a=:1',			    		// 金额大写转换其他方法对应路由
	'daxie'						=>	'm=Daxie&a=index',		    		// 金额大写转换首页对应路由
	
	/***退休养老保险金相关****/
	'tuixiuyanglao/:action'		=>	'm=TuiXiuYangLao&a=:1',			    // 退休养老保险金其他方法对应路由
	'tuixiuyanglao'				=>	'm=TuiXiuYangLao&a=index',		    // 退休养老保险金首页对应路由
	
	/***住房公积金相关****/
	'zhufanggongji/:action'		=>	'm=ZhuFangGongJi&a=:1',			    // 住房公积金其他方法对应路由
	'zhufanggongji'				=>	'm=ZhuFangGongJi&a=index',		    // 住房公积金首页对应路由
	
	/***社保相关****/
	'shebao/:action'			=>	'm=SheBao&a=:1',			    	// 社保其他方法对应路由
	'shebao'					=>	'm=SheBao&a=index',		    		// 社保首页对应路由
	
	/***教育部成绩相关****/
	'jiaoyubuchengji/:action'	=>	'm=JiaoYuBuChengJi&a=:1',			// 教育部成绩其他方法对应路由
	'jiaoyubuchengji'			=>	'm=JiaoYuBuChengJi&a=index',		// 教育部成绩首页对应路由
	
	/***四六级成绩相关****/
	'siliuji/:action'			=>	'm=SiLiuJi&a=:1',					// 四六级成绩其他方法对应路由
	'siliuji'					=>	'm=SiLiuJi&a=index',				// 四六级成绩首页对应路由
	
	/***语文工具书相关****/
	'yuwengongjushu/:action'	=>	'm=YuWenGongJuShu&a=:1',			// 语文工具书其他方法对应路由
	'yuwengongjushu'			=>	'm=YuWenGongJuShu&a=index',			// 语文工具书首页对应路由
	
	/***法律法规相关****/
	'falvfagui/:action'			=>	'm=FaLvFaGui&a=:1',					// 法律法规其他方法对应路由
	'falvfagui'					=>	'm=FaLvFaGui&a=index',				// 法律法规首页对应路由
	
	/***学历相关****/
	'xueli/:action'				=>	'm=XueLi&a=:1',						// 学历其他方法对应路由
	'xueli'						=>	'm=XueLi&a=index',					// 学历首页对应路由

				
	/***天气模块相关****/
	'tianqi/:action'			=>	'm=WeatherSearch&a=:1',				// 天气查询其他方法对应路由
	'tianqi'					=>	'm=WeatherSearch&a=index',			// 天气查询首页对应路由		

	
	/***周公解梦相关****/
	'dreamsearch/:action'		=>	'm=DreamSearch&a=:1',				// 周公解梦其他方法对应路由
	'dreamsearch'				=>	'm=DreamSearch&a=index',			// 周公解梦首页对应路由
			
	/***成语大全相关****/
	'phrase/:action'			=>	'm=Phrase&a=:1',			    	// 成语大全其他方法对应路由
	'phrase'					=>	'm=Phrase&a=index',		    		// 成语大全首页对应路由
	
	/***日历相关*****/
	'rili/:action'				=>	'm=RiliSearch&a=:1', 				// 日历其他方法对应路由
	'rili'						=>	'm=RiliSearch&a=index',				// 日立首页对应路由
	
	/***汽车标志大全相关***/
	'qichebiaozhi/:action'		=>	'm=CarSignSearch&a=:1',				// 汽车标志大全其他方法对应路由
	'qichebiaozhi'				=>	'm=CarSignSearch&a=index',			// 汽车标志首页对应路由

	'rili/:action'				=>	'm=RiliSearch&a=:1', 				// 日历其他方法对应路由
	'rili'						=>	'm=RiliSearch&a=index',				// 日立首页对应路由
	
	/***彩票相关*****/
	'caipiao/:action'			=>	'm=CaiPiao&a=:1', 					// 彩票其他方法对应路由
	'caipiao'					=>	'm=CaiPiao&a=index',				// 彩票首页对应路由
			
	/***北京时间相关*****/
	'bjtime/:action'			=>	'm=BjTime&a=:1', 					// 北京时间其他方法对应路由
	'bjtime'					=>	'm=BjTime&a=index',					// 北京时间首页对应路由
	
	/***女性安全期相关*****/
	'safeperiod/:action'		=>	'm=SafePeriod&a=:1', 				// 女性安全期其他方法对应路由
	'safeperiod'				=>	'm=SafePeriod&a=index',				// 女性安全期首页对应路由
	
	/***生日密码相关*****/
	'birthday/:action'  		=>	'm=Birthday&a=:1', 					// 生日密码其他方法对应路由
	'birthday'		    		=>	'm=Birthday&a=index',				// 生日密码首页对应路由
	
	/***姓名配对相关*****/
	'namematch/:action'		    =>	'm=NameMatch&a=:1', 				// 姓名配对其他方法对应路由
	'namematch'		 		    =>	'm=NameMatch&a=index',				// 姓名配对首页对应路由

	/***邮编搜索相关*****/
	'youbiansousuo/:action'	    =>  'm=PostCode&a=:1',					// 邮编搜索其他方法对应路由
	'youbiansousuo'				=>  'm=PostCode&a=index',				// 邮编搜索首页对应路由
	
	/***星座运势相关*****/
	'xingzuoyunshi/:action'	    =>  'm=Horoscope&a=:1',					// 星座运势其他方法对应路由
	'xingzuoyunshi'				=>  'm=Horoscope&a=index',				// 星座运势首页对应路由
	
	/***歇后语相关*****/
	'xiehouyu/:action'	    	=>  'm=XieHouYu&a=:1',					// 歇后语其他方法对应路由
	'xiehouyu'					=>  'm=XieHouYu&a=index',				// 歇后语首页对应路由
	
	/***黄道吉日相关*****/
	'huangdaojier/:action'	    =>  'm=Auspicious&a=:1',				// 黄道吉日其他方法对应路由
	'huangdaojier'				=>  'm=Auspicious&a=index',				// 黄道吉日首页对应路由
	
	/***食谱大全*****/	
	'caipu/:action'	    		=>  'm=CookBook&a=:1',					// 食谱大全其他方法对应路由
	'caipu'						=>  'm=CookBook&a=index',				// 食谱大全首页对应路由

	/***火星文转换*****/
	'huoxingwen/:action'	    =>  'm=TextSpeak&a=:1',					// 火星文转换其他方法对应路由
	'huoxingwen'				=>  'm=TextSpeak&a=index',				// 火星文转换首页对应路由
					
	/***24节气*****/
	'solar/:action'	    		=>  'm=Solar&a=:1',						// 24节气其他方法对应路由
	'solar'						=>  'm=Solar&a=index',					// 24节气首页对应路由
	
	/***标准女性三围*****/
	'measurements/:action'	    =>  'm=Measurements&a=:1',				// 标准女性三围其他方法对应路由
	'measurements'				=>  'm=Measurements&a=index',			// 标准女性三围首页对应路由
			
	/***心理年龄测试*****/
	'mentalagetest/:action'	    =>  'm=MentalAgeTest&a=:1',				// 心理年龄测试其他方法对应路由
	'mentalagetest'				=>  'm=MentalAgeTest&a=index',			// 心理年龄测试首页对应路由
	
	/***银行Atm网点查询*****/
	'atm/:action'	    		=>  'm=Atm&a=:1',						// 银行Atm网点查询其他方法对应路由
	'atm'						=>  'm=Atm&a=index',					// 银行Atm网点查询首页对应路由
	
	/***IQ智力测试*****/
	'iq/:action'	    		=>  'm=Iq&a=:1',						// 智力测试其他方法对应路由
	'iq'						=>  'm=Iq&a=index',						// 智力测试首页对应路由
	
	/***暗恋测试*****/
	'crush/:action'	   			=>  'm=Crush&a=:1',						// 暗恋测试其他方法对应路由
	'crush'						=>  'm=Crush&a=index',					// 暗恋测试首页对应路由
			
	/***成语接龙*****/
	'idiom/:action'	  			=>  'm=Idiom&a=:1',						// 成语接龙测试其他方法对应路由
	'idiom'						=>  'm=Idiom&a=index',					// 成语接龙测试首页对应路由
	
	/***离婚计算器*****/
	'divorce/:action'	   	 	=>  'm=Divorce&a=:1',					// 离婚计算器其他方法对应路由
	'divorce'					=>  'm=Divorce&a=index',				// 离婚计算器首页对应路由
	
	/***血型性格*****/
	'blood/:action'	   	 		=>  'm=Blood&a=:1',						// 血型性格其他方法对应路由
	'blood'						=>  'm=Blood&a=index',					// 血型性格首页对应路由
	
	/***电视节目预告*****/
	'promo/:action'	   	 		=>  'm=Promo&a=:1',						// 电视节目预告其他方法对应路由
	'promo'						=>  'm=Promo&a=index',					// 电视节目预告首页对应路由
	
	/***汉语词典*****/
	'hanyucidian/:action'	   	=>  'm=HanYuCiDian&a=:1',				// 汉语词典查询其他方法对应路由
	'hanyucidian'				=>  'm=HanYuCiDian&a=index',			// 汉语词典首页对应路由
	
	/***国家药品查询*****/
	'drug/:action'	   			=>  'm=Drug&a=:1',						// 国家药品查询其他方法对应路由
	'drug'						=>  'm=Drug&a=index',					// 国家药品查询首页对应路由
			
	/***性格色彩测试*****/
	'personalitytest/:action'	=>  'm=PersonalityTest&a=:1',			// 性格色彩测试查询其他方法对应路由
	'personalitytest'			=>  'm=PersonalityTest&a=index',		// 性格色彩测试首页对应路由
	
	/***电台查询*****/
	'radio/:action'				=>  'm=Radio&a=:1',						// 电台查询其他方法对应路由
	'radio'						=>  'm=Radio&a=index',					// 电台查询首页对应路由
	
	/***搞笑网络证件查询*****/
	'funnyweb/:action'			=>  'm=FunnyWeb&a=:1',					// 搞笑网络证件查询其他方法对应路由
	'funnyweb'					=>  'm=FunnyWeb&a=index',				// 搞笑网络证件询首页对应路由
	
	/***快递电话查询*****/
	'expresstelphone/:action'	=>  'm=ExpressTelphone&a=:1',			// 快递电话查询其他方法对应路由
	'expresstelphone'			=>  'm=ExpressTelphone&a=index',		// 快递电话查询首页对应路由
	
	/***世界时间证件查询*****/
	'worldtime/:action'			=>  'm=WorldTime&a=:1',					// 世界时间查询其他方法对应路由
	'worldtime'					=>  'm=WorldTime&a=index',				// 世界时间查询首页对应路由
	
	/***血型自测证件查询*****/
	'bloodtest/:action'			=>  'm=BloodTest&a=:1',					// 血型自测查询其他方法对应路由
	'bloodtest'					=>  'm=BloodTest&a=index',				// 血型自测查询首页对应路由
	
	/***手相查询*****/
	'plam/:action'				=>  'm=Plam&a=:1',						// 手相查询其他方法对应路由
	'plam'						=>  'm=Plam&a=index',					// 手相查询首页对应路由
			
	/***彩票查询*****/
	'lottery/:action'			=>  'm=Lottery&a=:1',					// 彩票查询其他方法对应路由
	'lottery'					=>  'm=Lottery&a=index',				// 彩票查询首页对应路由

	));

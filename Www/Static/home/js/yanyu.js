// JavaScript Document
var myDate=new Date();
function getStringCharCode(str){
	var num=0;
	for(var i=0;i<str.length;i++){
		num+=str.charCodeAt(i);
	}
	return num;	
}
function getNum(str){
	var myDate=new Date();
	var num=myDate.getDate()*(myDate.getDate()+7)*(myDate.getDate()+13);
	num=num+this.getStringCharCode(str)*9;

	return num;
	
	}
function returnNum(value){
	var stri=this.getNum(value);
	stri=String(stri).charAt(2)+String(stri).charAt(String(stri).length-2);
	stri=Number(stri);
	

	if(stri<=70 && stri>=10){
		//stri=stri+30;
	}
	else if(stri==0){
		stri=100;
		
	}	
	
	return stri;
}		
function showText(value){
	
	if(value==100){
		return "<font color:#FF0000>传说中的艳遇之神出现啦！抽奖看看，是不是锦上添花？</font>";
		}
	else if(value==99){
		return "<font color:#FF0000>恭喜你，艳遇收场，赶快抽奖，延续你一生的完美结局吧!</font>";
		}	
		
	else if(value>=96 && value<=98){
		return "幸福咫尺之间，赶紧抽艳遇筹码，嘿嘿，枕旁的他/她已经在向你招手！!";
		}	
		
	else if(value>=91 && value<=95){
		return "风流倜傥，玉树凌风，一朵梨花压海棠，艳遇不找你找谁啊？抽奖拿艳遇筹码直接奔艳场！";
		}
		
	else if(value>=86 && value<=90){
		return "有艳遇，有艳遇，还是有艳遇呢？还不赶紧抽取筹码开展艳遇攻战！";
		}	
		
	else if(value>=81 && value<=85){
		return "每次艳遇都会有激情爆发，激情，机情，还是基情，快点击抽奖获取激情艳遇筹码吧！    ";
		}	
		
	else if(value>=71 && value<=80){
		return "一段毕生难忘的艳遇就在今天，还等什么抽奖拿艳遇筹码吧！";
		}	
		
	else if(value>=60 && value<=70){
		return  "刚刚好，出门一定偶遇ta！抽奖拿艳遇筹码计划一下";
		}	
	else if(value>=50 && value<=59){
		return " 艳遇是搞出来的，你等有什么用，抽奖啊，快！";
		}			
		
	else if(value>=41 && value<=49){
		return " 艳遇是搞出来的，你等有什么用，抽奖啊，快！";
		}	
		
	else if(value>=30 && value<=40){
		return "艳遇的初始，或许只是一次偶然的意外，但却成就了无限的可能。赶紧抽奖把不可能变成有可能。";
		}		
		
	else if(value>=26 && value<=29){
		return "艳遇看见您就跑，马不停蹄的跑啊，赶紧抽取艳遇筹码把ta追回来吧";
		}
		
	else if(value>=6 && value<=25){
		return "您真需要丢进培养瓶加温！马上抽奖拿艳遇筹码拯救自己吧！";
		}	
		
	else if(value>=0 && value<=5){
		   return "活得太有勇气，长得太有创意，五官排列比较随心所欲。如果不想回火星就赶紧抽奖获艳遇筹码。";
		}	
}		
function test(){
	var str_input=document.getElementById("inputText").value;
	if(str_input != '' && str_input.length <=6){
			var stri=returnNum(document.getElementById("inputText").value);
			var showNum=stri;
			//showText(stri);
			var inputText=document.getElementById('inputText'); 
			var str = inputText.value;
			var userName = document.getElementById("userName");
			userName.innerHTML = str;
			
			var score = document.getElementById("score");
			score.innerHTML = showNum;
			
			var comment = document.getElementById("comment");
			comment.innerHTML = showText(stri);
			
			var yanyu_jieguo= document.getElementById('yanyu_jieguo');
			yanyu_jieguo.style.display="block";
			
			var yanyu_c= document.getElementById('yanyu_c');
			yanyu_c.style.display="none";
			
			if(showNum > 100 ){
				var yanyu_bg= document.getElementById('yanyu_bg');
				yanyu_bg.style.background='';			
				yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p1.jpg) right top no-repeat";
			}else if(showNum >=81 && showNum <=100){
				var yanyu_bg= document.getElementById('yanyu_bg');
				yanyu_bg.style.background='';			
				yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p1.jpg) right top no-repeat";
			}else if(showNum >=41 && showNum <=80){
				var yanyu_bg= document.getElementById('yanyu_bg');
				yanyu_bg.style.background='';			
				yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p2.jpg) right top no-repeat";
			}else if(showNum >=1 && showNum <=40){
				var yanyu_bg= document.getElementById('yanyu_bg');
				yanyu_bg.style.background='';			
				yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p3.jpg) right top no-repeat";
			}else if(showNum >=-49 && showNum <=0){
				var yanyu_bg= document.getElementById('yanyu_bg');
				yanyu_bg.style.background='';			
				yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p4.jpg) right top no-repeat";
			}else if(showNum >=-89 && showNum <=-50){
				var yanyu_bg= document.getElementById('yanyu_bg');
				yanyu_bg.style.background='';			
				yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p5.jpg) right top no-repeat";
			}else if(showNum >=-100 && showNum <=-90){
				var yanyu_bg= document.getElementById('yanyu_bg');
				yanyu_bg.style.background='';			
				yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p6.jpg) right top no-repeat";
			}else{
				var yanyu_bg= document.getElementById('yanyu_bg');
				yanyu_bg.style.background='';			
				yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p6.jpg) right top no-repeat";
			}
			
			if(showNum > 0){
				
				var k1=Math.floor(showNum/20);	
				var k2=showNum%20;			
				if(k2 == 0){
					var k3=5-k1;
				}else{
					var k3=5-k1-1;
				}
				
				var i;
				var j;
				var oTest=document.getElementById('yanyu_xing');
				oTest.innerHTML="";
				for(i=1;i<=k1;i++){
					var newNode = document.createElement("div"); 
					oTest.appendChild(newNode);
				}
				if(k2 != 0){
					var newNode = document.createElement("div");
					newNode.className='yanyu_xing1';
					oTest.appendChild(newNode);
					//yanyu_xing.appendChild('<div class="yanyu_xing2"></div>');
				}
				for(j=1;j<=k3;j++){
					var newNode = document.createElement("div");
					newNode.className='yanyu_xing2';
					oTest.appendChild(newNode);
					//yanyu_xing.appendChild('<div class="yanyu_xing3"></div>');
				}	
				
			}
			
			
	}else{
		alert("请输入要测试的名字。");
	}
}

$(document).ready(function(){
	// 为输入框添加回车事件
	 $("#inputText").keypress(function(event){
		var e = event||window.event;
		if(e.keyCode=="13"){
			test();
		}
		})
});
//JS获取url传递过来的参数
function getQueryString(name){
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}
//频道页跳转到内容也的处理方法
function submit_yanyu(){
	var inputText = document.getElementById("inputText").value;
	if(inputText == "请输入要测试的名字"){
		alert("请输入要测试的名字!");
		return false;
	}else{
		inputText  = uniencode(ignoreSpaces(inputText));
		window.location.href='/yanyuceshi/?inputText='+inputText;
	}
}
//得到频道页面传递过来的参数
inputText  = getQueryString('inputText');
showNum = returnNum(inputText);
//显示名称
var userName = document.getElementById("userName");
userName.innerHTML = inputText;
//显示分数
var score = document.getElementById("score");
score.innerHTML = showNum;
//显示评价
var comment = document.getElementById("comment");
comment.innerHTML = showText(showNum);

var yanyu_jieguo= document.getElementById('yanyu_jieguo');
yanyu_jieguo.style.display="block";

var yanyu_c= document.getElementById('yanyu_c');
yanyu_c.style.display="none";

if(showNum > 100 ){
	var yanyu_bg= document.getElementById('yanyu_bg');
	yanyu_bg.style.background='';			
	yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p1.jpg) right top no-repeat";
}else if(showNum >=81 && showNum <=100){
	var yanyu_bg= document.getElementById('yanyu_bg');
	yanyu_bg.style.background='';			
	yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p1.jpg) right top no-repeat";
}else if(showNum >=41 && showNum <=80){
	var yanyu_bg= document.getElementById('yanyu_bg');
	yanyu_bg.style.background='';			
	yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p2.jpg) right top no-repeat";
}else if(showNum >=1 && showNum <=40){
	var yanyu_bg= document.getElementById('yanyu_bg');
	yanyu_bg.style.background='';			
	yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p3.jpg) right top no-repeat";
}else if(showNum >=-49 && showNum <=0){
	var yanyu_bg= document.getElementById('yanyu_bg');
	yanyu_bg.style.background='';			
	yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p4.jpg) right top no-repeat";
}else if(showNum >=-89 && showNum <=-50){
	var yanyu_bg= document.getElementById('yanyu_bg');
	yanyu_bg.style.background='';			
	yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p5.jpg) right top no-repeat";
}else if(showNum >=-100 && showNum <=-90){
	var yanyu_bg= document.getElementById('yanyu_bg');
	yanyu_bg.style.background='';			
	yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p6.jpg) right top no-repeat";
}else{
	var yanyu_bg= document.getElementById('yanyu_bg');
	yanyu_bg.style.background='';			
	yanyu_bg.style.background="url("+$CONFIG['staticUrl']+"/images/yanyu/yanyu_p6.jpg) right top no-repeat";
}
if(showNum > 0){
	
	var k1=Math.floor(showNum/20);	
	var k2=showNum%20;			
	if(k2 == 0){
		var k3=5-k1;
	}else{
		var k3=5-k1-1;
	}
	
	var i;
	var j;
	var oTest=document.getElementById('yanyu_xing');
	oTest.innerHTML="";
	for(i=1;i<=k1;i++){
		var newNode = document.createElement("div"); 
		oTest.appendChild(newNode);
	}
	if(k2 != 0){
		var newNode = document.createElement("div");
		newNode.className='yanyu_xing1';
		oTest.appendChild(newNode);
		//yanyu_xing.appendChild('<div class="yanyu_xing2"></div>');
	}
	for(j=1;j<=k3;j++){
		var newNode = document.createElement("div");
		newNode.className='yanyu_xing2';
		oTest.appendChild(newNode);
		//yanyu_xing.appendChild('<div class="yanyu_xing3"></div>');
	}	
	
}
//JS过滤空格函数
function ignoreSpaces(string){
	var temp = "";
	string = '' + string;
	splitstring = string.split(" ");
	for(i = 0; i < splitstring.length; i++)
	temp += splitstring[i];
	return temp;
}
//解决中文字符转换成unicode编码的函数
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
//JS获取url传递过来的参数
function getQueryString(name){
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}
//频道页跳转到内容也的处理方法
function submit(){
	var name = document.getElementById("name").value;
	if(name == "请输入您的尊姓大名"){
		alert("请输入您的尊姓大名!");
		return false;
	}else{
		name  = uniencode(ignoreSpaces(name));
		window.location.href='/character/?name='+name;
	}
}
$("#name").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		calculate();
	}
});
function calculate(){
	var name = document.getElementById("name").value;
	if(name == "请输入您的尊姓大名" || name ==""){
		alert("请输入您的尊姓大名!");
		return false;
	}else{
		name  = ignoreSpaces(name);
		for(i = 0;i < name.length; i++){
			a = 0;
			a += name.charCodeAt(i);
		}
		shuzi=(a*47+70)%100;
		$("#renpin_p1").html(name);
		$("#renpin_p2").html(shuzi);
		$("#renpin_p3").html(getValue(shuzi));
		$("#renpin_img").html(getImg(shuzi));
	}
}
name  = getQueryString('name');
if(name == 'null'|| name == ''){
	name='张三';
}
a = 0;
for(i = 0;i < name.length; i++){
	a += name.charCodeAt(i);
}
shuzi=(a*47+70)%100;
$("#renpin_p1").html(name);
$("#renpin_p2").html(shuzi);
$("#renpin_p3").html(getValue(shuzi));
$("#renpin_img").html(getImg(shuzi));

	
//JS过滤空格函数
function ignoreSpaces(string){
	var temp = "";
	string = '' + string;
	splitstring = string.split(" ");
	for(i = 0; i < splitstring.length; i++)
	temp += splitstring[i];
	return temp;
}
//人品描述
function getValue(shuzi){
	if(shuzi== 0){
	    result = "你一定不是人吧？怎么一点人品都没有？！";
	}else if((shuzi>0)&&(shuzi<=5)){
	    result = "算了，跟你没什么人品好谈的...";
	}else if((shuzi > 5) && (shuzi <= 10)){
	    result = "是我不好...不应该跟你谈人品问题的...";
	}else if((shuzi > 10) && (shuzi <= 15)){
	    result = "杀过人没有?放过火没有?你应该无恶不做吧?";
	}else if((shuzi > 15) && (shuzi <= 20)){
	    result = "你貌似应该三岁就偷看隔壁大妈洗澡的吧...";
	}else if((shuzi > 20) && (shuzi <= 25)){
	    result = "你的人品之低下实在让人惊讶啊...";
	}else if((shuzi > 25) && (shuzi <= 30)){
	    result = "你的人品太差了。你应该有干坏事的嗜好吧?";
	}else if((shuzi > 30) && (shuzi <= 35)){
	    result = "你的人品真差!肯定经常做偷鸡摸狗的事...";
	}else if((shuzi > 35) && (shuzi <= 40)){
	    result = "你拥有如此差的人品请经常祈求佛祖保佑你吧...";
	}else if((shuzi > 40) && (shuzi <= 45)){
	    result = "老实交待..那些论坛上面经常出现的偷拍照是不是你的杰作?";
	}else if((shuzi > 45) && (shuzi <= 50)){
	    result = "你随地大小便之类的事没少干吧?";
	}else if((shuzi > 50) && (shuzi <= 55)){
	    result = "你的人品太差了..稍不小心就会去干坏事了吧?";
	}else if((shuzi > 55) && (shuzi <= 60)){
	    result = "你的人品很差了..要时刻克制住做坏事的冲动哦..";
	}else if((shuzi > 60) && (shuzi <= 65)){
	    result = "你的人品比较差了..要好好的约束自己啊..";
	}else if((shuzi > 65) && (shuzi <= 70)){
	    result = "你的人品勉勉强强..要自己好自为之..";
	}else if((shuzi > 70) && (shuzi <= 75)){
	    result = "有你这样的人品算是不错了..";
	}else if((shuzi > 75) && (shuzi <= 80)){
	    result = "你有较好的人品..继续保持..";
	}else if((shuzi > 80) && (shuzi <= 85)){
	    result = "你的人品不错..应该一表人才吧?";
	}else if((shuzi > 85) && (shuzi <= 90)){
	    result = "你的人品真好..做好事应该是你的爱好吧..";
	}else if((shuzi > 90) && (shuzi <= 95)){
	    result = "你的人品太好了..你就是当代活雷锋啊...";
	}else if((shuzi > 95) && (shuzi <= 99)){
	    result = "你是世人的榜样！";
	}else if(shuzi == 100){
		result = "天啦！你不是人！你是神！！！";
	}else{
	    result = "你的人品竟然负溢出了...我对你无语..";
	}
	return result;
}
//人品对应的图片
function getImg(shuzi){
	if(shuzi <=10){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/0-10.gif' alt='' />";
	}else if(shuzi <=20){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/10-20.gif' alt='' />";
	}else if(shuzi <=30){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/20-30.gif' alt='' />";
	}else if(shuzi <=40){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/30-40.gif' alt='' />";
	}else if(shuzi <=50){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/40-50.gif' alt='' />";
	}else if(shuzi <=60){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/50-60.gif' alt='' />";
	}else if(shuzi <=70){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/60-70.gif' alt='' />";
	}else if(shuzi <=80){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/70-80.gif' alt='' />";
	}else if(shuzi <=90){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/80-90.gif' alt='' />";
	}else if(shuzi <=100){
		img = "<img src='"+$CONFIG['staticUrl']+"/images/renpin/90-100.gif' alt='' />";
	}else{
		img = "<img src='images/renpin/90-100.gif' alt='' />";
	}
	return img;
}
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
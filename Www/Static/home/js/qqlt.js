function shouyetijiao(){
	var zdssname = document.getElementById('zdssname').value;
	if (/[^\d]/.test(zdssname)){
		alert("请输入QQ号码 ");
	}else if(zdssname.length<6 || zdssname.length>10){
		alert("请输入QQ号码 ");	
	}else{
		window.open("http://wpa.qq.com/msgrd?v=3&uin="+encodeURI(''+document.getElementById("zdssname").value+'')+"&site=qq&menu=yes");
	}
}
$("#zdssname").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		shouyetijiao();
	}
});
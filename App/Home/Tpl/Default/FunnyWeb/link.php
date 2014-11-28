<srcipt type="text/javascript">
function alert_window(){
	if(navigator.appName.indexOf('Explorer') > -1){
  		var imgname = document.getElementById('iframe').innerText;
  	}else{
		var imgname = document.getElementById('iframe').textContent;
	}
	window.parent.dey(imgname);
}
alert_window();
</srcipt>
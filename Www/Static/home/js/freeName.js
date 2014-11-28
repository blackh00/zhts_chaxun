function checkForm(){
	keyword = document.getElementById('type').value;
	if(keyword == '请输入您的姓氏，如“王”'){
		alert('请输入您的姓氏，如“王”');
		return false;
	}else{
		document.getElementById('form').submit();
	}
}
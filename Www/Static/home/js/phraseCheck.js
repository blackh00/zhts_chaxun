function phraseCheck(){
	keyword = document.getElementById('phraseSearch').value;
	if(keyword == '请输入关键字'){
		alert('请输入关键字');
		return false;
	}else{
		document.getElementById('phraseForm').submit();
	}
}
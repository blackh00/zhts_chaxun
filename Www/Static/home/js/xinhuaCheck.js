function check(){
	keyword = document.getElementById('search').value;
	if(keyword == '请输入要查询的汉字或拼音'){
		alert('请输入要查询的条件');
		return false;
	}else{
		document.getElementById('form').submit();
	}
}
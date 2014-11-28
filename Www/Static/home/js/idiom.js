/**
 * 成语接龙
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-3 下午5:27:47
 * @version 1.0
 */
function idiom_check(){
	var start = $('#start').val();
	if(start =='请输入成语'){
		alert('请输入成语');
		return false;
	}else{
		$('#form').submit();
	}
}
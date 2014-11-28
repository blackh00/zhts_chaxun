function ks_search(){
	$('.yaopin').hide();
	$('#ks').show();
}
function gj_search(){
	$('.yaopin').hide();
	$('#gj').show();
}
function check_form_ks(){
	var keyword = $('#keyword').val();
	if(keyword == ''){
		alert('请输入关键字！');
		return false;
	}else{
		$('#form_ks').submit();
	}
}
//判断是否是数字
function isInt(str){
	var reg = /^(-|\+)?\d+$/ ;
	return reg.test(str);
}
//分页跳转处理
function get_search_page_ks(){
	var category = $('#category').val();
	var key = $('#key').val();
	var i_page = $('#i_page').val();
	if(isInt(i_page)==true){
		window.location.href = $CONFIG['siteDynamicUrl']+'/drug/result/drug_key/'+key+'/category/'+category+'/flags/ks/p/'+i_page;
	}else{
		alert('请输入正确数字');
	}
}
function get_search_page_gj(){
	var appnum = $('#appnum').val();
	var pname = $('#pname').val();
	var ename = $('#ename').val();
	var name = $('#name').val();
	var category = $('#category').val();
	var unit = $('#unit').val();
	var code = $('#code').val();
	var appnum2 = $('#appnum2').val();
	var i_page = $('#i_page').val();
	var where = '';
	if(appnum!=''){
		where = where+'/appnum/'+appnum; 
	}
	if(pname!=''){
		where = where+'/pname/'+pname; 
	}
	if(ename!=''){
		where = where+'/ename/'+ename; 
	}
	if(name!=''){
		where = where+'/name/'+name; 
	}
	if(appnum2!=''){
		where = where+'/appnum2/'+appnum2; 
	}
	if(unit!=''){
		where = where+'/unit/'+unit; 
	}
	if(code!=''){
		where = where+'/code/'+code; 
	}
	if(category!=''){
		where = where+'/category/'+category; 
	}
	if(isInt(i_page)==true){
		window.location.href = $CONFIG['siteDynamicUrl']+'/drug/result'+where+'/flags/gj/p/'+i_page;
	}else{
		alert('请输入正确数字');
	}
}
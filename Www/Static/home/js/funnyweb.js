/**
 * 复制到剪切板
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-8-6 上午11:30:01
 * @version 1.0
 */
function copyImage(img){
	if($("#pic_new").css("display") == "none"){
		alert("请先点击办理证件，再复制");
		return;
	}
	if (img.tagName != 'IMG')
	{
		return;
	}
	if (typeof img.contentEditable == 'undefined' || !document.body.createControlRange){
		alert('抱歉，浏览器不支持直接复制图片！\n请将鼠标移到图片上方，单击鼠标右键在弹出菜单中选择"复制"');
	}else{
	    var ctrl = document.body.createControlRange();
	    img.contentEditable = true;
	    ctrl.addElement(img);
	    ctrl.execCommand('Copy');
	    img.contentEditable = false;
	    alert('复制完成，到QQ对话框里按Ctrl-V就可以啦！\n\n若不能粘贴请重复尝试或用鼠标右键选复制');
	}
}
//下载图片
function saveImage(){
	if($("#pic_new").css("display") == "none"){
		alert("请先点击办理证件，再下载");
		return;
	}
	var src = $('#createdImg').attr('src');
	num = src.indexOf('temp')+5;
	downloadname =src.substr(num);
	window.location.href = $CONFIG['siteDynamicUrl']+'/downloadImg.php?src='+src+'&downloadname='+downloadname;
}
function createImg(n){
	if(n==1){
		var card = $('#pic_1 .zjName img').length;
		var unit = $('#pic_1 .orgName img').length;
		var name = $('#pic_1 .iName').html();
		var age  = $('#pic_1 .iAge').html();
		var cont = $('#pic_1 .iContLine1').html();
		if(card ==1){
			alert('请填写证件名称！');
			return false;
		}else if(unit == 1){
			alert('请填写颁发单位名称！');
			return false;
		}else if(name == ''){
			alert('请填写名称！');
			return false;
		}else if(age == ''){
			alert('请填写年龄！');
			return false;
		}else if(cont == ''){
			alert('请填写证件内容！');
			return false;
		}else{
			$('#diy').submit();
			$('.diyPicForm').hide();
			$('#pic_1').show();
			$('#diy_image_1').hide();
			$('#diy_image_3').hide();
			$('#diy_image_4').hide();
			$('#diy_image_2').show();
			$('#pic_new').show();
			sentImgname();
		}
	}else if(n==2){
		var name = $('#pic_2 .iName').html();
		var sex = $('#pic_2 .iGender').html();
		var age = $('#pic_2 .iAge').html();
		if(name ==''){
			alert('请填写姓名！');
			return false;
		}else if(sex ==''){
			alert('请选择性别！');
			return false;
		}else if(age ==''){
			alert('请填写年龄！');
			return false;
		}else{
			$('#normal').submit();
			$('.diyPicForm').hide();
			$('#pic_2').show();
			$('#normal_image_1').hide();
			$('#pic_new').show();
			sentImgname();
		}
	}else if(n==3){
		var namem = $('.bName').html();
		var agem = $('.bAge').html();
		var namef = $('.gName').html();
		var agef = $('.gAge').html();
		if(namem ==''){
			alert('请填写男方姓名！');
			return false;
		}else if(agem ==''){
			alert('请填写男方年龄！');
			return false;
		}else if(namef ==''){
			alert('请填写女方姓名！');
			return false;
		}else if(agef ==''){
			alert('请填写女方年龄！');
			return false;
		}else{
			$('#marry').submit();
			$('.diyPicForm').hide();
			$('#pic_3').show();
			$('#marry_image_1').hide();
			$('#pic_new').show();
			sentImgname();
		}
	}else if(n==4){
		var name = $('#pic_4 .iName').html();
		alert(name);
		if(name ==''){
			alert('请填写名称！');
			return false;
		}else{
			$('#award').submit();
			$('.diyPicForm').hide();
			$('#pic_4').show();
			$('#award_image_1').hide();
			$('#pic_new').show();
			sentImgname();
		}
	}else if(n==5){
		var name = $('#daily_name').val();
		if(name ==''){
			alert('请填写报纸名称！');
			return false;
		}else{
			$('#daily').submit();
		}
	}else if(n==6){
		var name  = $('#time_name').val();
		var title = $('#time_title').val();
		if(name ==''){
			alert('请填写人物名称！');
			return false;
		}else if(title ==''){
			alert('请填写事件标题！');
			return false;
		}else{
			$('#time').submit();
		}
	}else if(n==7){
		var name  = $('#jinqi_name').val();
		var thank1= $('#thank1').val();
		var sign  = $('#jiniq_sign').val();
		if(name ==''){
			alert('请填写授予对象！');
			return false;
		}else if(thank1 ==''){
			alert('请填写感谢语！');
			return false;
		}else if(sign ==''){
			alert('请填写落款！');
			return false;
		}else{
			$('#jinqi').submit();
		}
	}else if(n==8){
		var name  = $('#offer_name').val();
		var university = $('#university').val();
		var professional = $('#professional').val();
		if(name ==''){
			alert('请填写学生名称！');
			return false;
		}else if(university==''){
			alert('请填写学校名称！');
			return false;
		}else if(professional==''){
			alert('请填写专业名称！');
			return false;
		}else{
			$('#offer').submit();
		}
	}else if(n==9){
		var name1  = $('#search_name1').val();
		var name2  = $('#search_name2').val();
		var qq  = $('#search_qq').val();
		var age  = $('#search_age').val();
		if(name1 ==''){
			alert('请填写丢失人姓名！');
			return false;
		}else if(name2 ==''){
			alert('请填写寻找人姓名！');
			return false;
		}else if(qq ==''){
			alert('请填写寻找人QQ！');
			return false;
		}else if(age ==''){
			alert('请填写丢失人年龄！');
			return false;
		}else{
			$('#search').submit();
		}
	}else if(n==10){
		var name  = $('#tongji_name').val();
		var age  = $('#tongji_age').val();
		var crime  = $('#tongji_crime').val();
		var address = $('#tongji_address').val();
		if(name ==''){
			alert('请填写姓名！');
			return false;
		}else if(age ==''){
			alert('请填写年龄！');
			return false;
		}else if(crime ==''){
			alert('请填写罪行！');
			return false;
		}else if(address ==''){
			alert('请填写籍贯！');
			return false;
		}else{
			$('#tongji').submit();
		}
	}
}
function sentImgname(m,n) {
	var imgname = n;
	$('#pic_new img').attr('src', imgname);
	if(m==1){
		$('#diy_image_2').attr('src', imgname);
		$('.zjName').hide();
		$('.orgName').hide();
		$('.iName').hide();
		$('.iGender').hide();
		$('.iAge').hide();
		$('.iName2').hide();
		$('.iContLine1').hide();
		$('.iDate').hide();
		$('.iSerial').hide();
	}else if(m==2){
		$('#normal_image_2').attr('src', imgname);
		$('.iName').hide();
		$('.iGender').hide();
		$('.iAge').hide();
		$('.iName2').hide();
		$('.iDate').hide();
		$('.iSerial').hide();
	}else if(m==3){
		$('#marry_image_2').attr('src', imgname);
		$('.bName').hide();
		$('.bAge').hide();
		$('.bName2').hide();
		$('.gName').hide();
		$('.gAge').hide();
		$('.gName2').hide();
		$('.iDate').hide();
		$('.iSerial').hide();
	}else if(m==4){
		$('#award_image_2').attr('src', imgname);
		$('.iName').hide();
		$('.iDate').hide();
		$('.iSerial').hide();
	}
}
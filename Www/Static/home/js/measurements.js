/**
 * 标注女性三围
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-4 下午6:11:19
 * @version 1.0
 */
function result(){
	var height = $('#height').val();
	if ((/[^\d]/.test(height))||(height<80)||(height>250)){
		$('.csjg').hide();
		$('.wxts').show();
	}else{
		$('.wxts').hide();
		$('.csjg').show();
		var res1 = Math.round(height * 0.535);
		var res2 = Math.round(height * 0.365);
		var res3 = Math.round(height * 0.565);
		$('#xw').html(res1);
		$('#yw').html(res2);
		$('#tw').html(res3);
	}
}
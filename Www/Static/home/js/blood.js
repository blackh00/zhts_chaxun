/**
 * 血型性格测试
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-4 下午4:41:46
 * @version 1.0
 */
function enter(type){
	switch(type){
		case a:
			$('.xxnav ul li').removeClass('def');
			$('.xx_a').addClass('def');
			$('.xuexing .bir_detail_box').attr('style','display:none');
			$('#a').attr('style','display:bolck');
			break;
		case b:
			$('.xxnav ul li').removeClass('def');
			$('.xx_b').addClass('def');
			$('.xuexing .bir_detail_box').attr('style','display:none');
			$('#b').attr('style','display:block');
			break;
		case ab:
			$('.xxnav ul li').removeClass('def');
			$('.xx_ab').addClass('def');
			$('.xuexing .bir_detail_box').attr('style','display:none');
			$('#ab').attr('style','display:block');
			break;
		case o:
			$('.xxnav ul li').removeClass('def');
			$('.xx_o').addClass('def');
			$('.xuexing .bir_detail_box').attr('style','display:none');
			$('#o').attr('style','display:block');
			break;
		default:
			break;
	}	
}

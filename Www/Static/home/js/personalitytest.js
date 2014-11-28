/**
 * 性格色彩测试
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-30 上午10:41:43
 * @version 1.0
 */
function start(){
	$('#mask').hide();
	$('.nianling').hide();
	$('#test').show();
}
var $sum = {};
var $text= {};
function select(i,j){
	$('#topic_'+i+' p').removeClass('dui');
	$text[i] = $('#topic_'+i+'_'+j).html().substr(14);
	$('#topic_'+i+'_'+j).addClass('dui');
	$sum[i]= j;
	$('.nl_wt').hide();
	$('#topic_'+(i+1)).show();
	$('.nl_but1').hide();
	$('#but'+(i+1)).show();
	$(".topicInc .sd:eq(0)").removeClass("sd").addClass("se");
	if(i==20){
		var totel = 0;
		for(k=1;k<=20;k++){
			totel += $sum[k];
			$('#result_'+k+' strong').html($text[k]);
		}
		$('#mask').hide();
		$('.nianling').hide();
		$('#result').show();
		if(totel <= 45){
			$('#state span').html('儿童状态');
			$('.nl_jg').html('你的心理年龄仍然稳定在儿童状态。你可能总是觉得自己有点可怜巴巴，在关键时刻特别渴望得到感情上的安慰和支持。你爱听赞扬，总想取悦别人，并且希望人们说你使他们高兴。这种儿童状态使你在许多方面有些不切实际，但这也使你比那些“成熟”的人们更能感受到快乐。你很可能热衷于体育，而且能象孩子似地喜欢各种东西。');
		}else if(totel <= 75){
			$('#state span').html('青少年状态');
			$('.nl_jg').html('你的内心世界是青少年状态，既需要独立自主，又需要抚慰、爱护，这种矛盾心理正是青少年状态的特点。他们希望从家庭生活的管束中摆脱出来，但同时对外部世界的严酷怀有一种潜在的担心。无论你年岁多大，这种青少年的矛盾心理是你性格中的重要倾向。你在估计形势时不大实际，很快地一会儿乐观，一会儿又悲观。可能你天性中最大的特点是创造方面，很可能你还保留着少年时代的观点：以为一切事情都是可能的，这世界是你的一块生日蛋糕。');
		}else if(totel <= 100){
			$('#state span').html('中老年状态');
			$('.nl_jg').html('你很成熟，事实上你肯定已经超过了25岁。这意味着，你在处理日常问题时相当实际、老练。你的天性中理性很强，对空洞的议论不感兴趣，而且不大有理想色彩。至少在你觉得能够控制的范围内，你自认为是个强者，你在此范围内控制他人，并同时关心他们。若你做了父母，你一定很有责任心，但你很可能会操心过多。你会发觉你的成人角色使你不得不牺牲许多自由。你是否失去了一些生活的乐趣呢?');
		}
	}
}
function uptopic(i){
	$('.nl_wt').hide();
	$('#topic_'+(i-1)).show();
	$('.nl_but1').hide();
	$('#but'+(i-1)).show();
	$('#topic_'+i+' p').removeClass('dui');
	$(".topicInc .se:last").removeClass("se").addClass("sd");
}
function restart(){
	window.location.href=window.location.href;
}
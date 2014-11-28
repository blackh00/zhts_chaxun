function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}
$(function(){
	if(getQueryString('search')){
		convert_shuzi();
	}
});

function convert_shuzi() {
	//alert(getQueryString('search'));
	var value = document.getElementById('shuzi_input').value;
	//去掉空格
	value = value.replace(/(^\s+)|(\s+$)/gi,'');
	
	var pattern = /^[0-9]+((\.)?[0-9]+)?$/;
	if(!pattern.test(value)){
		value = getQueryString('search'); 
	}
	if(!pattern.test(value)) {
		alert('请输入阿拉伯数字，小数点后最多2位数字');
		return false;
	}
	//数据检查
	if(value.length>12) {
		alert('数据太大，请合理输入');
		return false;
	}
	

	var dian = value.indexOf('.');
	var arr_shuzi = ['零','壹','贰','叁','肆','伍','陆','柒','捌','玖','拾'];
	var daxie_shuzi = '';
	var val = Number(value);
	var yi = Math.floor(val/100000000);//亿
	var wan = Math.floor(val%100000000/10000);//万
	var qian = Math.floor(val%10000/1000);//千
	var bai = Math.floor(val%1000/100); //百
	var shi = Math.floor(val%100/10);//十
	var ge = Math.floor(val%10);//个
	//亿，万要特殊处理下
	daxie_shuzi += yi==0?'':convert_int(yi)+'亿';
	
	if((yi>0&&wan<1000)&&(yi%10==0)) {
		daxie_shuzi += "零";
	}

	var wan_conv = convert_int(wan);
	daxie_shuzi += wan==0&&yi==0?'':wan_conv;
	daxie_shuzi += wan==0?'':'万';

	if(wan%10==0 && wan>0) {
		daxie_shuzi += "零";
	}

	daxie_shuzi += qian==0&&wan==0?'':arr_shuzi[qian];
	daxie_shuzi += qian==0?'':'仟';

	daxie_shuzi += bai==0&&qian==0?'':arr_shuzi[bai];
	daxie_shuzi += bai==0?'':'佰';

	daxie_shuzi += shi==0&&bai==0?'':arr_shuzi[shi];
	daxie_shuzi += shi==0?'':'拾';
	
	daxie_shuzi += ge==0?'':arr_shuzi[ge];	
	//去掉最后一个零	
	daxie_shuzi = daxie_shuzi.replace(/零$/gi,'');

	daxie_shuzi += '圆';
	//无小数点
	if(dian == -1) {
		daxie_shuzi += '整';
	//小数点
	}else {
		//如果个位不是零，则不需加零
		if(ge == 0) {
			daxie_shuzi += '零';
		}

		//只取两位小数点 
		var float_shuzhi = value.substr(dian+1);

		var jiao = value.substr(dian+1,1); //角
		daxie_shuzi += jiao==0?'':arr_shuzi[jiao];
		daxie_shuzi += jiao==0?'':'角';

		if(float_shuzhi.length > 1) {
			daxie_shuzi += jiao==0?'零':'';
			var fen = value.substr(dian+2,1); //分
			daxie_shuzi += fen==0?'':arr_shuzi[fen]+'分';
		}

	}
	//去掉重复零
	daxie_shuzi = daxie_shuzi.replace(/零{2,}/g,'零');
	document.getElementById('daxie_jieguo').style.display = 'block';
	document.getElementById('output_div').style.display = 'block';
	document.getElementById('daxie_c').style.display = 'none';
	document.getElementById('output_value').innerHTML = value;
	document.getElementById('output_shuzi').innerHTML = daxie_shuzi;
}

/**
 *整数转换
 *
 */
function convert_int(value) {
	var arr_shuzi = ['零','壹','贰','叁','肆','伍','陆','柒','捌','玖','拾'];
	var daxie_shuzi = '';
	var val = Number(value);
	var yi = Math.floor(val/100000000);//亿
	var wan = Math.floor(val%100000000/10000);//万
	var qian = Math.floor(val%10000/1000);//千
	var bai = Math.floor(val%1000/100); //百
	var shi = Math.floor(val%100/10);//十
	var ge = Math.floor(val%10);//个
	
	daxie_shuzi += yi==0?'':arr_shuzi[yi]+'亿';

	daxie_shuzi += wan==0&&yi==0?'':arr_shuzi[wan];
	daxie_shuzi += wan==0?'':'万';

	daxie_shuzi += qian==0&&wan==0?'':arr_shuzi[qian];
	daxie_shuzi += qian==0?'':'仟';

	daxie_shuzi += bai==0&&qian==0?'':arr_shuzi[bai];
	daxie_shuzi += bai==0?'':'佰';

	daxie_shuzi += shi==0&&bai==0?'':arr_shuzi[shi];
	daxie_shuzi += shi==0?'':'拾';

	daxie_shuzi += ge==0?'':arr_shuzi[ge];

	//去掉最后一个零	
	daxie_shuzi = daxie_shuzi.replace(/零$/gi,'');

	return daxie_shuzi;
}

//复制功能
function copy_cont() {
	var value = document.getElementById('output_shuzi').innerHTML;
	//去掉空格
	value = value.replace(/(^\s+)|(\s+$)/gi,'');
	if(window.clipboardData) {
		window.clipboardData.setData('text', value); 
		alert('复制成功');
	}else {
		alert('只支持IE内核的浏览器，可使用ctrl+c进行复制');
	}

}

//输入框
function input_focus(obj) {
	if(obj.className == 'ipt_style') {
		obj.value='';
		obj.className='ipt_style ipt_style_ing';
	}
}
function input_blur(obj) {
	var val = obj.value.replace(/(^\s+)|(\s+$)/gi,'');
	if(val==''){ 
		obj.className='ipt_style';
		obj.value='请输入阿拉伯数字，小数点后最多2位数字';
	}
}
//enter 提交
$("#shuzi_input").keypress(function(event){
	var e = event||window.event;
	if(e.keyCode=="13"){
		convert_shuzi();
	}
});
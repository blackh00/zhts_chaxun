function GONGLV_MEASURES() {
	this.watt = 1;
	this.kiloWatt = 1000;
	this.enHorsepower = 745.699872;
	this.miHorsepower = 735.49875;
	this.kgMeS = 9.80665;
	this.kkeS = 4184.1004;
	this.enHoteS = 1055.05585;
	this.enChiBangeS = 1.3558179490909;
	this.jiaoereS = 1;
	this.nS = 1;
}
var GONGLV_MEASURES = new GONGLV_MEASURES();
function conv_length_gl(id,value) {
	var inputs = document.getElementsByTagName("input");
	for(var i=0;i<inputs.length;i++) {
		if(inputs[i].nodeType== 1 &&  inputs[i].className=='inputTxtA' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
			inputs[i].value = number_format(GONGLV_MEASURES[id]/GONGLV_MEASURES[inputs[i].id]*value);
		}
	}
}
function checkNum(str) {
	for (var i=0; i<str.length; i++)
	{
		var ch = str.substring(i, i + 1)
		if (ch!="." && ch!="+" && ch!="-" && ch!="e" && ch!="E" && (ch < "0" || ch > "9"))
		{
			alert("请输入有效的数字");
			return false;
		}
	}
	return true;
}
function data_reset() {
	var inputs = document.getElementsByTagName("input");
	for(var i=0;i<inputs.length;i++) {
		if(inputs[i].nodeType== 1 &&  inputs[i].className=='inputTxtA' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
			inputs[i].value = '';
		}
	}
}
function number_format(num) {
	return parseFloat(num).toFixed(7);
}
var inputs = document.getElementsByTagName("input");
for(var i=0;i<inputs.length;i++) {
	if(inputs[i].nodeType== 1 &&  inputs[i].className=='submitGL' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
		inputs[i].onclick = function() {
			//验证数字是否正确
			var parent = this.parentNode;
			var childs = parent.childNodes;
			var id;
			var value ;
			for(var i=0;i<childs.length;i++) {
				if(childs[i].nodeType==1 &&  childs[i].className=='inputTxtA' && childs[i].nodeName.toUpperCase() == 'INPUT') {
					var val = childs[i].value;
					val = val.replace(/(^\s+)|(\s+$)/g,'');
					if(!checkNum(val)) {
						return false;
					}
					id = childs[i].id;
					value = val;
					break;
				}
			}
			conv_length_gl(id,value);
		}
	}
}
function rtrim(s){
    return s.replace( /\s*$/,"");
}
function checkGL(){
	var gl_value = $('#gl_txt').val();
	var myselect_from = rtrim($('#myselect_gl_from').val());
	var myselect_to = rtrim($('#myselect_gl_to').val());
	switch(myselect_from){
		case '瓦(W)':
			value_from=1;
			break;
		case '千瓦(kW)':
			value_from=1000;
			break;
		case '英制马力':
			value_from=745.6998720;
			break;
		case '米制马力':
			value_from=735.4987500;
			break;
		case '公斤·米/秒':
			value_from=9.8066500;
			break;
		case '千卡/秒':
			value_from=4184.1004000;
			break;
		case '英热单位/秒':
			value_from=1055.0558500;
			break;
		case '英尺·磅/秒':
			value_from=1.3558179;
			break;
		case '焦耳/秒':
			value_from=1;
			break;
		case '牛顿·米/秒':
			value_from=1;
			break;
		default:
			break;
	}
	switch(myselect_to){
		case '瓦(W)':
			value_to=1;
			break;
		case '千瓦(kW)':
			value_to=1000;
			break;
		case '英制马力':
			value_to=745.6998720;
			break;
		case '米制马力':
			value_to=735.4987500;
			break;
		case '公斤·米/秒':
			value_to=9.8066500;
			break;
		case '千卡/秒':
			value_to=4184.1004000;
			break;
		case '英热单位/秒':
			value_to=1055.0558500;
			break;
		case '英尺·磅/秒':
			value_to=1.3558179;
			break;
		case '焦耳/秒':
			value_to=1;
			break;
		case '牛顿·米/秒':
			value_to=1;
			break;
		default:
			break;
	}
	var value = number_format2(gl_value*value_from/value_to);
	$('#gl_h3').html(value);
	$('#gl_span').html(myselect_to);
}
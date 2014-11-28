function AREA_MEASURES()
{
	this.mSquare_kilometer = (1000 * 1000);
	this.mHectare = (100 * 100);
	this.mSquare_meter = 1;
	this.mAre = ((10000/15) * this.mSquare_meter);
	this.mSquare_decimeter = (0.1 * 0.1);
	this.mSquare_centimeter = (0.01 * 0.01);
	this.mSquare_millimeter = (0.001 * 0.001);
	this.engSquare_foot = (0.3048 * 0.3048);
	this.engSquare_yard = (3 * 3 * this.engSquare_foot);
	this.usSquare_rod = (16.5 *16.5 * this.engSquare_foot);
	this.engAcre = 160 * this.usSquare_rod;
	this.engSquare_mile = (5280 *5280 * this.engSquare_foot);
	this.engSquare_inch = (this.engSquare_foot / (12 * 12));
	this.hetc = 66666.666666667;
	this.acre = 666.66666666667;
	this.squareChi = 1/9;
	this.squareCun = 1/900;
	this.ping = 3.3057;
}
var AREA_MEASURES = new AREA_MEASURES();
function conv_length_mj(id,value) {
	var inputs = document.getElementsByTagName("input");
	for(var i=0;i<inputs.length;i++) {
		if(inputs[i].nodeType== 1 &&  inputs[i].className=='inputTxtA' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
			inputs[i].value = number_format(AREA_MEASURES[id]/AREA_MEASURES[inputs[i].id]*value);
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
function number_format2(num) {
	return parseFloat(num).toFixed(4);
}
var inputs = document.getElementsByTagName("input");
for(var i=0;i<inputs.length;i++) {
	if(inputs[i].nodeType== 1 &&  inputs[i].className=='submitMJ' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
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
			conv_length_mj(id,value);
		}
	}
}
function rtrim(s){
    return s.replace( /\s*$/,"");
} 
function checkMJ(){
	var mj_value = $('#mj_txt').val();
	var myselect_from = rtrim($('#myselect_mj_from').val());
	var myselect_to = rtrim($('#myselect_mj_to').val());
	switch(myselect_from){
		case '平方千米(km2)':
			value_from=1000000;
			break;
		case '公顷(ha)':
			value_from=10000;
			break;
		case '公亩(are)':
			value_from=666.6666667;
			break;
		case '平方米(m2)':
			value_from=1;
			break;
		case '平方分米(dm2)':
			value_from=0.01;
			break;
		case '平方厘米(cm2)':
			value_from=0.0001;
			break;
		case '平方毫米(mm2)':
			value_from=0.000001;
			break;
		case '平方英里(mi2)':
			value_from=2589988.1103360;
			break;
		case '英亩':
			value_from=4046.8564224;
			break;
		case '平方竿(rd2)':
			value_from=25.2928526;
			break;
		case '平方码(yd2)':
			value_from=0.8361274;
			break;
		case '平方英尺(ft2)':
			value_from=0.0929030;
			break;
		case '平方英寸(in2)':
			value_from=0.0006452;
			break;
		case '顷':
			value_from=66666.6666667;
			break;
		case '亩':
			value_from=666.6666667;
			break;
		case '平方尺':
			value_from=0.1111111;
			break;
		case '平方寸':
			value_from=0.0011111;
			break;
		case '坪':
			value_from=3.3057000;
			break;
		default:
			break;
	}
	switch(myselect_to){
		case '平方千米(km2)':
			value_to=1000000;
			break;
		case '公顷(ha)':
			value_to=10000;
			break;
		case '公亩(are)':
			value_to=666.6666667;
			break;
		case '平方米(m2)':
			value_to=1;
			break;
		case '平方分米(dm2)':
			value_to=0.01;
			break;
		case '平方厘米(cm2)':
			value_to=0.0001;
			break;
		case '平方毫米(mm2)':
			value_to=0.000001;
			break;
		case '平方英里(mi2)':
			value_to=2589988.1103360;
			break;
		case '英亩':
			value_to=4046.8564224;
			break;
		case '平方竿(rd2)':
			value_to=25.2928526;
			break;
		case '平方码(yd2)':
			value_to=0.8361274;
			break;
		case '平方英尺(ft2)':
			value_to=0.0929030;
			break;
		case '平方英寸(in2)':
			value_to=0.0006452;
			break;
		case '顷':
			value_to=66666.6666667;
			break;
		case '亩':
			value_to=666.6666667;
			break;
		case '平方尺':
			value_to=0.1111111;
			break;
		case '平方寸':
			value_to=0.0011111;
			break;
		case '坪':
			value_to=3.3057000;
			break;
		default:
			break;
	}
	var value = number_format2(mj_value*value_from/value_to);
	$('#mj_h3').html(value);
	$('#mj_span').html(myselect_to);
}
function LENGTH_MEASURES() {
	this.mKilometer = 1000;
	this.mMeter = 1;
	this.mDecimeter = 0.1;
	this.mCentimeter = 0.01;
	this.mMillimeter = 0.001;
	this.mMicronmeter = 0.000001;
	this.mLimeter = 500;
	this.mZhangmeter = 10 / 3;
	this.mChimeter = 1 / 3;
	this.mCunmeter = 1 / 30;
	this.mFenmeter = 1 / 300;
	this.mmLimeter = 1 / 3000;
	this.engFoot = 0.3048;
	this.engMile = 5280 * this.engFoot;
	this.engFurlong = 660 * this.engFoot;
	this.engYard = 3 * this.engFoot;
	this.engInch = this.engFoot / 12;
	this.nautMile = 1852;
	this.nautFathom = 6 * this.engFoot;
}
var LENGTH_MEASURES = new LENGTH_MEASURES();
function conv_length_cd(id,value) {
	document.getElementById('mKilometer').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mKilometer']*value);
	document.getElementById('mMeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mMeter']*value);
	document.getElementById('mDecimeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mDecimeter']*value);
	document.getElementById('mCentimeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mCentimeter']*value);
	document.getElementById('mMillimeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mMillimeter']*value);
	document.getElementById('mMicronmeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mMicronmeter']*value);
	document.getElementById('mMicronmeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mMicronmeter']*value);
	document.getElementById('mMicronmeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mMicronmeter']*value);

	document.getElementById('mLimeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mLimeter']*value);
	document.getElementById('mZhangmeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mZhangmeter']*value);
	document.getElementById('mChimeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mChimeter']*value);
	document.getElementById('mCunmeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mCunmeter']*value);
	document.getElementById('mFenmeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mFenmeter']*value);
	document.getElementById('mmLimeter').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['mmLimeter']*value);
	
	document.getElementById('nautMile').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['nautMile']*value);
	document.getElementById('engFoot').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['engFoot']*value);
	document.getElementById('engMile').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['engMile']*value);
	document.getElementById('engYard').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['engYard']*value);
	document.getElementById('engInch').value = number_format(LENGTH_MEASURES[id]/LENGTH_MEASURES['engInch']*value);
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
	if(inputs[i].nodeType== 1 &&  inputs[i].className=='submitCD' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
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
			conv_length_cd(id,value);
		}
	}
}
function rtrim(s){
    return s.replace( /\s*$/,"");
} 
function checkCD(){
	var cd_value = $('#cd_txt').val();
	var myselect_from = rtrim($('#myselect_cd_from').val());
	var myselect_to = rtrim($('#myselect_cd_to').val());
	switch(myselect_from){
		case '公里(km)':
			value_from=1000;
			break;
		case '米(m)':
			value_from=1;
			break;
		case '分米(dm)':
			value_from=0.1;
			break;
		case 'dm':
			value_from=0.1;
			break;
		case '厘米(cm)':
			value_from=0.01;
			break;
		case '毫米(mm)':
			value_from=0.001;
			break;
		case '微米(um)':
			value_from=0.0001;
			break;
		case '海里(nmi)':
			value_from=1852;
			break;
		case '英里(mi)':
			value_from=1609.3440000;
			break;
		case '码(yd)':
			value_from=0.9144000;
			break;
		case '英尺(ft)':
			value_from=0.3048000;
			break;
		case '英寸(in)':
			value_from=0.0254000;
			break;
		case '里':
			value_from=500;
			break;
		case '丈':
			value_from=3.3333333;
			break;
		case '尺':
			value_from=0.3333333;
			break;
		case '寸':
			value_from=0.0333333;
			break;
		case '分':
			value_from=0.0033333;
			break;
		case '厘':
			value_from=0.0003333;
			break;
		default:
			break;
	}
	switch(myselect_to){
		case '公里(km)':
			value_to=1000;
			break;
		case '米(m)':
			value_to=1;
			break;
		case '分米(dm)':
			value_to=0.1;
			break;
		case '厘米(cm)':
			value_to=0.01;
			break;
		case '毫米(mm)':
			value_to=0.001;
			break;
		case '微米(um)':
			value_to=0.0001;
			break;
		case '海里(nmi)':
			value_to=1852;
			break;
		case '英里(mi)':
			value_to=1609.3440000;
			break;
		case '码(yd)':
			value_to=0.9144000;
			break;
		case '英尺(ft)':
			value_to=0.3048000;
			break;
		case '英寸(in)':
			value_to=0.0254000;
			break;
		case '里':
			value_to=500;
			break;
		case '丈':
			value_to=3.3333333;
			break;
		case '尺':
			value_to=0.3333333;
			break;
		case '寸':
			value_to=0.0333333;
			break;
		case '分':
			value_to=0.0033333;
			break;
		case '厘':
			value_to=0.0003333;
			break;
		default:
			break;
	}
	var value = number_format2(cd_value*value_from/value_to);
	$('#cd_h3').html(value);
	$('#cd_span').html(myselect_to);
}
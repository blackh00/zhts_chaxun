function PRESS_MEASURES() {
	this.mKilopascal = 1000;
	this.mHectopascal = 100;
	this.mPascal = 1;
	this.mBar = 100000;
	this.mMillibar = 100;
	this.mAtm = 101325;
	this.mMillimeter_Hg = this.mAtm / 760;
	this.engInch_Hg = 25.4 * this.mMillimeter_Hg;
	this.engPound_sq_inch = 6894.757 ;
	this.engPound_sq_foot = this.engPound_sq_inch / 144 ;
	this.xpressKg_sq_cm = 98066.5;
	this.xpressKg_sq_m = 9.80665;
	this.mmmH2O = 1/0.101972;
}
var PRESS_MEASURES = new PRESS_MEASURES();
function conv_length_yl(id,value) {
	var inputs = document.getElementsByTagName("input");
	for(var i=0;i<inputs.length;i++) {
		if(inputs[i].nodeType== 1 &&  inputs[i].className=='inputTxtA' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
			inputs[i].value = number_format(PRESS_MEASURES[id]/PRESS_MEASURES[inputs[i].id]*value);
		}
	}
}
function checkNum(str) {
	for (var i=0; i<str.length; i++)
	{
		var ch = str.substring(i, i + 1)
		if (ch!="." && ch!="+" && ch!="-" && ch!="e" && ch!="E" && (ch < "0" || ch > "9"))
		{
			alert("璇疯緭鍏ユ湁鏁堢殑鏁板瓧");
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
	if(inputs[i].nodeType== 1 &&  inputs[i].className=='submitYL' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
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
			conv_length_yl(id,value);
		}
	}
}
function rtrim(s){
    return s.replace( /\s*$/,"");
}
function checkYL(){
	var yl_value = $('#yl_txt').val();
	var myselect_from = rtrim($('#myselect_yl_from').val());
	var myselect_to = rtrim($('#myselect_yl_to').val());
	switch(myselect_from){
		case '巴(bar)':
			value_from=100;
			break;
		case '千帕(kPa)':
			value_from=1;
			break;
		case '百帕(hPa)':
			value_from=0.1;
			break;
		case '毫巴(mbar)':
			value_from=0.1;
			break;
		case '帕斯卡':
			value_from=0.001;
			break;
		case '标准大气压':
			value_from=101.3250000;
			break;
		case '毫米汞柱(托)':
			value_from=0.1333224;
			break;
		case '磅力/英尺2':
			value_from=0.0478803;
			break;
		case '磅力/英寸2':
			value_from=6.8947570;
			break;
		case '英吋汞柱':
			value_from=3.3863882;
			break;
		case '公斤力/厘米2':
			value_from=98.0665000;
			break;
		case '公斤力/米2':
			value_from=0.0098067;
			break;
		case '毫米水柱':
			value_from=0.0098066;
			break;
		default:
			break;
	}
	switch(myselect_to){
		case '巴(bar)':
			value_to=100;
			break;
		case '千帕(kPa)':
			value_to=1;
			break;
		case '百帕(hPa)':
			value_to=0.1;
			break;
		case '毫巴(mbar)':
			value_to=0.1;
			break;
		case '帕斯卡':
			value_to=0.001;
			break;
		case '标准大气压':
			value_to=101.3250000;
			break;
		case '毫米汞柱(托)':
			value_to=0.1333224;
			break;
		case '磅力/英尺2':
			value_to=0.0478803;
			break;
		case '磅力/英寸2':
			value_to=6.8947570;
			break;
		case '英吋汞柱':
			value_to=3.3863882;
			break;
		case '公斤力/厘米2':
			value_to=98.0665000;
			break;
		case '公斤力/米2':
			value_to=0.0098067;
			break;
		case '毫米水柱':
			value_to=0.0098066;
			break;
		default:
			break;
	}
	var value = number_format2(yl_value*value_from/value_to);
	$('#yl_h3').html(value);
	$('#yl_span').html(myselect_to);
}
function TIJI_MEASURES() {
	this.mCubic_meter = 1000
	this.mHectoliter = 100
	this.mDekaliter = 10
	this.mLiter = 1
	this.mDeciliter = 0.1
	this.mCentiliter = 0.01
	this.mMilliliter = 0.001
	this.mCubic_millimeter = 0.000001
	this.mcTable_spoon= 0.015
	this.mcTea_spoon= 0.005
	this.uscCubic_inch = 0.016387064
	this.uscAcre_foot = 43560 * 1728 * this.uscCubic_inch
	this.uscCubic_yard = 27 * 1728 * this.uscCubic_inch
	this.uscCubic_foot = 1728 * this.uscCubic_inch
	this.uslGallon = 231 * this.uscCubic_inch
	this.uslBarrel = 42 * this.uslGallon
	this.uslQuart =  this.uslGallon / 4
	this.uslPint =  this.uslGallon / 8
	this.uslGill =  this.uslGallon / 32
	this.uslFluid_ounce = this.uslGallon / 128
	this.uslFluid_dram =  this.uslGallon / 1024
	this.uslMinim = this.uslFluid_ounce / 61440
	this.usdBarrel = 7056 * this.uscCubic_inch
	this.usdBushel = 2150.42 * this.uscCubic_inch
	this.usdPeck = this.usdBushel / 4
	this.usdQuart = this.usdBushel / 32
	this.usdPint = this.usdBushel / 64
	this.uscCup = 8 * this.uslFluid_ounce
	this.uscTable_spoon = this.uslFluid_ounce / 2
	this.uscTea_spoon = this.uslFluid_ounce / 6
	this.briGallon = 4.54609
	this.briBarrel = 36 * this.briGallon
	this.briBushel = 8  * this.briGallon
	this.briPint = this.briGallon / 8
	this.briFluid_ounce = this.briGallon / 160
}
var TIJI_MEASURES = new TIJI_MEASURES();
function conv_length_tj(id,value) {
	var inputs = document.getElementsByTagName("input");
	for(var i=0;i<inputs.length;i++) {
		if(inputs[i].nodeType== 1 &&  inputs[i].className=='inputTxtA' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
			inputs[i].value = number_format(TIJI_MEASURES[id]/TIJI_MEASURES[inputs[i].id]*value);
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
	if(inputs[i].nodeType== 1 &&  inputs[i].className=='submitTJ' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
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
			conv_length_tj(id,value);
		}
	}
}
function rtrim(s){
    return s.replace( /\s*$/,"");
}
function checkTJ(){
	var tj_value = $('#tj_txt').val();
	var myselect_from = rtrim($('#myselect_tj_from').val());
	var myselect_to = rtrim($('#myselect_tj_to').val());
	switch(myselect_from){
		case '立方米(m3)':
			value_from=1000;
			break;
		case '公石(hl)':
			value_from=100;
			break;
		case '十升(dal)':
			value_from=10;
			break;
		case '立方分米':
			value_from=1;
			break;
		case '分升(dl)':
			value_from=0.1;
			break;
		case '厘升(cl)':
			value_from=0.01;
			break;
		case '立方厘米(cm3)':
			value_from=0.001;
			break;
		case '立方毫米(mm3)':
			value_from=0.000001;
			break;
		case '桶':
			value_from=115.6271236;
			break;
		case '蒲式耳(bu)':
			value_from=35.2390702;
			break;
		case '加仑(bal)':
			value_from=4.5460900;
			break;
		case '夸脱(pt)':
			value_from=1.1012209;
			break;
		case '品脱(pt)':
			value_from=0.5506105;
			break;
		case '液量盎司(fl oz)':
			value_from=0.0284131;
			break;
		case '汤勺(Tbs)':
			value_from=0.0150000;
			break;
		case '调羹(tsp)':
			value_from=0.0050000;
			break;
		case '杯(fl oz)':
			value_from=0.2365882;
			break;
		case '桶[42加仑]':
			value_from=158.9872949;
			break;
		case '加仑(gal)':
			value_from=3.7854118;
			break;
		case '夸脱(qt)':
			value_from=0.9463529;
			break;
		case '品脱(pt)':
			value_from=0.4731765;
			break;
		case '及耳(gi)':
			value_from=0.1182941;
			break;
		case '液量盎司(fl oz)':
			value_from=0.0295735;
			break;
		case '液量打兰(fl dr)':
			value_from=0.0036967;
			break;
		case '量滴(min)':
			value_from=0.0000005;
			break;
		case '亩英尺':
			value_from=1233481.8375475;
			break;
		case '立方码':
			value_from=764.5548580;
			break;
		case '立方英尺':
			value_from=28.3168466;
			break;
		case '立方英寸':
			value_from=0.0163871;
			break;
		default:
			break;
	}
	switch(myselect_to){
		case '立方米(m3)':
			value_to=1000;
			break;
		case '公石(hl)':
			value_to=100;
			break;
		case '十升(dal)':
			value_to=10;
			break;
		case '立方分米':
			value_to=1;
			break;
		case '分升(dl)':
			value_to=0.1;
			break;
		case '厘升(cl)':
			value_to=0.01;
			break;
		case '立方厘米(cm3)':
			value_to=0.001;
			break;
		case '立方毫米(mm3)':
			value_to=0.000001;
			break;
		case '桶':
			value_to=115.6271236;
			break;
		case '蒲式耳(bu)':
			value_to=35.2390702;
			break;
		case '加仑(bal)':
			value_to=4.5460900;
			break;
		case '夸脱(pt)':
			value_to=1.1012209;
			break;
		case '品脱(pt)':
			value_to=0.5506105;
			break;
		case '液量盎司(fl oz)':
			value_to=0.0284131;
			break;
		case '汤勺(Tbs)':
			value_to=0.0150000;
			break;
		case '调羹(tsp)':
			value_to=0.0050000;
			break;
		case '杯(fl oz)':
			value_to=0.2365882;
			break;
		case '桶[42加仑]':
			value_to=158.9872949;
			break;
		case '加仑(gal)':
			value_to=3.7854118;
			break;
		case '夸脱(qt)':
			value_to=0.9463529;
			break;
		case '品脱(pt)':
			value_to=0.4731765;
			break;
		case '及耳(gi)':
			value_to=0.1182941;
			break;
		case '液量盎司(fl oz)':
			value_to=0.0295735;
			break;
		case '液量打兰(fl dr)':
			value_to=0.0036967;
			break;
		case '量滴(min)':
			value_to=0.0000005;
			break;
		case '亩英尺':
			value_to=1233481.8375475;
			break;
		case '立方码':
			value_to=764.5548580;
			break;
		case '立方英尺':
			value_to=28.3168466;
			break;
		case '立方英寸':
			value_to=0.0163871;
			break;
		default:
			break;
	}
	var value = number_format2(tj_value*value_from/value_to);
	$('#tj_h3').html(value);
	$('#tj_span').html(myselect_to);
}
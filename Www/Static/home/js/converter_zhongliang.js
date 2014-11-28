function WEIGHT_MEASURES() {
	this.mTon = 1000;
	this.mKilogram = 1;
	this.mGram = 0.001;
	this.mMilligram = 0.000001;
	this.cJin = 0.5;
	this.cDan = 50;
	this.cLiang = 0.05;
	this.cQian = 0.005;
	this.avdpPound = 0.45359237;
	this.briTon = 2240 * this.avdpPound;
	this.usTon = 2000 * this.avdpPound;
	this.briCWT = 112 * this.avdpPound;
	this.usCWT = 100 * this.avdpPound;
	this.briStone = 14 * this.avdpPound;
	this.avdpOunce = this.avdpPound / 16;
	this.avdpDram= this.avdpPound / 256;
	this.avdpGrain = this.avdpPound / 7000;
	this.troyPound = 5760 * this.avdpGrain;
	this.troyOunce = 480 * this.avdpGrain;
	this.troyDWT = 24 * this.avdpGrain;
	this.troyGrain = this.avdpGrain;
}
var WEIGHT_MEASURES = new WEIGHT_MEASURES();
function conv_length_zl(id,value) {
	var inputs = document.getElementsByTagName("input");
	for(var i=0;i<inputs.length;i++) {
		if(inputs[i].nodeType== 1 &&  inputs[i].className=='inputTxtA' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
			inputs[i].value = number_format(WEIGHT_MEASURES[id]/WEIGHT_MEASURES[inputs[i].id]*value);
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
	if(inputs[i].nodeType== 1 &&  inputs[i].className=='submitZL' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
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
			conv_length_zl(id,value);
		}
	}
}
function rtrim(s){
    return s.replace( /\s*$/,"");
}
function checkZL(){
	var zl_value = $('#zl_txt').val();
	var myselect_from = rtrim($('#myselect_zl_from').val());
	var myselect_to = rtrim($('#myselect_zl_to').val());
	switch(myselect_from){
		case '吨':
			value_from=1000;
			break;
		case '公斤(kg)':
			value_from=1;
			break;
		case '克(g)':
			value_from=0.0010000;
			break;
		case '毫克(mg)':
			value_from=0.0000010;
			break;
		case '市斤':
			value_from=0.5;
			break;
		case '担':
			value_from=50;
			break;
		case '两':
			value_from=0.05;
			break;
		case '钱':
			value_from=0.005;
			break;
		case '金衡磅':
			value_from=0.3732417;
			break;
		case '金衡盎司':
			value_from=0.0311035;
			break;
		case '金衡格令':
			value_from=0.0000648;
			break;
		case '英钱(dwt)':
			value_from=0.0015552;
			break;
		case '长吨(英制)':
			value_from=1016.0469088;
			break;
		case '短吨(美制)':
			value_from=907.1847400;
			break;
		case '英担':
			value_from=50.8023454;
			break;
		case '美担':
			value_from=45.3592370;
			break;
		case '英石':
			value_from=6.3502932;
			break;
		case '磅(lb)':
			value_from=0.4535924;
			break;
		case '盎司(oz)':
			value_from=0.0283495;
			break;
		case '打兰(dr)':
			value_from=0.0017718;
			break;
		case '格令':
			value_from=0.0000648;
			break;
		default:
			break;
	}
	switch(myselect_to){
		case '吨':
			value_to=1000;
			break;
		case '公斤(kg)':
			value_to=1;
			break;
		case '克(g)':
			value_to=0.0010000;
			break;
		case '毫克(mg)':
			value_to=0.0000010;
			break;
		case '市斤':
			value_to=0.5;
			break;
		case '担':
			value_to=50;
			break;
		case '两':
			value_to=0.05;
			break;
		case '钱':
			value_to=0.005;
			break;
		case '金衡磅':
			value_to=0.3732417;
			break;
		case '金衡盎司':
			value_to=0.0311035;
			break;
		case '金衡格令':
			value_to=0.0000648;
			break;
		case '英钱(dwt)':
			value_to=0.0015552;
			break;
		case '长吨(英制)':
			value_to=1016.0469088;
			break;
		case '短吨(美制)':
			value_to=907.1847400;
			break;
		case '英担':
			value_to=50.8023454;
			break;
		case '美担':
			value_to=45.3592370;
			break;
		case '英石':
			value_to=6.3502932;
			break;
		case '磅(lb)':
			value_to=0.4535924;
			break;
		case '盎司(oz)':
			value_to=0.0283495;
			break;
		case '打兰(dr)':
			value_to=0.0017718;
			break;
		case '格令':
			value_to=0.0000648;
			break;
		default:
			break;
	}
	var value = number_format2(zl_value*value_from/value_to);
	$('#zl_h3').html(value);
	$('#zl_span').html(myselect_to);
}
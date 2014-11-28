function HOT_MEASURES() {
	this.jiao = 1;
	this.kilogramM = 9.80392157;
	this.miHorsepowerH = 2647795.5;
	this.enHorsepowerH = 2684519.5392;
	this.KWH = 3600000;
	this.kK = 4185.851820846;
	this.enHot = 1055.05585262;
	this.enChiBangeS = 1.3557483731;
}
var HOT_MEASURES = new HOT_MEASURES();
function conv_length_rd(id,value) {
	var inputs = document.getElementsByTagName("input");
	for(var i=0;i<inputs.length;i++) {
		if(inputs[i].nodeType== 1 &&  inputs[i].className=='inputTxtA' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
			inputs[i].value = number_format(HOT_MEASURES[id]/HOT_MEASURES[inputs[i].id]*value);
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
	if(inputs[i].nodeType== 1 &&  inputs[i].className=='submitRL' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
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
			conv_length_rd(id,value);
		}
	}
}
function rtrim(s){
    return s.replace( /\s*$/,"");
}
function checkRD(){
	var rd_value = $('#rd_txt').val();
	var myselect_from = rtrim($('#myselect_rd_from').val());
	var myselect_to = rtrim($('#myselect_rd_to').val());
	switch(myselect_from){
		case '焦耳(J)':
			value_from=1;
			break;
		case '公斤·米':
			value_from=9.8039216;
			break;
		case '米制马力·时':
			value_from=2647795.5000000;
			break;
		case '英制马力·时':
			value_from=2684519.5392000;
			break;
		case '千瓦·时':
			value_from=3600000;
			break;
		case '千卡':
			value_from=4185.8518208;
			break;
		case '英热单位':
			value_from=1055.0558526;
			break;
		case '英尺·磅':
			value_from=1.3557484;
			break;
		default:
			break;
	}
	switch(myselect_to){
		case '焦耳(J)':
			value_to=1;
			break;
		case '公斤·米':
			value_to=9.8039216;
			break;
		case '米制马力·时':
			value_to=2647795.5000000;
			break;
		case '英制马力·时':
			value_to=2684519.5392000;
			break;
		case '千瓦·时':
			value_to=3600000;
			break;
		case '千卡':
			value_to=4185.8518208;
			break;
		case '英热单位':
			value_to=1055.0558526;
			break;
		case '英尺·磅':
			value_to=1.3557484;
			break;
		default:
			break;
	}
	var value = number_format2(rd_value*value_from/value_to);
	$('#rd_h3').html(value);
	$('#rd_span').html(myselect_to);
}
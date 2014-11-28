function WENDU_MEASURES() {
	this.tempFahr = 1;
	this.tempCelsius = (this.tempFahr - 32) * 5 / 9;
	this.tempKelvin = this.tempCelsius + 273.15;
	this.tempRankine = this.tempKelvin*1.8;
	this.tempReaumur = this.tempCelsius/1.25;
}
var WENDU_MEASURES = new WENDU_MEASURES();

function conv_length_wd(id,value) {
	value = Number(value);
	if(id == 'tempFahr') {
		document.getElementById('tempCelsius').value = number_format((value-32)*5/9);
		document.getElementById('tempFahr').value = number_format(value);
		document.getElementById('tempKelvin').value = number_format((value-32)*5/9+273.15);
		document.getElementById('tempRankine').value = number_format(((value-32)*5/9+273.15)*1.8);
		document.getElementById('tempReaumur').value = number_format((value-32)*5/9/1.25);
	}else if(id == 'tempCelsius') {
		document.getElementById('tempCelsius').value = number_format(value);
		document.getElementById('tempFahr').value = number_format(value*9/5+32);
		document.getElementById('tempKelvin').value = number_format(value+273.15);
		document.getElementById('tempRankine').value = number_format((value+273.15)*1.8);
		document.getElementById('tempReaumur').value = number_format(value/1.25);
	}else if(id == 'tempKelvin') {
		document.getElementById('tempCelsius').value = number_format(value-273.15);
		document.getElementById('tempFahr').value = number_format((value-273.15)*9/5+32);
		document.getElementById('tempKelvin').value = number_format(value);
		document.getElementById('tempRankine').value = number_format(value*1.8);
		document.getElementById('tempReaumur').value = number_format((value-273.15)/1.25);
	}else if(id == 'tempRankine') {
		document.getElementById('tempCelsius').value = number_format(value/1.8-273.15);
		document.getElementById('tempFahr').value = number_format((value/1.8-273.15)*9/5+32);
		document.getElementById('tempKelvin').value = number_format(value/1.8);
		document.getElementById('tempRankine').value = number_format(value);
		document.getElementById('tempReaumur').value = number_format((value/1.8-273.15)/1.25);
	}else if(id == 'tempReaumur') {
		document.getElementById('tempCelsius').value = number_format(value*1.25);
		document.getElementById('tempFahr').value = number_format(value*1.25*9/5+32);
		document.getElementById('tempKelvin').value = number_format(value*1.25+273.15);
		document.getElementById('tempRankine').value = number_format((value*1.25+273.15)*1.8);
		document.getElementById('tempReaumur').value = number_format(value);
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
	if(inputs[i].nodeType== 1 &&  inputs[i].className=='submitWD' && inputs[i].nodeName.toUpperCase() == 'INPUT') {
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
			conv_length_wd(id,value);
		}
	}
}
function rtrim(s){
    return s.replace( /\s*$/,"");
}
function checkWD(){
	var wd_value = $('#wd_txt').val();
	var myselect_from = rtrim($('#myselect_wd_from').val());
	var myselect_to = rtrim($('#myselect_wd_to').val());

	switch(myselect_from){
		case '摄氏度(C)':
			if(myselect_to=='摄氏度(C)'){
				var value = wd_value;
			}else if(myselect_to=='华氏度(F)'){
				var value = number_format2(wd_value*9/5+32);
			}else if(myselect_to=='开氏度(K)'){
				var value = number_format2(parseFloat(wd_value)+273.15);
			}else if(myselect_to=='兰氏度(Ra)'){
				var value = number_format2((parseFloat(wd_value)+273.15)*1.8);
			}else if(myselect_to=='列氏度(Re)'){
				var value = number_format2(wd_value/1.25);
			}
			break;
		case '华氏度(F)':
			if(myselect_to=='摄氏度(C)'){
				var value = number_format2((wd_value-32)*5/9);
			}else if(myselect_to=='华氏度(F)'){
				var value = wd_value;
			}else if(myselect_to=='开氏度(K)'){
				var value = number_format2((wd_value-32)*5/9+273.15);
			}else if(myselect_to=='兰氏度(Ra)'){
				var value = number_format2(((wd_value-32)*5/9+273.15)*1.8);
			}else if(myselect_to=='列氏度(Re)'){
				var value = number_format2((wd_value-32)*5/9/1.25)
			}
			break;
		case '开氏度(K)':
			if(myselect_to=='摄氏度(C)'){
				var value = number_format2(wd_value-273.15);
			}else if(myselect_to=='华氏度(F)'){
				var value = number_format2((wd_value-273.15)*9/5+32);
			}else if(myselect_to=='开氏度(K)'){
				var value = wd_value;
			}else if(myselect_to=='兰氏度(Ra)'){
				var value = number_format2(wd_value*1.8);
			}else if(myselect_to=='列氏度(Re)'){
				var value = number_format2((wd_value-273.15)/1.25);
			}
			break;
		case '兰氏度(Ra)':
			if(myselect_to=='摄氏度(C)'){
				var value = number_format2(wd_value/1.8-273.15);
			}else if(myselect_to=='华氏度(F)'){
				var value = number_format2((wd_value/1.8-273.15)*9/5+32);
			}else if(myselect_to=='开氏度(K)'){
				var value = number_format2(wd_value/1.8);
			}else if(myselect_to=='兰氏度(Ra)'){
				var value = wd_value;
			}else if(myselect_to=='列氏度(Re)'){
				var value = number_format2((wd_value/1.8-273.15)/1.25);
			}
			break;
		case '列氏度(Re)':
			if(myselect_to=='摄氏度(C)'){
				var value = number_format2(wd_value*1.25);
			}else if(myselect_to=='华氏度(F)'){
				var value = number_format2(wd_value*1.25*9/5+32);
			}else if(myselect_to=='开氏度(K)'){
				var value = number_format2(wd_value*1.25+273.15);
			}else if(myselect_to=='兰氏度(Ra)'){
				var value = number_format2((wd_value*1.25+273.15)*1.8);
			}else if(myselect_to=='列氏度(Re)'){
				var value = wd_value;
			}
			break;
		default:
			break;
	}
	$('#wd_h3').html(value);
	$('#wd_span').html(myselect_to);
}
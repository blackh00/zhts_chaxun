function ltp_getAdCode(obj,id,pk)
{
	if(isNaN(id))
		id = $("#" + id + " input:checked[name='key']").eq(0).val();
		
	if(!id)
		return false;
		
	if(pk == null)
		pk = 'id';		
	
	var fun = function(){
		// /admin.php?m=ProvinceAdv&a=index&position_id=8
		location.href = APP+'?'+VAR_MODULE+'='+CURR_MODULE+'&'+VAR_ACTION+'=getCode&'+pk+'=' + id;
	};
	
	setTimeout(fun,1);
}

function ltp_showAdList(obj,id,pk)
{
	if(isNaN(id))
		id = $("#" + id + " input:checked[name='key']").eq(0).val();
		
	if(!id)
		return false;
		
	if(pk == null)
		pk = 'id';
		
	if(pk == 'id')
		pk = 'position_id';
	
	CURR_MODULE = 'ProvinceAdv';
	var fun = function(){
		// /admin.php?m=ProvinceAdv&a=index&position_id=8
		location.href = APP+'?'+VAR_MODULE+'='+CURR_MODULE+'&'+VAR_ACTION+'=index&'+pk+'=' + id;
	};
	
	setTimeout(fun,1);
}

function ltp_addOrDelProvince(id, name, content)
{
	var string;
	string = '<tr id="show_region_' + id + '">';
	string += '<th>' + name + '</th>';
	string += '<td><input type="text" class="textinput" name="' + content + '" size="60" /></td></tr>';
	var fun = function(){
		var isCheck;
		isCheck = $("#select_region_" + id).attr("checked");
		if(isCheck == 'checked'){
			$(".act").before(string);
		} else {
			$("#show_region_" + id).remove();
		}		
	};
	
	setTimeout(fun,1);
}

function ltp_showOrHideDiv(id)
{	
	var fun = function(){
		$("#" + id).toggle();
	};
	
	setTimeout(fun,1);
}
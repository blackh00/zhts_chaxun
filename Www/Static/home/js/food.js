function show_hiddendiv(){
	document.getElementById("hidden_div").style.display='block';
	document.getElementById("_strHref").href='javascript:hidden_showdiv();';
	document.getElementById("_strSpan").innerHTML=">> 简要";
}
function hidden_showdiv(){
	document.getElementById("hidden_div").style.display='none';
	document.getElementById("_strHref").href='javascript:show_hiddendiv();';
	document.getElementById("_strSpan").innerHTML=">> 详细";
}

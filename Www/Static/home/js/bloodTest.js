function xx_cha()
{
  var f = document.getElementById('father_xx');
  var a = f.options[f.options.selectedIndex].value || f.options[f.selectedIndex].text;
  var m = document.getElementById('mother_xx');
  var b = m.options[m.options.selectedIndex].value || m.options[m.selectedIndex].text;
  var result='', result1='';
  if (a == 'A' && b == 'B') result = '<a href="/xuexing/A.htm" >A型</a> 、<a href="/xuexing/B.htm" >B型</a> 、<a href="/xuexing/AB.htm" >AB型</a> 、<a href="/xuexing/O.htm" >O型</a> ', result1 = '';
  else if (a == 'B' && b == 'A') result = '<a href="/xuexing/A.htm" >A型</a> 、<a href="/xuexing/B.htm" >B型</a> 、<a href="/xuexing/AB.htm" >AB型</a> 、<a href="/xuexing/O.htm" >O型</a> ', result1 = '';
  else if (a == 'A' && b == 'A') result = '<a href="/xuexing/A.htm" >A型</a> 或 <a href="/xuexing/O.htm" >O型</a> ', result1 = '<a href="/xuexing/B.htm" >B型</a>  和 <a href="/xuexing/AB.htm" >AB型</a> ';
  else if (a == 'A' && b == 'O') result = '<a href="/xuexing/A.htm" >A型</a> 或 <a href="/xuexing/O.htm" >O型</a> ', result1 = '<a href="/xuexing/B.htm" >B型</a>  和 <a href="/xuexing/AB.htm" >AB型</a> ';
  else if (a == 'O' && b == 'A') result = '<a href="/xuexing/A.htm" >A型</a> 或 <a href="/xuexing/O.htm" >O型</a> ', result1 = '<a href="/xuexing/B.htm" >B型</a>  和 <a href="/xuexing/AB.htm" >AB型</a> ';
  else if (a == 'A' && b == 'AB') result = '<a href="/xuexing/A.htm" >A型</a>  、<a href="/xuexing/B.htm" >B型</a> 及 <a href="/xuexing/AB.htm" >AB型</a>之一', result1 = '<a href="/xuexing/O.htm" >O型</a> ';
  else if (a == 'AB' && b == 'A') result = ' <a href="/xuexing/A.htm" >A型</a>  、<a href="/xuexing/B.htm" >B型</a> 及 <a href="/xuexing/AB.htm" >AB型</a>之一', result1 = '<a href="/xuexing/O.htm" >O型</a> ';
  else if (a == 'B' && b == 'B') result = '<a href="/xuexing/B.htm" >B型</a> 或 <a href="/xuexing/O.htm" >O型</a> ', result1 = '<a href="/xuexing/A.htm" >A型</a>  和 <a href="/xuexing/AB.htm" >AB型</a> ';
  else if (a == 'B' && b == 'O') result = '<a href="/xuexing/B.htm" >B型</a> 或 <a href="/xuexing/O.htm" >O型</a> ', result1 = '<a href="/xuexing/A.htm" >A型</a>  和 <a href="/xuexing/AB.htm" >AB型</a> ';
  else if (a == 'O' && b == 'B') result = '<a href="/xuexing/B.htm" >B型</a> 或 <a href="/xuexing/O.htm" >O型</a> ', result1 = '<a href="/xuexing/A.htm" >A型</a>  和 <a href="/xuexing/AB.htm" >AB型</a> ';
  else if (a == 'B' && b == 'AB') result = '<a href="/xuexing/A.htm" >A型</a>  、<a href="/xuexing/B.htm" >B型</a> 及 <a href="/xuexing/AB.htm" >AB型</a>之一', result1 = '<a href="/xuexing/O.htm" >O型</a> ';
  else if (a == 'AB' && b == 'B') result = '<a href="/xuexing/A.htm" >A型</a>  、<a href="/xuexing/B.htm" >B型</a> 及 <a href="/xuexing/AB.htm" >AB型</a>之一', result1 = '<a href="/xuexing/O.htm" >O型</a> ';
  else if (a == 'O' && b == 'O') result = ' <a href="/xuexing/O.htm" >O型</a> ', result1 = '<a href="/xuexing/A.htm" >A型</a> 、<a href="/xuexing/B.htm" >B型</a> 和 <a href="/xuexing/AB.htm" >AB型</a> ';
  else if (a == 'O' && b == 'AB') result = '<a href="/xuexing/A.htm" >A型</a> 或 <a href="/xuexing/B.htm" >B型</a> ', result1 = '<a href="/xuexing/O.htm" >O型</a>  和 <a href="/xuexing/AB.htm" >AB型</a> ';
  else if (a == 'AB' && b == 'O') result = '<a href="/xuexing/A.htm" >A型</a> 或 <a href="/xuexing/B.htm" >B型</a> ', result1 = '<a href="/xuexing/O.htm" >O型</a>  和 <a href="/xuexing/AB.htm" >AB型</a> ';
  else if (a == 'AB' && b == 'AB') result = '<a href="/xuexing/A.htm" >A型</a>  、<a href="/xuexing/B.htm" >B型</a> 及 <a href="/xuexing/AB.htm" >AB型</a>之一', result1 = '<a href="/xuexing/O.htm" >O型</a> ';
  document.getElementById('f_xx').innerHTML = a+"型";
  document.getElementById('m_xx').innerHTML = b+"型";
  document.getElementById('kn_xx').innerHTML = "孩子有可能出现的血型是： <strong >"+result+"</strong>";
  document.getElementById('bkn_xx').innerHTML = "不可能出现的血型是： <strong >"+result1+"</strong>";
  if(result1 != '')
  {
    document.getElementById('bkn_xx').style.display = "block";
  }
  document.getElementById('show_info').style.display = "block";
}
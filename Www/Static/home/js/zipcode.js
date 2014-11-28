function getQueryString(name)
{
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}
function getElementsByClassName(fatherId,tagName,className)
{
    var node = fatherId&&document.getElementById(fatherId) || document;
    tagName = tagName || "*";
    className = className.split(" ");
    var classNameLength = className.length;
    for(var i=0,j=classNameLength;i<j;i++)
    {
    	//创建匹配类名的正则
        className[i]= new RegExp("(^|\\s)" + className[i].replace(/\-/g, "\\-") + "(\\s|$)");
    }
    var elements = node.getElementsByTagName(tagName);
    var result = [];
    for(var i=0,j=elements.length,k=0;i<j;i++)
    {	//缓存length属性
        var element = elements[i];
        while(className[k++].test(element.className))
        {	//优化循环
            if(k === classNameLength)
            {
                result[result.length] = element;
                break;
            }  
        }
        k = 0;
    }
    return result;
}

var tabs = document.getElementById('J_tab_hd').getElementsByTagName('a'), num = tabs.length, divList= getElementsByClassName('J_tab_bd','div','rendData');
for (var i=0; i < num; i++)
{
	tabs[i].onclick = function(i)
	{
		for (var j=0; j < num; j++)
		{
			if(tabs[j] == this)
			{
				tabs[j].className = "cur";
				(divList[j] || tabs[j]).style.display = "block";
			}
			else
			{
				tabs[j].className = "";
				(divList[j] || tabs[j]).style.display = "none";
			}
		}
	}
}

var city = getQueryString('city');
//从电话区号查询URL获得参数
if(!city){
	city = getQueryString('province');
}
var cityArr = {"bj":0,"sh":1,"tj":2,"cq":3,"ah":4,"fj":5,"gs":6,"gd":7,"gx":8,"gz":9,"hn":10,"hb":11,"hn2":12,"hlj":13,"hb2":14,"hn3":15,"jl":16,"js":17,"jx":18,"ln":19,"nmg":20,"nx":21,"qh":22,"sc":23,"sd":24,"sx":25,"sx2":26,"xj":27,"xz":28,"yn":29,"zj":30,"tw":31};
if (cityArr[city])
{
	for (var j=0; j < num; j++)
	{
		if(j == cityArr[city])
		{
			tabs[j].className = "cur";
			(divList[j] || tabs[j]).style.display = "block";
		}
		else
		{
			tabs[j].className = "";
			(divList[j] || tabs[j]).style.display = "none";
		}
	}
}



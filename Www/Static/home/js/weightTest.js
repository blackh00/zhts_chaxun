$(function () {
    function tabs(tabTit, on, tabCon) {
        $(tabCon).each(function () {
            $(this).children().eq(0).show();
        });
        $(tabTit).each(function () {
            $(this).children().eq(0).addClass(on);
        });
        $(tabTit).children().hover(function () {//鼠标"hover"的效果
            $(this).addClass(on).siblings().removeClass(on);
            var index = $(tabTit).children().index(this);
            $(tabCon).children().eq(index).show().siblings().hide();
        });
    }
    tabs(".tab-hd", "active", ".tab-bd");
});
var imagenumber = 3 ;
var randomnumber = Math.random() ;
var rand = Math.round( (imagenumber-1) * randomnumber) + 1 ;
urls = new Array;
images = new Array;
alts = new Array;
var url = urls[rand];
var image = images[rand];
var alt = alts[rand];
function lookme(form) {
  var bmi;
  if(! checkform(form)) return false;
  comput(form);
  bmi = Math.round(form.weight.value*10000/eval(form.height.value*form.height.value));
  form.bmi.value= bmi;
  if (bmi >40) {
     $("#nowstat").html("啊,你还能买到衣服吗?\n你太、太...太胖了");
  }else if (bmi >30) {
     $("#nowstat").html("哇！你好胖啊!必须开始减肥了,听我的没错");
  }else if (bmi >27) {
     $("#nowstat").html("哎呀！你可是比较胖啊，赶快开始减肥计划吧！");
  }else if (bmi >22) {
     $("#nowstat").html("小心喔!稍胖，少吃点可以吗?\n还要多多运动啊!:)");
  }else if (bmi >=21) {
     $("#nowstat").html("你的身材好标准啊!\n要注意保持哦!");
  }else if (bmi >=18) {
     $("#nowstat").html("瘦了一点点，你应该多吃点东西啊!");
  }else if (bmi >=16) {
     $("#nowstat").html("你一定是受到了虐待，快点大量吃东西吧!");
  }else {
     $("#nowstat").html("哇塞!前胸贴后背,你怎么像个电线杆子\n一点肉都没有,快找大夫看看吧!!");
  }
  return true;
}
function comput(form) {
  if($('input:radio:checked').val() == "0"){
	  form.legendweight.value = Math.round(50+(2.3*(form.height.value-152))/2.54);
  }else{
	  form.legendweight.value = Math.round(45.5+(2.3*(form.height.value-152))/2.54);  
  }
}
function checkform(form){
  if(form.weight.value == null || form.weight.value.length ==0 ||
     form.height.value == null || form.height.value.length ==0) {
    alert("你以为我真的是神仙吗?你什么都不告诉我,我怎么给你测啊!!!");
    return false;
  }
  if(form.weight.value <=0) {
    alert("你将创下体重最轻的吉尼斯世界记录,当心地心引力对你不起作用啊.");
    return false;
  }
  if(form.weight.value >500) {
    alert("你不用测了,你的体重已经把我的秤压坏了.");
    return false;
  }
  if(form.height.value <=0) {
    alert("你不至于这么矮吧,你怎么比蚂蚁还小呢?");
    return false;
  }
  if(form.height.value >=300) {
    alert("喔!!!!你好伟大啊!!!!\n替我向上帝问好");
    return false;
  }
  return true;
}

function ClearForm(form){
	form.weight.value = "";
	form.height.value = "";
	form.bmi.value = "";
	form.my_comment.value = "";
}
function bmi(weight, height) {
	bmindx=weight/eval(height*height);
	return bmindx;
}
function checkform(form) {
	if (form.weight.value==null||form.weight.value.length==0
	|| form.height.value==null||form.height.value.length==0){
	alert("\是不是打鼾搞得你有点头昏脑胀，数字都忘了输^o^");
	 return false;
 }
else if (parseFloat(form.height.value) <= 0||
parseFloat(form.height.value) >=250||
parseFloat(form.weight.value) <= 0||
parseFloat(form.weight.value) >=250){
	alert("\本网站可不是程逞能的 \n你输的数字我头都大了 \n快改正一下，再测试一遍……");
	ClearForm(form);
	 return false;
	 }
	 return true;
}
function computeform(form) {
	if (checkform(form)) {
		yourbmi=Math.round(bmi(form.weight.value, form.height.value/100));
		form.bmi.value=yourbmi;
	if (yourbmi >38) {
		form.my_comment.value="别逗了!!!哪有这种身材";
	}
	else if (yourbmi >28 && yourbmi <=38) {
		form.my_comment.value="您太重了，早就得病了吧?!";
	}
	else if (yourbmi >25 && yourbmi <=28) {
		form.my_comment.value="你已经发福了，身体感到不舒服了，是吗?";
	}
	else if (yourbmi >20 && yourbmi <=25) {
		form.my_comment.value="你的体重目前正常，但也要预防疾病啊！";
	}
	else if (yourbmi >=15 && yourbmi <=20) {
		form.my_comment.value="哇!!!有些骨感，你是不是女孩子，小心会有很多人爱上你喽";
	}
	else if (yourbmi >=11 && yourbmi <15) {
		form.my_comment.value="这个不是火柴杆吗????";
	}
	else if (yourbmi <11) {
		form.my_comment.value="按照生物学来说这种生物是不能生存的";
	}
	}
	return;
}

<?php
/**
 * 十二生肖配对
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-9-23 下午6:17:19
 * @version 1.0
 */
class ZodialMatchAction extends Action{
	function _initialize(){
		$this->assign('flag','zonghe');
		$this->assign('headerFlag',1);
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		$this->display();
	}
	public function result(){
		$sx1 = $_POST['sx1'];
		$sx2 = $_POST['sx2'];
		$sx  = $sx1.$sx2;
		if($sx=='shushu'){
			$flag=1;
		}else if($sx=='shuniu'||$sx=='niushu'){
			$flag=2;
		}else if($sx=='shuhu'||$sx=='hushu'){
			$flag=3;
		}else if($sx=='shutu'||$sx=='tushu'){
			$flag=4;
		}else if($sx=='shulong'||$sx=='longshu'){
			$flag=5;
		}else if($sx=='shushe'||$sx=='sheshu'){
			$flag=6;
		}else if($sx=='shuma'||$sx=='mashu'){
			$flag=7;
		}else if($sx=='shuyang'||$sx=='yangshu'){
			$flag=8;
		}else if($sx=='shuhou'||$sx=='houshu'){
			$flag=9;
		}else if($sx=='shuji'||$sx=='jishu'){
			$flag=10;
		}else if($sx=='shugou'||$sx=='goushu'){
			$flag=11;
		}else if($sx=='shuzhu'||$sx=='zhushu'){
			$flag=12;
		}else if($sx=='niuniu'){
			$flag=13;
		}else if($sx=='niuhu'||$sx=='huniu'){
			$flag=14;
		}else if($sx=='niutu'||$sx=='tuniu'){
			$flag=15;
		}else if($sx=='niulong'||$sx=='longniu'){
			$flag=16;
		}else if($sx=='niushe'||$sx=='sheniu'){
			$flag=17;
		}else if($sx=='niuma'||$sx=='maniu'){
			$flag=18;
		}else if($sx=='niuyang'||$sx=='yangniu'){
			$flag=19;
		}else if($sx=='niuhou'||$sx=='houniu'){
			$flag=20;
		}if($sx=='niuji'||$sx=='jiniu'){
			$flag=21;
		}else if($sx=='niugou'||$sx=='gouniu'){
			$flag=22;
		}else if($sx=='niuzhu'||$sx=='zhuniu'){
			$flag=23;
		}else if($sx=='huhu'){
			$flag=24;
		}else if($sx=='hutu'||$sx=='tuhu'){
			$flag=25;
		}else if($sx=='hulong'||$sx=='longhu'){
			$flag=26;
		}else if($sx=='hushe'||$sx=='shehu'){
			$flag=27;
		}else if($sx=='huma'||$sx=='mahu'){
			$flag=28;
		}else if($sx=='huyang'||$sx=='yanghu'){
			$flag=29;
		}else if($sx=='huhou'||$sx=='houhu'){
			$flag=30;
		}if($sx=='huji'||$sx=='jihu'){
			$flag=31;
		}else if($sx=='hugou'||$sx=='gouhu'){
			$flag=32;
		}else if($sx=='huzhu'||$sx=='zhuhu'){
			$flag=33;
		}else if($sx=='tutu'){
			$flag=34;
		}else if($sx=='tulong'||$sx=='longtu'){
			$flag=35;
		}else if($sx=='tushe'||$sx=='shetu'){
			$flag=36;
		}else if($sx=='tuma'||$sx=='matu'){
			$flag=37;
		}else if($sx=='tuyang'||$sx=='yangtu'){
			$flag=38;
		}else if($sx=='tuhou'||$sx=='houtu'){
			$flag=39;
		}else if($sx=='tuji'||$sx=='jitu'){
			$flag=40;
		}if($sx=='tugou'||$sx=='goutu'){
			$flag=41;
		}else if($sx=='tuzhu'||$sx=='zhutu'){
			$flag=42;
		}else if($sx=='longlong'){
			$flag=43;
		}else if($sx=='longshe'||$sx=='shelong'){
			$flag=44;
		}else if($sx=='longma'||$sx=='malong'){
			$flag=45;
		}else if($sx=='longyang'||$sx=='yanglong'){
			$flag=46;
		}else if($sx=='longhou'||$sx=='houlong'){
			$flag=47;
		}else if($sx=='longji'||$sx=='jilong'){
			$flag=48;
		}else if($sx=='longgou'||$sx=='goulong'){
			$flag=49;
		}else if($sx=='longzhu'||$sx=='zhulong'){
			$flag=50;
		}else if($sx=='sheshe'){
			$flag=51;
		}else if($sx=='shema'||$sx=='mashe'){
			$flag=52;
		}else if($sx=='sheyang'||$sx=='yangshe'){
			$flag=53;
		}else if($sx=='shehou'||$sx=='houshe'){
			$flag=54;
		}else if($sx=='sheji'||$sx=='jishe'){
			$flag=55;
		}else if($sx=='shegou'||$sx=='goushe'){
			$flag=56;
		}else if($sx=='shezhu'||$sx=='zhushe'){
			$flag=57;
		}else if($sx=='mama'){
			$flag=58;
		}else if($sx=='mayang'||$sx=='yangma'){
			$flag=59;
		}else if($sx=='mahou'||$sx=='houma'){
			$flag=60;
		}else if($sx=='maji'||$sx=='jima'){
			$flag=61;
		}else if($sx=='magou'||$sx=='gouma'){
			$flag=62;
		}else if($sx=='mazhu'||$sx=='zhuma'){
			$flag=63;
		}else if($sx=='yangyang'){
			$flag=64;
		}else if($sx=='yanghou'||$sx=='houyang'){
			$flag=65;
		}else if($sx=='yangji'||$sx=='jiyang'){
			$flag=66;
		}else if($sx=='yanggou'||$sx=='gouyang'){
			$flag=67;
		}else if($sx=='yangzhu'||$sx=='zhuyang'){
			$flag=68;
		}else if($sx=='houhou'){
			$flag=69;
		}else if($sx=='houji'||$sx=='jihou'){
			$flag=70;
		}else if($sx=='hougou'||$sx=='gouhou'){
			$flag=71;
		}else if($sx=='houzhu'||$sx=='zhuhou'){
			$flag=72;
		}else if($sx=='jiji'){
			$flag=73;
		}else if($sx=='jigou'||$sx=='gouji'){
			$flag=74;
		}else if($sx=='jizhu'||$sx=='zhuji'){
			$flag=75;
		}else if($sx=='gougou'){
			$flag=76;
		}else if($sx=='gouzhu'||$sx=='zhugou'){
			$flag=77;
		}else if($sx=='zhuzhu'){
			$flag=78;
		}
		$this->assign('sx1',$sx1);
		$this->assign('sx2',$sx2);
		$this->assign('flag',$flag);
		$this->display();
	}
}

<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-8 下午2:28:32
 * @version 1.0
 */
class BirthDatesAction extends Action{
	
	// 控制器初始化方法。
	function _initialize(){
		$this->assign('flag','yule');
		$this->assign('headerFlag',1);
		$this->assign('footerFlag',1);
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	// 生辰八字首页显示。
	public function index(){
		$this->display();
	}
	
	// 生辰八字首页显示。
	public function baziSm(){
		
		// 判断是否是正常提交表单数据。
		if(isset($_POST['xing']) && $_POST['xing'] != '' && isset($_POST['ming']) && $_POST['ming'] != ''){
			include_once ROOT_PATH."/App/Vendor/PingYin/BirthDates/rli.php";
			include_once ROOT_PATH."/App/Vendor/PingYin/BirthDates/function.php";
		
			$bzwh=tgdzwh($yg1).tgdzwh($yz1).tgdzwh($mg1).tgdzwh($mz1).tgdzwh($dg1).tgdzwh($dz1).tgdzwh($tg1).tgdzwh($tz1);
			//echo $bzwh;
			$wnum1=substr_count($bzwh, "金");
			if($wnum1 >= 3){
				$mainw.="<strong>金</strong>旺";
			}elseif($wnum1==0){
				$mainq.="缺<strong>金</strong>";
			}
			$wnum2=substr_count($bzwh, "木");
			if($wnum2 >= 3){
				$mainw.="<strong>木</strong>旺";
			}elseif($wnum2==0){
				$mainq.="缺<strong>木</strong>";
			}
			$wnum3=substr_count($bzwh, "水");
			if($wnum3 >= 3){
				$mainw.="<strong>水</strong>旺";
			}elseif($wnum3==0){
				$mainq.="缺<strong>水</strong>";
			}
			$wnum4=substr_count($bzwh, "火");
			if($wnum4 >= 3){
				$mainw.="<strong>火</strong>旺";
			}elseif($wnum4==0){
				$mainq.="缺<strong>火</strong>";
			}
			$wnum5=substr_count($bzwh, "土");
			if($wnum5 >= 3){
				$mainw.="<strong>土</strong>旺";
			}elseif($wnum5==0){
				$mainq.="缺<strong>土</strong>";
			}
		
			if(mb_substr($_POST['xing'], 1,1,"utf8")!=''){
				$this->assign('xingM0',mb_substr($_POST['xing'], 0,1,"utf8"));
				$this->assign('xingM1',mb_substr($_POST['xing'], 1,1,"utf8"));
			}else{
				$this->assign('xingM0',$_POST['xing']);
			}
			if(mb_substr($_POST['ming'], 1,1,"utf8")!=''){
				$this->assign('mingM0',mb_substr($_POST['ming'], 0,1,"utf8"));
				$this->assign('mingM1',mb_substr($_POST['ming'], 1,1,"utf8"));
			}else{
				$this->assign('mingM0',$_POST['ming']);
			}
				
			$this->assign('b_xing',$_POST['xing']);
			$this->assign('b_ming',$_POST['ming']);
			$this->assign('xingbie',$_POST['xingbie']);
			$this->assign('nian1',$nian1);
			$this->assign('yue1',$yue1);
			$this->assign('ri1',$ri1);
			$this->assign('hh1',$hh1);
			$this->assign('shengXiao',$sx.' ,'.layin($ygz));
			$this->assign('wuXing',$mainw.$mainq);
			$this->assign('rZhuTian',tgdzwh($dg1));
			$this->assign('sYuSiJi',siji($yue1));
			$this->assign('mgz',$mgz);
			$this->assign('dgz',$dgz);
			$this->assign('tgz',$tgz);
			$this->assign('wuXingNian',tgdzwh($yg1).tgdzwh($yz1));
			$this->assign('wuXingYue',tgdzwh($mg1).tgdzwh($mz1));
			$this->assign('wuXingR',tgdzwh($dg1).tgdzwh($dz1));
			$this->assign('wuXingShi',tgdzwh($tg1).tgdzwh($tz1));
		
			$this->assign('layinNian',layin($ygz));
			$this->assign('layinYue',layin($mgz));
			$this->assign('layinR',layin($dgz));
			$this->assign('layinShi',layin($tgz));
		
			$this->assign('wnum1',$wnum1);
			$this->assign('wnum2',$wnum2);
			$this->assign('wnum3',$wnum3);
			$this->assign('wnum4',$wnum4);
			$this->assign('wnum5',$wnum5);
		
			$que0=M('birthdate_wh');
			$rs0=$que0->where("wh='".tgdzwh($dg1)."'")->find();
			$tnwh=$rs0["tnwh"];
			$ynwh=$rs0["ynwh"];
			$skzhyj=$rs0["skzhyj"];
			$whzx=$rs0["whzx"];
			$szwh=$rs0["szwh"];
			$hyhw=$rs0["hyhw"];
		
			$this->assign('tnwh',$tnwh);
			$this->assign('ynwh',$ynwh);
			$this->assign('ygz',$ygz);
			$this->assign('nongYDate',$yige_org_date[1]);
			$this->assign('nongRDate',$yige_org_date[2]);
			$this->assign('nongSDate',DiZhi($hh1));
			$this->assign('skzhyj',$skzhyj);
			$this->assign('whzx',$whzx);
			$this->assign('szwh',$szwh);
			$this->assign('hyhw',$hyhw);
		
			$que1=M('birthdate_sjrs');
			$rs1=$que1->where("wh='".tgdzwh($dg1)."' and sj='".siji($yue1)."'")->find();
			$sjrs=$rs1['sjrs'];
			$this->assign('sjrs',$sjrs);
		
			$que2=M('birthdate_sxgx');
			$rs2=$que2->where("sx='".$sx."'")->find();
			$sxgx=$rs2['sxgx'];
			$this->assign('sx',$sx);
			$this->assign('sxgx',$sxgx);
		
			$que3=M('birthdate_rgnm');
			$rs3=$que3->where("rgz='".$dgz."'")->find();
			$rgxx=$rs3['rgxx'];
			$rgcz=$rs3['rgcz'];
			$rgzfx=$rs3['rgzfx'];
			$this->assign('rgxx',$rgxx);
			$this->assign('rgcz',$rgcz);
			$this->assign('rgzfx',$rgzfx);
		
			if($yige_org_date[1]=='冬月'){
				$yige_org_date[1]="十二月";
			}
			$que4=M('birthdate_rysmn');
			$rs4=$que4->where("siceng='".$yige_org_date[1]."'")->find();
			$mingmi1=$rs4['mingmi'];
			$this->assign('mingmi1',$mingmi1);
		
			$que5=M('birthdate_rysmn');
			$rs5=$que5->where("siceng='".$yige_org_date[2]."日'")->find();
			$mingmi2=$rs5['mingmi'];
			$this->assign('mingmi2',$mingmi2);
		
			$que6=M('birthdate_rysmn');
			$rs6=$que6->where("siceng='".DiZhi($hh)."时'")->find();
			$mingmi3=$rs6['mingmi'];
			$this->assign('mingLiShiS',DiZhi($hh1));
			$this->assign('mingmi3',$mingmi3);
		
			$que7=M('birthdate_smtf');
			$rs7=$que7->where("ri='".$dgz."' and shi='".$tgz."'")->find();
			$tf1=$rs7['tf1'];
			$tf2=$rs7['tf2'];
		
			$que8=M('birthdate_qtbj');
			$rs8=$que8->where("tg='".$dg1."' and dz='".$mz1."'")->find();
			$qtbj=$rs8['content'];
			$this->assign('qtbj',$qtbj);
		
			$this->assign('sanMingTong',$tf1."<br />".$tf2);
			$this->assign('mingLiSh',$yige_org_date[1]);
			$this->assign('mingLiR',$yige_org_date[2]);
		
		}
		
		$titleKey='生辰八字查询-快查';
		$this->assign('titleKey',$titleKey);
		$footerFlag=1;
		$this->assign('footerFlag',$footerFlag);
		$flag="yule";
		$this->assign('flag',$flag);
		$this->display();
	}
	
}
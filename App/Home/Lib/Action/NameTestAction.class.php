<?php
/**
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author jiangtao <707093447@qq.com>
 * @CreateDate: 2013-5-7 下午4:08:49
 * @version 1.0
 */
class NameTestAction extends Action{
	
	// 控制器初始化方法。
	public function _initialize(){
		$flag="yule";
		$this->assign('flag',$flag);
		$this->assign('headInfo',setHead());
	}
		
	
	// 姓名测试首页显示。
	public function index(){
		$this->display();
	}
	
	// 姓名测试结果显示。
	public function testName(){
	// 包含中文转拼音文件。
		include ROOT_PATH . '/App/Vendor/PingYin/NameTest/pinyinInit.php';
		
		// 包含简体-繁体转换文件。
		include ROOT_PATH . '/App/Vendor/PingYin/NameTest/utf8_chinese.php';
		
		// 包含姓名测试逻辑处理文件。
		include ROOT_PATH . '/App/Vendor/PingYin/NameTest/function.php';
		
		if(isset($_REQUEST['xing']) && $_REQUEST['xing'] != '' && isset($_REQUEST['ming']) && $_REQUEST['ming'] != ''){			
		
			// '处理用户信息
			$tiange=0;
			$dige=0;
			$renge1=0;
			$renge2=0;
			$renge=0;
			$xing=$_REQUEST['xing'];
			$ming=$_REQUEST['ming'];
			
			// '姓
			//dim xing1,xing2,bihua1,bihua2
			$bihua1=0;
			$bihua2=0;
			$xing1=mb_substr($xing,0,1,"utf8");
			$xing11=mb_substr($xing,0,1,"utf8");
			$bihua1=getnum($xing1);
			$tiange=$bihua1+1;
			$tiangee=$bihua1+1;
			$renge1=$bihua1;
			
			if(mb_substr($xing,1,1,"utf8") != ''){
				$xing2=mb_substr($xing,1,1,"utf8");
				$xing22=mb_substr($xing,1,1,"utf8");
				$bihua2=getnum($xing2);
				$tiange=$bihua1+$bihua2;
				$tiangee=$bihua1+$bihua2;
				$renge1=$bihua2;
			}
	
			// '名
			// dim ming1,ming2,bihua3,bihua4
			$bihua3 = 0;
			$bihua4 = 0;
			$ming1=mb_substr($ming,0,1,"utf8");
			$ming11=mb_substr($ming,0,1,"utf8");
			$bihua3=getnum($ming1);
			$dige=$bihua3+1;
			$digee=$bihua3+1;
			$renge2=$bihua3;
			if(mb_substr($ming,1,1,"utf8") != ''){
				$ming2=mb_substr($ming,1,1,"utf8");
				$ming22=mb_substr($ming,1,1,"utf8");
				$bihua4=getnum($ming2);
				$dige=$bihua3+$bihua4;
				$digee=$bihua3+$bihua4;
			}
			$zhongge = $bihua1 + $bihua2 + $bihua3 + $bihua4;
			$zhonggee = $bihua1 + $bihua2 + $bihua3 + $bihua4;
			
			// 计算三才
			$renge=$renge1+$renge2;
			$rengee=$renge1+$renge2;
			$waige=$zhongge-$renge;
			$waigee=$zhonggee-$rengee;		
			if(mb_substr($xing,1,1,"utf8") == ''){
				$waige=$waige+1;
				$waigee=$waigee+1;
			}
			if(mb_substr($ming,1,1,"utf8") == ''){
				$waige=$waige+1;
				$waigee=$waigee+1;
			}
			
			// 传递参数。
			$this->assign("xing1",$xing1);
			
			$GbToBig=GbToBig($xing1);
			$this->assign('GbToBig',$GbToBig);
			
			$transformToPinYin=transformToPinYin(mb_substr($xing,0,1,"utf8"));
			$this->assign('transformToPinYin',$transformToPinYin);
			
			$this->assign('bihua1',$bihua1);
			
			$getzywh=getzywh($xing11);
			$this->assign('getzywh',$getzywh);
			
			$panDanXing=mb_substr($xing,1,1,"utf8");
			$this->assign('panDanXing',$panDanXing);
			
			$this->assign('xing2',$xing2);
			
			$GbToBig2=GbToBig($xing2);
			$this->assign('GbToBig2',$GbToBig2);
			
			$PinYin2=transformToPinYin(mb_substr($xing,1,1,"utf8"));
			$this->assign('PinYin2',$PinYin2);
			
			$this->assign('bihua2',$bihua2);
			
			$getzy=getzywh($xing22);
			$this->assign('getzy',$getzy);
			
			$this->assign('ming1',$ming1);
			
			$GbToBigM=GbToBig($ming1);
			$this->assign('GbToBigM',$GbToBigM);
			
			$PinYinM=transformToPinYin(mb_substr($ming,0,1,"utf8"));
			$this->assign('PinYinM',$PinYinM);
			
			$this->assign('bihua3',$bihua3);
			
			$getzywhM=getzywh($ming11);
			$this->assign('getzywhM',$getzywhM);
			
			$panDanMing=mb_substr($ming,1,1,"utf8");
			$this->assign('panDanMing',$panDanMing);
			
			$this->assign('ming2',$ming2);
			
			$GbToBigM2=GbToBig($ming2);
			$this->assign('GbToBigM2',$GbToBigM2);
			
			$PinYinM2=transformToPinYin(mb_substr($ming,1,1,"utf8"));
			$this->assign('PinYinM2',$PinYinM2);
			
			$this->assign('bihua4',$bihua4);
			
			$getzywhM2=getzywh($ming22);
			$this->assign('getzywhM2',$getzywhM2);
			
			$tiangeZ=$tiange." ( ".getsancai($tiange)." )";
			$this->assign('tiangeZ',$tiangeZ);
			
			$rengeZ=$renge." ( ".getsancai($renge)." )";
			$this->assign('rengeZ',$rengeZ);
			
			$digeZ=$dige." ( ".getsancai($dige)." )";
			$this->assign('digeZ',$digeZ);
			
			$waigeZ=$waige." ( ".getsancai($waige)." )";
			$this->assign('waigeZ',$waigeZ);
			
			$zhonggeZ=$zhongge." ( ".getsancai($zhongge)." )";
			$this->assign('zhonggeZ',$zhonggeZ);
			
			$this->assign('tiange',$tiange);
			$this->assign('rengee',$rengee);
			$this->assign('digee',$digee);
			$this->assign('zhonggee',$zhonggee);
			$this->assign('waigee',$waigee);
			
			// 天格详细解析数据查询。
			$res1=M('name_test_res81');
			$record1=$res1->where("num=".$tiangee)->find();
			$tgyy=$record1['yy'];
			$tgjx=$record1['jx'];
			$tgas=$record1['as'];
			$tgxx=$record1['content'];
			
			$this->assign('tgyy',$tgyy);
			$this->assign('tgjx',$tgjx);
			$this->assign('tgas',$tgas);
			$this->assign('tgxx',$tgxx);
			
			// 人格详细解析数据查询。
			$res2=M('name_test_res81');
			$record2=$res2->where("num=".$rengee)->find();
			$rgyy=$record2['yy'];
			$rgjx=$record2['jx'];
			$rgas=$record2['asz'];
			$rgxx=$record2['content'];
			
			$this->assign('rgyy',$rgyy);
			$this->assign('rgjx',$rgjx);
			$this->assign('rgas',$rgas);
			$this->assign('rgxx',$rgxx);
			
			// 地格详细解析数据查询。
			$res3=M('name_test_res81');
			$record3=$res3->where("num=".$digee)->find();
			$dgyy=$record3['yy'];
			$dgjx=$record3['jx'];
			$dgas=$record3['asz'];
			$dgxx=$record3['content'];
			
			$this->assign('dgyy',$dgyy);
			$this->assign('dgjx',$dgjx);
			$this->assign('dgas',$dgas);
			$this->assign('dgxx',$dgxx);
			
			// 总格详细解析数据查询。
			$res4=M('name_test_res81');
			$record4=$res4->where("num=".$zhonggee)->find();
			$zgyy=$record4['yy'];
			$zgjx=$record4['jx'];
			$zgas=$record4['asz'];
			$zgxx=$record4['content'];
			
			$this->assign('zgyy',$zgyy);
			$this->assign('zgjx',$zgjx);
			$this->assign('zgas',$zgas);
			$this->assign('zgxx',$zgxx);
			
			// 外格详细解析数据查询。
			$res5=M('name_test_res81');
			$record5=$res5->where("num=".$waigee)->find();
			$wgyy=$record5['yy'];
			$wgjx=$record5['jx'];
			$wgas=$record5['asz'];
			$wgxx=$record5['content'];
			
			$this->assign('wgyy',$wgyy);
			$this->assign('wgjx',$wgjx);
			$this->assign('wgas',$wgas);
			$this->assign('wgxx',$wgxx);
			
			// '三才吉凶
			$sancai=getsancai($tiange).getsancai($renge).getsancai($dige);
			$res6=M('name_test_sancai');
			$record6=$res6->where("title='".$sancai."'")->find();
			$sancaicontent=$record6['content'];
			$scyy=$record6['yy'];
			$scjx=$record6['jx'];
			$jcy=$record6['jcy'];
			$jcyjx=$record6['jx1'];
			$cgy=$record6['cgy'];
			$cgyjx=$record6['jx1'];
			$rjgx=$record6['rjgx'];
			$rjgxjx=$record6['jx3'];
			$xg=$record6['xg'];
			
			$this->assign('sancai',$sancai);
			$this->assign('sancaicontent',$sancaicontent);
			$this->assign('scyy',$scyy);
			$this->assign('scjx',$scjx);
			$this->assign('jcy',$jcy);
			$this->assign('jcyjx',$jcyjx);
			$this->assign('cgy',$cgy);
			$this->assign('cgyjx',$cgyjx);
			$this->assign('rjgx',$rjgx);
			$this->assign('rjgxjx',$rjgxjx);
			$this->assign('xg',$xg);
			
			// 姓名建议的业务逻辑。
			$xmdf=getpf($tgjx)/10+getpf($rgjx)+getpf($dgjx)+getpf($zgjx)+getpf($wgjx)/10+getpf($scjx)/4+getpf($jcyjx)/4+getpf($cgyjx)/4+getpf($rjgxjx)/4;
				
			if($zhonggee > 60){
				$xmdf=$xmdf-5;
			}
			$xmdf=50+$xmdf;
			$xmdf=floor($xmdf);
			
							
			if($xmdf >= 40 && $xmdf <50){
				$decryption='你的名字可能不是很好。强烈建议你换个名字试试，也许人生会因此而改变的。';
				$picture='50-40';
			} elseif ($xmdf >= 50 && $xmdf <60){
				$decryption='你的名字可能不太好，如果可能的话，不妨尝试改变一下，也许会有事半功倍之效。';
				$picture='60-50';
			} elseif ($xmdf >= 60 && $xmdf <70){
				$decryption='你的名字可能不太理想，要想赢得成功，必须比别人付出更多的艰辛和汗水。如果有条件，改个名字也未尝不可。';
				$picture='70-60';
			} elseif ($xmdf >= 70 && $xmdf <80){
				$decryption='你的名字一般。虽然人生路途中会遇到一些困难，但只要努力，还是会有很多收获的。如果有条件，改个名字也未尝不可。';
				$picture='80-70';
			} elseif ($xmdf >= 80 && $xmdf <90){
				$decryption='你的名字取得不错，如果与命理搭配得当，相信它会助你一生顺利的，祝你好运！';
				$picture='90-80';
			} elseif ($xmdf >= 90 && $xmdf <=100){
				$decryption='你的名字取得非常棒，如果与命理搭配得当，成功与惊喜将会伴随你的一生。但千万注意不要失去上进心。';
				$picture='100-90';
			} elseif ($xmdf >= 30 && $xmdf <40){
				$decryption='你的名字可能不是很好。强烈建议你换个名字试试，也许人生会因此而改变的。';
				$picture='40-30';
			} elseif ($xmdf >= 20 && $xmdf <30){
				$decryption='你的名字可能不是很好。强烈建议你换个名字试试，也许人生会因此而改变的。';
				$picture='30-20';
			} elseif ($xmdf >= 10 && $xmdf <20){
				$decryption='你的名字可能不是很好。强烈建议你换个名字试试，也许人生会因此而改变的。';
				$picture='20-10';
			}  elseif ($xmdf >= 0 && $xmdf <10){
				$decryption='你的名字可能不是很好。强烈建议你换个名字试试，也许人生会因此而改变的。';
				$picture='10-0';
			}else{}
			//echo $picture;exit;
			$this->assign('xmdf',$xmdf);
			$this->assign('decryption',$decryption);
			$currentTime=date("Y-m-d",time());
			$this->assign('currentTime',$currentTime);
			$this->assign('xing',$_REQUEST['xing']);
			$this->assign('ming',$_REQUEST['ming']);
			$this->assign('picture',$picture);
			$this->display();
		}else{
			$this->error("请正常提交姓名访问。");
		}
	}
	
	
}
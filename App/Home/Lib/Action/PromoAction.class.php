<?php
/**
 * 电视节目查询
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-26 下午6:00:40
 * @version 1.0
 */
class PromoAction extends Action{
	function _initialize(){
		$this->assign('flag','shenghuo');
		$this->assign('headerFlag',1);
		$this->assign('footerFlag',1);
		$this->assign('headInfo',setHead());
	}	
	public function index(){
		set_time_limit(0);
		if($_GET['count']){
			$count = $_GET['count'];
		}else{
			$count = 1;
		}
		if($_GET['i']){
			$i 	   = $_GET['i'];
		}else{
			$i     = 1;
		}
		$week      = date('w');
		switch($week){
			case 0:
				$week = '周日';
				break;
			case 1:
				$week = '周一';
				break;
			case 2:
				$week = '周二';
				break;
			case 3:
				$week = '周三';
				break;
			case 4:
				$week = '周四';
				break;
			case 5:
				$week = '周五';
				break;
			case 6:
				$week = '周六';
				break;
			default:
				break;
		}
		$num     = date('W');
		$Cache   = Cache::getInstance('File',array('expire'=>'3600'));
		$value   = $Cache->get('num');
		if(empty($value)){
			$Cache->set('num',$num);
		}else{
			if($num > $value){
				header("Content-Type:text/html;charset=utf-8");
				$w1	 = date('Y-m-d',strtotime('0 day'));
				$w2	 = date('Y-m-d',strtotime('1 day'));
				$w3	 = date('Y-m-d',strtotime('2 day'));
				$w4	 = date('Y-m-d',strtotime('3 day'));
				$w5	 = date('Y-m-d',strtotime('4 day'));
				$w6	 = date('Y-m-d',strtotime('5 day'));
				$w7	 = date('Y-m-d',strtotime('6 day'));
				$info       = array();
				if($count<=294){
					if($i<=7){
						/**中央电视台**/
						$url1 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=1&pro=ys";
						$url2 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=3&pro=ys";
						$url3 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=4&pro=ys";
						$url4 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=5&pro=ys";
						$url5 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=6&pro=ys";
						$url6 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=7&pro=ys";
						$url7 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=8&pro=ys";
						$url8 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=9&pro=ys";
						$url9 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=10&pro=ys";
						$url10 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=11&pro=ys";
						$url11 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=12&pro=ys";
						$url12 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=13&pro=ys";
						$url13 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=14&pro=ys";
						$url14 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=15&pro=ys";
						$url15 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=16&pro=ys";
						$url16 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=1&Channelid=17&pro=ys";
						/**中国教育电视台**/
						$url17 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=44&Channelid=18&pro=ys";
						$url116 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=44&Channelid=19&pro=ys";
						$url117 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=44&Channelid=20&pro=ys";
						$url118 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=44&Channelid=21&pro=ys";
						/**中数传媒**/
						$url18 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=405&pro=ys";
						$url119 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=412&pro=ys";
						$url120 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=416&pro=ys";
						$url121 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=417&pro=ys";
						$url122 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=418&pro=ys";
						$url123 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=419&pro=ys";
						$url124 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=420&pro=ys";
						$url125 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=427&pro=ys";
						$url126 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=428&pro=ys";
						$url127 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=885&pro=ys";
						$url128 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=886&pro=ys";
						$url129 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=887&pro=ys";
						$url130 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=889&pro=ys";
						$url131 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=890&pro=ys";
						$url132 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1142&pro=ys";
						$url133 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1143&pro=ys";
						$url134 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1144&pro=ys";
						$url135 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1145&pro=ys";
						$url136 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1146&pro=ys";
						$url137 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1147&pro=ys";
						$url138 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1148&pro=ys";
						$url139 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1149&pro=ys";
						$url140 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1150&pro=ys";
						$url141 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1151&pro=ys";
						$url142 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1152&pro=ys";
						$url143 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1153&pro=ys";
						$url144 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1154&pro=ys";
						$url145 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1155&pro=ys";
						$url146 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1156&pro=ys";
						$url147 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=1157&pro=ys";
						/**央视风云**/
					    $url19 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=398&pro=ys";
					    $url148 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=399&pro=ys";
					    $url149 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=400&pro=ys";
					    $url150 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=401&pro=ys";
					    $url151 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=421&pro=ys";
					    $url152 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=422&pro=ys";
					    $url153 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=423&pro=ys";
					    $url154 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=424&pro=ys";
					    $url155 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=888&pro=ys";
					    $url156 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=1158&pro=ys";
					    /**央视数字频道**/
					    $url157 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=425&pro=ys";
					    $url158 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=202&Channelid=426&pro=ys";
					    /**北广传媒**/
					    $url159 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1083&pro=ys";
					    $url160 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1084&pro=ys";
					    $url161 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1085&pro=ys";
					    $url162 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1086&pro=ys";
					    $url163 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1087&pro=ys";
					    $url164 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1088&pro=ys";
					    $url165 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1089&pro=ys";
					    $url166 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1090&pro=ys";
					    $url167 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1091&pro=ys";
					    $url168 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1092&pro=ys";
					    $url169 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=249&Channelid=1093&pro=ys";
					    /**数字频道**/
					    $url168 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=402&pro=ys";
					    $url169 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=403&pro=ys";
					    $url170 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=404&pro=ys";
					    $url171 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=405&pro=ys";
					    $url172 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=406&pro=ys";
					    $url173 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=407&pro=ys";
					    $url174 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=408&pro=ys";
					    $url175 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=409&pro=ys";
					    $url176 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=410&pro=ys";
					    $url177 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=411&pro=ys";
					    $url178 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=413&pro=ys";
					    $url179 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=414&pro=ys";
					    $url180 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=415&pro=ys";
					    $url181 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=884&pro=ys";
					    /**各省卫视**/
					    $url20 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=46&pro=ws";
					    $url182 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=41&pro=ws";
					    $url183 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=42&pro=ws";
					    $url184 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=43&pro=ws";
					    $url185 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=44&pro=ws";
					    $url186 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=45&pro=ws";
					    $url187 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=81&pro=ws";
					    $url188 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=60&pro=ws";
					    $url189 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=38&pro=ws";
					    $url190 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=50&pro=ws";
					    $url191 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=51&pro=ws";
					    $url192 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=58&pro=ws";
					    $url193 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=59&pro=ws";
					    $url194 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=18&pro=ws";
					    $url195 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=70&pro=ws";
					    $url196 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=31&pro=ws";
					    $url197 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=35&pro=ws";
					    $url198 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=39&pro=ws";
					    $url199 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=49&pro=ws";
					    $url200 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=36&pro=ws";
					    $url201 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=57&pro=ws";
					    $url202 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=47&pro=ws";
					    $url203 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=48&pro=ws";
					    $url204 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=40&pro=ws";
					    $url205 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=52&pro=ws";
					    $url206 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=53&pro=ws";
					    $url207 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=34&pro=ws";
					    $url208 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=592&pro=ws";
					    $url209 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=54&pro=ws";
					    $url210 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=55&pro=ws";
					    $url211 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=56&pro=ws";
					    $url212 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=93&pro=ws";
					    $url213 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=337&pro=ws";
					    $url214 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=1476&pro=ws";
					    /**动漫频道**/
					    $url215 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=129&pro=ws";
					    $url216 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=558&pro=ws";
					    $url217 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=69&pro=ws";
					    /**电影频道**/
					    $url218 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=108&Channelid=505&pro=ws";
					    $url219 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=108&Channelid=594&pro=ws";
					    /**数字/收费频道**/
					    $url220 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=22&pro=jw";
					    $url221 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=23&pro=jw";
					    $url222 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=24&pro=jw";
					    $url223 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=25&pro=jw";
					    $url224 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=26&pro=jw";
					    $url225 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=29&pro=jw";
					    $url226 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=30&pro=jw";
					    $url227 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=209&pro=jw";
					    $url228 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=290&pro=jw";
					    $url229 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=496&pro=jw";
					    $url230 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=737&pro=jw";
					    /**科教频道**/
					    $url231 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=151&Channelid=738&pro=jw";
					    $url232 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=151&Channelid=458&pro=jw";
					    /**影视频道**/
					    $url233 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=369&pro=jw";
					    $url234 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=1260&pro=jw";
					    $url235 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=1470&pro=jw";
					    $url236 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=1218&pro=jw";
					    $url237 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=735&pro=jw";
					    $url238 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=1255&pro=jw";
					    $url239 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=184&pro=jw";
					    $url240 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=183&pro=jw";
					    $url241 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=740&pro=jw";
					    $url242 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=411&pro=jw";
					    $url243 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=1179&pro=jw";
					    $url244 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=1180&pro=jw";
					    $url245 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=28&pro=jw";
					    $url246 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=1115&pro=jw";
					    /**国际咨询/财经频道**/
					    $url247 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=108&Channelid=461&pro=jw";
					    $url248 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=108&Channelid=462&pro=jw";
					    $url249 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=108&Channelid=463&pro=jw";
					    $url250 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=108&Channelid=464&pro=jw";
					    $url251 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=108&Channelid=27&pro=jw";
					    $url252 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=108&Channelid=465&pro=jw";

					    $url21 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=11&Channelid=81&pro=ws";
					    $url22 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=39&Channelid=70&pro=ws";
					    $url23 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=38&Channelid=60&pro=ws";
				    	$url24 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=35&Channelid=57&pro=ws";
						$url25 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=37&Channelid=59&pro=ws";
					    $url26 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=22&Channelid=44&pro=ws";
					    $url27 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=19&Channelid=41&pro=ws";
					    $url28 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=20&Channelid=42&pro=ws";
					    $url29 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=21&Channelid=43&pro=ws";
					    $url30 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=25&Channelid=47&pro=ws";
					    $url31 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=27&Channelid=49&pro=ws";
					    $url32 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=28&Channelid=50&pro=ws";
					    $url33 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=23&Channelid=45&pro=ws";
					    $url34 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=14&Channelid=36&pro=ws";
					    $url35 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=42&Channelid=93&pro=ws";
					    $url36 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=8&Channelid=31&pro=ws";
					    $url37 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=36&Channelid=58&pro=ws";
					    $url38 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=15&Channelid=37&pro=ws";
					    $url39 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=18&Channelid=40&pro=ws";
					    $url40 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=16&Channelid=38&pro=ws";
					    $url41 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=13&Channelid=35&pro=ws";
					    $url42 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=17&Channelid=39&pro=ws";
					    $url43 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=29&Channelid=51&pro=ws";
					    $url44 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=12&Channelid=34&pro=ws";
					    $url45 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=34&Channelid=56&pro=ws";
					    $url46 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=26&Channelid=48&pro=ws";
					    $url47 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=33&Channelid=55&pro=ws";
					    $url49 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=31&Channelid=53&pro=ws";
					    $url50 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=30&Channelid=52&pro=ws";
				    	$url51 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=592&pro=ws";
				    	$url52 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=26&pro=jw";
				    	$url53 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=27&pro=jw";
				    	$url54 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=28&pro=jw";
				    	$url55 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=7&Channelid=30&pro=jw";
				    	$url56 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=6&Channelid=29&pro=jw";
				    	$url57 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=59&Channelid=209&pro=jw";
						$url58 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=1180&pro=jw";
				    	$url59 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=280&Channelid=1187&pro=jw";
				    	$url60 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=5&Channelid=28&pro=jw";
		    			$url61 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=68&Channelid=560&pro=jw";
		    			$url62 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=48&Channelid=108&pro=jw";
		    			$url63 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=47&Channelid=107&pro=jw";
		    			$url64 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=9&Channelid=32&pro=jw";
		    			$url65 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=4&Channelid=24&pro=jw";
		    			$url66 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=4&Channelid=25&pro=jw";
		    			$url67 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=4&Channelid=183&pro=jw";
		    			$url68 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=3&Channelid=22&pro=jw";
		    			$url69 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=3&Channelid=23&pro=jw";
		    			$url70 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=4&Channelid=184&pro=jw";
						$url71 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=93&Channelid=496&pro=jw";
		    			$url72 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=113&Channelid=624&pro=jw";
		    			$url73 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=113&Channelid=617&pro=jw";
		    			$url74 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=113&Channelid=619&pro=jw";
		    			$url75 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=86&Channelid=369&pro=jw";
		    			$url76 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=4&Channelid=183&pro=jw";
		    			$url77 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=400&pro=jw";
		    			$url78 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=150&Channelid=737&pro=jw";
		    			$url79 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=412&pro=jw";
		    			$url80 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=83&Channelid=411&pro=jw";
		    			$url81 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=148&Channelid=735&pro=jw";
		    			// 本地
		    			// 广东
		    			$url82 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=39&Channelid=70&pro=guandong&tid=1";
		    			$url253 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=39&Channelid=71&pro=guandong&tid=1";
		    			$url254 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=39&Channelid=72&pro=guandong&tid=1";
		    			$url255 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=39&Channelid=73&pro=guandong&tid=1";
		    			$url256 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=39&Channelid=996&pro=guandong&tid=1";
		    			$url257 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=39&Channelid=1132&pro=guandong&tid=1";
		    			// 深圳
		    			$url258 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=42&Channelid=93&pro=guandong&tid=1";
		    			$url259 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=42&Channelid=94&pro=guandong&tid=1";
		    			$url260 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=42&Channelid=95&pro=guandong&tid=1";
		    			$url261 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=42&Channelid=96&pro=guandong&tid=1";
		    			$url262 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=42&Channelid=97&pro=guandong&tid=1";
		    			$url263 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=42&Channelid=98&pro=guandong&tid=1";
		    			$url264 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=42&Channelid=99&pro=guandong&tid=1";
		    			$url265 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=42&Channelid=100&pro=guandong&tid=1";
		    			// 广州
		    			$url266 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=43&Channelid=74&pro=guandong&tid=1";
		    			$url267 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=43&Channelid=75&pro=guandong&tid=1";
		    			$url268 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=43&Channelid=76&pro=guandong&tid=1";
		    			$url269 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=43&Channelid=77&pro=guandong&tid=1";
		    			$url270 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=43&Channelid=78&pro=guandong&tid=1";
		    			$url271 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=43&Channelid=79&pro=guandong&tid=1";
		    			$url272 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=43&Channelid=80&pro=guandong&tid=1";
		    			// 珠海
		    			$url273 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=61&Channelid=227&pro=guandong&tid=1";
		    			$url274 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=61&Channelid=497&pro=guandong&tid=1";
		    			// 潮州
		    			$url275 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=66&Channelid=238&pro=guandong&tid=1";
		    			$url276 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=66&Channelid=239&pro=guandong&tid=1";
		    			// 湛江
		    			$url277 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=94&Channelid=498&pro=guandong&tid=1";
		    			$url278 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=94&Channelid=499&pro=guandong&tid=1";
		    			// 佛山
		    			$url279 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=95&Channelid=500&pro=guandong&tid=1";
		    			$url280 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=95&Channelid=501&pro=guandong&tid=1";
		    			$url281 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=95&Channelid=502&pro=guandong&tid=1";
		    			$url282 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=95&Channelid=637&pro=guandong&tid=1";
		    			$url283 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=95&Channelid=638&pro=guandong&tid=1";
		    			// 肇庆
		    			$url284 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=96&Channelid=503&pro=guandong&tid=1";
		    			$url285 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=96&Channelid=504&pro=guandong&tid=1";
		    			// 惠州
		    			$url286 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=126&Channelid=659&pro=guandong&tid=1";
		    			$url287 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=126&Channelid=660&pro=guandong&tid=1";
		    			// 中山
		    			$url288 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=130&Channelid=670&pro=guandong&tid=1";
		    			$url289 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=130&Channelid=671&pro=guandong&tid=1";
		    			// 汕头
		    			$url290 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=138&Channelid=707&pro=guandong&tid=1";
		    			$url291 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=138&Channelid=708&pro=guandong&tid=1";
		    			$url292 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=138&Channelid=709&pro=guandong&tid=1";
		    			// 茂名
		    			$url293 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=162&Channelid=763&pro=guandong&tid=1";
		    			$url294 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=162&Channelid=764&pro=guandong&tid=1";
		    			
		    			
		    			$url83 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=41&Channelid=82&pro=shanghai&tid=1";
		    			$url84 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=38&Channelid=61&pro=beijing&tid=1";
		    			$url85 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=35&Channelid=153&pro=tianjing&tid=1";
				        $url86 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=37&Channelid=199&pro=chongqing&tid=1";
				        $url87 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=24&Channelid=435&pro=hunan&tid=1";
				        $url88 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=25&Channelid=131&pro=hubei&tid=1";
				        $url89 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=22&Channelid=115&pro=jiangsu&tid=1";
				        $url90 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=19&Channelid=267&pro=shandong&tid=1";
				        $url91 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=20&Channelid=343&pro=anhui&tid=1";
				        $url92 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=21&Channelid=180&pro=zhejiang&tid=1";
				        $url93 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=27&Channelid=441&pro=yunnan&tid=1";
				        $url94 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=28&Channelid=174&pro=guangxi&tid=1";
				        $url95 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=23&Channelid=218&pro=jiangxi&tid=1";
				        $url96 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=14&Channelid=262&pro=liaoning&tid=1";
				        $url97 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=55&Channelid=222&pro=hainan&tid=1";
				        $url98 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=36&Channelid=161&pro=sichuan&tid=1";
				        $url99 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=15&Channelid=319&pro=hebei&tid=1";
				        $url100 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=18&Channelid=314&pro=shanxi&tid=1";
				        $url101 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=16&Channelid=326&pro=henan&tid=1";
				        $url102 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=13&Channelid=363&pro=jilin&tid=1";
				        $url103 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=17&Channelid=228&pro=sanxi&tid=1";
				        $url104 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=29&Channelid=307&pro=fujian&tid=1";
				        $url105 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=12&Channelid=387&pro=heilongjiang&tid=1";
				        $url106 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=34&Channelid=570&pro=neimenggu&tid=1";
				        $url107 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=26&Channelid=376&pro=guizhou&tid=1";
				        $url108 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=33&Channelid=542&pro=xinjiang&tid=1";
				        $url109 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&ChannelID=54&TVid=1017&pro=xizang&tid=1";
				        $url110 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=31&Channelid=438&pro=ningxia&tid=1";
					    $url111 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=30&Channelid=537&pro=gansu&tid=1";
				        $url112 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&ChannelID=592&TVid=868&pro=qinghai&tid=1";
				        $url113 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&ChannelID=22&TVid=4&pro=xianggan&tid=1";
					    $url114 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&ChannelID=622&TVid=113&pro=taiwan&tid=1";
					    $url115 = "http://m.tvsou.com/epg.asp?programDT=".${w.$i}."&TVid=150&Channelid=737&pro=aomen&tid=1";
					    $result 	= getByNetFun(${url.$count});
					    $result 	= iconv("gb2312","utf-8//IGNORE",$result);
					    $matchAll1 	= array();
					    $matchAll2 	= array();
					    $matchAll3 	= array();
					    $reg1       = "/<div class=\"time\">(.*?)<\/div>/is";
					    $reg2       = "/<li class=\"li_on li_xian\" >(.*?)<br>(.*?)<\/li>/is";
					    $reg3       = "/<li class='tv_left'>([^<](.*?))<\/li>/is";
					    preg_match_all($reg1,$result,$matchAll1,PREG_SET_ORDER);
					    preg_match_all($reg2,$result,$matchAll2,PREG_SET_ORDER);
					    preg_match_all($reg3,$result,$matchAll3,PREG_SET_ORDER);
					    foreach($matchAll1 as $key => $value){
					    	$info[$key]['content'] = $value[1];
					    }
					    foreach($matchAll2 as $key => $value){
					    	$info[$key]['week'] = $value[1];
					    	$info[$key]['date'] = $value[2];
					    }
					    foreach($matchAll3 as $key => $value){
					    	$info[$key]['program'] = $value[1];
					    }
					    foreach($info as $key =>$value){
					    	switch($value['week']){
					    		case '周日':
					    			$wk = 0;
					    			break;
				    			case '周一':
				    				$wk = 1;
				    				break;
			    				case '周二':
			    					$wk = 2;
			    					break;
		    					case '周三':
		    						$wk = 3;
		    						break;
	    						case '周四':
	    							$wk = 4;
	    							break;
	    						case '周五':
	    							$wk = 5;
	    							break;
	    						case '周六':
	    							$wk = 6;
	    							break;
	    						default:
	    							break;
					    	}
					    	$file = json_encode($info);
					    	$channel = $value['program'];
					    	dump($channel);
					    	$channel = $this->unicode_encode($channel, $encoding = 'GBK', $prefix = '&#', $postfix = ';');
					    	//file_put_contents('D://promo/'.$channel.'_'.$wk.'.txt',$file);
							file_put_contents(ROOT_PATH.'/Www/upload/promo/'.$channel.'_'.$wk.'.txt',$file);	
					    }
					    echo '<script>';
					    echo 'window.location.href="'.__URL__.'/?count='.$count.'&i='.($i+1).'"';
					    echo '</script>';
				    }
				    echo '<script>';
				    echo 'window.location.href="'.__URL__.'/?count='.($count+1).'&i=1'.'"';
				    echo '</script>';
				}
			}
		}
		if(($count==294)&&($i==7)){
			$Cache->set('num',$num);
		}
		$this->assign('week',$week);
		$this->display(result);
	}
	public function result(){
		$id			= $_GET['id'];
		if(empty($_GET['id'])){
			$id 	= 1;
		}
		$weeks      = date('w');
		switch($weeks){
			case 0:
				$weeks = '周日';
				break;
			case 1:
				$weeks = '周一';
				break;
			case 2:
				$weeks = '周二';
				break;
			case 3:
				$weeks = '周三';
				break;
			case 4:
				$weeks = '周四';
				break;
			case 5:
				$weeks = '周五';
				break;
			case 6:
				$weeks = '周六';
				break;
			default:
				break;
		}
		$date         = date('Y年m月d日 ');
		$time		  = $date.$weeks;
		$program  	  = $_GET['program'];
		$week     	  = $_GET['week'];
		if(empty($_GET['week'])){
			$wk = date('w');
		}else{
			switch($week){
				case '周日':
					$wk = 0;
					break;
				case '周一':
					$wk = 1;
					break;
				case '周二':
					$wk = 2;
					break;
				case '周三':
					$wk = 3;
					break;
				case '周四':
					$wk = 4;
					break;
				case '周五':
					$wk = 5;
					break;
				case '周六':
					$wk = 6;
					break;
				default:
					break;
			}
		}
		$channel			= $this->unicode_encode($program, $encoding = 'GBK', $prefix = '&#', $postfix = ';');
		//$file 				= file_get_contents('D://promo/'.$channel.'_'.$wk.'.txt');
		$file 				= file_get_contents(ROOT_PATH.'/Www/upload/promo/'.$channel.'_'.$wk.'.txt');
		$info				= json_decode($file,true);
		$info[0]['content'] = str_replace('intro.asp','http://m.tvsou.com/intro.asp',$info[0]['content']);
		$info[0]['content'] = str_replace('/jq3.asp','http://m.tvsou.com/jq3.asp',$info[0]['content']);
		$result = $info[0]['content'];
		$result = explode('</li>',$result);
		for($i=0;$i<count($result)-1;$i++){
			if($i==0){
				$result[$i] = str_replace("<ul>","",$result[$i]);
			}
			$result[$i] = str_replace("<li class='gray'>","<div id='e1'>",$result[$i]);
			$result[$i] = str_replace("<span>","</div><div id='e2'>",$result[$i]);
			$result[$i] = str_replace("target='_blank'","target='_blank' class='black'",$result[$i]);
			$result[$i] = str_replace("</span>","</div>",$result[$i]);
		}
		$this->assign('resultInfo',$result);
		$this->assign('result',$info);
		$this->assign('weeks',$weeks);
		$this->assign('program',$program);
		$this->assign('id',$id);
		$this->assign('time',$time);
		$this->assign('wk',$wk);
		$this->display();
	}
	public function result_ws(){
		$id			= $_GET['id'];
		if(empty($_GET['id'])){
			$id 	= 1;
		}
		$weeks      = date('w');
		switch($weeks){
			case 0:
				$weeks = '周日';
				break;
			case 1:
				$weeks = '周一';
				break;
			case 2:
				$weeks = '周二';
				break;
			case 3:
				$weeks = '周三';
				break;
			case 4:
				$weeks = '周四';
				break;
			case 5:
				$weeks = '周五';
				break;
			case 6:
				$weeks = '周六';
				break;
			default:
				break;
		}
		$date         = date('Y年m月d日 ');
		$time		  = $date.$weeks;
		$program  	  = $_GET['program'];
		$week     	  = $_GET['week'];
		if(empty($_GET['week'])){
			$wk = date('w');
		}else{
			switch($week){
				case '周日':
					$wk = 0;
					break;
				case '周一':
					$wk = 1;
					break;
				case '周二':
					$wk = 2;
					break;
				case '周三':
					$wk = 3;
					break;
				case '周四':
					$wk = 4;
					break;
				case '周五':
					$wk = 5;
					break;
				case '周六':
					$wk = 6;
					break;
				default:
					break;
			}
		}
		$channel			= $this->unicode_encode($program, $encoding = 'GBK', $prefix = '&#', $postfix = ';');
		//$file 				= file_get_contents('D://promo/'.$channel.'_'.$wk.'.txt');
		$file 				= file_get_contents(ROOT_PATH.'/Www/upload/promo/'.$channel.'_'.$wk.'.txt');
		$info				= json_decode($file,true);
		$info[0]['content'] = str_replace('intro.asp','http://m.tvsou.com/intro.asp',$info[0]['content']);
		$info[0]['content'] = str_replace('/jq3.asp','http://m.tvsou.com/jq3.asp',$info[0]['content']);
		$result = $info[0]['content'];
		$result = explode('</li>',$result);
		for($i=0;$i<count($result)-1;$i++){
			if($i==0){
				$result[$i] = str_replace("<ul>","",$result[$i]);
			}
			$result[$i] = str_replace("<li class='gray'>","<div id='e1'>",$result[$i]);
			$result[$i] = str_replace("<span>","</div><div id='e2'>",$result[$i]);
			$result[$i] = str_replace("target='_blank'","target='_blank' class='black'",$result[$i]);
			$result[$i] = str_replace("</span>","</div>",$result[$i]);
		}
		$this->assign('resultInfo',$result);
		$this->assign('result',$info);
		$this->assign('weeks',$weeks);
		$this->assign('program',$program);
		$this->assign('id',$id);
		$this->assign('time',$time);
		$this->assign('wk',$wk);
		$this->display();
	}
	public function result_bd(){
		$id			= $_GET['id'];
		if(empty($_GET['id'])){
			$id 	= 1;
		}
		$weeks      = date('w');
		switch($weeks){
			case 0:
				$weeks = '周日';
				break;
			case 1:
				$weeks = '周一';
				break;
			case 2:
				$weeks = '周二';
				break;
			case 3:
				$weeks = '周三';
				break;
			case 4:
				$weeks = '周四';
				break;
			case 5:
				$weeks = '周五';
				break;
			case 6:
				$weeks = '周六';
				break;
			default:
				break;
		}
		$date         = date('Y年m月d日 ');
		$time		  = $date.$weeks;
		$program  	  = $_GET['program'];
		$week     	  = $_GET['week'];
		if(empty($_GET['week'])){
			$wk = date('w');
		}else{
			switch($week){
				case '周日':
					$wk = 0;
					break;
				case '周一':
					$wk = 1;
					break;
				case '周二':
					$wk = 2;
					break;
				case '周三':
					$wk = 3;
					break;
				case '周四':
					$wk = 4;
					break;
				case '周五':
					$wk = 5;
					break;
				case '周六':
					$wk = 6;
					break;
				default:
					break;
			}
		}
		$channel			= $this->unicode_encode($program, $encoding = 'GBK', $prefix = '&#', $postfix = ';');
		//$file 				= file_get_contents('D://promo/'.$channel.'_'.$wk.'.txt');
		$file 				= file_get_contents(ROOT_PATH.'/Www/upload/promo/'.$channel.'_'.$wk.'.txt');
		$info				= json_decode($file,true);
		$info[0]['content'] = str_replace('intro.asp','http://m.tvsou.com/intro.asp',$info[0]['content']);
		$info[0]['content'] = str_replace('/jq3.asp','http://m.tvsou.com/jq3.asp',$info[0]['content']);
		$result = $info[0]['content'];
		$result = explode('</li>',$result);
		for($i=0;$i<count($result)-1;$i++){
			if($i==0){
				$result[$i] = str_replace("<ul>","",$result[$i]);
			}
			$result[$i] = str_replace("<li class='gray'>","<div id='e1'>",$result[$i]);
			$result[$i] = str_replace("<span>","</div><div id='e2'>",$result[$i]);
			$result[$i] = str_replace("target='_blank'","target='_blank' class='black'",$result[$i]);
			$result[$i] = str_replace("</span>","</div>",$result[$i]);
		}
		$this->assign('resultInfo',$result);
		$this->assign('result',$info);
		$this->assign('weeks',$weeks);
		$this->assign('program',$program);
		$this->assign('id',$id);
		$this->assign('time',$time);
		$this->assign('wk',$wk);
		$this->display();
	}
	public function result_jw(){
		$id			= $_GET['id'];
		if(empty($_GET['id'])){
			$id 	= 1;
		}
		$weeks      = date('w');
		switch($weeks){
			case 0:
				$weeks = '周日';
				break;
			case 1:
				$weeks = '周一';
				break;
			case 2:
				$weeks = '周二';
				break;
			case 3:
				$weeks = '周三';
				break;
			case 4:
				$weeks = '周四';
				break;
			case 5:
				$weeks = '周五';
				break;
			case 6:
				$weeks = '周六';
				break;
			default:
				break;
		}
		$date         = date('Y年m月d日 ');
		$time		  = $date.$weeks;
		$program  	  = $_GET['program'];
		$week     	  = $_GET['week'];
		if(empty($_GET['week'])){
			$wk = date('w');
		}else{
			switch($week){
				case '周日':
					$wk = 0;
					break;
				case '周一':
					$wk = 1;
					break;
				case '周二':
					$wk = 2;
					break;
				case '周三':
					$wk = 3;
					break;
				case '周四':
					$wk = 4;
					break;
				case '周五':
					$wk = 5;
					break;
				case '周六':
					$wk = 6;
					break;
				default:
					break;
			}
		}
		$channel			= $this->unicode_encode($program, $encoding = 'GBK', $prefix = '&#', $postfix = ';');
		//$file 				= file_get_contents('D://promo/'.$channel.'_'.$wk.'.txt');
		$file 				= file_get_contents(ROOT_PATH.'/Www/upload/promo/'.$channel.'_'.$wk.'.txt');
		$info				= json_decode($file,true);
		$info[0]['content'] = str_replace('intro.asp','http://m.tvsou.com/intro.asp',$info[0]['content']);
		$info[0]['content'] = str_replace('/jq3.asp','http://m.tvsou.com/jq3.asp',$info[0]['content']);
		$result = $info[0]['content'];
		$result = explode('</li>',$result);
		for($i=0;$i<count($result)-1;$i++){
			if($i==0){
				$result[$i] = str_replace("<ul>","",$result[$i]);
			}
			$result[$i] = str_replace("<li class='gray'>","<div id='e1'>",$result[$i]);
			$result[$i] = str_replace("<span>","</div><div id='e2'>",$result[$i]);
			$result[$i] = str_replace("target='_blank'","target='_blank' class='black'",$result[$i]);
			$result[$i] = str_replace("</span>","</div>",$result[$i]);
		}
		$this->assign('resultInfo',$result);
		$this->assign('result',$info);
		$this->assign('weeks',$weeks);
		$this->assign('program',$program);
		$this->assign('id',$id);
		$this->assign('time',$time);
		$this->assign('wk',$wk);
		$this->display();
	}
	public function result_gqds(){
		$id			= $_GET['id'];
		if(empty($_GET['id'])){
			$id 	= 1;
		}
		$weeks      = date('w');
		switch($weeks){
			case 0:
				$weeks = '周日';
				break;
			case 1:
				$weeks = '周一';
				break;
			case 2:
				$weeks = '周二';
				break;
			case 3:
				$weeks = '周三';
				break;
			case 4:
				$weeks = '周四';
				break;
			case 5:
				$weeks = '周五';
				break;
			case 6:
				$weeks = '周六';
				break;
			default:
				break;
		}
		$date         = date('Y年m月d日 ');
		$time		  = $date.$weeks;
		$program  	  = $_GET['program'];
		$week     	  = $_GET['week'];
		if(empty($_GET['week'])){
			$wk = date('w');
		}else{
			switch($week){
				case '周日':
					$wk = 0;
					break;
				case '周一':
					$wk = 1;
					break;
				case '周二':
					$wk = 2;
					break;
				case '周三':
					$wk = 3;
					break;
				case '周四':
					$wk = 4;
					break;
				case '周五':
					$wk = 5;
					break;
				case '周六':
					$wk = 6;
					break;
				default:
					break;
			}
		}
		$channel			= $this->unicode_encode($program, $encoding = 'GBK', $prefix = '&#', $postfix = ';');
		//$file 				= file_get_contents('D://promo/'.$channel.'_'.$wk.'.txt');
		$file 				= file_get_contents(ROOT_PATH.'/Www/upload/promo/'.$channel.'_'.$wk.'.txt');
		$info				= json_decode($file,true);
		$info[0]['content'] = str_replace('intro.asp','http://m.tvsou.com/intro.asp',$info[0]['content']);
		$info[0]['content'] = str_replace('/jq3.asp','http://m.tvsou.com/jq3.asp',$info[0]['content']);
		$result = $info[0]['content'];
		$result = explode('</li>',$result);
		for($i=0;$i<count($result)-1;$i++){
			if($i==0){
				$result[$i] = str_replace("<ul>","",$result[$i]);
			}
			$result[$i] = str_replace("<li class='gray'>","<div id='e1'>",$result[$i]);
			$result[$i] = str_replace("<span>","</div><div id='e2'>",$result[$i]);
			$result[$i] = str_replace("target='_blank'","target='_blank' class='black'",$result[$i]);
			$result[$i] = str_replace("</span>","</div>",$result[$i]);
		}
		$this->assign('resultInfo',$result);
		$this->assign('result',$info);
		$this->assign('weeks',$weeks);
		$this->assign('program',$program);
		$this->assign('id',$id);
		$this->assign('time',$time);
		$this->assign('wk',$wk);
		$this->display();
	}
	public function result_flds(){
		$id			= $_GET['id'];
		if(empty($_GET['id'])){
			$id 	= 1;
		}
		$weeks      = date('w');
		switch($weeks){
			case 0:
				$weeks = '周日';
				break;
			case 1:
				$weeks = '周一';
				break;
			case 2:
				$weeks = '周二';
				break;
			case 3:
				$weeks = '周三';
				break;
			case 4:
				$weeks = '周四';
				break;
			case 5:
				$weeks = '周五';
				break;
			case 6:
				$weeks = '周六';
				break;
			default:
				break;
		}
		$date         = date('Y年m月d日 ');
		$time		  = $date.$weeks;
		$program  	  = $_GET['program'];
		$week     	  = $_GET['week'];
		if(empty($_GET['week'])){
			$wk = date('w');
		}else{
			switch($week){
				case '周日':
					$wk = 0;
					break;
				case '周一':
					$wk = 1;
					break;
				case '周二':
					$wk = 2;
					break;
				case '周三':
					$wk = 3;
					break;
				case '周四':
					$wk = 4;
					break;
				case '周五':
					$wk = 5;
					break;
				case '周六':
					$wk = 6;
					break;
				default:
					break;
			}
		}
		$channel			= $this->unicode_encode($program, $encoding = 'GBK', $prefix = '&#', $postfix = ';');
		//$file 				= file_get_contents('D://promo/'.$channel.'_'.$wk.'.txt');
		$file 				= file_get_contents(ROOT_PATH.'/Www/upload/promo/'.$channel.'_'.$wk.'.txt');
		$info				= json_decode($file,true);
		$info[0]['content'] = str_replace('intro.asp','http://m.tvsou.com/intro.asp',$info[0]['content']);
		$info[0]['content'] = str_replace('/jq3.asp','http://m.tvsou.com/jq3.asp',$info[0]['content']);
		$result = $info[0]['content'];
		$result = explode('</li>',$result);
		for($i=0;$i<count($result)-1;$i++){
			if($i==0){
				$result[$i] = str_replace("<ul>","",$result[$i]);
			}
			$result[$i] = str_replace("<li class='gray'>","<div id='e1'>",$result[$i]);
			$result[$i] = str_replace("<span>","</div><div id='e2'>",$result[$i]);
			$result[$i] = str_replace("target='_blank'","target='_blank' class='black'",$result[$i]);
			$result[$i] = str_replace("</span>","</div>",$result[$i]);
		}
		$this->assign('resultInfo',$result);
		$this->assign('result',$info);
		$this->assign('weeks',$weeks);
		$this->assign('program',$program);
		$this->assign('id',$id);
		$this->assign('time',$time);
		$this->assign('wk',$wk);
		$this->display();
	}
	/**
	 * $str 原始中文字符串
	* $encoding 原始字符串的编码，默认GBK
	* $prefix 编码后的前缀，默认"&#"
	* $postfix 编码后的后缀，默认";"
	*/
	function unicode_encode($str, $encoding = 'utf8', $prefix = '&#', $postfix = ';') {
		$str = iconv($encoding, 'UCS-2', $str);
		$arrstr = str_split($str, 2);
		$unistr = '';
		for($i = 0, $len = count($arrstr); $i < $len; $i++) {
			$dec = hexdec(bin2hex($arrstr[$i]));
			$unistr .= $prefix . $dec . $postfix;
		}
		return $unistr;
	}
	/**
	 * $str Unicode编码后的字符串
	 * $decoding 原始字符串的编码，默认GBK
	 * $prefix 编码字符串的前缀，默认"&#"
	 * $postfix 编码字符串的后缀，默认";"
	 */
	function unicode_decode($unistr, $encoding = 'utf8', $prefix = '&#', $postfix = ';') {
		$arruni = explode($prefix, $unistr);
		$unistr = '';
		for($i = 1, $len = count($arruni); $i < $len; $i++) {
			if (strlen($postfix) > 0) {
				$arruni[$i] = substr($arruni[$i], 0, strlen($arruni[$i]) - strlen($postfix));
			}
			$temp = intval($arruni[$i]);
			$unistr .= ($temp < 256) ? chr(0) . chr($temp) : chr($temp / 256) . chr($temp % 256);
		}
		return iconv('UCS-2', $encoding, $unistr);
	}
	
}
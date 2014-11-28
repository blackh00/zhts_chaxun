<?php
/**
 * 搞笑网络证件
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Xieyihong <305095253@qq.com>
 * @CreateDate: 2013-7-30 下午3:24:07
 * @version 1.0
 */
class FunnyWebAction extends Action{
	function _initialize(){
		$this->assign('flag','yule');
		$this->assign('footerFlag',1);
		$this->assign('headerFlag',1);
		$this->assign('headInfo',setHead());
	}
	public function index(){
		// 图片缓存
		$week    = date('W');
		$Cache   = Cache::getInstance('File',array('expire'=>'60'));
		$value   = $Cache->get('num');
		if(empty($value)){
			$Cache->set('num',$week);
		}else{
			if($week > $value){
				$normal_path = ROOT_PATH.'/Www/upload/temp/normal/';
				$award_path  = ROOT_PATH.'/Www/upload/temp/award/';
				$diy_path    = ROOT_PATH.'/Www/upload/temp/diy/';
				$marry_path  = ROOT_PATH.'/Www/upload/temp/marry/';
				$this->deldir($normal_path);
				$this->deldir($award_path);
				$this->deldir($marry_path);
				$this->deldir($diy_path);
				$Cache->set('num',$week);
			}
		}
		$ctype 	= 	$_POST['ctype'];
		if($ctype == 2){//普通版本处理
			$card   =   $_POST['card'];
			if($card=='处女证'){
				$card='v_1';
			}else if($card=='黑帮大姐大'){
				$card='v_2';
			}else if($card=='最有女人味'){
				$card='v_3';
			}else if($card=='处男证'){
				$card='n_1';
			}else if($card=='光棍证'){
				$card='n_2';
			}else if($card=='好男人证'){
				$card='n_3';
			}else if($card=='失恋证'){
				$card='a_1';
			}else if($card=='痴情证'){
				$card='a_2';
			}else if($card=='征婚证'){
				$card='a_3';
			}else if($card=='职业聊天证'){
				$card='z_1';
			}else if($card=='乞丐行乞证'){
				$card='z_2';
			}else if($card=='吹牛证'){
				$card='z_3';
			}else if($card=='十大杰出青年'){
				$card='z_4';
			}else if($card=='死不要脸证'){
				$card='h_1';
			}else if($card=='放屁许可证'){
				$card='h_2';
			}else if($card=='麦霸证'){
				$card='h_3';
			}else if($card=='天才证'){
				$card='h_4';
			}
			import("ORG.Net.UploadFile");
			$upload = new UploadFile(); // 实例化上传类
			$upload->maxSize = 3145728 ; // 讴置附件上传大小为3M
			$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 讴置附件上传类型
			$upload->savePath = ROOT_PATH.'/Www/upload/temp/normal/'; // 讴置附件上传目录
			if(!$upload->upload()) { // 上传错诣 提示错诣信息
				$this->error($upload->getErrorMsg());
			}else{ // 上传成功 获叏上传文件信息
				$info=	$upload->getUploadFileInfo();
			}
			$image	=	$info[0]['savename'];
			$name	=	$_POST['name'];
			$age	=	$_POST['age'];
			if(($card =='v_1')||($card =='v_2')||($card =='v_3')){
			 	$sex=	2;
			}else if(($card =='n_1')||($card =='n_2')||($card =='n_3')){
				$sex=	1;
			}else{
				$sex=	$_POST['sex'];
			}
			if($sex==1){
				$sex=	'男';
			}else if($sex==2){
				$sex=	'女';
			}
			$date	=	date('Y-m-d');
			$code 	=	'0000081';
			// 图片水印方法
			$image_path = ROOT_PATH.'/Www/upload/temp/normal/'.$image; //水印图片
			$image_path2 = ROOT_PATH.'/Www/upload/temp/normal/standards'.$image; //规格化水印图片
			// 将水印图片弄成固定规格
			include('SimpleImage.class.php');
			$images = new SimpleImage();
			$images ->load($image_path);
			$images ->resize(73,85);
			$images ->save($image_path2);
			$oldimage_name = ROOT_PATH.'/Www/Static/home/images/funnyweb/'.$card.'.png'; // 网络证件背景图
			$new_image_name = ROOT_PATH.'/Www/upload/temp/normal/'.$card.$image; // 生成图片
			list($owidth,$oheight) = getimagesize($oldimage_name);
			$width = 500;
			$height = 316;
			$im = imagecreatetruecolor($width, $height);
			$img_src = imagecreatefrompng($oldimage_name);
			imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
			$watermark = imagecreatefromjpeg($image_path2);
			list($w_width, $w_height) = getimagesize($watermark);
			$pos_x = 391;
			$pos_y = 34;
			imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, 73, 85);
			imagejpeg($im, $new_image_name, 100);
			imagedestroy($im);
			
			// 文本水印图片方法
			$font_path1 = ROOT_PATH.'/Www/Static/home/fonts/msyhbd.ttf'; // 微软雅黑粗体
			$font_path2 = ROOT_PATH.'/Www/Static/home/fonts/song.ttf'; // 宋体
			$oldimage_name_font= ROOT_PATH.'/Www/upload/temp/normal/'.$card.$image;
			$new_image_name_font = ROOT_PATH.'/Www/upload/temp/normal/'.$card.'_'.$image;
			list($owidth_font,$oheight_font) = getimagesize($oldimage_name_font);
			$width_font = 500;
			$height_font = 316;
			$image_font = imagecreatetruecolor($width_font, $height_font);
			$image_src = imagecreatefromjpeg($oldimage_name_font);
			imagecopyresampled($image_font, $image_src, 0, 0, 0, 0, $width_font, $height_font, $owidth_font, $oheight_font);
			$black = ImageColorAllocate($image_font, 0,0,0);
			imagettftext($image_font, 10, 0, 322, 53, $black, $font_path1, $name);
			imagettftext($image_font, 10, 0, 322, 80, $black, $font_path1, $sex);
			imagettftext($image_font, 10, 0, 322, 110, $black, $font_path1, $age);
			imagettftext($image_font, 10, 0, 365, 153, $black, $font_path1, $name);
			imagettftext($image_font, 10, 0, 352, 270, $black, $font_path2, $date);
			imagettftext($image_font, 10, 0, 380, 287, $black, $font_path2, $code);
			imagejpeg($image_font, $new_image_name_font, 100);
			imagedestroy($image_font);
			unlink($image_path);
			unlink($image_path2);
			unlink($oldimage_name_font);
			$imgname = $card.'_'.$image;
			$imgname = C(ATTACHMENT_URL).'/temp/normal/'.$imgname;
			exit("<script type='text/javascript'>
			window.parent.sentImgname('2','".$imgname."');
			</script>");
		}elseif($ctype==1){//自定义版本处理
			// 图片上传方法
			//import("ORG.Image");
			import("ORG.Net.image");
			import("ORG.Net.UploadFile");
			$upload = new UploadFile(); // 实例化上传类
			$upload->maxSize = 3145728 ; // 讴置附件上传大小为3M
			$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 讴置附件上传类型
			$upload->savePath = ROOT_PATH.'/Www/upload/temp/diy/'; // 讴置附件上传目录
			if(!$upload->upload()) { // 上传错诣 提示错诣信息
				$this->error($upload->getErrorMsg());
			}else{ // 上传成功 获叏上传文件信息
				$info=	$upload->getUploadFileInfo();
			}
			$card	=	$_POST['title'];
			$unit	=	$_POST['org'];
			$image	=	$info[0]['savename'];
			$name	=	$_POST['name'];
			$age	=	$_POST['age'];
			$sex	=	$_POST['ssex'];
			$content=	$_POST['cont'];
			$str1	=   '兹证明';
			$str2	=   '同志';
			$str3	=   mb_substr($content,0,14,'utf-8');
			$str4	=   mb_substr($content,14,14,'utf-8');
			$str5	=   mb_substr($content,28,14,'utf-8');
			$str6	=   mb_substr($content,42,14,'utf-8');
			$clen	=   mb_strlen($card,'utf-8');
			switch($clen){
				case 1:
					$cleft=105;
					break;
				case 2:
					$cleft=89;
					break;
				case 3:
					$cleft=73;
					break;
				case 4:
					$cleft=57;
					break;
				case 5:
					$cleft=41;
					break;
				default:
					break;
			}
			$ulen	=   mb_strlen($unit,'utf-8');
			switch($ulen){
				case 1:
					$uleft=108;
					break;
				case 2:
					$uleft=101;
					break;
				case 3:
					$uleft=94;
					break;
				case 4:
					$uleft=87;
					break;
				case 5:
					$uleft=80;
					break;
				case 6:
					$uleft=73;
					break;
				case 7:
					$uleft=66;
					break;
				case 8:
					$uleft=59;
					break;
				case 9:
					$uleft=52;
					break;
				case 10:
					$uleft=45;
					break;
				case 11:
					$uleft=38;
					break;
				case 12:
					$uleft=31;
					break;
				default:
					break;
			}
			if($sex==1){
				$sex=	'男';
			}else if($sex==2){
				$sex=	'女';
			}
			$date	=	date('Y-m-d');
			$code 	=	'0000081';
			// 图片水印方法
			$image_path = ROOT_PATH.'/Www/upload/temp/diy/'.$image; //水印图片
			$image_path2 = ROOT_PATH.'/Www/upload/temp/diy/standards'.$image; //规格化水印图片
			$image_path3 = ROOT_PATH.'/Www/Static/home/images/funnyweb/normal_logo.png'; //默认的规格化好的logo图片
			// 将水印图片弄成固定规格
			include('SimpleImage.class.php');
			$images = new SimpleImage();
			$images ->load($image_path);
			$images ->resize(73,85);
			$images ->save($image_path2);
			$oldimage_name = ROOT_PATH.'/Www/Static/home/images/funnyweb/default.png'; // 网络证件背景图
			$new_image_name = ROOT_PATH.'/Www/upload/temp/diy/diy'.$image; // 生成图片
			list($owidth,$oheight) = getimagesize($oldimage_name);
			$width = 500;
			$height = 316;
			$im = imagecreatetruecolor($width, $height);
			$img_src = imagecreatefrompng($oldimage_name);
			imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
			$watermark1 = imagecreatefromjpeg($image_path2);
			$pos_x1 = 391;
			$pos_y1 = 34;
			imagecopy($im, $watermark1, $pos_x1, $pos_y1, 0, 0, 73, 85);
			$watermark2 = imagecreatefrompng($image_path3);
			$pos_x2 = 53;
			$pos_y2 = 34;
			imagecopy($im, $watermark2, $pos_x2, $pos_y2, 0, 0, 156, 156);
			imagejpeg($im, $new_image_name, 100);
			imagedestroy($im);
			
			// 文本水印图片方法
			$font_path1 = ROOT_PATH.'/Www/Static/home/fonts/hydsj.ttf'; // 汉仪大宋简
			$font_path2 = ROOT_PATH.'/Www/Static/home/fonts/msyhbd.ttf'; // 微软雅黑粗体
			$font_path3 = ROOT_PATH.'/Www/Static/home/fonts/msyh.ttf'; // 微软雅黑
			$font_path4 = ROOT_PATH.'/Www/Static/home/fonts/song.ttf'; // 宋体
			$oldimage_name_font= ROOT_PATH.'/Www/upload/temp/diy/diy'.$image;
			$new_image_name_font = ROOT_PATH.'/Www/upload/temp/diy/diy_'.$image;
			list($owidth_font,$oheight_font) = getimagesize($oldimage_name_font);
			$width_font = 500;
			$height_font = 316;
			$image_font = imagecreatetruecolor($width_font, $height_font);
			$image_src = imagecreatefromjpeg($oldimage_name_font);
			imagecopyresampled($image_font, $image_src, 0, 0, 0, 0, $width_font, $height_font, $owidth_font, $oheight_font);
			$black = ImageColorAllocate($image_font, 0,0,0);
			$white = ImageColorAllocate($image_font, 255,255,255);
			
 			imagettftext($image_font, 26, 0, $cleft, 235, $white, $font_path1, $card);
			imagettftext($image_font, 12, 0, $uleft, 265, $white, $font_path1, $unit);
			imagettftext($image_font, 10, 0, 322, 53, $black, $font_path2, $name);
			imagettftext($image_font, 10, 0, 322, 80, $black, $font_path2, $sex);
			imagettftext($image_font, 10, 0, 322, 110, $black, $font_path2, $age);
			imagettftext($image_font, 10, 0, 345, 145, $black, $font_path2, $name);
			
			imagettftext($image_font, 10, 0, 290, 145, $black, $font_path3, $str1);
			imagettftext($image_font, 10, 0, 425, 145, $black, $font_path3, $str2);
			imagettftext($image_font, 10, 0, 273, 165, $black, $font_path3, $str3);
			imagettftext($image_font, 10, 0, 273, 185, $black, $font_path3, $str4);
			imagettftext($image_font, 10, 0, 273, 205, $black, $font_path3, $str5);
			imagettftext($image_font, 10, 0, 273, 225, $black, $font_path3, $str6);
			
			imagettftext($image_font, 10, 0, 350, 270, $black, $font_path4, $date);
			imagettftext($image_font, 10, 0, 380, 290, $black, $font_path4, $code);
			imagejpeg($image_font, $new_image_name_font, 100);
			imagedestroy();
			unlink($image_path);
			unlink($image_path2);
			unlink($oldimage_name_font);
			$imgname = 'diy_'.$image;
			$imgname = C(ATTACHMENT_URL).'/temp/diy/'.$imgname;
			exit("<script type='text/javascript'>
			window.parent.sentImgname('1','".$imgname."');
			</script>");
		}elseif($ctype==3){//结婚版本处理
			$card   =   $_POST['card'];
			if($card=='结婚证'){
				$card='a_4';
			}
			// 图片上传方法
			import("ORG.Net.UploadFile");
			$upload = new UploadFile(); // 实例化上传类
			$upload->maxSize = 3145728 ; // 讴置附件上传大小为3M
			$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 讴置附件上传类型
			$upload->savePath = ROOT_PATH.'/Www/upload/temp/marry/'; // 讴置附件上传目录
			if(!$upload->upload()) { // 上传错诣 提示错诣信息
				$this->error($upload->getErrorMsg());
			}else{ // 上传成功 获叏上传文件信息
				$info=	$upload->getUploadFileInfo();
			}
			$image1	=	$info[0]['savename'];
			$image2	=	$info[1]['savename'];
			$name1	=	$_POST['namem'];
			$age1	=	$_POST['agem'];
			$name2	=	$_POST['namef'];
			$age2	=	$_POST['agef'];
			$date	=	date('Y-m-d');
			$code 	=	'0000081';
			// 图片水印方法
			$image_path1 = ROOT_PATH.'/Www/upload/temp/marry/'.$image1; //水印图片
			$image_path3 = ROOT_PATH.'/Www/upload/temp/marry/standards'.$image1; //规格化水印图片
			$image_path2 = ROOT_PATH.'/Www/upload/temp/marry/'.$image2; //水印图片
			$image_path4 = ROOT_PATH.'/Www/upload/temp/marry/standards'.$image2; //规格化水印图片
			// 将水印图片弄成固定规格
			include('SimpleImage.class.php');
			$images1 = new SimpleImage();
			$images1 ->load($image_path1);
			$images1 ->resize(73,85);
			$images1 ->save($image_path3);
			
			$images2 = new SimpleImage();
			$images2 ->load($image_path2);
			$images2 ->resize(73,85);
			$images2 ->save($image_path4);
			
			$oldimage_name = ROOT_PATH.'/Www/Static/home/images/funnyweb/marry.png'; // 网络证件背景图
			$new_image_name = ROOT_PATH.'/Www/upload/temp/marry/marry'.$image1; // 生成图片
			list($owidth,$oheight) = getimagesize($oldimage_name);
			$width = 500;
			$height = 316;
			$im = imagecreatetruecolor($width, $height);
			$img_src = imagecreatefrompng($oldimage_name);
			imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
			$watermark1 = imagecreatefromjpeg($image_path3);
			$pos_x1 = 268;
			$pos_y1 = 107;
			imagecopy($im, $watermark1, $pos_x1, $pos_y1, 0, 0, 73, 85);
			
			$watermark2 = imagecreatefromjpeg($image_path4);
			$pos_x2 = 340;
			$pos_y2 = 107;
			imagecopy($im, $watermark2, $pos_x2, $pos_y2, 0, 0, 73, 85);
			imagejpeg($im, $new_image_name, 100);
			imagedestroy($im);
			
			// 文本水印图片方法
			$font_path1 = ROOT_PATH.'/Www/Static/home/fonts/msyhbd.ttf'; // 微软雅黑粗体
			$font_path2 = ROOT_PATH.'/Www/Static/home/fonts/song.ttf'; // 宋体
			$oldimage_name_font= ROOT_PATH.'/Www/upload/temp/marry/marry'.$image1;
			$new_image_name_font = ROOT_PATH.'/Www/upload/temp/marry/marry_'.$image1;
			list($owidth_font,$oheight_font) = getimagesize($oldimage_name_font);
			$width_font = 500;
			$height_font = 316;
			$image_font = imagecreatetruecolor($width_font, $height_font);
			$image_src = imagecreatefromjpeg($oldimage_name_font);
			imagecopyresampled($image_font, $image_src, 0, 0, 0, 0, $width_font, $height_font, $owidth_font, $oheight_font);
			$black = ImageColorAllocate($image_font, 0,0,0);
			imagettftext($image_font, 10, 0, 141, 114, $black, $font_path1, $name1);
			imagettftext($image_font, 10, 0, 141, 135, $black, $font_path1, $age1);
			imagettftext($image_font, 10, 0, 141, 161, $black, $font_path1, $name2);
			imagettftext($image_font, 10, 0, 141, 182, $black, $font_path1, $age2);
			imagettftext($image_font, 10, 0, 54,  217, $black, $font_path1, $name1);
			imagettftext($image_font, 10, 0, 142, 217, $black, $font_path1, $name2);
			imagettftext($image_font, 10, 0, 361, 262, $black, $font_path2, $date);
			imagettftext($image_font, 10, 0, 392, 280, $black, $font_path2, $code);
			imagejpeg($image_font, $new_image_name_font, 100);
			imagedestroy();
			unlink($image_path1);
			unlink($image_path2);
			unlink($image_path3);
			unlink($image_path4);
			unlink($oldimage_name_font);
			$imgname = 'marry_'.$image1;
			$imgname = C(ATTACHMENT_URL).'/temp/marry/'.$imgname;
			exit("<script type='text/javascript'>
			window.parent.sentImgname('3','".$imgname."');
			</script>");
		}elseif($ctype==4){//奖状版本处理
			$card   =   $_POST['title'];
			if($card=='最佳好老婆'){
				$card='v_4';
			}else if($card=='最佳好老公'){
				$card='n_4';
			}
			$card='v_4';
			$name	=	$_POST['name'];
			$date	=	date('Y-m-d');
			$code	=	'0000081';
			$time   =   time();
			// 文本水印图片方法
			$this->mkdirs(ROOT_PATH.'/Www/upload/temp/award/',0777); //判断是否存在该文件夹，不存在则创建
			$font_path1 = ROOT_PATH.'/Www/Static/home/fonts/msyhbd.ttf'; // 微软雅黑粗体
			$font_path2 = ROOT_PATH.'/Www/Static/home/fonts/song.ttf'; // 宋体
			$bg_image = ROOT_PATH.'/Www/Static/home/images/funnyweb/'.$card.'.png'; // 网络证件背景图
			$new_image = ROOT_PATH.'/Www/upload/temp/award/'.$card.$time.'.png';      // 生成图片
			list($owidth_font,$oheight_font) = getimagesize($bg_image);
			$width_font = 500;
			$height_font = 316;
			$image_font = imagecreatetruecolor($width_font, $height_font);
			$image_src = imagecreatefrompng($bg_image);
			imagecopyresampled($image_font, $image_src, 0, 0, 0, 0, $width_font, $height_font, $owidth_font, $oheight_font);
			$black = ImageColorAllocate($image_font, 0,0,0);
			imagettftext($image_font, 12, 0, 175, 150, $black, $font_path1, $name);
			imagettftext($image_font, 10, 0, 315, 227, $black, $font_path2, $date);
			imagettftext($image_font, 10, 0, 345, 242, $black, $font_path2, $code);
			imagejpeg($image_font, $new_image, 100);
			imagedestroy($image_font);
			
			$imgname = $card.$time.'.png';
			$imgname = C(ATTACHMENT_URL).'/temp/award/'.$imgname;
			exit("<script type='text/javascript'>
			window.parent.sentImgname('4','".$imgname."');
			</script>");
		}
		$this->display();
	}
	/**
	 * 文件删除功能
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-8-2 下午3:07:01
	 * @param unknown $dir
	 * @return boolean
	 */
	function deldir($dir){
		$dh = opendir($dir);
		while($file = readdir($dh)){
			if($file != "." && $file != ".."){
				$fullpath = $dir . "/" . $file;
				if(!is_dir($fullpath)){
					unlink($fullpath);
				}else{
					deldir($fullpath);
				}
			}
		}
		closedir($dh);
		if(rmdir($dir)){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * 判断是否存在文件夹，不存在则创建
	 *
	 * @author Xieyihong <305095253@qq.com>
	 * @CreateDate: 2013-8-7 下午4:41:11
	 * @param unknown $dir
	 * @param number $mode
	 * @return boolean
	 */
	function mkdirs($dir,$mode=0777){
		if(is_dir($dir)||@mkdir($dir,$mode)){
			return true;
		}
		if(!mkdirs(dirname($dir),$mode)){
			return false;
		}
		return @mkdir($dir,$mode);
	}
}